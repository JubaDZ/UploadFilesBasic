<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php
//$Show_Comments = false;
$confirm    = IsGet('confirm')  ? true : false ;
$notfound   = IsGet('notfound') ? true : false ;
//print_r($info);
/*--------------------------------------*/	
if (!$info["status"])
	$Show_Comments = false;

elseif( $confirm || $notfound )
	$Show_Comments = false;

elseif($info["status"] && !$info['public'])
    $Show_Comments = false;
	
elseif($info["status"] && !$info["isfile"])
	$Show_Comments = false;
	
else
	$Show_Comments = true;

/*--------------------------------------*/	

if($Show_Comments)
{
?>
<div id="comments" class="panel panel-default top20 animated bounceInDown">

		      <div class="panel-heading"><span><?php echo $lang[240] ?> </span></div>	
              <div class="panel-body top10"> 
		
					<?php if(IsLogin) { ?>
					<div id="erase_add_comment">
					    <div class="row">
						   <div class="form-group">
					        <div class="col-sm-1 col-md-1 hidden-xs hidden-sm"><i class="btn btn-default btn-circle btn-lg glyphicon glyphicon-user"></i></div>
					 
                            <div class="col-sm-12 col-md-11">
	            	            <div id="input_add_comment" class="input-placeholder" style="height: 80px;" ><?php echo $lang[238] ?> ....</div>
					        </div>
					     </div>
					  </div>
					</div>
					<?php } else { ?>
					
					<div class="row">
					   <div class="form-group">
					    <div class="col-sm-1 col-md-1 hidden-xs hidden-sm"><i class="btn btn-default btn-circle btn-lg glyphicon glyphicon-user"></i></div>
					    <div class="col-sm-12 col-md-11">
					            <div class="input-placeholder disabled" style="height: 80px;" ><?php echo $lang[98] ?> ....</div>
					    </div> 
					  </div>
			        </div>
					
					<?php } ?>
					
	                <div id="div_add_comment">
					    <div class="row">
					        <div class="col-sm-1 col-md-1 hidden-xs hidden-sm"><i class="btn btn-default btn-circle btn-lg glyphicon glyphicon-user"></i></div>
					 
                            <div class="col-sm-12 col-md-11">
					            <form id="add_comment_form" role="form" onsubmit="return false;">
					                <input  id="comment_file_id" value="<?php echo protect($_GET['download']) ?>" name="file_id" type="hidden" >
					                <div id="add_comment_Results"></div>
									<div class="form-group">
                                       <textarea id="text_comment" name="comment" maxlength="255" class="form-control" placeholder="<?php echo $lang[238] ?> ...." rows="3"></textarea>
						            </div>
									
									 <?php if(EnableCaptcha){?>
									 <div class="form-group">
									    <img id="captcha_6" src="ajax/index.php?captcha&background=<?php echo BodyColor ?>&font=<?php echo FontColor ?>" onclick="this.src='ajax/index.php?captcha&background=<?php echo BodyColor ?>&font=<?php echo FontColor ?>&' + Math.random();" alt="captcha" style="cursor:pointer;">
									    <a href="javascript:void(0)" onclick="GenerateCaptcha('<?php echo BodyColor ?>','<?php echo FontColor ?>');"><span class="glyphicon glyphicon-refresh"></span></a>
									    <input type="text" class="captcha form-control" maxlength="4" name="captcha" placeholder="<?php echo $lang[54] ?>">
									 </div>
									<?php }?>
                                    <div class="form-group">
                                        <button type="submit" id="submit_btn_comment" class="btn btn-primary" onclick="request('addcomment', 'add_comment_Results', 'add_comment_form')" disabled><?php echo $lang[239] ?></button>
                                        <button type="reset" id="cancel_comment" class="btn btn-default"><?php echo $lang[156] ?></button>
									</div>	
					            </form>
                            </div>
							
						</div>	
						
                        <div class="clearfix"></div>
                        </div>	
						
				   <div id="all_comment"> </div>
				 
				  <div id="page-selection"></div>
		
              </div><!--div panel-body -->
          
	
 </div>
 <?php
}
 ?>