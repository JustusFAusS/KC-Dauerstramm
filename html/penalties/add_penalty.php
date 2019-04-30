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
        $user_id= get_userid_by_username($_SESSION['username']);
        $penalties[];
        $num_penalties = 0;
        $user[];
        $num_user = 0;
        $sum_penalties = 0,00;
        $num_users = 0;
        $selected_users[];

        $quiery_get_penalties = "SELECT * FROM penalties;";
        $quiery_get_user = "SELECT * FROM user;";

        //connect to the database
        $db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');

        //Penalties auswerten
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
                                        <option>Nicht anwesend gewesen</option>
                                        <option>Monatsbeitrag</option>
                                        <option>Testat nicht rechzeitig aabgegeeben</option>
                                        <option>lAAAAAAAAAAAAAAAAAAAAAAAAAAAAnges Wort Test</option>
                                      </select>
                                    </div>
                        <h2>Nutzer zuordnen:</h2>
                            <div class='img-thumbnail m-1'>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="">Nutzer 1
                                    </label>
                                </div>
                            </div>
                            <div class='img-thumbnail m-1'>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="">Nutzer 2
                                    </label>
                                </div>
                            </div>
                            <div class='img-thumbnail m-1'>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="">Nutzer 3
                                    </label>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                        <div class="bg-white p-2">
                            <h2>Zusammenfassung:</h2>
                            <div class="list-group">
                              <a href="#" class="list-group-item list-group-item-action">
                                 <div class="row">
                                        <div class="col-sm-9">Anzahl Nutzer</div>
                                        <div class="col-sm-3">4</div>
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
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/footer.php');?>
 </body>
</html>
