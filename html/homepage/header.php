<link rel="stylesheet" href="/html/bootstrap/bootstrap.css">
<script src="/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <!-- Fette Schrift -->
    <a class="navbar-brand" href="/html/homepage/index.php"><img class="rounded mr-2" src="/resources/images/homepage/HomepageIcon.png" alt="" style="width:30px;">Kegelclub-Homepage</a>
    <!--Button für Handys-->    
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--Makiert die Buttons, die bei einem kleinen Bildschirm ausgeblendet werden-->
    <div class="collapse navbar-collapse" id="navb">
        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Link 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link 3</a>
            </li>
        </ul>
        <!-- Nutzerinterface (angemeldet etc)-->
        <?php
	        //Includes von Funktionen
	        include_once("functions.php");
		    if (nutzer_angemeldet()) {
                //Angemeldet
                //span "<echo class='navbar-text'>Angemeldet</span>";
                //Dropdown
                echo "<ul class='navbar-nav'><li class='nav-item dropdown'>";
                echo "<a class='nav-link dropdown-toggle' href='#' id='navbardrop' data-toggle='dropdown'>" . $_SESSION['username'] . "</a>";
                echo "<div class='dropdown-menu'>";
                //Profil bearbeiten
                echo "<form  method='post' class='form-inline' action='/html/registrationAndLogin/server.php'>";
                echo "<div class='col text-center'><button class='btn-success btn-block btn-sm mt-3' type='submit' name='logout_user'>Profil bearbeiten</button></div>";
                echo "</form>";
                //Abmelden Button
                echo "<form  method='post' class='form-inline' action='/html/registrationAndLogin/server.php'>";
                echo "<div class='col text-center'><button class='btn btn-outline-secondary btn-block btn-sm' type='submit' name='logout_user'>Abmelden</button></div>";
                echo "</form>";
                echo "</div></li></ul>";
        	} else {
                //Nicht Angemeldet
                //echo "<span class='navbar-text'>Nicht angemeldet</span>";
                //echo "<li class='nav-item'>";
                echo "<form class='form-inline my-2 my-lg-0' action='/html/registrationAndLogin/login.php'>";
                //echo "<a class='nav-link' href='/html/registrationAndLogin/login.php' data-target='#myModal' data-toggle='modal'>Registieren</a>";
                echo "<button class='btn btn-outline-secondary mr-1 ml-1' type='submit'>Anmelden</button>";
                echo "</form>";
                //echo "</li>";
                //Button Registrieren
                //echo "<li class='nav-item'>";
                echo "<form class='form-inline my-2 my-lg-0' action='/html/registrationAndLogin/register.php'>";
                //echo "<a class='nav-link' href='/html/registrationAndLogin/register.php' data-target='#myModal' data-toggle='modal'>Registieren</a>";
                echo "<button class='btn btn-success mr-1 ml-1' type='submit'>Registrieren</button>";
                echo "</form>";
                //echo "</li>";
        	}
	    ?>
    </div>
</nav>
