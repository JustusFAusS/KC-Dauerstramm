<?php
@session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php');

// initializing variables
// diese Variablen wird das Errors.php-Skript verwenden
$upload_errors = array();
//Welche Seite nach Erfolg aufgerufen werden soll
$pathAfterSuccess = "location: /KCD/html/homepage/index.php";

// connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

if (isset($_POST['btn_permission'])) {
    if(nutzer_angemeldet()) {
      echo "Du hast Aktualisieren gedrückt";
    }
  }
