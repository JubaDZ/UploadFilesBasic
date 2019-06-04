<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php
if(defined('LastIp')){ 
$InfoByIp = getLocationInfoByIp_2(longtoip(LastIp));
$country  = GetCountryName(protect($InfoByIp['countryCode']));
} else $country = GetCountryName('UN');
?>
<form id="profile_form" role="form" onsubmit="return false;" class="<?php echo ClassAnimated ?> zoomIn">
	   	
  <ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#profilehome"><?php echo $lang[105] ?></a></li>
	<li><a data-toggle="tab" href="#profilestats"><?php echo $lang[28] ?></a></li>
	<li><a data-toggle="tab" href="#profileedit"><?php echo $lang[187] ?></a></li>
  </ul>

<div class="tab-content">
  <div id="profilehome" class="tab-pane fade in active">
  
 <div class="well">
 
 <div class="form-group">
    <label for="username"><?php echo $lang[35] ?></label>
    <input type="text" class="form-control" value="<?php  echo defined('UserName') ? UserName : '' ?>" disabled>
  </div>
 
  <div class="form-group">
    <label for="user_level"><?php echo $lang[58] ?> </label>
    <input type="text" class="form-control" value="<?php echo user_level(IsAdmin) ?>" disabled>
  </div>
  
  <div class="form-group">
    <label for="user_plan"><?php echo $lang[229] ?></label>
    <input type="text" class="form-control" value="<?php  echo user_plan(PlanId) ?>" disabled>
  </div>
  

  
   <div class="form-group">
    <label for="key"><?php echo $lang[255] ?></label>
	<div class="input-group" style="margin: 0px;">
        <input type="text" id="key"  class="form-control" readonly value="<?php echo clean(Encrypt(TwoWayEncrypt(UserEmail,RegisterDate))) ?>" placeholder="<?php echo $lang[255]?>" >
	        <span class="input-group-btn">
			    <button class="btn btn-primary" onclick="CopyLink('key')" type="button"><?php echo $lang[146] ?></button>
		    </span>
	</div>
	 </div>
	 

 </div> <!-- well -->
</div><!-- tab home -->
  
  
  <div id="profileedit" class="tab-pane fade">
  <div class="well" id="well">
  <div class="form-group" id="ProfileResults"> </div>
 
   <div class="form-group">
    <label for="password"><?php echo $lang[37] ?></label>
    <input type="password" name="password" class="form-control" maxlength="20"  placeholder="<?php echo $lang[37]?>" required>
  </div>
  
  
   <div class="form-group">
    <label for="email"><?php echo $lang[40] ?> </label>
    <input type="text" name ="email" class="form-control" maxlength="40" placeholder="<?php echo $lang[40]?>" value="<?php echo defined('UserEmail') ? UserEmail : ''  ?>" required>
  </div>
  
   <div class="form-group">
    <label for="showfiles"><?php echo $lang[294] ?> </label>
	
  
  	<div class="input-group">
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[294]  ?>" disabled>
		<span class="input-group-addon" style="min-width: 15px;text-align: left;"><input name="showfiles" class="checkbox" type="checkbox" <?php if(Sql_user_showfiles(UserID)) echo ' checked' ?>></span>
    </div>
    </div>
 
 
 <?php if(EnableCaptcha){?>
   <div class="form-group">
    <img id="captcha_4" src="ajax/index.php?captcha&background=<?php echo WellColor ?>&font=<?php echo FontColor ?>" onclick="this.src='ajax/index.php?captcha&background=<?php echo WellColor ?>&font=<?php echo FontColor ?>&' + Math.random();" alt="captcha" style="cursor:pointer;">
	<a href="javascript:void(0)" onclick="GenerateCaptcha('<?php echo BodyColor ?>','<?php echo FontColor ?>');"><span class="glyphicon glyphicon-refresh"></span></a>
	<input type="text" class="captcha form-control" maxlength="4" name="captcha" placeholder="<?php echo $lang[54] ?>">
   </div>
 <?php }?>
   <div class="form-group">
     <button type="button" class="btn btn-primary btn-block" onclick="request('edituser','ProfileResults','profile_form');"><?php echo $lang[79] ?></button>
   </div>
   
  </div><!-- well  -->
 </div><!-- tab -->
 
 
  <div id="profilestats" class="tab-pane fade">
  
  <div class="well" id="well">
  <div class="form-group" id="ProfileResults"> </div>
 
   <div class="form-group">
    <label for="LastIp"><?php echo $lang[83] ?></label>
    <input type="LastIp" name="LastIp" class="form-control"  placeholder="<?php echo $lang[83]?>" value="<?php echo defined('LastIp') ? longtoip(LastIp) .' / ('.$country.')' : ''  ?>" disabled>
  </div>
  
  
   <div class="form-group">
    <label for="LastVisit"><?php echo $lang[262] ?> </label>
    <input type="text" name ="LastVisit" class="form-control" placeholder="<?php echo $lang[262]?>" value="<?php echo defined('LastVisit') ? (date('Y-m-d H:i:s',LastVisit)) .' / (' .time_elapsed_string(date('Y-m-d H:i:s',LastVisit)).')' : '' ?>" disabled>
  </div>
  
  
   <div class="form-group">
    <label for="Numberoffiles"><?php echo $lang[44] ?> </label>
    <input type="text" name ="Numberoffiles" class="form-control" placeholder="<?php echo $lang[44]?>" value="<?php echo Sql_Get_Files_Count(); ?>" disabled>
  </div>
  
    <div class="form-group">
    <label for="Numberoffiles"><?php echo $lang[34] ?> </label>
    <input type="text" name ="Numberoffiles" class="form-control" placeholder="<?php echo $lang[34]?>" value="<?php echo Sql_Get_Downloads_Count(); ?>" disabled>
  </div>
  
  
  
  
  
  
    <div class="form-group"><!--.' / '.FileSizeConvert(UserSpace)."-".FileSizeConvert(user_space_max)  -->
    <label for="user_Space"><?php echo $lang[173] ?> </label>
	<table class="table table-bordered">
	   <tr class="active">
	     <td class="danger" style="width:<?php echo PercentageUsed ?>%"><?php echo FileSizeConvert( $_SESSION['login']['user_space_used']) ?></td>
		 <td class="success" style="width:<?php echo PercentageFree ?>%"><?php echo FileSizeConvert( user_space_max) ?></td>
	   </tr>
	</table>

     <div class="progress">
       <div class="progress-bar progress-bar-danger" role="progressbar" id="progressUsed" style="width:<?php echo PercentageUsed ?>%">
	   <?php echo PercentageUsed ?>%
	   </div>
	   <div class="progress-bar progress-bar-success" role="progressbar" id="progressFree" style="width:<?php echo PercentageFree ?>%">
	   <?php echo PercentageFree ?>%
	   </div>
     </div>
  </div>
  
  <div class="form-group">
    <label for="user_Space"><?php echo $lang[292] ?> </label>
  
  <div  class="form-group panel-group">
    <div class="panel panel-default">
	    <div class="panel-body" id="DivChartDates">
           <canvas class="col-xs-12" style="margin-top:60px;" id="ChartDates"></canvas>
        </div>
    </div>
  </div>
  </div>
  
  </div><!-- well  -->
 </div><!-- tab -->
 
 
 
 
 
</div><!-- tab-content -->	

  
  </form>
  

       
		  

  