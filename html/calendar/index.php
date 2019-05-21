<!DOCTYPE html>
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<html>
<head>
	<title>Termine</title>
</head>
<body>
      <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/header.php');?>

			<!-- Seitenränder werden durch den Container festgelegt-->
			<div class="container">
					<!-- Erste Reihe. Wenn weitere hinzukommen können mehrere Kacheln erstellt werden-->
					<div class="row">
							<!-- Platzhalter-->
							<div class="col-sm-1"></div>
							<!-- Linkes Menue. Etwas groesser als das rechte-->
							<div class="col-sm-10">
									<div class="bg-white p-2 mb-3 mt-3">
											<h1>Ausstehende Termine</h1>

											<?php start_session();

											// connect to the database
											$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

											//Checken ob Nutzer angemeldet
											if ( nutzer_angemeldet() ){
												//hier werden alle Daten in einer Tabelle angezeigt

											        //Laden der Relevanten Daten
											        $query = "SELECT * FROM events ORDER BY datum DESC";
												$result = mysqli_query($db, $query);
												if ($result->num_rows > 0) {
													//Es wurden einträge gefunden

													echo '<ul class="list-group list-group-flush">';

													//Einzelne Events einfügen
													while($row = mysqli_fetch_assoc($result)){

														echo '<li class="list-group-item">';
															echo '<div style="display:block; text-align:left; float:left;"><h5>' . $row["Name"] . '</h5></div>';
															echo '<div style="display:block; text-align:right;">' . $row["Datum"] . '</div>';
															echo '<br> ';
															echo '<div class="panel-body">' . $row["Beschreibung"] . '</div>';
														echo 	'</li>';
													}
													echo '</ul>';
												}
											}
											 ?>
									</div>
							</div>

					</div>
					<form action="add_event.php">
						<input type="submit" value="Event eintragen" class="btn btn-link">
					</form>
			</div>

			<?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/footer.php');?>
</body>
</html>
