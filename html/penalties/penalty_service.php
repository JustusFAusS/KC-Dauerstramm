<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/html/homepage/functions.php');

// initializing variables
// diese Variablen wird das Errors.php-Skript verwenden
$upload_errors = array();
//Welche Seite nach Erfolg aufgerufen werden soll
$pathAfterSuccess = "location: /html/homepage/index.php";

// connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

//Hier wird die Methode abgefragt
if (isset($_POST['create_penalty'])) {
    if(nutzer_angemeldet()) {
        $p_message = $_POST['p_message'];
        $p_amount = $_POST['p_amount'];
        if(isset($p_message) && isset($p_amount)) {
            //Alle Variablen wurden gesetzt. Nun kann geprüft werden, ob diese Strafe schon existiert
            $check_message_exists_queue = "SELECT * FROM penalties WHERE message = '" . $p_message . "';";
            $result = mysqli_query($db, $check_message_exists_queue);
            $found_penalties = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if (isset($found_penalties)) {
                //Es wurde schon eine gleichnaige Regel gefunden
                array_push($upload_errors,"Diese Regel existiert schon");
            } else {
                //Alles bis auf die Summe ist geprüft
                if ($p_amount > 0) {
                    //Alle Prüfungen abgeschlossen
                    //Daten können in die Datenbank geschrieben werden
                    $add_penalty_queue = "INSERT INTO penalties(message, amount) VALUES ('" . $p_message . "'," . $p_amount . ");";
                    if (mysqli_query($db, $add_penalty_queue)==1) {
                        //Alles hat geklappt
                        header($pathAfterSuccess);  
                    } else {
                       array_push($upload_errors, "Technischer Fehler.");
                       array_push($upload_errors, $add_penalty_queue);  
                    }  
                } else {
                    array_push($upload_errors,"Die Strafe muss > 0 sein");
                }
            }
        } else {
            array_push($upload_errors,"Bitte tätigen Sie alle nötigen Eingaben");
        }
    } else {
        array_push($upload_errors,"Bitte melden Sie sich zunächst an");
    }
}
?>
