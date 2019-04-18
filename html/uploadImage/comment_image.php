<!DOCTYPE html>
<!--Aufruf über GET. Parameter (imageid)-->
<link rel="stylesheet" href="/KCD/html/bootstrap/bootstrap.css">
<script src="/KCD/html/bootstrap/bootstrap.bundle.js"></script>
<script src="/KCD/html/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<html>
<body>
    <?php include_once('service_upload_image.php') ?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/header.php');?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/functions.php');?>
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Bild Kommentieren</h4>
			</div>
			<div class="modal-body">
                <?php include('errors.php'); ?>
				<form action="/KCD/html/uploadImage/comment_image.php?imageid=<?php echo $_GET['imageid']; ?>" method="post">
					<div class="form-group">
						<textarea class="span5" rows="3" placeholder="Kommentar" required="required" style="min-width: 100%" name="comment_image_comment"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="comment_image" class="btn btn-primary btn-block btn-lg" value="Speichern">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<p>Kommentare können nicht gelöscht werden</p>
			</div>
		</div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/homepage/footer.php');?>
</body>
</html>

<?php


?>
