<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<!-- LogoutModal -->
<div  id="LogoutModal" class="modal Logout-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
	 
      <div class="modal-header btn-primary"><h4><i class="glyphicon glyphicon-log-out"></i>  <?php echo $lang[27] ?><button type="button" class="close" data-dismiss="modal">&times;</button></h4></div>
      <div class="modal-body"><div class="form-group" id="LogoutResults"> </div><i class="glyphicon glyphicon-question-sign"></i> <?php echo $lang[61] ?></div>
      <div class="modal-footer"><a href="javascript:void(0)" onclick="Logout();" class="btn btn-primary btn-block" <?php if(!IsLogin) echo 'disabled' ?>><?php echo $lang[27] ?></a></div>
    </div>
  </div>
</div>