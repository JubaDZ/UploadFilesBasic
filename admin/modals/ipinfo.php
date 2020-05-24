 <?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
 <!-- FileIpModal -->
  <div class="modal fade" id="IpInfosModal" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $lang[105] ?> </h4>
        </div>
        <div class="modal-body">
          
<div class="table-responsive">
<table class="table table-hover">
    <tbody>	

	  <tr>
        <th><?php echo $lang[83]?></th>
        <td id="ip_ip">--</td>
      </tr> 
	  
	  <tr>
        <th><?php echo $lang[160]?></th>
        <td><code id="ip_country">--</code></td>
      </tr>
	  
	  <tr>
        <th><?php echo $lang[208]?></th>
        <td id="ip_city" ><mark>--</mark></td>
      </tr> 
	  
	  <tr>
        <th><?php echo 'ISP'?></th>
        <td id="ip_isp">--</td>
      </tr>	
	  

	  <tr>
        <th><?php echo $lang[206]?></th>
        <td id="ip_lat">--</td>
      </tr>	
	  
	  <tr>
        <th><?php echo $lang[207]?></th>
        <td id="ip_lon">--</td>
      </tr>
	  

	  <tr><td colspan="2" id="IpInfosResults"></td></tr>
	
    </tbody>
  </table>
 </div> 
         </div>
        <div class="modal-footer">
		<button type="button" class="btn btn-primary btn-block" data-dismiss="modal"><?php echo $lang[3] ?></button>	 	
        </div>
      </div>
      
    </div>
  </div>