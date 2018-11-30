<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
	   <form id="contact_form" role="form" onsubmit="return false;" class="<?php echo ClassAnimated ?> zoomIn">
	   
	   <div class="form-group" id="ContactResults"> </div>
	   
	   
     <!-- Name input-->
            <div class="form-group">
              <label class="control-label" for="name"><?php echo $lang[35] ?></label>
                <input maxlength="50" name="name" id="contact_username" type="text" placeholder="<?php echo $lang[35] ?>" class="form-control">
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="control-label" for="email"><?php echo $lang[40] ?></label>   
                <input maxlength="50" name="email" type="text" placeholder="<?php echo $lang[40] ?>" class="form-control">
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="control-label" for="message"><?php echo $lang[53] ?></label>
                <textarea maxlength="10000" class="form-control" id="message" name="message" placeholder="<?php echo $lang[53] ?>..." rows="5"><?php echo (isGet('plan')) ? $lang[229] .' : '.(int)($_GET['plan']) ."\r\n" : ''; ?></textarea>
            </div>
		
		<?php if(EnableCaptcha){?>
		<div class="form-group">
         <img id="captcha_3" src="ajax/index.php?captcha&background=<?php echo BodyColor ?>&font=<?php echo FontColor ?>" onclick="this.src='ajax/index.php?captcha&background=<?php echo BodyColor ?>&font=<?php echo FontColor ?>&' + Math.random();" alt="captcha" style="cursor:pointer;">
	     <a href="javascript:void(0)" onclick="GenerateCaptcha('<?php echo BodyColor ?>','<?php echo FontColor ?>');"><span class="glyphicon glyphicon-refresh"></span></a>
	     <input type="text" class="captcha form-control" maxlength="4" name="captcha" placeholder="<?php echo $lang[54] ?>">
        </div>
		<?php }?>
		
		<div class="form-group">
		  <button type="submit" class="btn btn-primary btn-block" onclick="request('contact','ContactResults','contact_form');"><?php echo $lang[52] ?></button>
		</div>
		
	</form>
     
  
  