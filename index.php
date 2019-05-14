<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php');
start_session();
	if(nutzer_angemeldet() == true){
			header('location: /KCD/html/homepage/indexLoggedIn.php');
	} else {
		header('location: /KCD/html/homepage/indexPublic.php');
	}

?>
