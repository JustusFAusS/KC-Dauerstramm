<?php include_once('service_news.php') ?>
<!DOCTYPE html>
<html>
<body>
<h1>Nachrichten eintragen:</h1>
<form action="add_news.php" method="post">
        <?php include('errors.php');
	?>
        <div class="input-group">
                <label>Titel der Nachricht</label>
                <input type="text" name="new_title" value="<?php echo $new_news_title ?>">
        </div>
        <div class="input-group">
                <label>Nachricht</label>
                <input type="text" name="new_message" value="<?php echo $new_news_message ?>">
        </div>
        <div class="input-group">
                <button type="submit" class="btn" name="add_news">Speichern</but$
        </div>
</form>
</html>

