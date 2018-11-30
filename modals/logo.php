<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php if(EnableLogo) {?>
<div class="panel panel-default col-sm-12 col-md-12 logo <?php echo ClassAnimated ?> bounceInDown" id="logo">
    <div class="row pnlbody"> 
        <a href="./" >
	        <img class="img-responsive" alt="logo" src="<?php echo siteurl ?>/assets/css/images/logo<?php echo (IsRtl()) ? 'ar' : ''; ?>.png" >
	    </a>
    </div>
</div>
 <?php } ?>