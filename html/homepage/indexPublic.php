<!DOCTYPE html>
<!-- Includes Bootstrap-->
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<html>
 <head>
  	<title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 </head>
 <body id="body">
    <div id="whole_page">
	    <?php include("header.php");?>
        <!-- Seitenränder werden durch den Container festgelegt-->

        <div class="jumbotron" >
          <div class="container">
          <h1>Willkommen beim KC Dauerstramm!</h1>
          <p>Diese Webseite ist für Mitglieder und Freunde des KC Dauerstramms entwickelt worden.
            Du möchtest mehr erfahren? Dann melde Dich bitte an!</p>
            <form action="/KCD/html/registrationAndLogin/login.php" method="post">
            <input type="submit" name="btn_losGehts" class="btn btn-primary" value="Los geht's!">
          </from>
          </div>
        </div>

        <div class="container">
        <div class="row">
            <!-- Platzhalter-->
            <div class="col-sm-1"></div>
            <!-- Linkes Menue. Etwas groesser als das rechte-->
            <div class="col-sm-5">
                <div class="bg-white p-2 mb-3 mt-3">
            <h2>Über uns</h2>
            <p>Der Kegelclub Dauerstramm besteht seit 2015 und zählt derzeit 14 Mitglieder.
            In unserem Kegelclub sind nicht nur Freunde von Präzisionssportarten gut aufgehoben. Auch der
            gemütliche Aspekt des Kegelsports kommt bei uns zum Tragen. Gekegelt wird alle vier Wochen im
            Landgasthof Schimmelbaum in Senden-Ottmarsbocholt. Dort versorgt Wirtin Tina uns Hobbysportler
            regelmäßig mit hopfenhaltigen Erfrischungsgetränken. Doch nicht nur auf der Kegelbahn ist der KCD
            vertreten: Zu den zahlreichen Events gehören u.a. das KC-Schützenfest, der traditionelle Mai-Gang oder
            aber auch die alljährliche Weihnachtsfeier. </p>
            </div>
          </div>
        <div class="col-sm-5 mb-3 mt-3">
        <div class="bg-white p-2">
            <h2>Über diese Webseite</h2>
            <p>Diese Webseite wurde von einem dreiköpfigem Entwicklerteam erstellt, das sich aus
            Studierenden der Hochschule Weserbergland zusammensetzt. Die Hochschule Weserbergland ist
            eine private Elite-Hochschule in der niedersächsischen Trend-Metropole Hameln.
            Im Rahmen eines Praktikums zur PHP-Programmierung an der HSW nutzte das studentische Projektteam -
            bestehend aus Lennart Peters, Marius Hilt und Justus Falke -
            die an sie herangetragende Aufgabenstellung zur Erstellung einer Webseite ihrer Wahl dazu,
            den Kegelclub Dauerstramm ins World Wide Web zu bringen. </p>
            Möchten Sie uns Hinweise, Kritik oder einfach nur Lob für diese Webseite geben? Dann behalten
            Sie es für sich.
        </div>
        <!-- Platzhalter-->
        <div class="col-sm-1"></div>
    </div>

        </div>
        </div>
      <?php include("footer.php");?>
 </body>
</html>
