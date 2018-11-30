<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>  
<?php 
$info             = IsGet('download') ? Sql_Get_info(protect(Decrypt($_GET['download']))) : array('status'=>false);
$publicity        = Sql_Get_publicity($ads_page); 
$ads_google       = ($ads_page == 'ads_google')  ? true : false ;
$ads_download     = ($ads_page == 'ads_download')? true : false ;
$no_ads_title     = (empty($publicity['title'])) ? true : false ;
$file_status      = (IsGet('download')) ? $info['status'] : true;
$is_content_empty = (empty($publicity['content']) || $publicity['content'] =='<p><br></p>' || $publicity['content'] =='<br>'|| $publicity['content'] =='<p></p>') ? true : false ;
$is_deleteFile    = (IsGet('download') && ($_GET['download'] =='deleteFile')  && $ads_download ) ? true : false ;
if( display_ads && $publicity['status'] && !$is_content_empty && !$is_deleteFile  && ($file_status) )
{ 
     if($ads_google)
     { 
?>
<div>
<?php } else { ?>

 <div id="poster" class="panel panel-default <?php /*echo ($ads_download) ? 'top20 ' : '';*/  echo ClassAnimated ?> bounceInDown">
 <?php }  ?>
          	
<?php if( (!$no_ads_title) && (!$ads_google) ){ ?>		  
           <div class="panel-heading"><span><?php echo $publicity['title'] ?> </span></div>		  
            <div class="panel-body">  
              <?php } else { ?>		
              <div class="panel-body"> 
			  <?php } ?>			
	           <?php  echo $publicity['content']?>		
			  	  
              </div><!--div col-xs-12 -->
         
	
 
 </div> <!--div poster -->
<?php } 
unset($publicity);
unset($info);
?>