<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<!-- <p><?php echo sitename ?></p> --> 
<form id="delete_folders_form" role="form" onsubmit="return false;">   
<div class="table-responsive">    
  <table class="table table-bordered">
    <thead>
      <tr>
	    <th><span id="span_select_all"><input id="select_all" type="checkbox" class="selectall" /></span></th>
		<th><a href="javascript:void(0)" onclick="orderTable('userId','folders');"><?php echo $lang[35]?></a></th>
        <th><a href="javascript:void(0)" onclick="orderTable('folderName','folders');"><?php echo $lang[62]?></th>
		<th><?php echo $lang[42]?></a></th> 
		<th><a href="javascript:void(0)" onclick="orderTable('date_added','folders');"><?php echo $lang[33]?></a></th>	
		<th><a href="javascript:void(0)" onclick="orderTable('isPublic','folders');"><?php echo $lang[176]?></a></th>   		
		<th><a href="javascript:void(0)" onclick="orderTable('Id','folders');"><?php echo $lang[43]?></a></th>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
	<tr id="button-selection"><td colspan="7"><button id="button_1" type="submit" class="btn btn-primary btn-block" onclick="confirm_request('delete_selected','DeleteSelectedResults','delete_folders_form');"><?php echo $lang[32] ?></button></td></tr>
    <tr id="result-selection"><td id="DeleteSelectedResults" colspan="7"></td></tr>
  </table>
</div>
</form>     
    <div id="page-selection"></div>