<!-- SiteCloseModal -->
<div  id="SiteCloseModal" class="modal Logout-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
	 
      <div class="modal-header btn-primary"><h4><i class="glyphicon glyphicon-lock"></i> <?php echo $lang[64] ?> / <a href="?login" id="href-modal-header"> <?php echo $lang[20]?></a></h4></div>
      <div class="modal-body"><div class="form-group" id="SiteCloseResults"> </div><i class="glyphicon glyphicon-question-sign"></i> <?php echo closemsg ?></div>
      <div class="modal-footer"><a href="javascript:void(0)" onclick="Logout();" class="btn btn-primary btn-block" <?php if(!IsLogin) echo 'disabled'?>><?php echo $lang[27] ?></a></div>
    </div>
  </div>
</div>