<?php include_once('server.php') ?>
<?php include_once('/html/homepage/functions.php') ?>

<?php
//Automatischer verweis auf die Homepage
	if (nutzer_angemeldet()){
		header('location: /html/homepage/index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Nutzername</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Passwort</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Anmelden</button>
  	</div>
  	<p>
  		Noch nicht registriert? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>
