<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<!-- <p><?php echo SiteName() ?></p> -->   

	   <form id="search_form" role="form" onsubmit="return false; " class="<?php echo ClassAnimated ?> zoomIn">
	   
	   <div class="form-group" id="SearchResults"> </div>
	   <div class="form-group"> 
		    <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept"><?php echo $lang[59] ?></span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#filename"><?php echo $lang[36] ?></a></li>
					  <li><a href="#originalFilename"><?php echo $lang[36].' - '.$lang[177] ?></a></li>
					  <li><a href="#username"><?php echo $lang[35] ?></a></li>
					  <li><a href="#uploadedDate"><?php echo $lang[33] ?></a></li>
					  <li><a href="#folderId"><?php echo $lang[62] ?></a></li>
					  
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="filename" id="search_param">         
                <input type="text" class="form-control" name="q" id="InputQry" onkeypress="return runQry(event)" placeholder="<?php echo $lang[59] ?> ...">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" onclick="request('search','SearchResults','search_form');"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
			</div>
		</form>
		

<form id="delete_files_form" role="form" onsubmit="return false;">  
<div class="table-responsive">      
  <table class="table table-bordered">
    <thead>
      <tr>
	    <th><span id="span_select_all"><input id="select_all" type="checkbox" class="selectall" /></span></th>
        <th><a href="javascript:void(0)" onclick="orderTable('userId','files');"><?php echo $lang[35]?></a></th>
        <th><a href="javascript:void(0)" onclick="orderTable('filename','files');"><?php echo $lang[36]?></a></th>
		<th style="min-width:70px;"><a href="javascript:void(0)" onclick="orderTable('fileSize','files');" ><?php echo $lang[42]?></a></th>
		<th class="hidden-xs"><a href="javascript:void(0)" onclick="orderTable('totalDownload','files');"><i class="glyphicon glyphicon-download-alt"></i></a></th>
		<th class="hidden-xs"><i class="glyphicon glyphicon-flag"></i></th>
		<th class="hidden-xs"><i class="glyphicon glyphicon-comment"></i></th>
        <th class="hidden-xs" style="min-width:120px;"><a href="javascript:void(0)" onclick="orderTable('uploadedDate','files');"><?php echo $lang[33]?></th>
		<th><a href="javascript:void(0)" onclick="orderTable('id','files');"><?php echo $lang[43]?></a></th>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
	<tr id="button-selection"><td colspan="9"><button id="button_1" type="submit" class="btn btn-primary btn-block" onclick="confirm_request('delete_selected','DeleteSelectedResults','delete_files_form');"><?php echo $lang[32] ?></button></td></tr>
	<tr id="result-selection"><td id="DeleteSelectedResults" colspan="9"></td></tr>
  </table>
 </div> 
</form>     
    <div id="page-selection"></div>