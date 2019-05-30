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
<head>
    <title>Bild löschen</title>
</head>
<body>
    <?php include_once('service_upload_image.php') ?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/header.php');?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/functions.php');?>

    <?php //Laden des Bildes
        $img_title;
        $img_comment;
        $img_path;
        if ($delete_success == false) {
            if (nutzer_angemeldet()) {
                $getMatchedImages = "SELECT * from images where ImageID='" . $_GET['imageid'] . "';";
                //Query ausführen und anschließend in ein Array umwandeln
                $result = mysqli_query($db, $getMatchedImages);
                $found_images = mysqli_fetch_array($result,MYSQLI_ASSOC);
                //Wurde eine Nutzer-ID gefunden?
                if (isset($found_images)) {
                    $img_title = htmlspecialchars($found_images["ImageTitle"], ENT_QUOTES, 'UTF-8');
                    $img_comment = htmlspecialchars($found_images["ImageComment"], ENT_QUOTES, 'UTF-8');
                    $img_path = htmlspecialchars($found_images["ImageDir"], ENT_QUOTES, 'UTF-8');
                } else {
                    array_push($errors, "Fehler: Das zu löschende Bild existiert nicht!");
                    $img_title = "Nicht definiert";
                    $img_comment = "Kein Kommentar zu diesem Bild vorhanden";
                }
            } else {
                header("/KCD/index.php");
            }
        } else {
            $img_title = "Nicht definiert";
            $img_comment = "Kein Kommentar zu diesem Bild vorhanden";
            $img_path = "/KCD/resources/images/homepage/HomepageIcon.png";
        }
    ?>
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Bild Löschen</h4>
			</div>
			<div class="modal-body">
                <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/KCD/html/global/notifications.php"); ?>
				<form method="post">
                    <img src="<?php echo $img_path; ?>" alt="Bild nicht verfügbar" class="img-thumbnail rounded mb-1">
                        <div class="img-thumbnail rounded mb-1">
                        <h3><?php echo $img_title; ?></h3>
                        <p><?php echo $img_comment; ?></p>
                        </div>
					<div class="form-group">
						<input type="<?php if ($delete_success) { echo "button";} else { echo "submit"; } ?>" name="delete_image" class="btn btn-primary btn-block btn-lg <?php if ($delete_success) { echo "disabled";} ?>" value="Löschen">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<p>Obacht. Ein gelöschtes Bild wird (inkl. der zugehörigen Kommentare) gelöscht. Eine Wiederherstellung ist unmöglich!</p>
			</div>
		</div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/KCD/html/global/footer.php');?>
</body>
</html>
