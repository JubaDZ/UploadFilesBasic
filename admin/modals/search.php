 <?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<!-- SearchModal-->
<div class="modal fade" id="SearchModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $lang[59] ?>  </h4>
        </div>
        <div class="modal-body">

		  
	   <form id="search_form" role="form" onsubmit="return false;">
	   
	   <div class="form-group" id="SearchResults"> </div>
	   <div class="form-group"> 
		    <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept"><?php echo $lang[59] ?></span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#filename"><?php echo $lang[36] ?></a></li>
					  <li><a href="#username"><?php echo $lang[35] ?></a></li>
					  <li><a href="#uploadedDate"><?php echo $lang[33] ?></a></li>
					  <li><a href="#folderId"><?php echo $lang[62] ?></a></li>
					  
                    <!--  <li><a href="#its_equal">It's equal</a></li>
                      <li><a href="#greather_than">Greather than ></a></li>
                      <li><a href="#less_than">Less than < </a></li>
                      <li class="divider"></li>
                      <li><a href="#all">Anything</a></li>-->
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="filename" id="search_param">         
                <input type="text" class="form-control" name="q" placeholder="<?php echo $lang[59] ?> ...">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" onclick="request('search','SearchResults','search_form');"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
			</div>
		</form>

	
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-block" data-dismiss="modal"><?php echo $lang[3] ?></button>	  
        </div>
      </div>
      
    </div>
  </div>