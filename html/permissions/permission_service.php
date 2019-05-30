<?php
@session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php');

// initializing variables
// diese Variablen wird das Errors.php-Skript verwenden
$errors = array();
$success = array();

// connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

if (isset($_POST['btn_permission'])) {
    if(nutzer_angemeldet()) {
      if (isset($_POST['btn_permission'])){

        // Voraussetzung fuer die Anpassung der Berechtigungen ist, dass
        // weiterhin mind. ein Amin angegeben ist
        if(isset($_POST['Admin'])){

        // Zunaechst alle Datensaetze der Tabelle userpermissions loeschen
        $sqlDeleteAdmin = "DELETE FROM userpermissions WHERE permissionID =1";
        if (mysqli_query($db, $sqlDeleteAdmin)==1){
          // Alles hat geklappt
        } else {
          array_push($errors, "Technischer Fehler");
        }
        $sqlDeleteKassenwart = "DELETE FROM userpermissions WHERE permissionID =2";
        if (mysqli_query($db, $sqlDeleteKassenwart)==1){
          // Alles hat geklappt
        } else {
          array_push($errors, "Technischer Fehler");
        }

        // Nun Tabelleninhalt anhand ausgelesener Checkboxen neu aufbauen
        if (isset($_POST['Admin'])){
          foreach ($_POST['Admin'] as $id):
            $sqlInsertAdmin = "INSERT INTO userpermissions VALUES ($id, 1)";
            if(mysqli_query($db, $sqlInsertAdmin)==1){
              // Alles hat geklappt
            } else {
              array_push($errors, "Technischer Fehler");
            }
          endforeach;
        }

        if (isset($_POST['Kassenwart'])){
          foreach ($_POST['Kassenwart'] as $id):
            $sqlInsertKassenwart = "INSERT INTO userpermissions VALUES ($id, 2)";
            if(mysqli_query($db, $sqlInsertKassenwart)==1){
              // Alles hat geklappt
            } else {
              array_push($errors, "Technischer Fehler");
            }
          endforeach;

          array_push($success, "Berechtigungen wurden angepasst!");
      }
    } else {
      array_push($errors, "Es muss mindestens ein Administrator angegeben werden");
    }

      }
  }
}
