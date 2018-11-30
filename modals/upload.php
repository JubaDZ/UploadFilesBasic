<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
 <!-- FileInfosModal -->
  <div class="modal fade" id="UploadFileModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="UploadModalTitle"><?php echo $lang[1] ?> </h4>
        </div>
        <div class="modal-body">
		<input type="hidden" id="UpdateFileName" />
		
         
		  <?php require ('dropzone.php') ?>
		  
          <div class="row">
           <div class="col-xs-12">
             <div id="progressOuter" class="progress progress-striped active" style="display:none;">
               <div id="progressBar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
             </div>
           </div>
          </div>
		  <br>
		  
		  <div class="row">
            <div class="col-xs-12">
              <div id="msgBox">
              </div>
            </div>
          </div>
        
	        </div>
   
      </div>
      
    </div>
  </div>
