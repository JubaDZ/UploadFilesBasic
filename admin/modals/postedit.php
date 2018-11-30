<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<form id="publicity_form" role="form" onsubmit="return false;">
	   
	   <div class="form-group" id="PublicityResults"> </div>
	   
	   
	   
	<div class="form-group">
      <label class="control-label" for="title"><?php echo $lang[190] ?></label><br>
	  <select  name="page_name" id="page_name" class="selectpicker"  data-width="100%" title="<?php echo $lang[190] ?>">
        <option value="ads_download"><?php echo $lang[128] ?></option>
		<option value="ads_index"><?php echo $lang[21]?></option>
		<option value="ads_google"><?php echo $lang[21].' - google'?></option>
      </select>
	  
    </div>
	   
	   
     <!-- title input-->
            <div class="form-group">
              <label class="control-label" for="title"><?php echo $lang[185] ?></label>
                <input name="title" maxlength="100" id="publicity_title"  value ="" type="text" placeholder="<?php echo $lang[185] ?>" class="form-control">
            </div>
    
 
    
            <!-- content body -->
            <div class="form-group">
              <label class="control-label" for="message"><?php echo $lang[186] ?></label>
                <textarea class="editor form-control" maxlength="21844" id="publicity_content" name="content" placeholder="<?php echo $lang[186] ?>..." rows="5"></textarea>
            </div>
		<div class="form-group">
		  <button type="submit" class="btn btn-primary btn-block" onclick="request('publicity','PublicityResults','publicity_form');"><?php echo $lang[187] ?></button>	
		</div>
</form>

  