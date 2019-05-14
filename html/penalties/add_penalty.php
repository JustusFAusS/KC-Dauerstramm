<!-- Includes Bootstrap-->
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php') ?>

<?php include('penalty_service.php') ?>
<?php
    //Automatischer verweis auf die Homepage, wenn die Rechte nicht ausreichen oder der Nutzer nicht angemeldet ist
	if (nutzer_angemeldet() == false || checkKassenwartPermissions(get_userid_by_username($_SESSION['username']), $db) == false){
		header('location: /KCD/html/homepage/index.php');
	} else {
        //Hier werden alle Werte für die Seite berechnet

        $pathAfterSuccess = "location: /KCD/html/homepage/index.php";
        $user_id= get_userid_by_username($_SESSION['username']);
        $penalties;
        $num_penalties = 0;
        $user;
        $num_user = 0;
        $sum_penalties = 0.00;
        $num_penalties = 0;
        $num_users = 0;
        $is_first_run = isset($_POST['save_settings']);

        if(!(isset($selected_users)))
        {
            $selected_users = array();
        } 
        $num_selected_users = -1;
        $all_users;
        //$selected_penalty;
        $saving_enabled = false;
        $errors = array();

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
            $actu_user_num = 0;
            $num_selected_users = 0;
            while ($num_users > $actu_user_num -1) {
                if (isset($_POST['u_' . $actu_user_num])) {
                    $actual_checkbox_value = $_POST['u_' . $actu_user_num];
                    //Checkbox ist gesetzt und somit ausgewählt worden
                    $num_selected_users = $num_selected_users + 1;
                    //Value der Check-Box ist gleich der users.id des passenden Nutzers
                    array_push($selected_users,$actual_checkbox_value);
                }
                $actu_user_num = $actu_user_num + 1;
            }
            if ($num_selected_users == 0)
            {
                array_push($errors, "Bitte wählen Sie mindestens einen Nutzer aus.");
            }
        }  else {
           array_push($errors, "Es sind keine Nutzer vorhanden. Bitte fügen Sie zunächst Nutzer hinzu!");
        }
        //Ausgewählte Strafe auswerten
        if ($num_penalties > 0)
        {
            if (isset($_POST['groupbox']))
            {
                $selected_penalty_id = $_POST['groupbox'];
                //Es wurde eine Auswahl in der Kombobox getroffen
                $quiery_get_selected_penalty = "SELECT * FROM penalties where penalties.penaltyID = '" . $selected_penalty_id . "' ;";
                $selected_penalty_db_result = mysqli_query($db, $quiery_get_selected_penalty);
                $selected_penalty = mysqli_fetch_array($selected_penalty_db_result,MYSQLI_ASSOC);
                if(isset($selected_penalty))
                {
                    //Wenn hier keiner gefunden wurde liegt ein Fehler im System vor. Eine Strafe ist in der Dropdown-Liste vorhanden. Eine Passende ID zu dieser
                    //Strafe existiert aber nicht. Dieser Fall kann nur durch einen Programmfehler hervorgerufen werden. 
                } else {
                  array_push($errors, "Technischer Fehler: fefcfdfb5cc88c336d959ff94b979099. Inkonsestente Daten!");
                }
            } else {
                array_push($errors, "Bitte wählen Sie eine Strafe aus der Dropdown-Liste aus.");
            }
        } else {
            array_push($errors, "Es sind keine Strafen vorhanden. Bitte fügen Sie zunächst Strafen hinzu!");
        }
        
        //Summe Schulden berechnen
        if (isset($selected_penalty) && ($num_selected_users > 0))
        {
            //Alle Kriterien für eine erfolgreiche Berechnung sind gegeben. Außerdem kann der Button Speichern aktiviert werden
            $sum_penalties = $selected_penalty['amount'] * $num_selected_users;
            $saving_enabled = true;
        } else {
            $saving_enabled = false;
        }

        if(isset($_POST['save_settings']))
        {
            //Der Speichern-Button wurde geklickt
            if($saving_enabled)
            {
                //Kann gespeichert werden
                while ($actu_user = mysqli_fetch_assoc($all_users))
                {
                    //Nutzer schon vorher selektiert?
                    if(in_array($actu_user['id'],$selected_users)) { 
                        //Nutzer kann in die Tabelle geschrieben werden
                        $save_penalty_quiery = "Insert INTO userpenalties (userID,penaltyID,date,ispayed) VALUES ('" . $actu_user['id'] . "','" . $selected_penalty['penaltyID'] . "',NOW(),false);";
                        if (mysqli_query($db, $save_penalty_quiery)== 0)
                        {
                            //Datenbankfehler
                           array_push($errors, "Technischer Fehler (Datenbankfehler): add84190959e25a2458eb99b5f280d4b");
                        } else {
                            header($pathAfterSuccess);
                        }
                    }
                }
                
            } else {
                array_push($errors, "Speichern nicht möglich. Bitte lösen Sie die Fehlermeldungen");  
            }
        }
        
        //Hier werden alle Error_Nachrichten gelöscht, wenn die Form nicht durch den Speichern-Dialog aufgerufen wird
        if (!($is_first_run))
        {
            $success = $errors;
            $errors = array();
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
        <form action="add_penalty.php" method="post" name="add_penalty">
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
                            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/notifications.php"); ?>
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
                                          <select class="form-control" id="sel1" name="groupbox" onChange='add_penalty.submit()'>
                                            <?php
                                                //Hier werden die zuvor ermittelten Strafen eingefügt
                                                if ($num_penalties > 0)
                                                {
                                                    //Wenn schon einer aus dem Vorherigen Formular ausgewählt wurde muss der zuerst angezeigt werden
                                                    //Führt zu einem doppelten Eintrag. Ist aber nicht so relevant
                                                    if (isset($selected_penalty))
                                                    {
                                                        echo "<option onChange='add_penalty.submit()'  value=" . $selected_penalty["penaltyID"] . ">" . $selected_penalty['message'] . "</option>";
                                                    } else {
                                                        echo "<option onChange='add_penalty.submit()'> Strafe wählen</option>";
                                                    }
                                                    while ($actu_penalty = mysqli_fetch_assoc($penalties))
                                                    {
                                                        echo "<option onChange='add_penalty.submit()' value=" . $actu_penalty["penaltyID"] . ">" . $actu_penalty['message'] . "</option>";
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
                                            //Nutzer schon vorher selektiert?
                                            $tmp = "";
                                            if(in_array($actu_user['id'],$selected_users)) { 
                                                $tmp = "checked";
                                            }
                                            echo '<div class="img-thumbnail m-1"><div class="form-check"><label class="form-check-label">';
                                            echo '<input type="checkbox" onChange="add_penalty.submit()" class="form-check-input" name="u_' . $counter . '" value="' . $actu_user['id']. '" ' . $tmp . '>' . $actu_user['username'] . "</input>";
                                            echo '</div></div>';
                                            $counter = $counter +1;
                                        }
                                    }
                                ?>
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
                                            <div class="col-sm-3"><?php echo $sum_penalties; ?>€</div>
                                    </div>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action list-group-item-dark">
                                     <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" name="save_settings" class="btn btn-danger btn-block">Strafen Speichern</button>    
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
