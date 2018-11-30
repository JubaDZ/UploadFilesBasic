<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
 <!-- ShowLinks -->
  <div class="modal fade" id="ShowLinks" role="dialog">
    <div class="modal-dialog" id="_ShowLinks">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $lang[23] ?> - <span class="text-color" id="FileOrgName"> </span> </h4>
        </div>
        <div class="modal-body espace" >
		
          <input type="hidden" id="FileId">

		  	  
<table class="table table-striped links">
    <tbody>
	<?php if( thumbnail ){ ?>
	  <tr id="thumbnail_tr">
        <td class="col-md-2 hidden-sml singleline" id="thumbnail_url"> <?php echo $lang[172] ?>:</td>
        <td class="col-md-10"><img id="thumbnail" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="img-thumbnail" alt=""></td> <!--text-center  -->
      </tr>
	<?php } if(IsLogin){ ?>
	
	  <tr id="view_tr">
        <td class="col-md-2 hidden-sml singleline" id="label_view"> <?php echo $lang[164] ?>:</td>
        <td class="col-md-10"> 
		  <div class="input-group" style="margin: 0px;">
                <input type="text" class="form-control" id="view" style="text-align: left;direction: ltr;" readonly>
			    <span class="input-group-btn">
			      <button class="btn btn-primary" onclick="CopyLink('view')" type="button"><?php echo $lang[146] ?></button>
		        </span>  
		
          </div>
		</td>	
      </tr>
	<?php } ?>
	
	
      <tr>
        <td class="col-md-2 hidden-sml singleline" id="label_url"> <?php echo $lang[184] ?>:</td>
        <td class="col-md-10"> 
		  <div class="input-group" style="margin: 0px;">
                <input type="text" class="form-control" id="url" style="text-align: left;direction: ltr;" readonly>
			    <span class="input-group-btn">
			      <button class="btn btn-primary" onclick="CopyLink('url')" type="button"><?php echo $lang[146] ?></button>
		        </span>  
		
          </div>
		</td>	
      </tr>
	  
	  
	  <?php if(deletelink){ ?>
      <tr>
        <td class="col-md-2 hidden-sml singleline" id="label_delete"><?php echo $lang[26] ?>:</td>
        <td class="col-md-10">
			<div class="input-group" style="margin: 0px;">
               <input type="text" class="form-control" id="delete" style="text-align: left;direction: ltr;" readonly>
			    <span class="input-group-btn">
			      <button class="btn btn-primary" onclick="CopyLink('delete')" type="button"><?php echo $lang[146] ?></button>
		        </span>  
            </div>
		</td>
      </tr>
	  <?php } ?> 
	  
      <tr>
        <td class="col-md-2 hidden-sml singleline" id="label_downloadlink"><?php echo $lang[184] ?>:</td>
        <td class="col-md-10">
			<div class="input-group" style="margin: 0px;">
               <input type="text" class="form-control" id="downloadlink" style="text-align: left;direction: ltr;" readonly>
			    <span class="input-group-btn">
			      <button class="btn btn-primary" onclick="CopyLink('downloadlink')" type="button"><?php echo $lang[146] ?></button>
		        </span> 			
            </div>
		</td>
      </tr>
	  
	  
	    <?php if(directdownload){ ?>
	   <tr>
        <td class="col-md-2 hidden-sml singleline" id="label_directlink"><?php echo $lang[51] ?>:</td>
        <td class="col-md-10">
			<div class="input-group" style="margin: 0px;">
               <input type="text" class="form-control" id="directlink" style="text-align: left;direction: ltr;" readonly> 
			    <span class="input-group-btn">
			      <button class="btn btn-primary" onclick="CopyLink('directlink')" type="button"><?php echo $lang[146] ?></button>
		        </span>   
            </div>
		</td>
      </tr>
	   <?php } ?>  
	   
	   
	  <tr><td colspan="2" id="TDFileNum" class="col-md-12 hidden-sml text-center">  ( <span id="FileNum" class="small"></span> )  </td></tr>
	  <tr><td class="col-md-12 display-sml text-center"> ( <span id="FileNumMobile" class="small"></span> ) </td></tr>
	  
    </tbody>
  </table>
		   
		
		   
		  <?php if(IsRtL()){ ?>
		    <button type="button" rel="tooltip" title="<?php echo $lang[189] ?>" class="btn btn-primary next_previous right" id="previous" onclick="ShowNextFileModal('previous','ShowLinks')"><span class="glyphicon glyphicon-chevron-right"></span></button>
		    <button type="button" rel="tooltip" title="<?php echo $lang[188] ?>"  class="btn btn-primary next_previous left" id="next" onclick="ShowNextFileModal('next','ShowLinks')"><span class="glyphicon glyphicon-chevron-left"></span></button>    
		   <?php } else { ?>
		    <button type="button" rel="tooltip" title="<?php echo $lang[189] ?>" class="btn btn-primary next_previous left" id="previous" onclick="ShowNextFileModal('previous','ShowLinks')"><span class="glyphicon glyphicon-chevron-left"></span></button>
		    <button type="button" rel="tooltip" title="<?php echo $lang[188] ?>" class="btn btn-primary next_previous right" id="next" onclick="ShowNextFileModal('next','ShowLinks')"><span class="glyphicon glyphicon-chevron-right"></span></button>
		  <?php }  ?>
		
		  
	    
        </div>
        <div class="modal-footer espace">
         <!-- <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang[3]?></button> -->
        </div>
      </div>
      
    </div>
  </div>