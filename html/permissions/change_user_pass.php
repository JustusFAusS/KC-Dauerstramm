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

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/functions.php') ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/registrationAndLogin/server.php') ?>

<?php
//Automatischer verweis auf die Homepage
	if (nutzer_angemeldet() == false){
		header('location: /KCD/index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Passwort ändern</title>
  <style type="text/css">
    body {
		font-family: 'Varela Round', sans-serif;
	}
	.modal-login {
		color: #636363;
		width: 350px;
	}
	.modal-login .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
	}
	.modal-login .modal-header {
		border-bottom: none;
		position: relative;
		justify-content: center;
	}
	.modal-login h4 {
		text-align: center;
		font-size: 26px;
	}
	.modal-login  .form-group {
		position: relative;
	}
	.modal-login i {
		position: absolute;
		left: 13px;
		top: 11px;
		font-size: 18px;
	}
	.modal-login .form-control {
		padding-left: 40px;
	}
	.modal-login .form-control:focus {
		border-color: #00ce81;
	}
	.modal-login .form-control, .modal-login .btn {
		min-height: 40px;
		border-radius: 3px;
	}
	.modal-login .hint-text {
		text-align: center;
		padding-top: 10px;
	}
	.modal-login .close {
        position: absolute;
		top: -5px;
		right: -5px;
	}
	.modal-login .modal-footer {
		background: #ecf0f1;
		border-color: #dee4e7;
		text-align: center;
		margin: 0 -20px -20px;
		border-radius: 5px;
		font-size: 13px;
		justify-content: center;
	}
	.modal-login .modal-footer a {
		color: #999;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
</style>
</head>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/header.php');?>
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Nutzerpasswort ändern</h4>
			</div>
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/notifications.php"); ?>
			<div class="modal-body">
				<form action="change_user_pass.php" method="post">
                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <select class="form-control" id="gb1" name="selected_user">
                            <option value="nothingSelected">Wählen Sie einen Nutzer</option>
                            <?php
                                $queryUser = "SELECT * FROM users";
                                $resultUser = mysqli_query($db, $queryUser);
                                if ($resultUser->num_rows > 0) {
                                    while($rowUser = mysqli_fetch_assoc($resultUser)){
                                        echo "<option value='" . $rowUser['id'] . "'>". $rowUser['username'] ."</option>";
                                    }
                                } else {
                                    echo "<option value=''>Keine Nutzer da</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" name="password_new_0" class="form-control" placeholder="Neues Passwort" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" name="password_new_1" class="form-control" placeholder="Neues Passwort bestätigen" required="required">
					</div>
					<div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" name="password_master" class="form-control" placeholder="Master-Passwort" required="required">
					</div>
					<div class="form-group">
						<input type="submit" name="change_user_pass" class="btn btn-warning btn-block btn-lg" value="Bestätigen">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#">Das Zurücksetzen von Admin-Passwörtern ist hier aus Sicherheitsgründen nicht gestattet.</a>
			</div>
		</div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/footer.php');?>
</body>
</html>
