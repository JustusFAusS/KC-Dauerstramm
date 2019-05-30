<!DOCTYPE html>
<!-- Includes Bootstrap-->
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php include_once('permission_service.php') ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/functions.php') ?>


<?php
//Automatischer verweis auf die Homepage, falls unangemeldeter Nutzer oder Nutzer nicht Admin
	if (nutzer_angemeldet() == false || checkAdminPermissions(get_userid_by_username($_SESSION['username']), $db) ==false){
		header('location: /KCD/index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Nutzerberechtigungen</title>
</head>
</head>
<body>
	  <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/header.php');?>
  <div class="container mt-3">
  <h2>Nutzerberechtigungen</h2>
  <p>Hier können die Nutzerberechtigungen verwaltet werden:</p>
	<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/notifications.php"); ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nutzername</th>
        <th>Email</th>
				<th>Adminrechte</th>
				<th>Kassenwart</th>
      </tr>
    </thead>
    <tbody>
  <?php
  //Laden der User-Daten
  $queryUser = "SELECT * FROM users";
  $resultUser = mysqli_query($db, $queryUser);
  if ($resultUser->num_rows > 0) {
    while($rowUser = mysqli_fetch_assoc($resultUser)){
        echo '<tr>';
        echo '<td>'.$rowUser['username'].'</td>';
        echo '<td>'.$rowUser['email'].'</td>'; ?>
				<form action="show_permission.php" method="post">
					<?php
				if(checkAdminPermissions($rowUser['id'], $db)==true){
				 echo'<td><div class="checkbox">
				 <label><input type="checkbox" name="Admin[]" value='.$rowUser['id'].' checked></label>
				 </div></td>';
				} else{
			 	 echo '<td><div class="checkbox">
				 <label><input type="checkbox" name="Admin[]" value='.$rowUser['id'].'></label>
				 </div></td>';
				}
				if(checkKassenwartPermissions($rowUser['id'], $db)==true){
					echo'<td><div class="checkbox">
 				 <label><input type="checkbox" name="Kassenwart[]" value='.$rowUser['id'].' checked></label>
 				 </div></td>';
				} else{
					echo '<td><div class="checkbox">
 				 <label><input type="checkbox" name="Kassenwart[]" value='.$rowUser['id'].'></label>
 				 </div></td>';
				}
        echo '</tr>';
    }
        echo '</tbody>';
        echo '</table>';
  //      echo '</div>';
    }
    else{
      array_push($errors, "Technischer Fehler!");
    }
		?>

	<div class="container my-3">
			  <input type="submit" name ='btn_permission' class="btn btn-success" style="float: right;" value ="Aktualisieren">
				<div class="clearfix">
  <span class="float-left"></span>
  <span class="float-right"></span>
</div>
	  </div>
		</form>
		</div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/footer.php');?>
</body>
</html>
