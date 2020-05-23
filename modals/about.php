<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
  <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Tababout"><?php echo $lang[19] ?></a></li>
        <li><a data-toggle="tab" href="#Tabterms"><?php echo $lang[152] ?></a></li>
        <li><a data-toggle="tab" href="#Tabprivacy"><?php echo $lang[153] ?></a></li>
    </ul>
    <div class="tab-content">
	
        <div id="Tababout" class="tab-pane fade in active">
			<div class="form-group">
			  <div class="well" id="WellCopyright">
                <center><h3><?php  echo SiteName()  ?></h3>
				   <code style="font-size: 18px;"><?php  echo scriptversion  ?></code> 
	               <h4 class=""><?php  echo description  ?></h4>
                   
				</center>
	            <hr>
                <!-- تحذير لا تقم بحذف الحقوق والا سيستمر تنبيه في الظهور الى غاية اعادة الحقوق الى سابق عهدها -->
                    <h4><?php echo $lang[12] ?> : <br>
                    <i id="aboutCopyright"><?php echo 'onexite' ?></i></h4>
                    <h4><?php echo $lang[40] ?> : <br>
                    <i id="emailCopyright"><?php echo 'onexite@gmail.com' ?></i></h4>
					<hr>
					<div class="table-responsive <?php echo ClassAnimated ?> swing">
					<table id="" class="table table-striped">
					  <tr><th><?php echo $lang[199] ?></th><th><?php echo $lang[5] ?></th><th><?php echo $lang[200] ?></th></tr>
					  <tr><td>jQuery.js</td><td>1.11.3</td><td>jQuery Foundation, Inc</td></tr>
					  <tr><td>Chart.js</td><td>2.9.3</td><td>Nick Downie</td></tr>
					  <tr><td>Simple Ajax Uploader.js</td><td>2.6.7</td><td>LPology, LLC</td></tr>
					  <tr><td>bootpag.js</td><td>1.0.7</td><td>botmonster@7items.com</td></tr>
					  <tr><td>Summernote.js</td><td>0.8.2</td><td>Alan Hong</td></tr>
					  <tr><td>Bootstrap.js</td><td>3.4.1</td><td>Twitter, Inc</td></tr>
					  <tr><td>Functions.js</td><td>0.9.7</td><td>onexite</td></tr>
					  <tr><td>Bootstrap-select.js</td><td>1.13.1</td><td>caseyjhol</td></tr>
					  <tr><td>bootstrap-checkbox.js</td><td>1.0.1</td><td>Roberto Montresor</td></tr>
					  <tr><td>bootbox.js</td><td>5.4.0</td><td>Nick Payne</td></tr>
					  <tr><td>bootstrap-tagsinput.js</td><td>0.6.1</td><td>Tim Schlechter</td></tr>
					  <tr><td>bootstrap-maxlength.js</td><td>1.7.0</td><td>mimo84</td></tr>
					  <tr><td>Respond.js</td><td>1.4.2</td><td>Scott Jehl</td></tr>
					  <tr><td>bootstrap-toggle.js</td><td>2.2.0</td><td>Min Hur</td></tr>
					  <tr><td>bootstrap-colorselector.js</td><td>0.2.0</td><td>Flaute</td></tr>
					  <tr><td>bootstrap-show-password.js</td><td>1.0.3</td><td>zhixin wen</td></tr>
					  <tr><td>bootstrap-countUp.js</td><td>1.8.1</td><td>@inorganik</td></tr>
					  <tr><td>sticky.js</td><td>1.2.0</td><td>Anthony Garand</td></tr>
					  <tr><td>hi-base64.js</td><td>0.2.0</td><td>emn178@gmail.com</td></tr>
					  <tr><td>HTML5 Shiv.js</td><td>3.7.3</td><td>@afarkas @jdalton @jon_neal @rem</td></tr>
					  <tr><td>animate.css</td><td>4.0.0</td><td>Daniel Eden</td></tr>
					  <tr><td>bootstrap-rtl.css</td><td>3.3.4</td><td>Morteza Ansarinia</td></tr>
					</table>
					</div>
					
					
                </div>
            </div>
        </div>
		
		
        <div id="Tabterms" class="tab-pane fade">
		  <div class="well">
		    <p><?php echo terms; ?></p>
		  </div>
        </div>
		
		<div id="Tabprivacy" class="tab-pane fade">
		  <div class="well">
		    <p><?php echo privacy; ?></p>
		  </div>
        </div>
		
		
    </div>