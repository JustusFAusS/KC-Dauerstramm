<?php
session_start();

//Diese Klasse behandelt alle Methoden zum editieren der Events
//Methode		Beschreibung							Parameter
//add_event		Fügt event hinzu					$event_title $newformat $event_message
//delete_event Löscht ein Events				eventid

//Funktionen importieren
include($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/notifications.php");

//Globale Variablen
//Weiterleitung nach erfolg führt zu dieser Seite
$success_page = 'location: /KCD/html/calendar/index.php';
$failure_page = 'location: /KCD/html/claendar/add_event.php';
//Weiterleitung nach fehlendem Login führt zu dieser Seite
$no_login_page = 'location: /KCD/html	/registrationAndLogin/login.php';
//Datenbank
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');
//Hier werden die Fehler hinterlegt
$errors = array();
$success = array();

//Nutzer angemeldet?
if (nutzer_angemeldet()) {
	if(isset($_POST['add_event'])){
		//Methode zum hinzufügen gewählt
		$event_title = mysqli_real_escape_string($db, htmlspecialchars($_POST['title']));
		$event_date = mysqli_real_escape_string($db, $_POST['date']);
		$event_message = mysqli_real_escape_string($db, htmlspecialchars($_POST['message']));
		if (empty($event_title)) { array_push($errors,'Bitte geben Sie einen Titel der Nachricht an.'); }
		$time = strtotime($event_date);
		$newformat = date('Y-m-d',$time);
		if (empty($newformat)) {array_push($errors, 'Bitte geben Sie ein gültiges Datum an.');}
		if (empty($event_message)) { array_push($errors,'Die eigentliche Nachricht ist leer. Bitte geben Sie einen Text an.'); }

		//Anzahl der Fehler prüfen
		if (count($errors) == 0) {
			$new_event_query = "INSERT INTO events (name,date,description,uploadedby) VALUES ('$event_title','$newformat','$event_message','" . get_userid_by_username($_SESSION['username']) . "');";
			mysqli_query($db, $new_event_query);
			//Daten eingetragen
			header($success_page);
		}
	}
	if (isset($_POST['delete_event'])) {
	    //Hier können images kommentiert werden
	    if (nutzer_angemeldet()) {
	            $getMatchedEvents = "SELECT * from events where EventID='" . $_GET['eventid'] . "';";
			    //Query ausführen und anschließend in ein Array umwandeln
			    $result = mysqli_query($db, $getMatchedEvents);
			    $found_events = mysqli_fetch_array($result,MYSQLI_ASSOC);
	            //Wurde eine Nutzer-ID gefunden?
			    if (isset($found_events)) {
	                    //Aktuelle Nutzer-ID
	                    $actual_user_id = get_userid_by_username($_SESSION['username']);
	                    //Hat der Nutzer Admin-Rechte?
	                    $is_admin = checkAdminPermissions($actual_user_id,$db);
	                    if(($found_events['UploadedBy'] == $actual_user_id) || $is_admin)
	                    {
                        // Hier kann das Bild nun entfernt werden
                        $del_comments_queue = "DELETE FROM events WHERE EventID = '". $_GET['eventid'] . "';";
                        if (mysqli_query($db, $del_comments_queue) == 1) {
													  $delete_success = true;
														array_push($success,"Der Termin wurde erfolgreich gelöscht.");
														// header($success_page);
                        }else {
																array_push($errors, "Fehler: Der Termin konnte nicht aus der Datenbank gelöscht werden. Bitte wenden Sie sich an Ihren Administrator!");
															}
	                    }else {
	                        array_push($errors, "Fehler: Sie haben nicht die nötigen Rechte für diesen Vorgang!");
												}
	            }else {
	                array_push($errors, "Fehler: Der zu löschende Termin existiert nicht!");
	            }
	    } else {
	        array_push($errors, "Fehler: Sie sind nicht angemeldet");
	    }
	}
} else {
	header($no_login_page);
}
?>
