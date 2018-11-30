<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
 <!-- EditUserModal -->
  <div class="modal fade" id="EditUserModal" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="EditUserModal_title"><?php echo $lang[79] ?> </h4>
        </div>
        <div class="modal-body">
          
	<!-- <div class="modal-loader loading-spin"></div> -->	  
	<form id="edituser_form" role="form" onsubmit="return false;">
	
	 <div class="form-group" id="EditUserResults"> </div>
	
    <div class="input-group">
      <span class="input-group-addon" style="min-width: 120px;"><?php echo $lang[35] ?></span>
	    <input id="user_id" name="user_id" type="hidden" >
        <input id="username" maxlength="15" name="username" type="text" class="form-control" value="<?php  ?>" placeholder="<?php echo $lang[35] ?>">
    </div>
	
	<div class="input-group">
      <span class="input-group-addon" style="min-width: 120px;"><?php echo $lang[37] ?></span>
        <input id="password" maxlength="20" name="password" type="password" class="form-control" value="<?php  ?>" placeholder="<?php echo $lang[37] ?>">	
    </div>
	<!-- data-toggle="password"  -->
	<div class="input-group">
      <span class="input-group-addon" style="min-width: 120px;"><?php echo $lang[40] ?></span>
        <input id="email" name="email" maxlength="40" type="text" class="form-control" value="<?php  ?>" placeholder="<?php echo $lang[40] ?>">
    </div>

	
    <div class="input-group">
      <span class="input-group-addon" style="min-width: 120px;"><?php echo $lang[57] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[58] ?>" disabled>
	  <span class="input-group-addon" style="min-width: 15px;"><input class="settings" id="level" name="level" type="checkbox" <?php  ?>> </span>
    </div>
  
	
	 <div class="input-group">
      <span class="input-group-addon" style="min-width: 120px;"> <?php echo $lang[3] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[80] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;"><input class="settings" id="status" name="status" type="checkbox" <?php  ?>> </span>
    </div>
  
	<div class="input-group">
	<span class="input-group-addon" style="min-width: 120px;"> <?php echo $lang[229] ?></span>
	  <select name="plan_id" class="selectpicker" data-live-search="true"  data-width="100%"  title="<?php echo $lang[229] ?>">
		<option value="0" selected><?php echo $lang[226] ?></option>	
        <option value="1"><?php echo $lang[227] ?></option>
		<option value="2"><?php echo $lang[228] ?></option>
      </select>
	</div>
  </form>
	
        </div>
        <div class="modal-footer">

		  <button type="submit" id="BtnUpdateUser" class="btn btn-primary btn-block" onclick="request('edituser','EditUserResults','edituser_form');"><?php echo $lang[79] ?></button>
		
        </div>
      </div>
      
    </div>
  </div>