<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
 <!-- EditPlanModal -->
  <div class="modal fade" id="EditPlanModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $lang[79] ?> </h4>
        </div>
        <div class="modal-body">
          
	<!-- <div class="modal-loader loading-spin"></div> -->	  
	<form id="editplan_form" role="form" onsubmit="return false;">
	
	 <div class="form-group" id="EditPlanResults"> </div>
	 <input id="plan_id" maxlength="15" name="plan_id" type="hidden" >
    <div class="input-group">
      <span class="input-group-addon" ><?php echo $lang[229] ?></span>

        <input id="plan_text" maxlength="15" type="text" readonly class="form-control"  placeholder="<?php echo $lang[229] ?>">
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml" ><?php echo $lang[25] ?></span>
        <input type="text" maxlength="1000" id="plan_extensions" name="extensions" class="form-control" placeholder="<?php echo $lang[25] ?>" data-role="tagsinput" >
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon" ><?php echo $lang[231] ?></span>
        <input type="text" maxlength="10" id="plan_price" name="price" class="form-control" placeholder="<?php echo $lang[231] ?>"  >
    </div>
	
	
	 <div class="input-group">
      <span class="input-group-addon" ><?php echo $lang[24] ?></span>
        <input type="text" id="plan_maxsize" name="maxsize" maxlength="255" class="form-control"  placeholder="<?php echo $lang[24] ?>">
	  <?php echo OptionSizeHtml('format_maxsize')?>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon" ><?php echo $lang[173] ?></span>
        <input type="text" id="plan_userspacemax" name="userspacemax" maxlength="255" class="form-control"  placeholder="<?php echo $lang[173] ?>">
	  <?php echo OptionSizeHtml('format_userspacemax')?>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon" ><?php echo $lang[234] ?></span>
        <input type="text" id="plan_speed" name="speed" maxlength="255" class="form-control"  placeholder="<?php echo $lang[234] ?>">
	  <?php echo OptionSizeHtml('format_speed')?>
    </div>
	
	 
	 <div class="input-group">
      <span class="input-group-addon" ><?php echo $lang[78] ?></span>
        <input type="text" id="plan_Interval" name="Interval"  class="form-control" placeholder="<?php echo $lang[78] ?>">
	  <span style="min-width: 60px;" class="input-group-addon" ><?php echo $lang[216] ?></span>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon" ><?php echo $lang[236] ?></span>
        <input type="text" id="plan_days_older" name="days_older"  class="form-control" placeholder="<?php echo $lang[236].' 30 '.$lang[222].' ...' ?>">
	  <span style="min-width: 60px;" class="input-group-addon" ><?php echo $lang[222] ?></span>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon" ><?php echo $lang[237] ?></span>
        <input type="text" id="plan_maxUploads" name="maxUploads"  class="form-control" placeholder="<?php echo $lang[237] ?>">
	  <span style="min-width: 60px;" class="input-group-addon" ><?php echo function_exists('ini_get') ? ini_get('max_file_uploads') : '' ?></span>
    </div>
	
	
	
	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[183] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[183] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input class="settings" id="plan_display_ads" name="display_ads" type="checkbox"> </span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[248] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[248] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input class="settings" id="plan_multiple" name="multiple" type="checkbox"> </span>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[172] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[172] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input class="settings" id="plan_thumbnail" name="thumbnail" type="checkbox"> </span>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[65] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[65] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input class="settings" id="plan_enable_userfolder" name="enable_userfolder" type="checkbox"></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[51] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[51] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input class="settings" id="plan_directdownload" name="directdownload" type="checkbox"></span>
    </div>
	
	
	
	
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[26] ?></span>
        <input type="text"  class="form-control"  placeholder="<?php echo $lang[26] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input class="settings" id="plan_deletelink" name="deletelink" type="checkbox"></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[28] ?></span>
        <input type="text"  class="form-control"  placeholder="<?php echo $lang[28] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input class="settings" id="plan_statistics" name="statistics" type="checkbox"></span>
    </div>
	
  
  
  </form>
	
        </div>
        <div class="modal-footer">

		  <button type="submit" id="BtnUpdatePlan" class="btn btn-primary btn-block" onclick="request('editplan','EditPlanResults','editplan_form');"><?php echo $lang[79] ?></button>
		
        </div>
      </div>
      
    </div>
  </div>