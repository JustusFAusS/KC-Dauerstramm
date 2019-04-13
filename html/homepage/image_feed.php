<?php 
//session_start();

//Includes von Funktionen
include_once("functions.php"); 

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
	if ($result->num_rows > 0) {
		//Es wurden Bilder gefunden

		//Aufbauen der Tabelle
		echo "<table border='1'><tbody>";
		//Einzelne Zeilen einfügen
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td><img src='" . $row["ImageDir"] . "' alt='Bild nicht verfügbar.' width='150' height='100'></td>";
			echo "<td>" . $row["ImageTitle"] . $row["ImageID"] . "</td>";
			echo "<td>" . $row["ImageComment"] . "</td>";
			echo "<td>" . get_user_by_id($row["UploadedBy"]) . "</td>";
			echo "</tr>";
			//Kommentare laden
			$query_get_comments = "SELECT * FROM imageComments INNER JOIN images ON images.ImageID = imageComments.imageID WHERE imageComments.imageID = " . $row["ImageID"] . ";";
			$comments_result = mysqli_query($db, $query_get_comments);
			//Sind kommentare vorhanden?
			if ($comments_result->num_rows > 0) {
				echo "<tr><td>" . "Kommentare:" . "</td></tr>";
				//Kommentare einblenden
				while($comment_row = mysqli_fetch_assoc($comments_result)){
					echo "<tr><td>" . $comment_row["message"] . "</td></tr>";
					echo "<tr><td>" . get_user_by_id($comment_row["creationUserID"]) . "</td></tr>";
				}
			} 
			echo "<tr><td>Kommentar verfassen</td></tr>";
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
