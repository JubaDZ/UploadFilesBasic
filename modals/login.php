<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<form id="login_form" role="form" onsubmit="return false;" class="<?php echo ClassAnimated ?> zoomIn">
	   
	<div class="form-group" id="LoginResults"> </div>
	   
	  
  <div class="form-group">
    <label for="Email"><?php echo $lang[35] ?></label>
    <input type="text" id="login_username" class="form-control" name="Email" maxlength="15" placeholder="<?php echo $lang[35] ?>" tabindex="1" required>
  </div>
  
  <div class="form-group">
    <label for="Password"><?php echo $lang[37] ; if(defined('access_forgot') && access_forgot){ ?> ( <a href="?forgot" tabindex="3"><?php echo $lang[41] ?></a> ) <?php } ?></label>
    <input type="password" class="form-control" maxlength="20" name="Password" placeholder="<?php echo $lang[37] ?>" tabindex="2" required>
  </div>
  <?php if(defined('EnableCaptcha') && EnableCaptcha){?>
    <div class="form-group">
    <img id="captcha_1" src="ajax/index.php?captcha&background=<?php echo BodyColor ?>&font=<?php echo FontColor ?>" onclick="this.src='ajax/index.php?captcha&background=<?php echo BodyColor ?>&font=<?php echo FontColor ?>&' + Math.random();" alt="captcha" style="cursor:pointer;">
	<a href="javascript:void(0)" onclick="GenerateCaptcha('<?php echo BodyColor ?>','<?php echo FontColor ?>');"><span class="glyphicon glyphicon-refresh"></span></a>
	<input type="text" class="captcha form-control" maxlength="4"  name="captcha" placeholder="<?php echo $lang[54] ?>">
  </div>
  <?php }?>
  <div class="form-group">
     <button type="submit" class="btn btn-primary btn-block" tabindex="4" onclick="request('login','LoginResults','login_form');"><?php echo $lang[20] ?></button>	
  </div>
</form>
