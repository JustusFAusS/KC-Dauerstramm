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
	}
?>
<!DOCTYPE html>

<html>
 <head>
  	<title>Homepage</title>
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
                          <a href="#" class="list-group-item list-group-item-action">
                             <div class="row">
                                    <div class="col-sm-8">
                                        <h5>Nicht abgemeldet</h5>
                                    </div>
                                    <div class="col-sm-2">
                                        5,00€
                                    </div>
                                    <div class="col-sm-2">
                                        <small> 31.12.2019</small>
                                    </div>
                            </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                             <div class="row">
                                    <div class="col-sm-8">Kl. Strafe </div>
                                    <div class="col-sm-2">500,00€</div>
                                    <div class="col-sm-2"><small> 31.12.2019</small></div>
                            </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                             <div class="row">
                                    <div class="col-sm-8">Kl. Strafe LAAAAAAAAAAAAAAAAAAAANGES WORT</div>
                                    <div class="col-sm-2">500,00€</div>
                                    <div class="col-sm-2"><small> 31.12.2019</small></div>
                            </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                            <div class="row">
                                    <div class="col-sm-8">Kl. Strafe eine wirklich sehr lange Strafe mit vielen kleinen Wörtern</div>
                                    <div class="col-sm-2">500,00€</div>
                                    <div class="col-sm-2"><small> 31.12.2019</small></div>
                            </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action list-group-item-dark">
                            <div class="row">
                                    <div class="col-sm-8"><h5>Summe (12):</h5></div>
                                    <div class="col-sm-2"><h5>500,00€</h5></div>
                                    <div class="col-sm-2"></div>
                            </div>
                          </a>
                        </div>
                        <h2>Bezahlte Strafen:</h2>
                        <div class="list-group">
                          <a href="#" class="list-group-item list-group-item-action">
                             <div class="row">
                                    <div class="col-sm-8">
                                        <h5>Nicht abgemeldet</h5>
                                    </div>
                                    <div class="col-sm-2">
                                        5,00€
                                    </div>
                                    <div class="col-sm-2">
                                        <small> 31.12.2019</small>
                                    </div>
                            </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                             <div class="row">
                                    <div class="col-sm-8">Kl. Strafe </div>
                                    <div class="col-sm-2">500,00€</div>
                                    <div class="col-sm-2"><small> 31.12.2019</small></div>
                            </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                             <div class="row">
                                    <div class="col-sm-8">Kl. Strafe LAAAAAAAAAAAAAAAAAAAANGES WORT</div>
                                    <div class="col-sm-2">500,00€</div>
                                    <div class="col-sm-2"><small> 31.12.2019</small></div>
                            </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                            <div class="row">
                                    <div class="col-sm-8">Kl. Strafe eine wirklich sehr lange Strafe mit vielen kleinen Wörtern</div>
                                    <div class="col-sm-2">500,00€</div>
                                    <div class="col-sm-2"><small> 31.12.2019</small></div>
                            </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action list-group-item-dark">
                            <div class="row">
                                    <div class="col-sm-8"><h5>Summe (12):</h5></div>
                                    <div class="col-sm-2"><h5>500,00€</h5></div>
                                    <div class="col-sm-2"></div>
                            </div>
                          </a>
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
                                        <div class="col-sm-3">200,00€</div>
                                        <div class="col-sm-3"><span class="badge badge-primary badge-pill">14</span></div>
                                </div>
                              </a>
                              <a href="#" class="list-group-item list-group-item-action">
                                 <div class="row">
                                        <div class="col-sm-6">Bezahlt</div>
                                        <div class="col-sm-3">500,00€</div>
                                        <div class="col-sm-3"><span class="badge badge-primary badge-pill">14</span></div>
                                </div>
                              </a>
                              <a href="#" class="list-group-item list-group-item-action list-group-item-dark">
                                 <div class="row">
                                        <div class="col-sm-6">Gesamt</div>
                                        <div class="col-sm-3">700,00€</div>
                                        <div class="col-sm-3"><span class="badge badge-primary badge-pill">14</span></div>
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
