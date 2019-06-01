<!DOCTYPE html>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/functions.php');
start_session();

//Funktionen, die hier verwendet werden
function endsWith($string, $endString) 
{ 
    $len = strlen($endString); 
    if ($len == 0) { 
        return true; 
    } 
    return (substr($string, -$len) === $endString); 
}

function codeToMessage($code) 
    { 
        switch ($code) { 
            case UPLOAD_ERR_INI_SIZE: 
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
                break; 
            case UPLOAD_ERR_FORM_SIZE: 
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
                break; 
            case UPLOAD_ERR_PARTIAL: 
                $message = "The uploaded file was only partially uploaded"; 
                break; 
            case UPLOAD_ERR_NO_FILE: 
                $message = "No file was uploaded"; 
                break; 
            case UPLOAD_ERR_NO_TMP_DIR: 
                $message = "Missing a temporary folder"; 
                break; 
            case UPLOAD_ERR_CANT_WRITE: 
                $message = "Failed to write file to disk"; 
                break; 
            case UPLOAD_ERR_EXTENSION: 
                $message = "File upload stopped by extension"; 
                break; 

            default: 
                $message = "Unknown upload error (or no error)"; 
                break; 
        } 
        return $message; 
    } 


// initializing variables
// diese Variablen wird das Errors.php-Skript verwenden
$errors = array();
$success = array();
if (isset($delete_success) == false)
{
    $delete_success = false;
}
//Welche Seite nach Erfolg aufgerufen werden soll
$pathAfterSuccess = "location: /KCD/index.php";

// connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

//Hier wird die Methode abgefragt
if (isset($_POST['save_image'])) {
	//Pfad des Bildes auf der Platte (nur zum speichern)
    $Server_Root = $_SERVER['DOCUMENT_ROOT'];
    //Manchmal endet dieser Pfad auf einem Slash, manchmal nicht. Um diese Varianz auszugleichen, habe ich hier diese Methode eingefügt
    if (endsWith($Server_Root, "/") == false)
    {
        $Server_Root = $Server_Root . "/";
    }
	$target_dir = $Server_Root . "KCD/resources/images/uploadedImages/";
	$basename = basename($_FILES["fileToUpload"]["name"]);
	//Hier wird ein zufälliger Hash generiert. Dadurch können gleiche Dateinamen öfter hochgeladen werden.
	$target_name = md5(rand() . $basename);
	$imageFileType = strtolower(pathinfo($basename,PATHINFO_EXTENSION));
	//Hier wird einfach der Dateiname ausgelesen (mit Endung)
	$target_file = $target_dir . $target_name . "." . $imageFileType;

	//Dieser Pfad wird in der DB hinterlegt werden. Damit die Datei nicht mit dem Server Root-Path korolliert fehlt dieser
	//Er muss anschließend ermittelt werden.
	$target_dir_withoutRootFolder = "/KCD/resources/images/uploadedImages/" . $target_name . "." . $imageFileType;

	//Auslesen der Parameter
	$target_title = $_POST['title'];
	$target_comment = $_POST['comment'];
    $uploadOk = 1;
	//Nutzer-Login Checken
	//Nutzer angemeldet?
        if (isset($_SESSION['username'])) {
            //File temporär speichern
            $uploades_file = $_FILES["fileToUpload"]["tmp_name"];
            if ($_FILES['fileToUpload']['error'] == 0)
            {
                if (file_exists($uploades_file))
                {
		            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            		if($check !== false) {
                		//kein Error-Handling notwendig
                		$uploadOk = 1;
            		} else {
                        if ($uploadOk == 1) {
                		    array_push($errors, "Die Datei ist kein gültiges Bild.");
                        }
                		$uploadOk = 0;
            		}
                } else {
                    array_push($errors, "Die hochgeladenen Daten können nicht verarbeitet werden. Bitte versuchen Sie es erneut. (Dateifehler)");
                    $uploadOk = 0;
                }
            } else {
                array_push($errors, "Es ist ein Interner Fehler beim Upload des Files aufgetreten.");
                if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_INI_SIZE)
                {
                    $max_upload = min(ini_get('post_max_size'), ini_get('upload_max_filesize'));
                    array_push($errors, "Die Datei ist zu groß. Es können nur Bilder mit einer Größe unter " . $max_upload . " liegen");
                } else {
                    array_push($errors,  codeToMessage($_FILES['fileToUpload']['error']));
                }
                $uploadOk = 0;
            }
		//Existiert das Bild schon?
		if (file_exists($target_file) && $uploadOk == 1) {

			array_push($errors, "Die Datei existiert schon auf dem Server. Bitte versuchen Sie es erneut.");
			$uploadOk = 0;
		}

		//Bildgrösse überprüfen
		if ($_FILES["fileToUpload"]["size"] > 12000000 && $uploadOk == 1) {
    			array_push($errors, "Das Bild ist zu groß. Bitte laden Sie ein kleineres Bild hoch.");
    			$uploadOk = 0;
		}

		//Formate aussortieren
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $uploadOk == 1) {
    			array_push($errors,"Das Bild hat ein falsches Format. Nur JPG, JPEG, PNG & GIF sind erlaubt.");
    			$uploadOk = 0;
		}

		//Unbekannte Fehler?
		if ($uploadOk == 0) {
			array_push($errors,"Der upload wurde abgebrochen!");
		} else {
			//Speichern des Bildes
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        		//Erfolgreich hochgeladen
				//Speichern in der Datenbank
				//Nutzer aus DB holen
				$getUserIDQuery = "SELECT id from users where username = '". $_SESSION['username'] ."';";
				//Query ausführen und anschließend in ein Array umwandeln
				$result = mysqli_query($db, $getUserIDQuery);
				$user_id = mysqli_fetch_array($result,MYSQLI_ASSOC);
				//Wurde eine Nutzer-ID gefunden?
				if (isset($user_id)) {
					//Daten in die DB schreiben
					//Hier wird das Feld ausgesucht (in diesem Fall die ID)
					$full_id = $user_id["id"];
					$query = "INSERT INTO images (ImageDir,ImageTitle,ImageComment,UploadedAt,UploadedBy) VALUES ('$target_dir_withoutRootFolder','$target_title','$target_comment',NOW(),'$full_id');";
					mysqli_query($db, $query);
					$_SESSION['success'] = "Das Bild wurde hochgeladen";
                                        
				} else {
					array_push($errors,"Fehler bei der Abfrage. Kein Nutzer gefunden.");
				}
			} else {
        			array_push($errors,"Es ist ein unbekannter Fehler aufgetreten (IO-Fehler). Bitte versuchen Sie es erneut. Genauere Fehleranalyse: " . $_FILES["fileToUpload"]["error"]);    
                    if (!is_writeable($target_file)) {
                        array_push($errors,"Zudem kann in das Verzeichnis nicht geschrieben werden...");
                        array_push($errors,"Ziel:" . $target_file);
                        array_push($errors,"Quelle:" . $_FILES["fileToUpload"]["tmp_name"]);
                    }
                    if(is_dir($target_dir)) {
                        array_push($errors,"Der Übergebene Pfad ist unter Windows kein Ordner");
                        array_push($errors,"Übergebener Pfad ist:" .$target_dir);
                    }
                    if(is_writable($target_dir)) {
                        array_push($errors,"Ist ein Pfad. Leider hat der Server keine Berechtigung um in den Ordner zu schreiben [ARGH]");
                        array_push($errors,"Übergebener Pfad ist:" .$target_dir);
                    }
    			}
        	}
		//Nach erfolg an die Homepage verweisen
		if (count($errors) == 0) {
			header($pathAfterSuccess);
		}
	} else {
		array_push($errors, "Fehler: Nicht angemeldet!");
	}
}

if (isset($_POST['comment_image'])) {
    //Hier können images kommentiert werden
    if (nutzer_angemeldet()) {
        if (isset($_GET['imageid'])) {
		    $getMatchedImages = "SELECT * from images where ImageID='" . $_GET['imageid'] . "';";
		    //Query ausführen und anschließend in ein Array umwandeln
		    $result = mysqli_query($db, $getMatchedImages);
		    $found_images = mysqli_fetch_array($result,MYSQLI_ASSOC);
            //Wurde eine Nutzer-ID gefunden?
		    if (isset($found_images)) {
                $query = "INSERT INTO `imagecomments`(`imageID`, `message`, `creationdate`, `creationUserID`) VALUES ('" . $_GET['imageid'] . "','" . $_POST["comment_image_comment"] . "',NOW(),'" . get_userid_by_username($_SESSION['username']) . "');";
                mysqli_query($db, $query);
                header($pathAfterSuccess);
            } else {
                array_push($errors, "Fehler: Das zu kommentierende Bild existiert nicht!");
            }
        }
    } else {
        array_push($errors, "Fehler: Sie sind nicht angemeldet");
    }

}

if (isset($_POST['delete_image'])) {
    //Hier können images kommentiert werden
    if (nutzer_angemeldet()) {
            $getMatchedImages = "SELECT * from images where ImageID='" . $_GET['imageid'] . "';";
		    //Query ausführen und anschließend in ein Array umwandeln
		    $result = mysqli_query($db, $getMatchedImages);
		    $found_images = mysqli_fetch_array($result,MYSQLI_ASSOC);
            //Wurde eine Nutzer-ID gefunden?
		    if (isset($found_images)) {
                    //Aktuelle Nutzer-ID
                    $actual_user_id = get_userid_by_username($_SESSION['username']);
                    //Hat der Nutzer Admin-Rechte?
                    $is_admin = checkAdminPermissions($actual_user_id,$db);
                    if(($found_images['UploadedBy'] == $actual_user_id) || $is_admin)
                    {
                        // Hier kann das Bild nun entfernt werden
                        // Es wird damit begonnen alle Kommentare zu löschen
                        $del_comments_queue = "DELETE FROM imagecomments WHERE imageID = '". $found_images['ImageID'] . "';";
                        if (mysqli_query($db, $del_comments_queue) == 1) {
                            //Nun müssen die Ressourcen freigegeben werden
                            if (unlink($_SERVER['DOCUMENT_ROOT'] . $found_images['ImageDir']) == 1)
                            {
                                //Nun muss das Bild aus der DB gänzlich entfernt werden
                                $del_comments_queue = "DELETE FROM images WHERE ImageID = '". $found_images['ImageID'] . "';";
                                if (mysqli_query($db, $del_comments_queue) == 1) {
                                    array_push($success,"Das bild wurde erfolgreich gelöscht. Sie können diese Seite nun schließen");
                                    //Setzen einer Erfolgsvariable, damit die Form den Button ausblenden kann
                                    $delete_success = true;
                                } else {
                                    array_push($errors, "Fehler: Das Bild konnte nicht aus der Datenbank gelöscht werden. Bitte wenden Sie sich an Ihren Administrator!");
                                }
                            } else {
                                array_push($errors, "Fehler: Ressourcen konnten nicht gelöscht werden. Bitte wenden Sie sich an Ihren Administrator");
                            }
                        } else {
                            array_push($errors, "Fehler: Kommentare konnten nicht gelöscht werden. Bitte wenden Sie sich an Ihren Administrator");
                        }
                    } else {
                        array_push($errors, "Fehler: Sie haben nicht die nötigen Rechte für diesen Vorgang!");
                    }
            } else {
                array_push($errors, "Fehler: Das zu löschende Bild existiert nicht!");
            }
    } else {
        array_push($errors, "Fehler: Sie sind nicht angemeldet");
    }

}

?>
