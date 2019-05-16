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

	//Laden der Relevanten Daten -- NUR DIE ERSTEN 5 FÜR DIE HOMEPAGE --
	$query = "SELECT * FROM images ORDER BY UploadedAt DESC LIMIT 3";
	$result = mysqli_query($db, $query);
	//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	//If == true ? noch keine möglichkeit der Abfrage gefunden
	if ($result->num_rows > 0) {
		//Es wurden Bilder gefunden

        //Aktuelle Nutzer-ID
        $actual_user_id = get_userid_by_username($_SESSION['username']);
        //Hat der Nutzer Admin-Rechte?
        $is_admin = checkAdminPermissions($actual_user_id,$db);

		//Aufbauen der Tabelle
		//echo "<table border='0'><tbody>";
		//Einzelne Zeilen einfügen
		while($row = mysqli_fetch_assoc($result) ){
			//echo "<tr>";
            echo "<div class='img-thumbnail mt-3 mb-3'>";
                echo '<div class="row">';
                    echo "<div class='col-sm-5'><a href='" . $row["ImageDir"] . "'>";
                    echo "<img src='" . $row["ImageDir"] . "'alt='Bild nicht verfügbar' class='img-thumbnail rounded'>";
                    echo "</a></div>";
                    echo "<div class='col-sm-7'>";
                        echo '<div class="row">';
                            echo "<div class='col-sm-12'><h3>" . $row["ImageTitle"] . "</h3></div>";
                        echo "</div>";
                        echo '<div class="row">';
                            echo "<div class='col-sm-12'>" .  $row["ImageComment"] . "</div>";
	                    echo "</div>";
                        echo '<div class="row">';
                            echo '<div class="col-sm-12"><p class="text-secondary">' . get_user_by_id($row["UploadedBy"]) . "</p></div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
			    //Kommentare laden
			    $query_get_comments = "SELECT * FROM imagecomments INNER JOIN images ON images.ImageID = imagecomments.imageID WHERE imagecomments.imageID = " . $row["ImageID"] . ";";
			    $comments_result = mysqli_query($db, $query_get_comments);
			    //Sind kommentare vorhanden?
			    if ($comments_result->num_rows > 0) {
                    echo "<div class='img-thumbnail m-1'>";
                        echo '<div class="row">';
				            echo "<div class='col-sm-12'>" . "Kommentare:" . "</div>";
                        echo '</div>';
				        //Kommentare einblenden
				        while($comment_row = mysqli_fetch_assoc($comments_result)){
                            echo "<div class='img-thumbnail m-1'>";
                                echo "<div class='row'>";
					                echo "<div class='col-sm-12'>" . $comment_row["message"] . "</div>";
                                echo '</div>';
                                echo "<div class='row'>";
					                echo "<div class='col-sm-12'><p class='text-secondary'>" . get_user_by_id($comment_row["creationUserID"]) . "</p></div>";
                                echo '</div>';
                            echo "</div>";
                        }
                    echo '<div class="row">';
                    echo "<div class='col-sm-10'>";
                    echo '<form action="/KCD/html/uploadImage/comment_image.php?imageid=' . $row['ImageID'] . '" method="post">';
                    echo "<button type='submit' class='btn btn-light ml-1' data-toggle='modal' data-target='#ModalImage" . $row['ImageID'] . "'>Kommentar verfassen</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "<div class='col-sm-2'>";
                    //Wenn der Nutzer das Bild erstellt hat, dann kann er dieses Bild auch wieder löschen
                    //Administratoren können das immer machen 
                    if (($actual_user_id == $row['UploadedBy']) || $is_admin)
                    {
                        echo '<form action="/KCD/html/uploadImage/delete_image.php?imageid=' . $row['ImageID'] . '" method="post">';
                        echo "<button type='submit' class='btn btn-danger mr-1 pull-right'>Löschen</button>";
                        echo "</form>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
			    } else {
                    //Hier nochmal, da der Button in dem Rahmen bleiben soll. Aber nur, wenn kommentare existieren
                    echo '<div class="row">';
                    echo "<div class='col-sm-10'>";
                    echo '<form action="/KCD/html/uploadImage/comment_image.php?imageid=' . $row['ImageID'] . '" method="post">';
                    echo "<button type='submit' class='btn btn-light ml-1' data-toggle='modal' data-target='#ModalImage" . $row['ImageID'] . "'>Kommentar verfassen</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "<div class='col-sm-2'>";
                    //Wenn der Nutzer das Bild erstellt hat, dann kann er dieses Bild auch wieder löschen
                    //Administratoren können das immer machen 
                    if (($actual_user_id == $row['UploadedBy']) || $is_admin)
                    {
                        echo '<form action="/KCD/html/uploadImage/delete_image.php?imageid=' . $row['ImageID'] . '" method="post">';
                        echo "<button type='submit' class='btn btn-danger mr-1 pull-right'>Löschen</button>";
                        echo "</form>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
            echo "</div>";
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
