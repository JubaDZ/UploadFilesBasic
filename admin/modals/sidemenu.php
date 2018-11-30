<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<div id="menu" class="col-sm-3 col-md-3">
	<div class="collapse navbar-collapse" id="sideNavbar">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="glyphicon glyphicon-tasks"></i> <?php echo $lang[47]?></a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse <?php if(AdminGetIsEmpty || isGet('comments') || isGet('files') || isGet('users') || isGet('folders') || isGet('reports') || isGet('statistics') ) echo ' in';?>">
            <div class="list-group">
			  <a href="./" class="list-group-item<?php echo AdminGetIsEmpty ? ' active' : '';?>"><i class="glyphicon glyphicon-home"></i> <?php echo $lang[21] ?></a>
			  <a href="?files" class="list-group-item<?php actv2('files')?>"><i class="glyphicon glyphicon-file"></i> <?php echo $lang[109]?></a>
			  <a href="?users" class="list-group-item<?php actv2('users')?>"><i class="glyphicon glyphicon-user"></i> <?php echo $lang[73]?></a>
			  <a href="?folders" class="list-group-item<?php actv2('folders')?>"><i class="glyphicon glyphicon-folder-close"></i> <?php echo $lang[74]?></a>
			  <a href="?comments" class="list-group-item<?php actv2('comments')?>"><?php echo (t_comments_o>0) ? '<span class="badge">'.t_comments_o.'</span>':''; ?><i class="glyphicon glyphicon-comment"></i> <?php echo $lang[240]?></a>
			  <a href="?reports" class="list-group-item<?php actv2('reports')?>"><?php echo (t_reports_o>0) ? '<span class="badge" id="today-reports">'.t_reports_o.'</span>':''; ?><i class="glyphicon glyphicon-flag"></i> <?php echo $lang[101]?></a>
			  <a href="?statistics" class="list-group-item<?php actv2('statistics')?>"><i class="glyphicon glyphicon-stats"></i> <?php echo $lang[28]?></a>

            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><i class="glyphicon glyphicon-edit"></i> <?php echo $lang[29]?> </a> 
            </h4>
          </div>
          <div id="collapseFour" class="panel-collapse collapse <?php if( isGet('publicity') || isGet('settings')  || isGet('plans')) echo ' in';?>">
            <div class="list-group">
               <a href="?publicity" class="list-group-item<?php actv2('publicity')?>" ><i class="glyphicon glyphicon-pushpin"></i> <?php echo $lang[183]?></a>    
			   <a href="?plans" class="list-group-item<?php actv2('plans')?>" ><i class="glyphicon glyphicon-usd"></i> <?php echo $lang[230]?></a> 
			  
			   <a href="?settings" id="confg" class="list-group-item<?php actv2('settings')?>" ><i class="glyphicon glyphicon-cog"></i> <?php echo $lang[29]?></a>
			   
			  
			   
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><i class="glyphicon glyphicon-globe"> </i> <?php echo $lang[193]?> </a>
            </h4>
          </div>
          <div id="collapseFive" class="panel-collapse collapse <?php if( isGet('update') || isGet('backup') || isGet('info') ) echo ' in';?>">
		      <a href="?update" class="list-group-item<?php actv2('update')?>"><i class="glyphicon glyphicon-refresh"></i> <?php echo $lang[79]?></a> 
			  <a href="?backup" id="backup" class="list-group-item<?php actv2('backup')?>" ><i class="glyphicon glyphicon-hdd"></i> <?php echo $lang[263]?></a>
			  <a href="?info&site" class="list-group-item<?php actv2('info')?>" ><i class="glyphicon glyphicon-info-sign"></i> <?php echo $lang[105]?></a> 
			  <a href="javascript:void(0)" class="list-group-item" data-toggle="modal" data-target="#LogoutModal"><i class="glyphicon glyphicon-log-out"></i> <?php echo $lang[27]?></a>
			
          </div>
        </div>
      </div>
   </div>
</div>
    