<!--Hier darf NICHT NOCHMAL ALLES IMPORTIERT WERDEN XGADLPE-->
<!--Führt zu fehlern!-->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <!--Favicon-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <!-- Fette Schrift -->
    <a class="navbar-brand" href="/KCD/html/homepage/index.php"><img class="rounded mr-2" src="/KCD/resources/images/homepage/HomepageIcon.png" alt="" style="width:30px;">Kegelclub-Homepage</a>
    <!--Button für Handys-->
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--Makiert die Buttons, die bei einem kleinen Bildschirm ausgeblendet werden-->
    <div class="collapse navbar-collapse" id="navb">
        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/KCD/html/homepage/images.php">Bilder</a>
            </li>
            <?php 
                //Includes von Funktionen
	            include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php');
                start_session();
                if (nutzer_angemeldet()) {
                    //Hier werden die Links zu den Administratoren und den Kassenwarten angezeigt
                    //Das kann nur geschehen, wenn der Nutzer angemeldet ist
                    $userID = get_userid_by_username($_SESSION['username']);
                    //connect to the database
                    $db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');
                    //Nutzer angemeldet
                    if (checkAdminPermissions($userID,$db))
                    {
                        //Nutzer hat Admin-Rechte. Es können die Links des Admins angezeigt werden
                        //Dropdown
                        echo "<ul class='navbar-nav'><li class='nav-item dropdown'>";
                        echo "<a class='nav-link dropdown-toggle pr-4' href='' id='navbardrop' data-toggle='dropdown'>" . "Verwaltung" . "</a>";
                        echo "<div class='dropdown-menu'>";
                        //show permisstions 
                        echo "<form  method='post' class='form-inline' action='/KCD/html/permissions/show_permission.php'>";
                        echo "<div class='col text-center'><button class='btn-success btn-block btn-sm mt-3' type='submit' name='redirect'>Rechte verwalten</button></div>";
                        echo "</form>";
                        echo "</div></li></ul>";
                    }
                    //Dropdown Strafen
                    echo "<ul class='navbar-nav'><li class='nav-item dropdown'>";
                    echo "<a class='nav-link dropdown-toggle pr-4' href='' id='navbardrop' data-toggle='dropdown'>" . "Strafenverwaltung" . "</a>";
                    echo "<div class='dropdown-menu'>";
                    //Einzelene Elemente
                    echo '<a class="dropdown-item" href="/KCD/html/penalties/show_penalties.php">Eigene Strafen</a>';
                    if (checkKassenwartPermissions($userID,$db))
                    {
                        echo '<a class="dropdown-item" href="/KCD/html/penalties/edit_penalties.php">Strafen verwalten</a>';
                        echo '<a class="dropdown-item" href="/KCD/html/penalties/add_penalty.php">Strafen einreichen</a>';
                        echo '<a class="dropdown-item" href="/KCD/html/penalties/create_penalty.php">Strafe erstellen</a>';
                    }
                    echo "</div></li></ul>";
                }
            ?>
        </ul>
        <!-- Nutzerinterface (angemeldet etc)-->
        <?php
	        //Includes von Funktionen
	        include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php');
            //Damit die aktuelle Session gefunden wurde
            start_session();
		    if (nutzer_angemeldet()) {
                //Angemeldet
                //echo <span class='navbar-text'>Angemeldet</span>";
                //Dropdown
                echo "<ul class='navbar-nav'><li class='nav-item dropdown'>";
                echo "<a class='nav-link dropdown-toggle pr-4' href='' id='navbardrop' data-toggle='dropdown'>" . $_SESSION['username'] . "</a>";
                echo "<div class='dropdown-menu'>";
                //Profil bearbeiten
                echo "<form  method='post' class='form-inline' action='/KCD/html/registrationAndLogin/profile_information.php'>";
                echo "<div class='col text-center'><button class='btn-success btn-block btn-sm mt-3' type='submit' name='redirect'>Profil bearbeiten</button></div>";
                echo "</form>";
                //Abmelden Button
                echo "<form  method='post' class='form-inline' action='/KCD/html/registrationAndLogin/server.php'>";
                echo "<div class='col text-center'><button class='btn btn-outline-secondary btn-block btn-sm' type='submit' name='logout_user'>Abmelden</button></div>";
                echo "</form>";
                echo "</div></li></ul>";
        	} else {
                //Nicht Angemeldet
                //echo "<span class='navbar-text'>Nicht angemeldet</span>";
                //echo "<li class='nav-item'>";
                echo "<form class='form-inline my-2 my-lg-0' action='/KCD/html/registrationAndLogin/login.php'>";
                //echo "<a class='nav-link' href='/KCD/html/registrationAndLogin/login.php' data-target='#myModal' data-toggle='modal'>Registieren</a>";
                echo "<button class='btn btn-outline-secondary mr-1 ml-1' type='submit'>Anmelden</button>";
                echo "</form>";
                //echo "</li>";
                //Button Registrieren
                //echo "<li class='nav-item'>";
                echo "<form class='form-inline my-2 my-lg-0' action='/KCD/html/registrationAndLogin/register.php'>";
                //echo "<a class='nav-link' href='/KCD/html/registrationAndLogin/register.php' data-target='#myModal' data-toggle='modal'>Registieren</a>";
                echo "<button class='btn btn-success mr-1 ml-1' type='submit'>Registrieren</button>";
                echo "</form>";
                //echo "</li>";
        	}
	    ?>
    </div>
</nav>
