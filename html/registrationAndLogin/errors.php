<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
      <div class="alert alert-danger" role="alert">
  	  <?php echo $error ?>
      </div>
  	<?php endforeach ?>
  </div>
<?php  endif ?>


<?php  if (count($success) > 0) : ?>
  <div class="success">
  	<?php foreach ($success as $suc) : ?>
      <div class="alert alert-success" role="alert">
  	  <?php echo $suc ?>
      </div>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
