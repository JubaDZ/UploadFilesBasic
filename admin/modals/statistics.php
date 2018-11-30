 <?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<!-- <p><?php echo SiteName() ?></p> -->  
<form id="delete_statistics_form" role="form" onsubmit="return false;">      
<div class="table-responsive"> 
  <table class="table">
    <thead>
      <tr>
	    <th><span id="span_select_all"><input id="select_all" type="checkbox" class="selectall" /></span></th>
		<th> <?php echo $lang[36]?> </th>
        <th> <?php echo $lang[105]?> </th>
		<!--<th><a href="javascript:void(0)" onclick="orderTable('id','stats');"><?php echo $lang[43]?></a></th>-->
 
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
	<tr id="button-selection"><td colspan="7"><button id="button_1" type="submit" class="btn btn-primary btn-block" onclick="confirm_request('delete_selected','DeleteSelectedResults','delete_statistics_form');"><?php echo $lang[32] ?></button></td></tr>
	<tr id="result-selection"><td id="DeleteSelectedResults" colspan="7"></td></tr>
  </table>
</div> 
</form>     
    <div id="page-selection"></div>
