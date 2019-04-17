<?php  if (count($upload_errors) > 0) : ?>
    <div class="error">
  	    <?php foreach ($upload_errors as $error) : ?>
            <div class="alert alert-danger" role="alert">
  	        <?php echo $error ?>
            </div>
  	    <?php endforeach ?>
    </div>
<?php  endif ?>
