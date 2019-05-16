<?php
//session_start();

//Includes von Funktionen
include_once("functions.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/uploadImage/service_upload_image.php");

//initialisierung von Variablen
$userID = "";
start_session();

//connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

//Checken ob Nutzer angemeldet
if ( nutzer_angemeldet() ){
	//Hier werden alle Daten in einer Tabelle angezeigt

	//Laden der Relevanten Daten
	$query = "SELECT * FROM images ORDER BY UploadedAt DESC";
	$result = mysqli_query($db, $query);
	//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	//If == true ? noch keine möglichkeit der Abfrage gefunden
	if ($result->num_rows > 0) {
		//Es wurden Bilder gefunden

		//Aufbauen der Tabelle
		//echo "<table border='0'><tbody>";
		//Einzelne Zeilen einfügen
        $num_image = 0;
        //Das erste Bild einer Zeile
        echo '<div class="row mb-3">';
		while($row = mysqli_fetch_assoc($result)){
            if ($num_image % 3 == 0)
            {
                //Das erste Bild einer Zeile
                echo '<div class="row mb-3">';
            }
            
            //echo "<div class='img-thumbnail mt-3 mb-3'>";
            // Bild kann immmer eingefügt werden
            echo "<div class='col-sm-4'><a href='" . $row["ImageDir"] . "'>";
            echo "<img src='" . $row["ImageDir"] . "'alt='Bild nicht verfügbar' class='img-thumbnail rounded'>";
            echo "</a></div>";
            //echo "</div>";
            if ($num_image % 3 == 2)
            {
                //Das letzte Bild einer Zeile
                echo "</div>";
            }
            $num_image = $num_image + 1;
		}
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
