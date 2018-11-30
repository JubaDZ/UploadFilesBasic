<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php 
define('url_json_file',Decrypt(u_encrypt_url));
define('tmpZip_file','../tmp.zip');/*مكان تخزيا الملف المؤقت*/
define('extract_dir','../');/*مسار فك الضغط*/

if(Mysqli_IsConnect)
{
$_SESSION['settings']['update']['host']['dbhost'] = dbhost ;
$_SESSION['settings']['update']['host']['dbuser'] = dbuser ;
$_SESSION['settings']['update']['host']['dbpass'] = dbpass ;
$_SESSION['settings']['update']['host']['dbname'] = dbname ;
}
else
{
if($fp = fopen('../includes/config.php','w')){
	$content = "<?php
define('dbhost','".$_SESSION['settings']['update']['host']['dbhost']."'); 
define('dbuser','".$_SESSION['settings']['update']['host']['dbuser']."'); 
define('dbpass','".$_SESSION['settings']['update']['host']['dbpass']."'); 
define('dbname','".$_SESSION['settings']['update']['host']['dbname']."'); 

define('FooterInfo',false); //false-true
define('TotalStats',false); // home page  Require ApiStatus 
define('OutputImage',true); //forceView
define('EnableLogo',false);
define('UpdateBrowser',true); // ie8=< message
define('DirectoryChanged',false);

/*define('MainTitle','اكتب هنا اسم موقعك');*/\r\n"
.'$supportedLangs  '."= array('ar','en','') ;\r\n"	
.'$_plans          '."= array('0'=>'free','1'=>'premium','2'=>'gold','3'=>'register');\r\n"	
.'$currentpage     '."= 1 ;\r\n"
.'$totalpages      '."= 1 ;\r\n

?>";
fwrite($fp,$content);
fclose($fp);
}
	
exit(header('Location: ../install'));	
}

if(isset($_SESSION['settings']['update']['url']))
	define('url_zip_file',$_SESSION['settings']['update']['url']);

if(isset($_SESSION['settings']['update']['version']))
	define('update_version',$_SESSION['settings']['update']['version']);
?>
<div class="table-responsive">
  <table class="table table-hover">
 <tbody>
 <tr> <th><?php echo $lang[134]?> </th> <td><code><?php echo sitename();?></code></td> </tr>
 <tr> <th><?php echo $lang[12]?>  </th> <td><?php echo Decrypt(u_encrypt_author);?></td> </tr> 
 <tr> <th><?php echo $lang[72]?>  </th> <td><code><?php echo sitename();?></code></td> </tr>
 <tr> <th><?php echo $lang[132]?> </th> <td><code><?php echo description;?></code></td> </tr>
 <tr> <th><?php echo $lang[5]?>   </th> <td><code><?php echo scriptversion;?></code></td> </tr>
 </tbody> 
 </table>
 </div>
    
     
	       
<?php 
if(isGet('ZipArchive'))
{
	$data=extractUpdate(url_zip_file,extract_dir,tmpZip_file);
	echo $data['html'];
	unset($data);
	
    $contents = sqlUpdate(url_json_file); 
	if($contents['status'])
		{
			echo $contents['update_infos'];
			echo $contents['status_html'];
		}
		
	unset($contents);	
}
else
{
	$contents = getUpdate(url_json_file); 
	if($contents['status']) {
		echo $contents['update_infos'];
		echo $contents['status_html'];
	}
	unset($contents);
}


?>