<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
 <ul class="ds-btn">
   <div class="row">
        <li class="col-xs-12 col-md-3">
             <a class="cpanelBtn btn btn-lg btn-primary btn-block" href="./?users">
             <i class="cpanelIcon glyphicon glyphicon-user pull-left"></i><span><span id="t_users"><?php echo t_users ?></span><hr><small class="text-color"><?php echo $lang[73]?></small></span></a>   
        </li>
		
		<li class="col-xs-12 col-md-3">
             <a class="cpanelBtn btn btn-lg btn-primary btn-block" href="./?files">
             <i class="cpanelIcon glyphicon glyphicon-file pull-left"></i><span><span id="t_files"><?php echo t_files ?></span><hr><small class="text-color"><?php echo $lang[109]?></small></span></a> 
        </li>
		
		<li class="col-xs-12 col-md-3">
             <a class="cpanelBtn btn btn-lg btn-primary btn-block" href="./?reports">
             <i class="cpanelIcon glyphicon glyphicon-flag pull-left"></i><span><span id="t_reports"><?php echo t_reports ?></span><hr><small class="text-color"><?php echo $lang[101]?></small></span></a> 
        </li>
		
        <li class="col-xs-12 col-md-3">
            <a class="cpanelBtn btn btn-lg btn-primary btn-block" href="./?folders">
            <i class="cpanelIcon glyphicon glyphicon-folder-close pull-left"></i><span><span id="t_folders"><?php echo t_folders ?></span><hr><small class="text-color"><?php echo $lang[74]?></small></span></a>    
        </li>
		
		
	</div>
	<div class="row">
        <li class="col-xs-12 col-md-3">
             <a class="cpanelBtn btn btn-lg btn-primary btn-block" href="./?statistics">
             <i class="cpanelIcon glyphicon glyphicon-stats pull-left"></i><span><span id="t_statistics"><?php echo t_statistics ?></span><hr><small class="text-color"><?php echo $lang[28]?></small></span></a> 
        </li>
		
		<li class="col-xs-12 col-md-3">
		      <a class="cpanelBtn btn btn-lg btn-primary btn-block" href="./?comments">
		      <i class="cpanelIcon glyphicon glyphicon-comment pull-left"></i><span><span id="t_comments"><?php echo t_comments ?></span><hr><small class="text-color"><?php echo $lang[240]?></small></span></a>
        </li>
       
		<li class="col-xs-12 col-md-3">
		      <a class="cpanelBtn btn btn-lg btn-primary btn-block" href="./">
		      <i class="cpanelIcon glyphicon glyphicon-hdd pull-left"></i><span><span id="t_size"><?php echo t_size ?></span><hr><small class="text-color"><?php echo $lang[42]?></small></span></a>
        </li>
		
		<li class="col-xs-12 col-md-3">
		      <a class="cpanelBtn btn btn-lg btn-primary btn-block" href="./">
		      <i class="cpanelIcon glyphicon glyphicon-globe pull-left"></i><span><span id="t_visitors"><?php echo t_visitors ?></span><hr><small class="text-color"><?php echo $lang[270]?></small></span></a>
        </li>
		
		
		<li class="col-xs-12 col-md-3">

        </li>
	</div>	
  </ul>


  
<?php require_once ('./modals/siteinfo.php'); ?>
    

 
  <?php if( function_exists('disk_total_space') && function_exists('disk_free_space') ){ ?>
   <div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $lang[173] ;?></div>
	       <div class="panel-body" id="DivChartSpace">
              <canvas class="col-xs-12" style="margin-top:60px;" id="ChartSpace"></canvas>
           </div>
    </div>
 </div>
  <?php }?>
  
    <?php if( Sql_Get_Files_Count(true) > 0 ){ ?>
   <div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $lang[291] ;?></div>
	       <div class="panel-body" id="DivChartExt">
              <canvas class="col-xs-12" style="margin-top:60px;" id="ChartExt"></canvas>
           </div>
    </div>
 </div>
  <?php }?>
  
   <div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $lang[128] . ' / ' .$lang[160] ;?></div>
	       <div class="panel-body" id="DivWorldMap">
		      <div class="col-xs-12" style="margin-top:60px;" id="WorldMap"></div>
           </div>
    </div>
  </div>

  
  <div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $lang[128] . ' / ' .$lang[84]  ;?></div>
	    <div class="panel-body" id="DivChartDates">
           <canvas class="col-xs-12" style="margin-top:60px;" id="ChartDates"></canvas>
        </div>
    </div>
  </div>
 
 
 <div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $lang[174]. ' / ' .$lang[84]  ;?></div>
	       <div class="panel-body" id="DivChartUploads">
              <canvas class="col-xs-12" style="margin-top:60px;" id="ChartUploads"></canvas>
           </div>
    </div>
 </div>

