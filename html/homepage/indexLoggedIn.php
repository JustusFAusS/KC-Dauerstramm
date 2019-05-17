<!-- Includes Bootstrap-->
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<html>
 <head>
   <style type="text/css">
   .jumbotron{
background-image: url('/KCD/resources/images/homepage/HomepageBild4.jpeg');
background-size:auto 100% ;
background-repeat: no-repeat;
 background-position: 95% center;
 height: 300;
}
</style>
  	<title>Homepage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body id="body">

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php');
start_session();
if (nutzer_angemeldet() == false){
		header('location: /KCD/index.php');
  }  ?>
   <div id="whole_page">

<?php include("header.php");?>


  <div class="jumbotron" style="background-color: #e0cccc;">
  <div class="container">
  <h1>Willkommen im internen Bereich!</h1>
  <p>Du bist jetzt eingeloggt...</p>
  </div>
</div>


<div class="container">
<div class="row">
    <!-- Platzhalter-->
    <div class="col-sm-1"></div>
    <!-- Linkes Menue. -->
    <div class="col-sm-5">
        <div class="bg-white p-2 mb-3 mt-3">
    <h2>Was ist neu?</h2>
    <?php
    // Anzeigen der neusten 5 Bilder aus dem Bilder-Feed
    include($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/uploadImage/image_feed_newest3ForHomepage.php");
    ?>
    <form action='/KCD/html/uploadImage/images.php' method="post">
    <input type="submit" name="btn_mehrAnzeigen" class="btn btn-primary" value="Mehr anzeigen">
  </from>
    </div>
  </div>
<div class="col-sm-5 mb-3 mt-3">
<div class="bg-white p-2">
    <h2>Mein Deckel</h2>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/penalties/sum_only_includable.php");?>
</div>
<div class="bg-white p-2">
    <h2>Terminübersicht</h2>
    Hier eine Terminübersicht
</div>

</div>
<div class="col-sm-1"></div>
</div>
</div>




      <?php include("footer.php");?>
 </body>
</html>
