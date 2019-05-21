<?php
session_start();

//Diese Klasse behandelt alle Methoden zum editieren der Events
//Methode		Beschreibung							Parameter
//add_event		Fügt event hinzu							new_title,new_event,new_message

//Funktionen importieren
include($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/homepage/functions.php");

//Globale Variablen
//Weiterleitung nach erfolg führt zu dieser Seite
$success_page = 'location: /KCD/html/calender/index.php';
//Weiterleitung nach fehlendem Login führt zu dieser Seite
$no_login_page = 'location: html/registrationAndLogin/login.php';
//Datenbank
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');
//Hier werden die Fehler hinterlegt
$errors = array();


//Nutzer angemeldet?
if (nutzer_angemeldet()) {
	if(isset($_POST['add_event'])){
		//Methode zum hinzufügen gewählt
		$new_event_title = mysqli_real_escape_string($db, $_POST['new_title']);
		$new_event_date = mysqli_real_escape_string($db, $_POST['new_date']);
		$new_event_message = mysqli_real_escape_string($db, $_POST['new_message']);
		if (empty($new_news_title)) { array_push($errors,'Bitte geben Sie einen Titel der Nachricht an.'); }
		$time = strtotime($new_event_date);
		$newformat = date('Y-m-d',$time);
		if (empty($newformat)) {array_push($errors, 'Bitte geben Sie ein gültiges Datum an.');}
		if (empty($new_news_message)) { array_push($errors,'Die eigentliche Nachricht ist leer. Bitte geben Sie einen Text an.'); }

		//Anzahl der Fehler prüfen
		if (count($errors) == 0) {
			$new_event_query = "INSERT INTO events (name,datum,beschreibung) VALUES ('$new_news_title','$newformat','$new_news_message');";
			mysqli_query($db, $new_event_query);
			//Daten eingetragen
			header($success_page);
		}
	}

} else {
	header($no_login_page);
}

?>