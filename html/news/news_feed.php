<?php
session_start();

//Includes von Funktionen
include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/functions.php");


//Variablen initialisieren



// connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

//Checken ob Nutzer angemeldet
if ( nutzer_angemeldet() ){
	//hier werden alle Daten in einer Tabelle angezeigt

        //Laden der Relevanten Daten
        $query = "SELECT * FROM news";
	$result = mysqli_query($db, $query);
	if ($result->num_rows > 0) {
		//Es wurden einträge gefunden

		//Aufbauen der Tabelle
		echo "<table border='1'><tbody>";
		//Einzelne Zeilen einfügen
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr><td>" . $row["title"] . "</td><tr>";
			echo "<tr><td>" . $row["date"] . "</td><tr>";
			echo "<tr><td>" . $row["message"] . "</td><tr>";
			echo "<tr><td></td><tr>";
		}
		echo "</tbody></table>";
	} else {
	echo "<p> Es wurden keine Nachrichten gefunden</p>";
	}
} else {
	echo "<p> Noch nicht angemeldet</p>";
}

?>
