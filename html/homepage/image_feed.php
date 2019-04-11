<?php
session_start();

//Includes von Funktionen
include("functions.php"); 

//initialisierung von Variablen
$userID = "";

//connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

//Checken ob Nutzer angemeldet
if ( nutzer_angemeldet() ){
	//Hier werden alle Daten in einer Tabelle angezeigt

	//Laden der Relevanten Daten
	$query = "SELECT * FROM images";
	$result = mysqli_query($db, $query);
	//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	//If == true ? noch keine möglichkeit der Abfrage gefunden
if ( True ) {
		//Es wurden Bilder gefunden

		//Aufbauen der Tabelle
		echo "<table><tbody>";
		//Einzelne Zeilen einfügen
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td><img src=" . $row["ImageDir"] . " alt='Bild nicht verfügbar.'></td>";
			echo "</tr>";
		}
		echo "</tbody></table>";
	} else {
		//Es wurden keine Bilder gefunden
		//Hier kann eine schönere Ausgabe erfolgen
		echo "Es sind noch keine Bilder hochgeladen worden.";
	}

} else {
	//Hier kann mit echo etwas zurückgegeben werden
	//Ich selber habe mich bewusst dagegen entschieden, da dieser Code sich einfach versteckt, wenn er nicht angemeldet ist (einbetten in eine Webseite)
	echo "Nicht angemeldet";
}

?>
