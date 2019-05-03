<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php');

// initializing variables
// diese Variablen wird das Errors.php-Skript verwenden
$upload_errors = array();
//Welche Seite nach Erfolg aufgerufen werden soll
$pathAfterSuccess = "location: /KCD/html/homepage/index.php";

// connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

//Hier wird die Methode abgefragt
//Aufruf einer Methode wird über das Existieren eines POST-Werts ermittelt


//Methode:              create_penalty
//Information:          fügt eine Strafe hinzu
//                      Nutzer muss angemeldet sein (Fehlermeldung)
//Parameter:            p_message   (POST)  [benoetigt, wird gepprüft]  Typ: String
//                      p_amount    (POST)  [benoetigt, wird geprüft]   Typ: Double (punkt als Dezimaltrenner(5,2))
//Fehler:               werden an das Array upload_errors weitergegeben
//Ergebnis bei erfolg:  Weiterleitung an pathAfterSuccess

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
                if ($p_amount > 0 && $p_amount < 1000) {
                    //Alle Prüfungen abgeschlossen
                    //Daten können in die Datenbank geschrieben werden
                    $add_penalty_queue = "INSERT INTO penalties(message, amount) VALUES ('" . $p_message . "'," . $p_amount . ");";
                    if (mysqli_query($db, $add_penalty_queue)==1) {
                        //Alles hat geklappt
                        header($pathAfterSuccess);
                    } else {
                        array_push($upload_errors, "Technischer Fehler. (Datenbank-Fehler)");
                        array_push($upload_errors,$p_message,$p_amount);
                        //Für genauere Problemanalyse
                        //array_push($upload_errors, $add_penalty_queue);
                    }
                } else {
                    array_push($upload_errors,"Die Strafe zwischen 0 und 1000 liegen (2 Stellen nach dem Komma).");
                }
            }
        } else {
            array_push($upload_errors,"Bitte tätigen Sie alle nötigen Eingaben");
        }
    } else {
        array_push($upload_errors,"Bitte melden Sie sich zunächst an");
    }
}

if (isset($_POST['add_penalty'])) {
    //Automatischer verweis auf die Homepage
	if (nutzer_angemeldet() == false){
		header('location: /KCD/html/homepage/index.php');
	} else {
        //Hier werden alle Werte für die Seite berechnet
//Ausgewählte Nutzer auswerten
        if ($num_users > 0)
        { 
            $actu_user_num = 0;
            $num_selected_users = 0;
            while ($num_users > $actu_user_num -1) {
                if (isset($_POST['u_' . $actu_user_num])) {
                    $actual_checkbox_value = $_POST['u_' . $actu_user_num];
                    //Checkbox ist gesetzt und somit ausgewählt worden
                    $num_selected_users = $num_selected_users + 1;
                    //Value der Check-Box ist gleich der users.id des passenden Nutzers
                    array_push($selected_users,$actual_checkbox_value);
                }
                $actu_user_num = $actu_user_num + 1;
            }
            if ($num_selected_users == 0)
            {
                array_push($errors, "Bitte wählen Sie mindestens einen Nutzer aus.");
            }
        }  else {
           array_push($errors, "Es sind keine Nutzer vorhanden. Bitte fügen Sie zunächst Nutzer hinzu!");
        }
        //Ausgewählte Strafe auswerten
        if ($num_penalties > 0)
        {
            if (isset($_POST['groupbox']))
            {
                $selected_penalty_id = $_POST['groupbox'];
                //Es wurde eine Auswahl in der Kombobox getroffen
                $quiery_get_selected_penalty = "SELECT * FROM penalties where penalties.penaltyID = '" . $selected_penalty_id . "' ;";
                $selected_penalty_db_result = mysqli_query($db, $quiery_get_selected_penalty);
                $selected_penalty = mysqli_fetch_array($selected_penalty_db_result,MYSQLI_ASSOC);
                if(isset($selected_penalty))
                {
                    //Wenn hier keiner gefunden wurde liegt ein Fehler im System vor. Eine Strafe ist in der Dropdown-Liste vorhanden. Eine Passende ID zu dieser
                    //Strafe existiert aber nicht. Dieser Fall kann nur durch einen Programmfehler hervorgerufen werden. 
                } else {
                  array_push($errors, "Technischer Fehler: fefcfdfb5cc88c336d959ff94b979099. Inkonsestente Daten!");
                }
            } else {
                array_push($errors, "Bitte wählen Sie eine Strafe aus der Dropdown-Liste aus.");
            }
        } else {
            array_push($errors, "Es sind keine Strafen vorhanden. Bitte fügen Sie zunächst Strafen hinzu!");
        }
        
        //Summe Schulden berechnen
        if (isset($selected_penalty) && ($num_selected_users > 0))
        {
            //Alle Kriterien für eine erfolgreiche Berechnung sind gegeben. Außerdem kann der Button Speichern aktiviert werden
            $sum_penalties = $selected_penalty['amount'] * $num_selected_users;
            $saving_enabled = true;
        } else {
            $saving_enabled = false;
        }

        if(isset($_POST['save_settings']))
        {
            //Der Speichern-Button wurde geklickt
            if($saving_enabled)
            {
                //Kann gespeichert werden
                while ($actu_user = mysqli_fetch_assoc($all_users))
                {
                    //Nutzer schon vorher selektiert?
                    if(in_array($actu_user['id'],$selected_users)) { 
                        //Nutzer kann in die Tabelle geschrieben werden
                        $save_penalty_quiery = "Insert INTO userpenalties (userID,penaltyID,date) VALUES ('" . $actu_user['id'] . "','" . $selected_penalty['penaltyID'] . "',NOW());";
                        if (mysqli_query($db, $save_penalty_quiery)== 0)
                        {
                            //Datenbankfehler
                           array_push($errors, "Technischer Fehler (Datenbankfehler): add84190959e25a2458eb99b5f280d4b");
                        } else {
                            header($pathAfterSuccess);
                        }
                    }
                }
                
            } else {
                array_push($errors, "Speichern nicht möglich. Bitte lösen Sie die Fehlermeldungen");  
            }
        }  
}
?>
