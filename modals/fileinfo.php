 <?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
 <?php if(!defined('IsAdminPage')) define('IsAdminPage',false); ?>
 <!-- FileInfosModal -->
  <div class="modal fade" id="FileInfosModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $lang[105] ?> </h4>
        </div>
        <div class="modal-body">
<input type="hidden" id="FileId">  
<input type="hidden" id="FileUrl">     
<div class="table-responsive">
<table class="table table-hover">
    <tbody>	
	
     <?php if( IsAdminPage ){ ?>
	  <tr>
        <th><?php echo $lang[35]?></th>
        <td id="fileInfo_username" ><mark>--</mark></td>
      </tr> 
	  <?php } ?>
	  
	  <tr>
        <th><?php echo $lang[36]?></th>
        <td id="fileInfo_filename">--</td>
      </tr>
	  
	  <tr id="thumbnail">
        <th><?php echo $lang[172]?></th>
        <td><img id="fileInfo_thumbnail" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="img-thumbnail" alt=""></td>
      </tr>
	  
	   <?php if( IsAdminPage ){ ?>
	  <tr id="media">
        <th><?php echo $lang[209]?></th>
        <td>
		  <div id="DivPlayer"></div>
		</td>
      </tr>
	  <?php } ?>
	  
	  <tr>
        <th><?php echo $lang[33]?></th>
        <td id="fileInfo_date">--</td>
      </tr>	
	  
	   <?php if( IsAdminPage ){ ?>
	  <tr>
        <th><?php echo $lang[83]?></th>
        <td id="fileInfo_ip">--</td>
      </tr> 
	  <?php } ?>
	 
	  <tr>
        <th><?php echo $lang[62]?></th>
        <td id="fileInfo_folder">--</td>
      </tr>	
	  
	  <?php if( IsAdminPage ){ ?>
	  <tr>
        <th><?php echo $lang[34]?></th>
        <td id="fileInfo_downcount">--</td>
      </tr>
	   
	  <tr>
        <th><?php echo $lang[82]?></th>
        <td id="fileInfo_reportcount">--</td>
      </tr>
	  <?php } ?>
	  
	  <tr>
        <th><?php echo $lang[42]?></th>
        <td><span id="fileInfo_size" class="label label-default">--</span></td>
      </tr> 
	  
	  <tr>
        <th><?php echo $lang[18]?></th>
        <td id="fileInfo_urldownload">--</td>
      </tr> 
	  
	   <?php if( IsAdminPage ){ ?>
	  <tr>
        <th><?php echo $lang[79]?></th>
        <td id="fileInfo_updateurl">--</td>
      </tr> 
	  <?php } ?>
	  
	  <?php if( IsLogin ){ ?>
	 <tr>
        <th><?php echo $lang[32]?></th>
        <td id="fileInfo_delete">--</td>
     </tr> 
	  <?php } ?>
	  <tr><td colspan="2" id="FileInfosResults" class="text-center"></td></tr>
	
	
    </tbody>
  </table>
 </div> 


          <?php if(IsRtL()){ ?>
		    <a class="files prev" href="javascript:void(0);" rel="tooltip" title="<?php echo $lang[188] ?>"  id="next" onclick="ShowNextFileModal('next','FileInfoModal')">›</a>
			<a class="files next" href="javascript:void(0);" rel="tooltip" title="<?php echo $lang[189] ?>"  id="previous" onclick="ShowNextFileModal('previous','FileInfoModal')">‹</a>   
		   <?php } else { ?>
		    <a class="files next" href="javascript:void(0);" rel="tooltip" title="<?php echo $lang[188] ?>"  id="next" onclick="ShowNextFileModal('next','FileInfoModal')">›</a>
			<a class="files prev" href="javascript:void(0);" rel="tooltip" title="<?php echo $lang[189] ?>"  id="previous" onclick="ShowNextFileModal('previous','FileInfoModal')">‹</a>
 <?php }?>
 
 
         </div>
        <div class="modal-footer">
		   <button type="button" class="btn btn-primary btn-block" data-dismiss="modal"><?php echo $lang[3] ?></button>
        </div>
      </div>
      
    </div>
  </div>