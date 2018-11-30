<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php define('footerTxt',FooterInfo()) ?>
<div class="container" id="myFooter">
 <div class="row">
    <div class="col-sm-3 col-md-3"> </div>
	<div class="col-sm-9 col-md-9">
	 <div class="btn-primary footer <?php echo ClassAnimated ?> bounceInDown" >
      <div style="padding: 15px;">
        <div class="text-muted" id="footer"> 
		
		 <span id="footerTxt"><?php echo footerTxt ?></span>
		 <div class="hidden-xs pull-<?php directionDiv(); ?>">
		 <ul class="list-inline">
		   <li><a href="<?php echo facebook; ?>" target="_blank"><i class="btn btn-facebook btn-circle icon-facebook"></i></a></li>
		   <li><a href="<?php echo twitter; ?>" target="_blank"><i class="btn btn-twitter btn-circle icon-twitter"></i></a> </li>
		   <li><a href="<?php echo gplus; ?>" target="_blank"><i class="btn btn-gplus btn-circle icon-gplus"></i> </a></li>
		  </ul>
		 </div>
		</div >
      </div>
	 </div>
	</div>
  </div>
</div>
	<!-- Copyright onexite © 2018. All rights reserved. Therms of use | Privacy Policy -->