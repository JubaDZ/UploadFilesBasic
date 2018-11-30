<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<!-- <p><?php echo SiteName() ?></p> -->   


<form id="delete_comments_form" role="form" onsubmit="return false;">  
<div class="table-responsive">      
  <table class="table table-bordered">
    <thead>
      <tr>
	    <th><span id="span_select_all"><input id="select_all" type="checkbox" class="selectall" /></span></th>
        <th><a href="javascript:void(0)" onclick="orderTable('user_id','files');"><?php echo $lang[35]?></a></th>
        <th><a href="javascript:void(0)" onclick="orderTable('file_id','files');"><?php echo $lang[36]?></a></th>
		<th><a href="javascript:void(0)" onclick="orderTable('date','files');" ><?php echo $lang[84]?></a></th>
		<th class="hidden-xs"><?php echo $lang[241]?></th>
		<th><a href="javascript:void(0)" onclick="orderTable('id','files');"><?php echo $lang[43]?></a></th>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
	<tr id="button-selection"><td colspan="8"><button id="button_1" type="submit" class="btn btn-primary btn-block" onclick="confirm_request('delete_selected','DeleteSelectedResults','delete_comments_form');"><?php echo $lang[32] ?></button></td></tr>
    <tr id="result-selection"><td id="DeleteSelectedResults" colspan="8"></td></tr>
 </table>
 </div> 
</form>     
    <div id="page-selection"></div>