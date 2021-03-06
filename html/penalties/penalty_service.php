<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/functions.php');

// initializing variables
// diese Variablen wird das Errors.php-Skript verwenden
$errors = array();
$errors = array();
$success = array();
// connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

//Erfolgsmeldungen


//Hier wird die Methode abgefragt
//Aufruf einer Methode wird über das Existieren eines POST-Werts ermittelt


//Methode:              create_penalty
//Information:          fügt eine Strafe hinzu
//                      Nutzer muss angemeldet sein (Fehlermeldung)
//Parameter:            p_message   (POST)  [benoetigt, wird gepprüft]  Typ: String
//                      p_amount    (POST)  [benoetigt, wird geprüft]   Typ: Double (punkt als Dezimaltrenner(5,2))
//Fehler:               werden an das Array errors weitergegeben
//Ergebnis bei erfolg:  Ausgabe einer Meldung

if (isset($_POST['create_penalty'])) {
    if(nutzer_angemeldet()) {
        $p_message = mysqli_real_escape_string($db,$_POST['p_message']);
        $p_amount = mysqli_real_escape_string($db,$_POST['p_amount']);
        if(isset($p_message) && isset($p_amount)) {
            //Alle Variablen wurden gesetzt. Nun kann geprüft werden, ob diese Strafe schon existiert
            $check_message_exists_queue = "SELECT * FROM penalties WHERE message = '" . $p_message . "';";
            $result = mysqli_query($db, $check_message_exists_queue);
            $found_penalties = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if (isset($found_penalties)) {
                //Es wurde schon eine gleichnaige Regel gefunden
                array_push($errors,"Diese Regel existiert schon");
            } else {
                //Alles bis auf die Summe ist geprüft
                if ($p_amount > 0 && $p_amount < 1000) {
                    //Alle Prüfungen abgeschlossen
                    //Daten können in die Datenbank geschrieben werden
                    $add_penalty_queue = "INSERT INTO penalties(message, amount) VALUES ('" . $p_message . "'," . $p_amount . ");";
                    if (mysqli_query($db, $add_penalty_queue)==1) {
                        //Alles hat geklappt
                        array_push($success,"Die Strafe wurde erfolgreich eingetragen");
                    } else {
                        array_push($errors, "Technischer Fehler. (Datenbank-Fehler)");
                        array_push($errors,$p_message,$p_amount);
                        //Für genauere Problemanalyse
                        //array_push($errors, $add_penalty_queue);
                    }
                } else {
                    array_push($errors,"Die Strafe zwischen 0 und 1000 liegen (2 Stellen nach dem Komma).");
                }
            }
        } else {
            array_push($errors,"Bitte tätigen Sie alle nötigen Eingaben");
        }
    } else {
        array_push($errors,"Bitte melden Sie sich zunächst an");
    }
}

if(nutzer_angemeldet()) {
    //Nun muss überprüft werden, ob eine Strafe gelöscht oder bezahlt wird
    if (isset($_POST['b_pay']))
    {
        //Bezahlen einer Strafe
        $pay_bill_queue = "UPDATE userpenalties SET ispayed = true WHERE userpenaltyid = " . $_POST['b_pay'] . ".;";
        if (mysqli_query($db, $pay_bill_queue)==1) {
            //Hat alles geklappt
        } else {
            array_push($errors,"Technischer Fehler bei der Datenbankabfrage.");
        }
    } elseif (isset($_POST['b_del'])) {
        //Löschen einer Strafe
        $pay_del_queue = "DELETE FROM userpenalties WHERE userpenaltyid = " . $_POST['b_del'] . ".;";
        if (mysqli_query($db, $pay_del_queue)==1) {
            //Hat alles geklappt

        } else {
            array_push($errors,"Technischer Fehler bei der Datenbankabfrage.");
        }
    } elseif (isset($_POST['b_unpay'])) {
        //Löschen einer Strafe
        $pay_undel_queue = "UPDATE userpenalties SET ispayed = false WHERE userpenaltyid = " . $_POST['b_unpay'] . ".;";
        if (mysqli_query($db, $pay_undel_queue)==1) {
            //Hat alles geklappt

        } else {
            array_push($errors,"Technischer Fehler bei der Datenbankabfrage.");
        }
    }
} else {
    array_push($errors,"Bitte melden Sie sich zunächst an.");
}

if (isset($_POST['del_penalty'])) {
    if(nutzer_angemeldet()) {
        if (checkKassenwartPermissions(get_userid_by_username($_SESSION['username']),$db)) {
            //Es müssen mehrere Abfragen getätigt werden, damit die Strafe problemlos gelöscht werden kann
            $check_for_existing_penalties = "SELECT * FROM userpenalties WHERE userpenalties.penaltyID = '" . $_POST['groupbox'] . "';";
            $check_for_existing_penalties_result = mysqli_query($db, $check_for_existing_penalties);
            $rowcount = mysqli_num_rows($check_for_existing_penalties_result);
            if ($rowcount > 0) {
                array_push($errors,"Diese Strafe ist schon einem Nutzer zugeordnet. Bitte löschen Sie diese Zuordnung, bevor sie fortfahren. Dieser Vorgang wurde abgebrochen");
            } else {
                $check_if_penalty_exists_query = "SELECT * FROM penalties WHERE penaltyID = '". $_POST['groupbox'] . "';";
                $check_if_penalty_exists_result = mysqli_query($db, $check_if_penalty_exists_query);
                $rowcount = mysqli_num_rows($check_if_penalty_exists_result);
                if ($rowcount > 0) {
                    $del_selected_penalty_queue = "DELETE FROM penalties WHERE penaltyID = '". $_POST['groupbox'] . "';";
                    if (mysqli_query($db, $del_selected_penalty_queue) == 1) {
                        //Alles hat geklappt. Die Seite kann erneut geladen werden
                        array_push($success,"Die ausgewählte Strafe wurde erfolgreich gelöscht!");
                    } else {
                        array_push($errors,"Technischer Fehler innerhalb der Datenbank. Die Strafe konnte nicht gelöscht werden.");
                    }
                } else {
                    array_push($errors,"Die ausgewählte Strafe existiert nicht. Bitte laden Sie diese Seite erneut");
                }
            }
        } else {
            array_push($errors,"Sie haben nicht genügend Rechte. Ihre Anfrage wird nicht bearbeitet.");
        }
    } else {
        array_push($errors,"Sie sind nicht angemeldet.");
    }
}
?>
