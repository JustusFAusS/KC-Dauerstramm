<!DOCTYPE html>
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<html>
<body>
	<?php
	// include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/calendar/service_event.php');
	// connect to the database
	$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

	//Checken ob Nutzer angemeldet
	if ( nutzer_angemeldet() ){

		//Aktuelle Nutzer-ID
    $actual_user_id = get_userid_by_username($_SESSION['username']);
    //Hat der Nutzer Admin-Rechte?
    $is_admin = checkAdminPermissions($actual_user_id,$db);

		//hier werden alle Daten in einer Tabelle angezeigt

	        //Laden der Relevanten Daten
					$query = "SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC LIMIT 3";
		$result = mysqli_query($db, $query);
		if ($result->num_rows > 0) {
			//Es wurden einträge gefunden

			echo '<ul class="list-group list-group-flush">';

			$i = 0;
			//Einzelne Events einfügen
			while(($row = mysqli_fetch_assoc($result))){
				echo '<li class="list-group-item">';
					echo '<div style="display:block; text-align:left; float:left;"><h5>' . $row["Name"] . '</h5></div>';
					echo '<div style="display:block; text-align:right;">' . $row["Date"] . '</div>';
					echo '<br> ';
					echo '<div class="panel-body">' . $row["Description"] . '</div>';
				echo 	'</li>';
			}
			echo '</ul>';
		}
	}
	 ?>

</body>
</html>
