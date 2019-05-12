<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
      <div class="alert alert-danger" role="alert">
  	  <?php echo $error ?>
      </div>
  	<?php endforeach ?>
  </div>
<?php  endif ?>


<?php
  if (isset($success)) {  
    if (count($success) > 0) {
        echo "<div class='success'>";
  	    foreach ($success as $suc) {
            echo '<div class="alert alert-success" role="alert">';
  	        echo $suc;
            echo '</div>';
        }
    }
}
?>
