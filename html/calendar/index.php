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
      <?php
			include_once('service_event.php');
			include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/header.php');
			include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/notifications.php');
			?>

			<!-- Seitenränder werden durch den Container festgelegt-->
			<div class="container">
					<!-- Erste Reihe. Wenn weitere hinzukommen können mehrere Kacheln erstellt werden-->
					<div class="row">
							<!-- Platzhalter-->
							<div class="col-sm-1"></div>
							<!-- Linkes Menue. Etwas groesser als das rechte-->
							<div class="col-sm-10">
									<div class="bg-white p-2 mb-3 mt-3">
										<div style="display:block; text-align:left; float:right;">
											<form action="add_event.php">
												<input type="submit" value="Event hinzufügen" class="btn btn-primary">
											</form>
										</div>
										<div style="display:block; text-align:left;"><h1>Ausstehende Termine</h1></div>


											<?php start_session();

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
											        $query = "SELECT * FROM events ORDER BY datum ASC";
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
															if (($actual_user_id == $row['UploadedBy']) || $is_admin)
					                    {
					                        // echo '<form action="/KCD/html/calendar/delete_event.php?eventid=' . $row['EventID'] . '" method="post">';
					                        // echo "<button type='submit' class='btn btn-danger mr-1 pull-right'>Löschen</button>";
					                        // echo "</form>";
																	echo '<!-- Button to Open the Modal -->
																		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Löschen</button>

																	<!-- The Modal -->
																	<div class="modal" id="myModal">
																	  <div class="modal-dialog">
																	    <div class="modal-content">

																	      <!-- Modal Header -->
																	      <div class="modal-header">
																	        <h4 class="modal-title">Wirklich löschen?</h4>
																	        <button type="button" class="close" data-dismiss="modal">&times;</button>
																	      </div>

																	      <!-- Modal body -->
																	      <div class="modal-body">
																					Wollen Sie den Termin unwiederruflich löschen?
																	      </div>

																	      <!-- Modal footer -->
																	      <div class="modal-footer">
																					<form action="/KCD/html/calendar/index.php?eventid=' . $row['EventID'] . '" method="post">
																						<input type="submit" style="display:block" name="delete_event" class="btn btn-primary btn-block btn-lg" value="Termin Löschen' . $row['EventID'] . '">
																					</form>
																						<button type="button" class="btn btn-danger" data-dismiss="modal">Abbrechen</button>

																	      </div>

																	    </div>
																	  </div>
																	</div>';

					                    }
														echo 	'</li>';
													}
													echo '</ul>';
												}
											}
											 ?>
									</div>
							</div>

					</div>

			</div>

			<?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/footer.php');?>
</body>
</html>
