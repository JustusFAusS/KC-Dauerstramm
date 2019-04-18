<!-- Includes Bootstrap-->
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php include_once('penalty_service.php') ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php') ?>

<?php
//Automatischer verweis auf die Homepage
	if (nutzer_angemeldet() == false){
		header('location: /KCD/html/homepage/index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
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
	.modal-login .btn {
		background: #00ce81;
		border: none;
		line-height: normal;
	}
	.modal-login .btn:hover, .modal-login .btn:focus {
		background: #00bf78;
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
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/header.php');?>
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Strafe erstellen</h4>
			</div>
			<div class="modal-body">
                <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/uploadImage/errors.php"); ?>
				<form action="create_penalty.php" method="post">
					<div class="form-group">
						<i class="fa fa-user"></i>
						<input type="text" name="p_message" class="form-control" placeholder="Grund" required="required">
					</div>
                    <div class="form-group">
                        <i class="fa fa-money"></i>
                        <input type="text" name ="p_amount" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Strafe in € (z.B. '1.25')" required="required">
                    </div>
					<div class="form-group">
						<input type="submit" name="create_penalty" class="btn btn-primary btn-block btn-lg" value="Speichern">
					</div>
				</form>
			</div>
		</div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/footer.php');?>
</body>
</html>
