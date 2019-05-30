<!DOCTYPE html>
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
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/header.php');?>
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Bild hochladen</h4>
			</div>
			<div class="modal-body">
                <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/notifications.php"); ?>
				<form action="upload_image.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<i class="fa fa-user"></i>
						<input type="text" name="title" class="form-control" placeholder="Titel" required="required" value="<?php echo $target_title; ?>">
					</div>
                    <div class="form-group">
						<i class="fa fa-envelope"></i>
						<input type="text" name="comment" class="form-control" placeholder="Kommentar" required="required" value="<?php echo $target_comment; ?>">
					</div>
					<div class="form-group">
						<input type="file" name="fileToUpload" id="fileToUpload">
                        <p> (Bilder sind nicht Optional) </p>
					</div>
					<div class="form-group">
						<input type="submit" name="save_image" class="btn btn-primary btn-block btn-lg" value="Hochladen">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<a href="login.php">Bilder können von dir und allen Administratoren gelöscht werden</a>
			</div>
		</div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/footer.php');?>
</body>
</html>
