<!-- Includes Bootstrap-->
<link rel="stylesheet" href="/html/bootstrap/bootstrap.css">
<script src="/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<html>
 <head>
  	<title>Homepage</title>
 </head>
 <body id="body">
    <div id="whole_page">
	    <?php include("header.php");?>
        <!-- Seitenränder werden durch den Container festgelegt-->
        <div class="container">
            <!-- Erste Reihe. Wenn weitere hinzukommen können mehrere Kacheln erstellt werden-->
            <div class="row">
                <!-- Platzhalter-->
                <div class="col-sm-1"></div>
                <!-- Linkes Menue. Etwas groesser als das rechte-->
                <div class="col-sm-6">
                    <div class="bg-white p-2 mb-3 mt-3">
                        <h1>Wilkommen</h1>
                        <h2>News:</h2>
                        <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
                        <h2>Interner Bereich:</h2>
                        <?php
                  			session_start();
                            //Nutzer angemeldet?
                            if (isset($_SESSION['username'])) {
                         		echo "<p>Hallo Welt</p>";
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
                        <!--
                        <h2>Bilder:</h2>
                        <?php include_once("image_feed.php");?>
                        <h2>News:</h2>
                        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/html/news/news_feed.php");?>-->
                    </div>
                </div>
                <div class="col-sm-4 mb-3 mt-3">
                        <div class="bg-white p-2">
                            <h1>[Nutzername]</h1>
                            <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
                        </div>               
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
        <?php include("footer.php");?>
 </body>
</html>
