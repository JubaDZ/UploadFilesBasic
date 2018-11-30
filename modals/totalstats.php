<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<div id="total_stats" class="top20">
<div class="table-responsive <?php echo ClassAnimated ?> swing">        
  <table id="table_total_stats" class="panel table table-bordered">
    <thead>
      <tr class="active">
        <th><i class="glyphicon glyphicon-download-alt"></i> <?php echo $lang[245]?></th>
        <th><i class="glyphicon glyphicon-cloud-upload"></i> <?php echo $lang[246]?></th>
        <th><i class="glyphicon glyphicon-user"></i> <?php echo $lang[247]?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td id="download-count">0</td>
        <td id="file-count">0</td>
        <td id="user-count">0</td>
      </tr>

    </tbody>
  </table>
  
</div>  
</div>