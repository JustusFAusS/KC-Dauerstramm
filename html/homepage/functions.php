<?php
@session_start();

function nutzer_angemeldet()
{
   	if (isset($_SESSION['username'])) {
   		return ( True );
	} else {
		return ( False );
	}
}

function get_user_by_id($user_id)
{
	// connect to the database
	$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');
	$query = "SELECT username FROM users where id = '$user_id';";
	$result = mysqli_query($db, $query);
	if ($result->num_rows == 1) {
		$row = mysqli_fetch_assoc($result);
		return (  $row["username"] );
	} else {
		return ( "Kein user gefunden. |" . $user_id ."|" . $result->num_rows . "|" );
	}
}

function get_userid_by_username($user_name)
{
    // connect to the database
	$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');
	$query = "SELECT id FROM users where username = '$user_name';";
	$result = mysqli_query($db, $query);
	if ($result->num_rows == 1) {
		$row = mysqli_fetch_assoc($result);
		return (  $row["id"] );
	} else {
		return ( "-1" );
	}
}

function get_email_by_userid($user_id)
{
    // connect to the database
	$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');
	$query = "SELECT email FROM users where id = '$user_id';";
	$result = mysqli_query($db, $query);
	if ($result->num_rows == 1) {
		$row = mysqli_fetch_assoc($result);
		return (  $row["email"] );
	} else {
		return ( "Kein user gefunden. |" . $user_id ."|" . $result->num_rows . "|" );
	}
}
?>
