 <?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<form id="backup_db_form" role="form" onsubmit="return false;">   
<div class="table-responsive">         
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><span id="span_select_all"><input id="select_all" type="checkbox" class="selectall" /></span></th>
        <th><?php echo $lang[264] ?></th>
      </tr>
    </thead>
	
    <tbody id="tbody">
    </tbody>
	
	<tr id="button-selection"><td colspan="8"><button id="button_1" type="submit" class="btn btn-primary btn-block" onclick="Download_Attachment('BackupDbResults','backup_db_form');"><?php echo $lang[263] ?></button></td></tr>
    <tr id="result-selection"><td id="BackupDbResults" colspan="8"></td></tr>
 </table>
 </div> 
 
 
</form>   





