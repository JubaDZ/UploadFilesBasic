<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>

            <tr>
			  <thead>
			    <td colspan="2" id="th_pass">
				<div class="panel">
					<div class="top10 panel-body divpass">
                     
<!--					 <div class="form-group">
                        <div class="input-group col-sm-12">
                          <span class="input-group-addon" style="min-width:50px;"><i class="glyphicon glyphicon-lock"></i></span>
                          <input id="FilePassword" name="password" placeholder="<?php echo $lang[37] ?>" class="form-control"  type="password">
                        </div>
                      </div>-->
					  
					  <div class="form-group has-error">
					    <label class="control-label" for="inputError"><?php echo $lang[37] ?></label>
					    <input id="FilePassword" name="password" placeholder="<?php echo $lang[37] ?>" class="form-control"  type="password">
					  </div>
					  
                      <div class="form-group">
                        <input name="recover-submit" onclick="confirmPasswordFile(<?php echo $DownloadID ?> )" class="btn btn-primary btn-block" value="<?php echo $lang[175] ?>" type="submit">
                      </div>
					  
					  <div id="confirmPasswordDiv"></div>
					 </div>
				</div>	 
               </td>
			 </thead>
			</tr>
          
           
       