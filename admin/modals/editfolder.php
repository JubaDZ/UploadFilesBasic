<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
 <!-- EditFolderModal -->
  <div class="modal fade" id="EditFolderModal" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $lang[62].' / '.$lang[79] ?> </h4>
        </div>
        <div class="modal-body">
          
		 <!-- <div class="modal-loader loading-spin"></div> --> 
		  
	<form id="editfolder_form" role="form" onsubmit="return false;">
	
	 <div class="form-group" id="EditFolderResults"> </div>
	
    <div class="input-group">
      <span class="input-group-addon" style="min-width: 120px;"><?php echo $lang[62] ?></span>
	    <input id="folder_id" name="folder_id" type="hidden" >
        <input id="folder_name" name="folderName"  maxlength="255" type="text" class="form-control" value="<?php  ?>" placeholder="<?php echo $lang[62] ?>">
    </div>
	
	<div class="input-group">
      <span class="input-group-addon" style="min-width: 120px;"><?php echo $lang[37] ?></span>
        <input id="folder_password" name="password"  maxlength="20" type="password" class="form-control" value="<?php  ?>" placeholder="<?php echo $lang[37] ?>">
    </div>
	
	<div class="input-group">
      <span class="input-group-addon" style="min-width: 120px;"><?php echo $lang[35] ?></span>
        <input id="folder_user" name="username"  maxlength="15" type="text" class="form-control" value="<?php  ?>" placeholder="<?php echo $lang[35] ?>">
    </div>

	
	 <div class="input-group">
      <span class="input-group-addon" style="min-width: 120px;"><?php echo $lang[176] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[176] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;"><input id="folder_ispublic" class="settings" name="ispublic" type="checkbox" <?php  ?>></span>
    </div>
  
  
  </form>
	
        </div>
        <div class="modal-footer">

		  <button type="submit" id="BtnUpdateFolder" class="btn btn-primary btn-block" onclick="request('editfolder','EditFolderResults','editfolder_form');"><?php echo $lang[79] ?></button>
		
        </div>
      </div>
      
    </div>
  </div>