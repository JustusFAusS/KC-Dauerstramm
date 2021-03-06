<!--Hier darf NICHT NOCHMAL ALLES IMPORTIERT WERDEN XGADLPE-->
<!--Führt zu fehlern!-->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <!--Favicon-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <!-- Fette Schrift -->
    <a class="navbar-brand" href="/KCD/index.php"><img class="rounded mr-2" src="/KCD/resources/images/homepage/HomepageIcon.png" alt="" style="width:30px;">Kegelclub-Homepage</a>
    <!--Button für Handys-->
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--Makiert die Buttons, die bei einem kleinen Bildschirm ausgeblendet werden-->
    <div class="collapse navbar-collapse" id="navb">
        <!-- Links -->
        <ul class="navbar-nav mr-auto">
                <?php
                    //Includes von Funktionen
	                include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/functions.php');
                    start_session();
                    if (nutzer_angemeldet()) {
                        //Hier wird abgefragt, wann der Nutzer das letzte mal die Seite gewechselt hat. Nach einem Festen Zeitintervall wird der Nutzer hier
                        //ausgeloggt und zu der Öffentliche-Homepage-Page weitergeleitet
                        //Zudem wurde dieser Timestamp beim erfolgreichen Login das erste mal gesetzt.
                        //Das Timeout wird hier über die Variable session_timeout erstellt

                        $session_timeout = 600;
                        if (!isset($_SESSION['last_visit'])) {
                            //Nach dem ersten Aufruf einer Seite
                            $_SESSION['last_visit'] = time();
                        }

                        if((time() - $_SESSION['last_visit']) > $session_timeout) {
                            //Nutzer zu lange Inaktiv. Weiterleitung auf die Öffentliche-Homepage-Page
                            session_destroy();
                            header('location: /KCD/html/registrationAndLogin/timeout.php');
                        }


                        echo '<li class="nav-item">';
                        echo "<ul class='navbar-nav'><li class='nav-item dropdown'>";
                        echo "<a class='nav-link dropdown-toggle pr-4' href='' id='navbardrop' data-toggle='dropdown'>Bilder</a>";
                        echo "<div class='dropdown-menu'>";
                        echo "<a class='dropdown-item' href='/KCD/html/uploadImage/images.php'>Bilder-Feed</a>";
                        echo "<a class='dropdown-item' href='/KCD/html/uploadImage/upload_image.php'>Bilder hochladen</a>";
                        echo "</div></li></ul>";
                        echo "</li>";

                        echo "<li class='nav-item'>
                        <ul class='navbar-nav'><li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle pr-4' href='' id='navbardrop' data-toggle='dropdown'>Termine</a>
                        <div class='dropdown-menu'>
                        <a class='dropdown-item' href='/KCD/html/calendar/index.php'>Terminübersicht</a>
                        <a class='dropdown-item' href='/KCD/html/calendar/add_event.php'>Termin hinzufügen</a>
                        </div></li></ul>
                        </li>";
                    }
                ?>




            <?php
                //Includes von Funktionen
	            include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/functions.php');
                start_session();
                if (nutzer_angemeldet()) {
                    //Hier werden die Links zu den Administratoren und den Kassenwarten angezeigt
                    //Das kann nur geschehen, wenn der Nutzer angemeldet ist
                    $userID = get_userid_by_username(htmlspecialchars($_SESSION['username']), ENT_QUOTES, 'UTF-8');
                    //connect to the database
                    $db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');
                    //Nutzer angemeldet
                    if (checkAdminPermissions($userID,$db))
                    {
                        //Nutzer hat Admin-Rechte. Es können die Links des Admins angezeigt werden
                        //Dropdown
                        echo "<ul class='navbar-nav'><li class='nav-item dropdown'>";
                        echo "<a class='nav-link dropdown-toggle pr-4' href='' id='navbardrop' data-toggle='dropdown'>" . "Administration" . "</a>";
                        echo "<div class='dropdown-menu'>";
                        //show permisstions
                        echo '<a class="dropdown-item" href="/KCD/html/permissions/show_permission.php">Rechte verwalten</a>';
                        echo '<a class="dropdown-item" href="/KCD/html/permissions/permission_set_master.php">Master-Passwort ändern</a>';
                        echo '<a class="dropdown-item" href="/KCD/html/permissions/change_user_pass.php">Nutzer-Passwort ändern</a>';
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
                        echo '<a class="dropdown-item" href="/KCD/html/penalties/create_penalty.php">Strafe erstellen</a>';
                        echo '<a class="dropdown-item" href="/KCD/html/penalties/add_penalty.php">Strafen erfassen</a>';
                        echo '<a class="dropdown-item" href="/KCD/html/penalties/edit_penalties.php">Strafen verwalten</a>';
                        echo '<a class="dropdown-item" href="/KCD/html/penalties/delete_penalty.php">Strafe löschen</a>';
                    }
                    echo "</div></li></ul>";
                }
            ?>
        </ul>
        <!-- Nutzerinterface (angemeldet etc)-->
        <?php
	        //Includes von Funktionen
	        include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/functions.php');
            //Damit die aktuelle Session gefunden wurde
            start_session();
		    if (nutzer_angemeldet()) {
                //Angemeldet
                //Dropdown
                echo "<ul class='navbar-nav'><li class='nav-item dropdown mr-3'>";
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
                echo "<form class='form-inline my-2 my-lg-0' action='/KCD/html/registrationAndLogin/login.php'>";
                echo "<button class='btn btn-outline-secondary mr-1 ml-1' type='submit'>Anmelden</button>";
                echo "</form>";
                //Button Registrieren
                echo "<form class='form-inline my-2 my-lg-0' action='/KCD/html/registrationAndLogin/register.php'>";
                echo "<button class='btn btn-success mr-1 ml-1' type='submit'>Registrieren</button>";
                echo "</form>";
        	}
	    ?>
    </div>
</nav>
