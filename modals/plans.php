<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php
 $free='';
 $gold='';
 $premium='';
 $register='';
 $translate = translate();
$result = Sql_query("SELECT * FROM `plans`");
if($result)
while($row = mysqli_fetch_assoc($result))
{
	if($row['name']=='price') 
	{
	$pricefree     = '<h1>'.IntToIcon($row["free"]).'</h1>';	
	$pricepremium  = '<h1>'.IntToIcon($row["premium"]).'</h1>';	
    $pricegold     = '<h1>'.IntToIcon($row["gold"]).'</h1>';	
    $priceregister = '<h1>'.IntToIcon($row["register"]).'</h1>';		
	continue;	
	}
		
	if($row['name']=='extensions')
	{
		   $free.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td><code>'.count(explode( ',', $row["free"] )).'</code></td>
				</tr>';	
	$premium.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td><code>'.count(explode( ',', $row["premium"] )).'</code></td>
				</tr>';	
       $gold.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td><code>'.count(explode( ',', $row["gold"] )).'</code></td>
				</tr>';	
   $register.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td><code>'.count(explode( ',', $row["register"] )).'</code></td>
				</tr>';					
	continue;	
	}
		
	    $free.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td>'.IntToIcon($row["free"]).'</td>
				</tr>';
	 $premium.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td>'.IntToIcon($row["premium"]).'</td>
				</tr>';
        $gold.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td>'.IntToIcon($row["gold"]).'</td>
				</tr>';	
   $register.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td>'.IntToIcon($row["register"]).'</td>
				</tr>';					
				
}
?>

    <div class="row top20 <?php echo ClassAnimated ?> swing" id="plans">
        <div class="col-xs-12 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo $lang[226] ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">	
                       <?php echo $pricefree ?>
                        <small></small>
                    </div>
                    <table class="table table-striped">

                    <?php echo $free; ?>
                    </table>
                </div>
                <div class="panel-footer">
                    <a disabled href="?contact&plan=0" class="btn btn-primary btn-block" role="button"><?php echo $lang[52] ?></a>
                    </div>
            </div>
        </div>
		   <div class="col-xs-12 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo $lang[235] ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">	
                       <?php echo $priceregister ?>
                        <small></small>
                    </div>
                    <table class="table table-striped">

                    <?php echo $register; ?>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="?register" class="btn btn-primary btn-block" role="button"><?php echo $lang[55] ?></a>
                    </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="panel panel-success">
                <div class="corneRribbon">
                    <div class="corneRribbon-inner">
                        <span class="corneRribbon-label"><?php echo $lang[232] ?></span>
                    </div>
                </div>
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo $lang[227] ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <?php echo $pricepremium ?>
                        <small></small>
                    </div>
                    <table class="table table-striped">
                        <?php echo $premium; ?>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="?contact&plan=1" class="btn btn-primary btn-block" role="button"><?php echo $lang[52] ?></a>
                    </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo $lang[228] ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <?php echo $pricegold ?>
                        <small></small>
                    </div>
                    <table class="table table-striped">
                        <?php echo $gold; ?>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="?contact&plan=2" class="btn btn-primary btn-block" role="button"><?php echo $lang[52] ?></a> </div>
            </div>
        </div>
    </div>

