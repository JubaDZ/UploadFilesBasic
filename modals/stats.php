<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<!-- Modal -->
  <div class="modal fade" id="StatsModal" role="dialog">
    <div class="modal-dialog" id="_StatsModal">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $lang[28] ?>  - <span class="text-color" id="Statfilename"></span> </h4>
        </div>
        <div class="modal-body">

		   
		   
		<ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#Countrie"><?php echo $lang[160] ?></a></li>
          <li><a data-toggle="tab" href="#Browser"><?php echo $lang[158] ?></a></li>
          <li><a data-toggle="tab" href="#Platform"><?php echo $lang[159] ?></a></li>
		  <li><a data-toggle="tab" href="#Referrer"><?php echo $lang[161] ?></a></li>
		  <li><a data-toggle="tab" href="#DateTab"><?php echo $lang[84] ?></a></li>
		  
        </ul>
    <div class="tab-content">
        <div id="Countrie" class="tab-pane well fade in active">
		<div class="form-group" id="DivChartCountries">
		  <canvas width="400" height="200" id="ChartCountries"></canvas>
		</div>
             		 
			   
<div class="form-group">
<div class="table-responsive">
 <table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $lang[160] ?></th>
		<th><?php echo $lang[157] ?></th>
		<th><?php echo $lang[162] ?></th>
      </tr>
    </thead>
    <tbody id="Countries">
    </tbody>
  </table>
</div>

 <div id="page-selection_1" class="text-center"></div>
</div>
			   
		 
       
        </div>
		
		
        <div id="Browser" class="tab-pane well fade">
		<div class="form-group" id="DivChartBrowsers">
		  <canvas width="400" height="200" id="ChartBrowsers"></canvas>
		</div>
		  <div class="form-group">

<div class="table-responsive">
 <table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $lang[158] ?></th>
		<th><?php echo $lang[157] ?></th>
		<th><?php echo $lang[162] ?></th>
      </tr>
    </thead>
    <tbody id="Browsers">
    </tbody>
  </table>
</div>

    <div id="page-selection_2" class="text-center"></div>
       </div>
	   
        </div>
		
		<div id="Platform" class="tab-pane well fade">
		<div class="form-group" id="DivChartPlatforms">
		  <canvas width="400" height="200" id="ChartPlatforms"></canvas>
		</div>
		<div class="form-group">

<div class="table-responsive">
 <table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $lang[159] ?></th>
		<th><?php echo $lang[157] ?></th>
		<th><?php echo $lang[162] ?></th>
      </tr>
    </thead>
    <tbody id="Platforms">
    </tbody>
  </table>
</div>

    <div id="page-selection_3" class="text-center"></div>
       </div>
        </div>
		
		
	<div id="Referrer" class="tab-pane well fade">
		<div class="form-group" id="DivChartReferrers">
		  <canvas id="ChartReferrers"></canvas>
		</div>
		
			<div class="form-group">
<div class="table-responsive">
 <table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $lang[161] ?></th>
		<th><?php echo $lang[157] ?></th>
		<th><?php echo $lang[162] ?></th>
      </tr>
    </thead>
    <tbody id="Referrers">
    </tbody>
  </table>
</div>

    <div id="page-selection_4" class="text-center"></div>
            </div>	
        </div>
		
		
				<div id="DateTab" class="tab-pane well fade">
				
				<div class="form-group" id="DivChartDates">
		          <canvas id="ChartDates"></canvas>
		        </div>
			 
			<div class="form-group">

<div class="table-responsive">
 <table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $lang[84] ?></th>
		<th><?php echo $lang[157] ?></th>
		<th><?php echo $lang[162] ?></th>
      </tr>
    </thead>
    <tbody id="Dates">
    </tbody>
  </table>
</div>

    <div id="page-selection_5" class="text-center"></div>
            </div>	
        </div>
		
		
    </div>
		   	  
        </div>
        <div class="modal-footer">

        </div>
      </div>
      
    </div>
  </div>