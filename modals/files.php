<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php 
$currentpage = (isGet('currentpage') && is_numeric($_GET['currentpage'])) ? (int) $_GET['currentpage'] : 1;
$totalpages = Sql_totalpages() ;
$totalpages = ($totalpages < 1) ? 1 : $totalpages; 
?>
		   
<div class="form-group">
<?php if(IsLogin) {?>
<form id="delete_files_form" role="form" onsubmit="return false;">  
<div class="table-responsive <?php echo ClassAnimated ?> swing">
 <table class="table" id="tablefiles">
    <thead>
      <tr>
	    <th><span id="span_select_all"><input id="select_all" type="checkbox" class="selectall" /></span></th>
        <th class="cell-collapse"><i class="glyphicon glyphicon-file"></i> <?php echo $lang[36]?></th>
		<th style="min-width:65px;" class="hidden-xs"><i class="glyphicon glyphicon-scale"></i> <?php echo $lang[42]?></th>
		<th class="hidden-xs"><i class="glyphicon glyphicon-download-alt"></i></th>
		<th class="hidden-xs"><i class="glyphicon glyphicon-comment"></i></th>
        <th style="min-width:120px;" class="hidden-xs"><i class="glyphicon glyphicon-time"></i> <?php echo $lang[33]?></th>
		<th style="min-width:90px;" ><i class="glyphicon glyphicon-cog"></i> <?php echo $lang[43]?></th>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
	<tr id="button-selection"><td colspan="7"><button id="button_1" type="submit" class="btn btn-primary btn-block" onclick="confirm_request('delete_selected','DeleteSelectedResults','delete_files_form');"><?php echo $lang[32] ?></button></td></tr>
	<tr id="result-selection"><td id="DeleteSelectedResults" colspan="7"></td></tr>
  </table>
</div>
</form>

    <div id="page-selection" class="text-center"></div>

<?php } else echo '<hr><h2 class="text-color">'.$lang[49].'</h2>' ?> 	
</div>
		   

    