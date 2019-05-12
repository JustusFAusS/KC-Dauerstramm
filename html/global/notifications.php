<!-- Dies PHP-Skript kann eingebunden werden, um Benachrichtigungen an den
Nutzer auszugeben. Dafür muss in das jeweilige Arrays der entsprechende
Benachrichtigungstext hinterlegt werden -->

<?php
// Ausgabe von Erfolgsmeldungen
  if (isset($errors)) {
    if (count($errors) > 0) {
        echo "<div class='success'>";
  	    foreach ($errors as $error) {
            echo '<div class="alert alert-success" role="alert">';
  	        echo $error;
            echo '</div>';
        }
    }
}
?>

<?php
// Ausgabe von Erfolgsmeldungen
  if (isset($success)) {
    if (count($success) > 0) {
        echo "<div class='success'>";
  	    foreach ($success as $suc) {
            echo '<div class="alert alert-success" role="alert">';
  	        echo $suc;
            echo '</div>';
        }
    }
}
?>

<?php
// Ausgabe neutraler Informationen
  if (isset($information)) {
    if (count($information) > 0) {
        echo "<div class='info'>";
  	    foreach ($information as $info) {
            echo '<div class="alert alert-info" role="alert">';
  	        echo $info;
            echo '</div>';
        }
    }
}
?>
