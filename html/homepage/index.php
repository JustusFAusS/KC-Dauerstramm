<html>
 <head>
  <title>Homepage</title>
 </head>
 <body>
	<?php include("header.php");?>
	<h1>Wilkommen</h1>
	<h2>News:</h2>
	<p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
	<h2>Interner Bereich:</h2>
	<?php
  	session_start();
	//Nutzer angemeldet?
	if (isset($_SESSION['username'])) {
		 echo "<p>Hallo Welt</p>";
		//<form action="/html/registerAndLogout/server.php" method="post">
   		//	<input type="submit" name="logout_user" value="Abmelden"/>
		//</form>
		echo "<form method='post' action='/html/registrationAndLogin/server.php'><button type='submit' class='btn' name='logout_user'>Abmelden</button></form>";
	} else {
		echo '<p> Bitte melden Sie sich an [Hier kann auch eine Komplette Seite eingebettet werden]</p>';
		echo "<form method='get' action='/html/registrationAndLogin/login.php'><button type='submit' class='btn'>zum Login</button></form>";
	}
	?>
	<h2>Footer:</h2>
	<h2>Links:</h2>
	<a href="/html/registrationAndLogin/register.php">Registrieren</a><br></br>
	<a href="/html/registrationAndLogin/login.php">Login</a><br></br>
	<a href="/html/uploadImage/upload_image.php">Upload von Bildern</a><br></br>
	<a href="/html/homepage/image_feed.php">Image Feed (gekapselt. Normalerweise keine eigene Seite)</a><br></br>
	<a href="/html/news/news_feed.php">News Feed (gekapselt. Normalerweise keine eigene Seite)</a><br></br>
	<a href="/html/news/add_news.php">Hinzufügen von Nachrichten</a><br></br>

	<h2>Bilder:</h2>
	<?php include_once("image_feed.php");?>
	<h2>News:</h2>
	<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/html/news/news_feed.php");?>
 </body>
</html>
