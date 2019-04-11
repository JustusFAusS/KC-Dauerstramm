<?php
session_start();

//Diese Klasse behandelt alle Methoden zum editieren der News
//Methode		Beschreibung							Parameter
//add_news		Fügt news hinzu							new_title,new_message

//Funktionen importieren
include($_SERVER['DOCUMENT_ROOT'] . "/html/homepage/functions.php"); 

//Globale Variablen
//Weiterleitung nach erfolg führt zu dieser Seite
$success_page = 'location: /html/homepage/index.php';
//Weiterleitung nach fehlendem Login führt zu dieser Seite
$no_login_page = 'location: html/registrationAndLogin/login.php';
//Datenbank
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');
//Hier werden die Fehler hinterlegt
$errors = array(); 


//Nutzer angemeldet?
if (nutzer_angemeldet()) {
	if(isset($_POST['add_news'])){
		//Methode zum hinzufügen gewählt
		$new_news_title = mysqli_real_escape_string($db, $_POST['new_title']);
		$new_news_message = mysqli_real_escape_string($db, $_POST['new_message']);
		if (empty($new_news_title)) { array_push($errors,'Bitte geben Sie einen Titel der Nachricht an.'); }
		if (empty($new_news_message)) { array_push($errors,'Die eigentliche Nachricht ist leer. Bitte geben Sie einen Text an.'); }

		//Anzahl der Fehler prüfen
		if (count($errors) == 0) {
			$new_news_query = "INSERT INTO news (title,message,date) VALUES ('$new_news_title','$new_news_message',NOW());";
			mysqli_query($db, $new_news_query);
			//Daten eingetragen
			header($success_page);
		}
	}

} else {
	header($no_login_page);
}

?>
