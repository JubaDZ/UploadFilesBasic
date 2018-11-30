<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php
$pathInfo = pathinfo($_SERVER['PHP_SELF']); 
define('_dirname_', $pathInfo['dirname'] );
?>
<script type="text/JavaScript">
document.write('<style type="text/css">body {visibility: visible;}</style>');
</script>
<style>
	@media (min-width: 979px) {
    body {
		padding-top: 60px; 
	}
	.container {
  		width: 540px;
  	}
}

.vtexIdUI-page {
	box-shadow: 0 0 3px #ccc;
}

.vtexIdUI-code-field {
	margin: 0 auto;
	width: 30%;
	margin-bottom: 10px;
}


.alert-general {
    border-radius: 0;
    border-width: 1px 0 1px 0;
    margin-bottom: 0;
}
.alert-modal-body {padding-top: 15px;}
</style>
	
<div class="container">
  
    <div class="vtexIdUI-page">
      <div class="modal-header btn-primary">
        <h4><span class="vtexIdUI-heading"><?php echo $lang[111] ?></span> <small class="pull-<?php directionDiv(); ?>"><?php echo $lang[14]?> 404</small></h4>
      </div>
      
      <div class="alert alert-info alert-general alert-modal-body clearfix">
        <i class="icon-frown icon-4x pull-<?php directionDiv(); ?>"></i>
        <p><?php echo $lang[167] ?> <strong><?php echo _dirname_ ?></strong> <?php echo $lang[166] ?><br>
          <small><?php echo $lang[165] ?></small>
        </p>
      </div>
      
        <div class="modal-footer">
          <a class="vtexIdUI-back-link pull-<?php directionDiv(); ?> dead-link" href="./" ><i class="icon-arrow-<?php directionDiv(); ?>"></i> <?php echo $lang[156] ?></a>
          <button class="btn pull-<?php directionDiv(true); ?> btn-large" type="submit" disabled><?php echo $lang[27] ?></button>
        </div>

    </div>
  
</div>