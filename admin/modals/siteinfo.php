<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php if(!isGet('site')) { ?>
<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $lang[105] ;?></div>
	    <div class="panel-body">
   
<?php } ?>  
   
     <div class="col-xs-12">
	 
	 <div class="table-responsive">
	 <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
		<th><?php echo $lang[194]?></th>
      </tr>
    </thead>
    <tbody>
	
	  <tr>
        <td>upload_max_filesize</td>
		<td><code><?php echo function_exists('ini_get') ? FileSizeConvert(return_bytes(@ini_get('upload_max_filesize'))) : '' ?></code></td>
      </tr>
	  
	   <tr>
        <td>post_max_size</td>
		<td><code><?php echo function_exists('ini_get') ? FileSizeConvert(return_bytes(@ini_get('post_max_size'))) : '' ?></code></td>
      </tr>
	  
	  <tr>
        <td>memory_limit</td>
		<td><code><?php echo function_exists('ini_get') ? FileSizeConvert(return_bytes(@ini_get('memory_limit'))) : '' ?></code></td>
      </tr>
	  
	   <tr>
        <td>max_execution_time</td>
		<td><code><?php echo function_exists('ini_get') ? (@ini_get('max_execution_time').' '.$lang[216]) : '' ?></code></td>
      </tr>
	  
	  <tr>
        <td>max_input_time</td>
		<td><code><?php echo function_exists('ini_get') ? (@ini_get('max_input_time').' '.$lang[216]) : '' ?></code></td>
      </tr>
	  
	   <tr>
        <td>max_file_uploads</td>
		<td><code><?php echo function_exists('ini_get') ? (@ini_get('max_file_uploads').' '.$lang[109]) : '' ?></code></td>
      </tr>
	  
	   <tr>
        <td>phpversion</td>
		<td><code><?php echo function_exists('phpversion') ? phpversion() : '' ?></code></td>
      </tr>
	  
	  <tr>
        <td>mysqlversion</td>
		<td><code><?php echo mysqlversion() ?></code></td>
      </tr>
	  
	   <tr>
        <td><?php echo $lang[243] ?></td>
		<td><code><?php echo function_exists('disk_free_space') ? FileSizeConvert(@disk_free_space("/")):'-' ?></code></td>
      </tr>
	  
	  <tr>
        <td><?php echo $lang[242] ?></td>
		<td><code><?php echo function_exists('disk_total_space') ? FileSizeConvert(@disk_total_space("/")):'-' ?></code></td>
      </tr>
	  
	   <tr>
        <td><?php echo $lang[193] ?></td>
		<td><a target="_blank" href="<?php echo siteurl ?>"><?php echo SiteName() ?></a></td>
      </tr>
	  
	   <tr>
        <td><?php echo $lang[70] ?></td>
		<td><code><?php echo theme ?></code></td>
      </tr>
	  
	   <tr>
        <td><?php echo $lang[252] ?></td>
		<td><code><?php echo installdate ?></code></td>
      </tr>
	  
	   <tr>
        <td><?php echo $lang[5] ?></td>
		<td><code><?php echo scriptversion ?></code></td>
      </tr>
	  
	   <tr>
        <td><?php echo $lang[272] .' / '. $lang[80]?></td>
		<td><?php echo IntToIcon(ApiStatus) ?></td>
      </tr>
	  
	   <tr>
        <td><?php echo $lang[157].' '.$lang[278] ?></td>
		<td><code><?php echo api_requests ?></code></td>
      </tr>
	  <tr>
        <td><?php echo $lang[12] ?></td>
		<td><code id="author"><?php echo 'onexite' ?></code></td>
      </tr>

	  
    </tbody>
  </table>
</div>
	 
	 </div>
	<?php if(!isGet('site')) { ?> 
	 
  </div>
  </div>
 </div>
	<?php } ?>