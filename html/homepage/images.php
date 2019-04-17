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
  	<title>Bilder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <div class="col-sm-10 p-2 mb-3 mt-3">
                    <h1>Hochgeladene Bilder</h1>
                    <?php include_once("image_feed.php");?>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
        <?php include("footer.php");?>
 </body>
</html>
