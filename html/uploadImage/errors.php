<?php  if (count($upload_errors) > 0) : ?>
  session_start();
  <div class="error">
  	<?php foreach ($upload_errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
