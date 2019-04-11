<?php
session_start();

function nutzer_angemeldet()
{
   	if (isset($_SESSION['username'])) {
   		return ( True );
	} else {
		return ( False );
	}
}

?>
