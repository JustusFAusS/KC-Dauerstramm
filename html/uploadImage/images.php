<!-- Includes Bootstrap-->
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
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
	    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/header.php');?>
        <!-- Seitenränder werden durch den Container festgelegt-->
        <div class="container">
            <!-- Erste Reihe. Wenn weitere hinzukommen können mehrere Kacheln erstellt werden-->
            <div class="row">
                <!-- Platzhalter-->
                <div class="col-sm-1"></div>
                <div class="col-sm-7 p-2 mt-3">
                    <h1>Hochgeladene Bilder</h1>
                </div>
                <div class="col-sm-3 p-2 mt-3">
                    <form action="images.php" method="get" name="style">
                        <div class="btn-group pull-right">
                            <button type="submit" data-toggle="tooltip" title="Bilderansicht" class="btn btn-primary" name="style" value="1"><i class="fa fa-photo" style="font-size:36px"></i></button>
                            <button type="submit" data-toggle="tooltip" title="Kommentare anzeigen"class="btn btn-primary" name="style" value="2"><i class="fa fa-newspaper-o" style="font-size:36px"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <!-- Platzhalter-->
                <div class="col-sm-1"></div>
                <div class="col-sm-10 p-2 mb-3">
                <?php
                    if(isset($_GET["style"])) {
                        if($_GET["style"] == '1')
                        {
                            include_once("image_feed_just_images.php");
                        } else {
                            include_once("image_feed.php");
                        }
                    } else {
                        include_once("image_feed.php");
                    }
                ?>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/footer.php');?>
 </body>
</html>

<!-- Hier werden die Tooltips angezeigt-->
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
