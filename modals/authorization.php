<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<div  id="authorized-modal">
  <div class="<?php echo ClassAnimated ?> zoomIn">
      <div style="padding-bottom:15px;">
	     <i class="glyphicon glyphicon-question-sign"></i> <?php echo $lang[147] ?>
	  </div>
       <div class="authorized-footer">
	   <a href="?register"  class="btn btn-primary"><?php echo $lang[39] ?></a>
	   <a href="?login"  class="btn btn-primary"><?php echo $lang[20] ?></a>  
	 </div>
    </div>
  </div>
