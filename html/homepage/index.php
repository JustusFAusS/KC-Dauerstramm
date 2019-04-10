<html>
 <head>
  <title>Homepage</title>
 </head>
 <body>
	<?php
  	session_start();
	if (isset($_SESSION['username'])) {
		 echo "<p>Hallo Welt</p>";
		//<form action="/html/registerAndLogout/server.php" method="post">
   		//	<input type="submit" name="logout_user" value="Abmelden"/>
		//</form>
		echo "<form method='post' action='/html/registrationAndLogin/server.php'><button type='submit' class='btn' name='logout_user'>Abmelden</button></form>";
	} else {
		echo '<p> Bitte melden Sie sich zunächst an</p>';
	}
	?>
 </body>
</html>
