<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Termin hinzufügen</title>
  </head>
  <body>
    <?php include_once('service_event.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/header.php');?>

    <div class="modal-dialog modal-login">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h4 class="modal-title">Termin hinzufügen</h4>
  			</div>
  			<div class="modal-body">
                  <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/notifications.php"); ?>
  				<form action="add_event.php" method="post" enctype="multipart/form-data">
  					<div class="form-group">
  						<i class="fa fa-user"></i>
  						<input type="text" name="title" class="form-control" placeholder="Titel" required="required">
  					</div>
            <div class="form-group">
  						<i class="fa fa-envelope"></i>
  						<input type="text" name="date" class="form-control" placeholder="Datum" required="required">
  					</div>
            <div class="form-group">
  						<i class="fa fa-envelope"></i>
  						<input type="text" name="message" class="form-control" placeholder="Beschreibung" required="required">
  					</div>
            <div class="form-group">
  						<input type="submit" name="add_event" class="btn btn-primary btn-block btn-lg" value="Event Speichern">
  					</div>
  				</form>
  			</div>
  		</div>
      </div>


    <!-- <h1>zukünftigen Termin hinzufügen:</h1>
    <form action="add_event.php" method="post">
            <?php //('errors.php');?>
            <div class="input-group">
                    <label>Titel des Termins</label>
                    <input type="text" name="new_title" value="">
            </div>
            <div class="input-group">
                    <label>Datum</label>
                    <input type="text" name="new_message" value="">
            </div>
            <div class="input-group">
                    <label>Beschreibung</label>
                    <input type="text" name="new_message" value="">
            </div>
            <div class="input-group">
                    <button type="submit" class="btn btn-outline-success" name="add_news">Speichern</but$
            </div>
    </form>
  </div> -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/footer.php');?>
  </body>
</html>
