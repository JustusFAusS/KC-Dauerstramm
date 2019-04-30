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
	} else {
        //Hier werden alle Werte für die Seite berechnet

        //To-Do: Strafen summe berechnen (value der Listen auslesen)
        $user_id= get_userid_by_username($_SESSION['username']);
        $penalties;
        $num_penalties = 0;
        $user;
        $num_user = 0;
        $sum_penalties = 0.00;
        $num_penalties = 0;
        $num_users = 0;
        $selected_users;
        $num_selected_users = -1;
        $all_users;

        $quiery_get_penalties = "SELECT * FROM penalties;";
        $quiery_get_user = "SELECT * FROM users;";

        //connect to the database
        $db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

        //Penalties auswerten
        $penalties = mysqli_query($db, $quiery_get_penalties);
        $num_penalties = $penalties->num_rows;
        
        //Nutzer auswerten
        $all_users = mysqli_query($db, $quiery_get_user);
        $num_users = $all_users->num_rows;
        
        //Ausgewählte Nutzer auswerten
        if ($num_users > 0)
        {
            $selected_users = 0;
            $actu_user_num = 0;
            $num_selected_users = 0;
            while ($num_users > $actu_user_num -1) {
                $actual_checkbox_value = $_POST['u_' . $actu_user_num];
                if (isset($actual_checkbox_value)) {
                    //Checkbox ist gesetzt und somit ausgewählt worden
                    $num_selected_users = $num_selected_users + 1;
                    //Value der Check-Box ist gleich der users.id des passenden Nutzers
                    array_push($selected_users,$actual_checkbox_value);
                }
                $actu_user_num = $actu_user_num + 1;
            }
        }      
    }
?>
<!DOCTYPE html>

<html>
 <head>
  	<title>Strafe eintragen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 </head>
 <body id="body">
    <div id="whole_page">
	    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/header.php');?>
        <!-- Die komplette Seite ist eine Form -->
        <form action="add_penalty.php" method="post">
            <!-- Seitenränder werden durch den Container festgelegt-->
            <div class="container">
                <!-- Erste Reihe. Wenn weitere hinzukommen können mehrere Kacheln erstellt werden-->
                <div class="row">
                    <!-- Platzhalter-->
                    <div class="col-sm-1"></div>
                    <!-- Linkes Menue. Etwas groesser als das rechte-->
                    <div class="col-sm-11">
                        <div class="bg-white p-2 mt-3">
                            <h1>Strafe Eintragen:</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Platzhalter-->
                    <div class="col-sm-1"></div>
                    <!-- Linkes Menue. Etwas groesser als das rechte-->
                    <div class="col-sm-6">
                        <div class="bg-white p-2 mb-3">
                            <h2>Strafe auswählen:</h2>
                                        <div class="form-group">
                                          <select class="form-control" id="sel1">
                                            <?php
                                                //Hier werden die zuvor ermittelten Strafen eingefügt
                                                if ($num_penalties > 0)
                                                {
                                                    while ($actu_penalty = mysqli_fetch_assoc($penalties))
                                                    {
                                                        echo "<option>" . $actu_penalty['message'] . "</option>";
                                                    }
                                                }
                                            ?>
                                          </select>
                                        </div>
                            <h2>Nutzer zuordnen:</h2>
                                <?php
                                    //Hier werden die Nutzer eingetragen
                                    if ($num_users > 0)
                                    {
                                        $counter = 1;
                                        while ($actu_user = mysqli_fetch_assoc($all_users))
                                        {
                                            echo '<div class="img-thumbnail m-1"><div class="form-check"><label class="form-check-label">';
                                            echo '<input type="checkbox" class="form-check-input" name="u_' . $counter . '" value=' . $actu_user['id'] . '>' . $actu_user['username'] . "</input>";
                                            echo '</div></div>';
                                            $counter = $counter +1;
                                        }
                                    }
                                ?>
                                <button type="submit" class="btn btn-info btn-block">Berechnen</button>  
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                            <div class="bg-white p-2">
                                <h2>Zusammenfassung:</h2>
                                <div class="list-group">
                                  <a href="#" class="list-group-item list-group-item-action">
                                     <div class="row">
                                            <div class="col-sm-9">Anzahl Nutzer</div>
                                            <div class="col-sm-3"><?php echo $num_selected_users; ?> </div>
                                    </div>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action">
                                     <div class="row">
                                            <div class="col-sm-9">Summe Schulden:</div>
                                            <div class="col-sm-3">12,00€</div>
                                    </div>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action list-group-item-dark">
                                     <div class="row">
                                            <div class="col-sm-12">
                                                <button type="button" class="btn btn-danger btn-block">Strafen Speichern</button>    
                                            </div>
                                    </div>
                                  </a>
                                </div>
                            </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </form>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/footer.php');?>
 </body>
</html>
