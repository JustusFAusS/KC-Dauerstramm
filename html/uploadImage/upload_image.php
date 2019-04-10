<?php include('service_upload_image.php') ?>
<!DOCTYPE html>
<html>
<body>
<h1>Bild hochladen</h1>
<form action="upload_image.php" method="post" enctype="multipart/form-data">
        <?php include('errors.php'); ?>
        <div class="input-group">
                <label>Titel des Bildes</label>
                <input type="text" name="title" value="<?php echo $target_title; ?>">
        </div>
        <div class="input-group">
                <label>Kommentar</label>
                <input type="text" name="comment" value="<?php echo $target_comment; ?>">
        </div>
	<div class="input-group">
        	<input type="file" name="fileToUpload" id="fileToUpload">
	</div>
	<div class="input-group">
                <button type="submit" class="btn" name="save_image">Hochladen</button>
        </div>
</form>
</html>

