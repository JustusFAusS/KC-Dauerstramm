<!DOCTYPE html>
<!-- Includes Bootstrap-->
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/functions.php');
start_session();
$errors = array();
//Welche Seite nach Erfolg aufgerufen werden soll
$pathAfterSuccess = "location: /KCD/index.php";

// connect to the database
$db = mysqli_connect('localhost', 'KCD', '56748', 'KCD');
if(nutzer_angemeldet()) {
    //Nutzer-ID holen
    $user_id = get_userid_by_username($_SESSION['username']);
    $get_all_penalties_queue = "SELECT penalties.message,penalties.amount,userpenalties.ispayed,userpenalties.date FROM penalties INNER JOIN userpenalties ON userpenalties.penaltyID = penalties.penaltyID WHERE userpenalties.userID = " . $user_id . " ;";
    //Zu errechnende Summen
    $sum_payed_count = 0;
    $sum_unpayed_count = 0;
    $sum_total_count = 0;
    $sum_payed_amount = 0.00;
    $sum_unpayed_amount = 0.00;
    $sum_total_amount = 0.00;
    //Zu errechnende Strafen-Arrays
    $arr_payed = array();
    $arr_unpayed = array();

    if ($all_penalties_db_result = mysqli_query($db, $get_all_penalties_queue)) {
        //Hier ist kein Fehler bei der DB-Abfrage aufgetreten
        //Alle gefundenen Strafen durchlaufen
        $l_amount = 0.00;
        while($row = mysqli_fetch_assoc($all_penalties_db_result)){
            $l_amount = $row['amount'];
            $sum_total_count = $sum_total_count +1;

            $l_penalty = array(  'message' => htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8'),
                                'amount'   => htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8'),
                                'ispayed'  => htmlspecialchars($row['ispayed'], ENT_QUOTES, 'UTF-8'),
                                'date'  => htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8'));
            if ($row['ispayed']) {
                $sum_total_amount = $sum_total_amount + $l_amount;
                $sum_payed_count = $sum_payed_count + 1;
                $sum_payed_amount = $sum_payed_amount + $l_amount;
                array_push($arr_payed,$l_penalty);
            } else {
                $sum_total_amount = $sum_total_amount + $l_amount;
                $sum_unpayed_count = $sum_unpayed_count + 1;
                $sum_unpayed_amount = $sum_unpayed_amount + $l_amount;
                array_push($arr_unpayed,$l_penalty);
            }
        }
        if ($sum_total_count == 0)
        {
            array_push($errors,"Sie haben keine Strafen");
        }
    } else {
        //Fehler bei der DB-Abfrage
        array_push($errors,"Technischer Fehler bei der Datenbankabfrage.");
    }
} else {
    //Nutzer ist nicht angemeldet
    array_push($errors,"Sie sind nicht angemeldet. Eine Afrage kann nicht getätigt werden.");
}
?>

<?php
//Automatischer verweis auf die Homepage
	if (nutzer_angemeldet() == false){
		header('location: /KCD/index.php');
	}
?>
<!DOCTYPE html>

<html>
 <head>
  	<title>Strafenübersicht</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 </head>
 <body id="body">
    <div id="whole_page">
	    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/header.php');?>
        <!-- Seitenränder werden durch den Container festgelegt-->
        <div class="container">
            <!-- Erste Reihe. Wenn weitere hinzukommen können mehrere Kacheln erstellt werden-->
            <div class="row">
                <!-- Platzhalter-->
                <div class="col-sm-1"></div>
                <!-- Linkes Menue. Etwas groesser als das rechte-->
                <div class="col-sm-11">
                    <div class="bg-white p-2 mt-3">
                        <?php include("errors.php"); ?>
                        <h1>Strafenübersicht:</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Platzhalter-->
                <div class="col-sm-1"></div>
                <!-- Linkes Menue. Etwas groesser als das rechte-->
                <div class="col-sm-6">
                    <div class="bg-white p-2 mb-3">
                        <h2>Offene Strafen:</h2>
                        <div class="list-group mb-3">
                          <?php
                                foreach($arr_unpayed AS $nr) {
                                    echo '<a href="#" class="list-group-item list-group-item-action">';
                                    echo '<div class="row">';
                                    echo '<div class="col-sm-7">';
                                    echo '<h5>' . $nr['message'] . '</h5>';
                                    echo '</div>';
                                    echo '<div class="col-sm-2">';
                                    echo $nr['amount'] . '€';
                                    echo '</div>';
                                    echo '<div class="col-sm-3">';
                                    echo '<small>' . $nr['date'] . '</small>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                }
                                echo '<a href="#" class="list-group-item list-group-item-action list-group-item-dark">';
                                echo '<div class="row">';
                                echo '<div class="col-sm-7"><h5>' . "Summe" . '</h5></div>';
                                echo '<div class="col-sm-2"><h5>' . $sum_unpayed_amount . '€</h5></div>';
                                echo '<div class="col-sm-3"></div>';
                                echo '</div></a>';
                          ?>
                        </div>
                        <h2>Bezahlte Strafen:</h2>
                        <div class="list-group">
                        <?php
                                foreach($arr_payed AS $nr) {
                                    echo '<a href="#" class="list-group-item list-group-item-action">';
                                    echo '<div class="row">';
                                    echo '<div class="col-sm-7">';
                                    echo '<h5>' . $nr['message'] . '</h5>';
                                    echo '</div>';
                                    echo '<div class="col-sm-2">';
                                    echo $nr['amount'] . '€';
                                    echo '</div>';
                                    echo '<div class="col-sm-3">';
                                    echo '<small>' . $nr['date'] . '</small>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                }
                                echo '<a href="#" class="list-group-item list-group-item-action list-group-item-dark">';
                                echo '<div class="row">';
                                echo '<div class="col-sm-7"><h5>' . "Summe" . '</h5></div>';
                                echo '<div class="col-sm-2"><h5>' . $sum_payed_amount . '€</h5></div>';
                                echo '<div class="col-sm-3"></div>';
                                echo '</div></a>';
                          ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                        <div class="bg-white p-2">
                            <h2>Zusammenfassung:</h2>
                            <div class="list-group">
                              <a href="#" class="list-group-item list-group-item-action">
                                 <div class="row">
                                        <div class="col-sm-6">Unbezahlt</div>
                                        <div class="col-sm-3"><?php echo $sum_unpayed_amount ?>€</div>
                                        <div class="col-sm-3"><span class="badge badge-primary badge-pill"><?php echo $sum_unpayed_count ?></span></div>
                                </div>
                              </a>
                              <a href="#" class="list-group-item list-group-item-action">
                                 <div class="row">
                                        <div class="col-sm-6">Bezahlt</div>
                                        <div class="col-sm-3"><?php echo $sum_payed_amount ?>€</div>
                                        <div class="col-sm-3"><span class="badge badge-primary badge-pill"><?php echo $sum_payed_count ?></span></div>
                                </div>
                              </a>
                              <a href="#" class="list-group-item list-group-item-action list-group-item-dark">
                                 <div class="row">
                                        <div class="col-sm-6">Gesamt</div>
                                        <div class="col-sm-3"><?php echo $sum_total_amount ?>€</div>
                                        <div class="col-sm-3"><span class="badge badge-primary badge-pill"><?php echo $sum_total_count ?></span></div>
                                </div>
                              </a>
                            </div>
                        </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/footer.php');?>
 </body>
</html>
