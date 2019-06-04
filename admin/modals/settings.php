<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
 
 <!-- SettingsModal -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#setting" data-toggle="tab"><?php echo $lang[29] ?></a></li>
	  <li><a href="#permissions" data-toggle="tab"><?php echo $lang[250] ?></a></li>
	  <li><a href="#maxi" data-toggle="tab"><?php echo $lang[24] ?></a></li>
	  <li><a href="#style" data-toggle="tab"><?php echo $lang[70] ?></a></li>
	  <li><a href="#banned" data-toggle="tab"><?php echo $lang[269] ?></a></li>
      <li><a href="#terms" data-toggle="tab"><?php echo $lang[152].' ...' ?></a></li>
	  <li><a href="#closesite" data-toggle="tab"><?php echo $lang[64] ?></a></li>
    </ul>
    
	<form id="settings_form" role="form" onsubmit="return false;" class="tab-content">
	
	 <div id="SettingsResults"> </div>
	 
	 
	<div class="well tab-pane fade" id="style">
	
  	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[70] ?></span>
       <select onchange="SelectStyleSheet(this);" name="theme" class="selectpicker" data-live-search="true"  data-width="100%"  title="<?php echo $lang[70] ?>">
	    <option value="<?php echo str_replace(".min.css","",theme)  ?>" selected><?php echo str_replace(".min.css","",theme)  ?></option>
		<?php for($i=0;$i<count(ListStyles());$i++) echo '<option value="'.ListStyles()[$i].'">'.ListStyles()[$i].'</option>';?>
      </select>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[191] ?></span>
        <input readonly name="WellColor" id="WellColor" type="text"  maxlength="255" class="form-control" value="<?php echo WellColor ?>" style="text-align: left;direction: ltr;" >
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[191] ?></span>
        <input readonly id="BodyColor" name="BodyColor" type="text"  maxlength="255" class="form-control" value="<?php echo BodyColor ?>" style="text-align: left;direction: ltr;" >
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[191] ?></span>
        <input readonly id="FontColor" name="FontColor" type="text"  maxlength="255" class="form-control" value="<?php echo FontColor ?>" style="text-align: left;direction: ltr;" >
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[253] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[253] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="animated" class="settings" type="checkbox" <?php if(animated) echo ' checked' ?>></span>
    </div>
	
</div> <!-- tab-style -->
	 
	 
	<div class="well tab-pane fade" id="banned">

	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[266] ?></span>
        <input type="text" maxlength="1000" name="banned_ips" value="<?php echo banned_ips ?>" class="form-control" placeholder="<?php echo $lang[266] ?>" data-role="tagsinput" >
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[267] ?></span>
        <input type="text" maxlength="1000" id="banned_countries" name="banned_countries" value="<?php echo banned_countries ?>" class="form-control" placeholder="<?php echo $lang[267] ?>"  >
    </div>
	

</div> <!-- tab-banned -->
	 
      <div class="well tab-pane active in" id="setting">
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[72] ?></span>
        <input name="sitename" type="text"  maxlength="255" class="form-control" value="<?php echo sitename ?>" style="text-align: left;direction: ltr;" placeholder="<?php echo $lang[72] ?>">
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[112] ?></span>
        <input name="rtlsitename" type="text" maxlength="255" class="form-control" value="<?php echo rtlsitename ?>" placeholder="<?php echo $lang[112] ?>">
    </div>

    <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[18] ?></span>
        <input name="siteurl" type="text" maxlength="255" class="form-control" value="<?php echo siteurl ?>" style="text-align: left;direction: ltr;" placeholder="<?php echo $lang[18] ?>">
    </div>
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[40] ?></span>
        <input type="text"  name="sitemail" maxlength="255" class="form-control" value="<?php echo sitemail ?>" style="text-align: left;direction: ltr;" placeholder="<?php echo $lang[40] ?>">
    </div>
	<div class="input-group">
      <span class="input-group-addon hidden-sml"> <?php echo $lang[63] ?> </span>
        <input type="text"  name="folderupload" maxlength="255" class="form-control" value="<?php echo folderupload ?>" style="text-align: left;direction: ltr;" placeholder="<?php echo $lang[63] ?>">
    </div>
	
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[68] ?></span>
	  
	  <select  name="language" class="selectpicker" data-live-search="true"  data-width="100%"  title="<?php echo $lang[68] ?>">
	    <!--<option value="<?php echo InterfaceLanguage ?>" selected><?php echo GetLanguageCode(InterfaceLanguage)  ?></option>-->
		<option value="<?php echo language ?>" selected><?php echo $lang[113] ?></option>	
        <option value="ar">العربية</option>
		<option value="en">English</option>
		<option value=""><?php echo $lang[114] ?></option>
      </select>
	  
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[66] ?></span>
	  <select name="time_zone" class="selectpicker" data-live-search="true"  data-width="100%"  title="<?php echo $lang[66] ?>">
	    <option selected><?php echo time_zone ?></option>
        <?php echo LoadTimeZones(); ?>
      </select>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[67] ?></span>
        <input type="text"  maxlength="30" name="prefixname" value="<?php echo prefixname ?>" class="form-control" style="text-align: left;direction: ltr; " placeholder="<?php echo $lang[67] ?>">
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[25] ?></span>
        <input type="text" maxlength="1000" name="extensions" value="<?php echo extensions ?>" class="form-control" placeholder="<?php echo $lang[25] ?>" data-role="tagsinput" >
    </div>

	
	</div> <!-- tab-settings -->
	
		<div class="well tab-pane fade" id="permissions">
	 
	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[172] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[172] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="thumbnail" class="settings" type="checkbox" <?php if(thumbnail) echo ' checked' ?>> </span>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[55] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[55] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="register" class="settings" type="checkbox" <?php if(register) echo ' checked' ?>></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[65] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[65] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="enable_userfolder" class="settings" type="checkbox" <?php if(enable_userfolder) echo ' checked' ?>></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[265] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[265] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="enable_orgFilename" class="settings" type="checkbox" <?php if(enable_orgFilename) echo ' checked' ?>></span>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[149] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[1].' / '.$lang[149] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="authorized" class="settings" type="checkbox" <?php if(authorized) echo ' checked' ?>></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[51] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[51] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="directdownload" class="settings" type="checkbox" <?php if(directdownload) echo ' checked' ?>></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[26] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[26] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="deletelink" class="settings" type="checkbox" <?php if(deletelink) echo ' checked' ?>></span>
    </div>
	

	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[248].'/'.$lang[174] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[259]  ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="multiple" class="settings" type="checkbox" <?php if(multiple) echo ' checked' ?>></span>
    </div>
	
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[248].'/'.$lang[158] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[260] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="multipleSelect" class="settings" type="checkbox" <?php if(multipleSelect) echo ' checked' ?>></span>
    </div>
	
	
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[240] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[240] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="EnableComments" class="settings" type="checkbox" <?php if(EnableComments) echo ' checked' ?>></span>
    </div>
	
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[254] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[254] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="EnableCaptcha" class="settings" type="checkbox" <?php if(EnableCaptcha) echo ' checked' ?>></span>
    </div>
	
	
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[28] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[28]  ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="statistics" class="settings" type="checkbox" <?php if(statistics) echo ' checked' ?>></span>
    </div>
	
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[281] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[281] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="ApiStatus" class="settings" type="checkbox" <?php if(ApiStatus) echo ' checked' ?>></span>
    </div>
	
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[282] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[282] ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="access_contact" class="settings" type="checkbox" <?php if(access_contact) echo ' checked' ?>></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[283] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[283]  ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="access_plans" class="settings" type="checkbox" <?php if(access_plans) echo ' checked' ?>></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[284] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[284]  ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="access_forgot" class="settings" type="checkbox" <?php if(access_forgot) echo ' checked' ?>></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[294] ?></span>
        <input type="text"  class="form-control hidden-sml" placeholder="<?php echo $lang[258].$lang[294]  ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="showUserfiles" class="settings" type="checkbox" <?php if(showUserfiles) echo ' checked' ?>></span>
    </div>
	
    </div> <!-- tab-permissions -->
	
	
	<div class="well tab-pane fade" id="maxi">
	
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[24] ?></span>
        <input type="text"  name="maxsize" maxlength="255" class="form-control" value="<?php echo nbrOnly(maxsize) ?>" placeholder="<?php echo $lang[24] ?>">
	  <?php echo OptionSizeHtml('format_maxsize',(maxsize))?>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[173] ?></span>
        <input type="text"  name="userspacemax" maxlength="255" class="form-control" value="<?php echo nbrOnly(userspacemax) ?>" placeholder="<?php echo $lang[173] ?>">
	  <?php echo OptionSizeHtml('format_userspacemax',(userspacemax))?>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[234] ?></span>
        <input type="text"  name="speed" maxlength="255" class="form-control" value="<?php echo nbrOnly(speed) ?>" placeholder="<?php echo $lang[234] ?>">
	  <?php echo OptionSizeHtml('format_speed',(speed))?>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml" ><?php echo $lang[236] ?></span>
        <input type="text"  name="days_older" value="<?php echo days_older ?>" class="form-control" placeholder="<?php echo $lang[236].' 30 '.$lang[222].' ...' ?>">
	  <span style="min-width: 60px;" class="input-group-addon" ><?php echo $lang[222] ?></span>
    </div>
	 
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[78] ?></span>
        <input type="text"  name="Interval" value="<?php echo Interval ?>" class="form-control" placeholder="<?php echo $lang[78] ?>">
	  <span style="min-width: 60px;" class="input-group-addon"><?php echo $lang[216] ?></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml" ><?php echo $lang[237] ?></span>
        <input type="text"  name="maxUploads" value="<?php echo maxUploads ?>" class="form-control" placeholder="<?php echo $lang[237] ?>">
	  <span style="min-width: 60px;" class="input-group-addon" ><?php echo function_exists('ini_get') ? ini_get('max_file_uploads') : '' ?></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[69] ?></span>
        <input type="text"  name="rowsperpage" value="<?php echo rowsperpage ?>" class="form-control" placeholder="<?php echo $lang[249] ?>">
		<span style="min-width: 60px;" class="input-group-addon"><?php echo $lang[261] ?></span>
    </div>
	
	</div> <!-- tab-maxi -->
	
	
	
	
	
	<div class="well tab-pane fade" id="closesite">
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"> <?php echo $lang[64] ?> </span>
         <textarea maxlength="21844" class="editor form-control" rows="5" id="closemsg" name="closemsg"  placeholder="<?php echo $lang[64] ?>"><?php echo closemsg ?></textarea>
		 <span class="input-group-addon" style="min-width: 15px;text-align: left;"><input id="siteclose" name="siteclose" class="settings" type="checkbox" <?php if(siteclose) echo ' checked' ?>></span>
    </div>
	
	</div> <!-- tab-closesite -->
	

	
	<div class="well tab-pane fade" id="terms">
  
  	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[152] ?></span>
	    <textarea maxlength="21844" class="editor form-control" rows="5" name="terms" id="editor" placeholder="<?php echo $lang[152] ?>"><?php echo terms ?></textarea>
    </div>
	
  
    <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[153] ?></span>
	    <textarea maxlength="21844" class="editor form-control" rows="5" name="privacy" id="privacy" placeholder="<?php echo $lang[153] ?>"><?php echo privacy ?></textarea>
    </div>
	
	</div> <!-- tab-terms -->
	
	</form> <!-- tab-content -->


	<br>
  <div class="form-group">
     <button id="btn" type="submit" class="btn btn-primary btn-block" onclick="request('settings','SettingsResults','settings_form');"><?php echo $lang[71] ?></button>
  </div>