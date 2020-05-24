<?php
(file_exists('../includes/config.php')) ? require_once ('../includes/config.php') : '';
require_once ('./ini.php');	
require_once ('../includes/session.php');
require_once ('../includes/functions.php');
require_once ('../includes/connect.php');

$_maxFileSize   = return_bytes(@ini_get('upload_max_filesize'));
$_maxPostSize   = return_bytes(@ini_get('post_max_size'));
$_memory_limit  = return_bytes(@ini_get('memory_limit'));
$_siteurl       = str_replace('/install','', siteURL() );
//$_siteurl       = str_replace('/install/','', siteURL() );
//$_siteurl       = ( substr($_siteurl, -1)!=='/') ? $_siteurl.'/' : $_siteurl;
( !defined('siteurl')) ? define('siteurl',  $_siteurl) : '';
( !defined('maxsize')) ? define('maxsize',  FileSizeConvert(min($_maxFileSize,$_maxPostSize , $_memory_limit))) : '';

if (isset($_GET['unlink']))
{
	@unlinkRecursive('../install',true);
	exit(header('Location: ../'));
}
if(Mysqli_IsConnect)
{
	$_SESSION['settings']['update']['host']['dbhost'] = dbhost ;
	$_SESSION['settings']['update']['host']['dbuser'] = dbuser ;
	$_SESSION['settings']['update']['host']['dbpass'] = dbpass ;
	$_SESSION['settings']['update']['host']['dbname'] = dbname ;
}
	
(!defined('InterfaceLanguage')) ? define('InterfaceLanguage',Auto_detect_language()) : ''; 
(!defined('theme')) ? define('theme', 'fbootstrap.min.css') : '';
require_once ('../includes/languages/'.LANG_FILE);	

if (isset($_GET['settings'])){	
$date = timestamp();
$ip   = iplong();
if(Mysqli_IsConnect)
{
$username    = protect($_POST['username']);
$password    = md5(protect($_POST['password']));

$siteurl     = protect($_POST['siteurl']);
$sitemail    = protect($_POST['sitemail']);
$language    = protect($_POST['language']);
$time_zone   = protect($_POST['time_zone']);


$siteurl     = protect($_POST['siteurl']);
$sitemail    = protect($_POST['sitemail']);
$language    = protect($_POST['language']);
$time_zone   = protect($_POST['time_zone']);
$sitename    = protect($_POST['sitename']);
$rtlsitename = protect($_POST['rtlsitename']);
$Interval    =(int)$_POST['Interval'];
$maxUploads  =(int)$_POST['maxUploads'];
$days_older	 =(int)$_POST['days_older'];

$closemsg           = isPost('closemsg') ?  protect($_POST['closemsg']) : closemsg ;	 
$siteclose          = isPost('siteclose') ?  1 : 0 ;	 
$register           = isPost('register') ?  1 : 0 ;
$authorized         = isPost('authorized') ?  1 : 0 ;
$directdownload     = isPost('directdownload') ?  1 : 0 ;
$enable_userfolder  = isPost('enable_userfolder') ?  1 : 0 ;
$enable_orgFilename = isPost('enable_orgFilename') ?  1 : 0 ;

$banned_countries   = protect($_POST['banned_countries']);
$banned_ips         = protect($_POST['banned_ips']);

$statistics     = isPost('statistics') ?  1 : 0 ;
$thumbnail      =  isPost('thumbnail') ?  1 : 0 ;
$multiple       = isPost('multiple') ?  1 : 0 ;
$multipleSelect = isPost('multipleSelect') ?  1 : 0 ;
$deletelink     = isPost('deletelink') ?  1 : 0 ;
$EnableComments = isPost('EnableComments') ?  1 : 0 ;
$EnableCaptcha  = isPost('EnableCaptcha') ?  1 : 0 ;
$animated       = isPost('animated') ?  1 : 0 ;

$PlayMedia          = isPost('PlayMedia') ?  1 : 0 ;
$ApiStatus          = isPost('ApiStatus') ?  1 : 0 ;
$access_contact     = isPost('access_contact') ?  1 : 0 ;
$access_plans       = isPost('access_plans') ?  1 : 0 ;
$access_forgot      = isPost('access_forgot') ?  1 : 0 ;
$showUserfiles      = isPost('showUserfiles') ?  1 : 0 ;

$folderupload = protect($_POST['folderupload']);
$prefixname   = protect($_POST['prefixname']);
$extensions   = protect($_POST['extensions']);
$rowsperpage  = protect($_POST['rowsperpage']);
$theme        = protect($_POST['theme']).'.min.css';

$BodyColor    = protect($_POST['BodyColor']);
$WellColor    = protect($_POST['WellColor']);
$FontColor    = protect($_POST['FontColor']);

$description  = protect($_POST['description']);	
$keywords     = protect($_POST['keywords']);	
$privacy      = ($_POST['privacy']);	
$terms        = ($_POST['terms']);

$maxsize      = ($_POST['maxsize']!=='') ? protect($_POST['maxsize'].$_POST['format_maxsize']) : '';
$userspacemax = ($_POST['userspacemax']!=='') ? protect($_POST['userspacemax'].$_POST['format_userspacemax']) : '';
$speed        = ($_POST['speed']!=='') ? protect($_POST['speed'].$_POST['format_speed']) : '';

$twitter      = protect($_POST['twitter']);	
$gplus        = protect($_POST['gplus']);
$facebook     = protect($_POST['facebook']);

$conn         =  mysqliconnect(false);
Sql_query("CREATE DATABASE IF NOT EXISTS ".dbname);
$conn         = mysqliconnect();
Sql_mode();
//Sql_query("DROP TABLE IF EXISTS `users`");
Sql_query("DROP TABLE IF EXISTS `settings`");
//Sql_query("DROP TABLE IF EXISTS `files`");
Sql_query("DROP TABLE IF EXISTS `reports`");
//Sql_query("DROP TABLE IF EXISTS `folders`");
//Sql_query("DROP TABLE IF EXISTS `stats`");
Sql_query("DROP TABLE IF EXISTS `comments`");
Sql_query("DROP TABLE IF EXISTS `plans`");
Sql_query("DROP TABLE IF EXISTS `publicity`");

/*-- Table structure for table `files`*/

Sql_query("CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `fileSize` bigint(20) NOT NULL,
  `uploadedDate` int(11) NOT NULL,
  `deleteHash` varchar(15) NOT NULL,
  `folderId` int(11) NOT NULL,
  `totalDownload` int(11) NOT NULL,
  `originalFilename` varchar(255) NOT NULL,
  `accessPassword` varchar(32) NOT NULL,
  `isPublic` int(1) NOT NULL,
  `uploadedIP` int(11) UNSIGNED NOT NULL,
  `last_access` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1 ;");

/*-- Table structure for table `folders`*/

Sql_query("CREATE TABLE IF NOT EXISTS `folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `folderName` varchar(255) NOT NULL,
  `isPublic` int(1) NOT NULL,
  `accessPassword` varchar(32) NOT NULL,
  `date_added` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1 ;");

/*-- Table structure for table `stats`*/

Sql_query("CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referrer` varchar(255) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `platform` varchar(30) NOT NULL,
  `file_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `ip` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1 ;");

/*-- Table structure for table `reports`*/

Sql_query("CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `ip` int(11) UNSIGNED NOT NULL,
  `status` int(1) NOT NULL,
  `reason` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1 ;");

/*-- Table structure for table `settings`*/

Sql_query("CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(20) NOT NULL,
  `value` text NOT NULL,
  `parameter` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;");

/*-- Table structure for table `users`*/

Sql_query("CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(25) NOT NULL,
  `level` int(2) NOT NULL DEFAULT '0',
  `last_visit` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `register_date` int(11) NOT NULL,
  `plan_id` int(1) NOT NULL DEFAULT '0',
  `end_plan` int(11) NOT NULL,
  `last_ip` int(11) UNSIGNED NOT NULL,
  `showfiles` int(1) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  AUTO_INCREMENT=1 ;");


/*-- Table structure for table `comments`*/

Sql_query("CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8  AUTO_INCREMENT=1 ;");

/*-- Table structure for table `plans`*/

Sql_query("CREATE TABLE IF NOT EXISTS `plans` (
  `name` varchar(100) NOT NULL,
  `gold` text NOT NULL,
  `free` text NOT NULL,
  `premium` text NOT NULL,
  `register` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;");

/*-- Dumping data for table `plans`*/

Sql_query("INSERT INTO `plans` (`name`, `gold`, `free`, `premium`, `register`) VALUES
('maxsize', '', '', '', ''),
('extensions', '', '', '', ''),
('Interval', '', '', '', ''),
('directdownload', '', '', '', ''),
('statistics', '', '', '', ''),
('userspacemax', '', '', '', ''),
('thumbnail', '', '', '', ''),
('display_ads', '', '', '', ''),
('price', '', '', '', ''),
('speed', '', '', '', ''),
('maxUploads', '', '', '', ''),
('multiple', '', '', '', ''),
('enable_userfolder', '', '', '', '');");


Sql_query("TRUNCATE `settings`");

/*--update 0.6--*/
if(num_rows(Sql_query("SHOW COLUMNS FROM `files` LIKE 'last_access';"))==0) 
	Sql_query("ALTER TABLE `files` ADD `last_access` INT NOT NULL ;");

if(num_rows(Sql_query("SHOW COLUMNS FROM `users` LIKE 'plan_id';"))==0) 
	Sql_query("ALTER TABLE `users` ADD `plan_id` INT(1) NOT NULL ;");

if(num_rows(Sql_query("SHOW COLUMNS FROM `users` LIKE 'last_ip';"))==0) 
	Sql_query("ALTER TABLE `users` ADD `last_ip` INT NOT NULL ;");


if(num_rows(Sql_query("SHOW COLUMNS FROM `users` LIKE 'end_plan';"))==0) 
	Sql_query("ALTER TABLE `users` ADD `end_plan` INT NOT NULL ;");

if(num_rows(Sql_query("SHOW COLUMNS FROM `users` LIKE 'showfiles';"))==0) 
	Sql_query("ALTER TABLE `users` ADD `showfiles` INT(1) NOT NULL ;");

Sql_query("UPDATE `files` SET `last_access` = '$date'");


Sql_query("ALTER DATABASE ".dbname." CHARACTER SET utf8 COLLATE utf8_bin;");
Sql_query("ALTER TABLE `files` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;");
Sql_query("ALTER TABLE `users` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;");
Sql_query("ALTER TABLE `reports` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;");
Sql_query("ALTER TABLE `stats` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;");
Sql_query("ALTER TABLE `plans` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;");
Sql_query("ALTER TABLE `comments` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;");
Sql_query("ALTER TABLE `settings` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;");
Sql_query("ALTER TABLE `folders` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;");
//Sql_query("ALTER TABLE <table-name> CHARACTER SET utf8 COLLATE utf8_bin;");


/*--update 0.9 and older --*/
/*
Sql_query("ALTER TABLE `files` CHANGE `uploadedIP` `uploadedIP` BIGINT NOT NULL;");
Sql_query("ALTER TABLE `users` CHANGE `last_ip` `last_ip` BIGINT NOT NULL;");
Sql_query("ALTER TABLE `reports` CHANGE `ip` `ip` BIGINT NOT NULL;");
Sql_query("ALTER TABLE `stats` CHANGE `ip` `ip` BIGINT NOT NULL;");*/
/*------------------------*/

if(num_rows(Sql_query("SHOW COLUMNS FROM `stats` LIKE 'country_code';"))==0) 
{
	$result = Sql_query("SELECT `country`,`id` FROM `stats`");
	if($result)
		while($row = mysqli_fetch_assoc($result))
			Sql_query( "UPDATE `stats` SET `country` =  '".GetCountryCode($row['country'],'en')."' WHERE `id`= '".$row['id']."'" ) ;	
		
	($result) ? mysqli_free_result($result) : '';
	Sql_query("ALTER TABLE `stats` CHANGE `country` `country_code` VARCHAR(2) CHARACTER SET utf8  COLLATE utf8 _swedish_ci NOT NULL;");
}


/*if(num_rows(Sql_query("SHOW COLUMNS FROM `files` LIKE 'size';"))==0) 
	Sql_query("ALTER TABLE `files` ADD `size` INT NOT NULL ;");*/

/*-- Dumping data for table `settings`*/

Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('rtlsitename', '$rtlsitename');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('sitename','$sitename');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('siteurl','$siteurl');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('sitemail','$sitemail');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('language','$language');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('time_zone','$time_zone');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('siteclose','$siteclose');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('closemsg','$closemsg');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('register','$register');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('enable_userfolder','$enable_userfolder');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('folderupload','$folderupload');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('prefixname','$prefixname');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('maxsize','$maxsize');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('extensions','$extensions');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('rowsperpage','$rowsperpage');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('installdate','".date('Y-m-d')."');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('Interval', '$Interval');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('scriptversion', '".scriptversion."');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('description', '$description');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('keywords', '$keywords');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('authorized', '$authorized');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('terms', '$terms');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('privacy', '$privacy');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('directdownload', '$directdownload');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('statistics', '$statistics');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('userspacemax', '$userspacemax');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('thumbnail', '$thumbnail');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('ads_download', '');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('ads_google', '');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('ads_index', '');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('twitter', '$twitter');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('facebook', '$facebook');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('gplus', '$gplus');");

Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('BodyColor', '$BodyColor');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('WellColor', '$WellColor');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('FontColor', '$FontColor');");


Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('PlayMedia', '$PlayMedia');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('ApiStatus', '$ApiStatus');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('access_contact', '$access_contact');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('access_plans', '$access_plans');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('access_forgot', '$access_forgot');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('showUserfiles', '$showUserfiles');");

Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('speed', '$speed');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('days_older', '$days_older');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('maxUploads', '$maxUploads');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('multiple', '$multiple');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('multipleSelect', '$multipleSelect');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('deletelink', '$deletelink');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('theme', '$theme');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('EnableComments', '$EnableComments');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('EnableCaptcha', '$EnableCaptcha');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('animated', '$animated');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('enable_orgFilename', '$enable_orgFilename');");

Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('banned_ips', '$banned_ips');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('banned_countries', '$banned_countries');");

Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('visitors', '0');");
Sql_query("INSERT INTO `settings` (`name`, `value`) VALUES ('api_requests', '0');");



//Sql_query("INSERT INTO `folders` (`userId`, `folderName`, `isPublic`, `accessPassword`, `date_added`) VALUES ( '0', '$folderupload', '1', '', '$date');");

/*-- Dumping data for table `users`*/

if(num_rows(Sql_query("SELECT * FROM `users` WHERE `username`='$username' OR `email`='$sitemail'"))==0) 
{
Sql_query("INSERT INTO `users` (`username`, `password`, `email`, `level`, `last_visit`,`last_ip` ,`register_date`,`showfiles`) VALUES ( '$username', '$password', '$sitemail', '1', '$date','$ip','$date','$showUserfiles');");	
//(isset($_SESSION['login'])) ? unset( $_SESSION['login'] ) : '';
if(isset($_SESSION['login'])) unset( $_SESSION['login'] ) ;

$UserID                          = (string)Sql_Last_query_id();
$_SESSION['login']['username']   = $username;
//$_SESSION['login']['password']   = $password;
$_SESSION['login']['user_id']    = $UserID;
$_SESSION['login']['status']     = true;
$_SESSION['login']['user_level'] = '1'; //(bool)
$_SESSION['login']['user_status']= '0';
$_SESSION['login']['plan_id']    = '0';
$_SESSION['login']['user_email'] = $sitemail;
$_SESSION['login']['register_date'] = $date;

$_SESSION['login']['last_visit'] = $date;
$_SESSION['login']['last_ip']    = $ip;

$_SESSION['login']['user_space_used'] = 0 ;
$_SESSION['login']['user_space_left'] = user_space_max;
//(session_status() == PHP_SESSION_ACTIVE) ? session_regenerate_id() : '';
( is_session_started()=== true ) ? session_regenerate_id() : '';

}

	
if($enable_userfolder )
{
	$uploadDir = $folderupload .'/'.$username;
	$db_userId    = $UserID ;
}	
else
{
	$uploadDir = $folderupload ;
	$db_userId    = 0;
} 
		
$folderExists = num_rows(Sql_query("SELECT 1 FROM `folders` WHERE `folderName` = '$uploadDir' AND `userId` = '$db_userId'")) ;

		if($folderExists==0)
		{
			Sql_query("INSERT INTO `folders` (`userId`, `folderName`, `isPublic`, `accessPassword`, `date_added`) VALUES ( '$db_userId', '$uploadDir', '1', '', '$date');");
			$_SESSION['login']['folder_id']   = (int)Sql_Last_query_id() ;
			$_SESSION['login']['folder_name'] = $uploadDir;
		}
		else
		{
			$_SESSION['login']['folder_id']   = Get_folderId_By_UserId(0) ;
			$_SESSION['login']['folder_name'] = $uploadDir;
		}

			
if($fp = fopen('../.htaccess','w')){
$content = 'Options -Indexes
AddDefaultCharset UTF-8
<files ~ "^.*\.([Hh][Tt][Aa])">
order allow,deny
deny from all
satisfy all
</files>

<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html
  AddOutputFilterByType DEFLATE text/css
  AddOutputFilterByType DEFLATE text/javascript
  AddOutputFilterByType DEFLATE text/xml
  AddOutputFilterByType DEFLATE text/plain
  AddOutputFilterByType DEFLATE image/x-icon
  AddOutputFilterByType DEFLATE image/svg+xml
  AddOutputFilterByType DEFLATE image/png
  AddOutputFilterByType DEFLATE image/gif
  AddOutputFilterByType DEFLATE image/jpg
  AddOutputFilterByType DEFLATE image/jpeg
  AddOutputFilterByType DEFLATE application/rss+xml
  AddOutputFilterByType DEFLATE application/javascript
  AddOutputFilterByType DEFLATE application/x-javascript
  AddOutputFilterByType DEFLATE application/xml
  AddOutputFilterByType DEFLATE application/xhtml+xml
  AddOutputFilterByType DEFLATE application/x-font
  AddOutputFilterByType DEFLATE application/x-font-truetype
  AddOutputFilterByType DEFLATE application/x-font-ttf
  AddOutputFilterByType DEFLATE application/x-font-otf
  AddOutputFilterByType DEFLATE application/x-font-opentype
  AddOutputFilterByType DEFLATE application/vnd.ms-fontobject
  AddOutputFilterByType DEFLATE font/ttf
  AddOutputFilterByType DEFLATE font/otf
  AddOutputFilterByType DEFLATE font/opentype

# For Olders Browsers Which Cant Handle Compression
  BrowserMatch ^Mozilla/4 gzip-only-text/html
  BrowserMatch ^Mozilla/4\.0[678] no-gzip
  BrowserMatch \bMSIE !no-gzip !gzip-only-text/html
</IfModule>

ErrorDocument 404 '.siteurl.'/?404
ErrorDocument 403 '.siteurl.'/?403';	
fwrite($fp,$content);
fclose($fp);
}

/*
RewriteEngine On
RewriteRule ^delete/([^/]*)/id/([^/]*)\.html$ '.siteurl.'/index.php?delete=$1&id=$2 [L]
RewriteRule ^download/([^/]*)\.html$ '.siteurl.'/index.php?download=$1 [L]
RewriteRule ^unq/([^/]*)/file/([^/]*)\.html$ '.siteurl.'/index.php?unq=$1&file=$2 [L]
RewriteRule ^reset/([^/]*)\.html$ '.siteurl.'/index.php?reset=$1 [L]
*/

WriteHtaccessUploadFolder('..'.$folderupload,!$directdownload);
/*
unlink('../install/ini.php');
unlink('../install/index.php' );*/	
@unlinkRecursive('../install',true);

for($i=0; $i<count($uselessFiles); $i++) 
	unlink('../'.$uselessFiles[$i]);

PrintArray(array('settings'=>'general','success_msg' => $lang[104] , 'admincp' => siteurl.'/admin' , 'username' => $username ));
}
else
	if(isPost('host') && isPost('host_user') && isPost('host_pass') && isPost('host_base') )
{
$host      = protect($_POST['host']);
$host_user = protect($_POST['host_user']);
$host_pass = protect($_POST['host_pass']);
$host_base = protect($_POST['host_base']);

$conn =  mysqli_connect($host , $host_user, $host_pass);
if($conn)
	mysqli_query($conn,"CREATE DATABASE IF NOT EXISTS ".$host_base);

if($fp = fopen('../includes/config.php','w')){
	$content = "<?php
define('dbhost','$host'); 
define('dbuser','$host_user'); 
define('dbpass','$host_pass'); 
define('dbname','$host_base'); 

define('StatsPanel',true); //false-true
define('TotalStats',false); // home page  Require ApiStatus 
define('OutputImage',true); //forceView
define('EnableLogo',false);
define('UpdateBrowser',true); // ie8=< message
define('DirectoryChanged',false);

/*define('MainTitle','اكتب هنا اسم موقعك');*/\r\n"
.'$supportedLangs  '."= array('ar','en','') ;\r\n"	
.'$_plans          '."= array('0'=>'free','1'=>'premium','2'=>'gold','3'=>'register');\r\n

?>";
fwrite($fp,$content);
fclose($fp);}
PrintArray(array('settings'=>'server','success_msg' => $lang[178] ));
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $lang[71] ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../assets/css/themes/<?php echo theme ?>" id="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/fontello.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/styles.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-tagsinput.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-checkbox.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/summernote.min.css">
  <link rel="icon" type="image/png" href="../assets/css/images/favicon.png" />

  <?php /*include_once ('../includes/styles.php');*/ ?>
  <?php if(IsRtL()){ ?>
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-rtl.min.css" >
  <?php } ?>
 
   	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.min.js" type="text/javascript"></script>
      <script src="../assets/js/respond.min.js" type="text/javascript"></script>
	  <script src="../assets/js/es5-shim.min.js" type="text/javascript"></script>
    <![endif]-->
	
	<!--[if IE]>
	   <link rel="shortcut icon" href="../assets/css/images/favicon.ico">
	<![endif]-->
  <script src="../assets/js/jquery.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../assets/js/jquery.bootpag.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
  <script src="../assets/js/typeahead.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-select.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-show-password.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-maxlength.min.js" type="text/javascript"></script>
  <script src="../assets/js/summernote.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-checkbox.min.js" type="text/javascript"></script>
  
  <?php if(InterfaceLanguage=='ar'){ ?>
  <script src="../assets/js/i18n/defaults-ar_AR.js" type="text/javascript"></script>
  <script src="../assets/js/i18n/summernote-ar-AR.js" type="text/javascript"></script>
  <?php } ?>
 
  <script language="javascript" type="text/javascript">
  var
  	   IsRtL       = Boolean('<?php echo (bool)IsRtL() ?>');
	  if(IsRtL) 
		  summernoteLang = 'ar-AR';
	  else
		  summernoteLang = 'en-US';
  function redirect(parameter) {
	window.location = './'+parameter;
}
  $(document).ready(function(e){
	  	options = {
			lang:summernoteLang,
			height: 150,  
			toolbar: [
			['style', ['style']],
			['font', ['bold', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['table', ['table']],
			['insert', ['link']],
			['view', ['codeview']]
			]};	
			
	$('.editor').summernote(options);
	$('#settings').hide();
	$('#closemsg').summernote('disable');
	$('input[maxlength]').maxlength();
	$('textarea').maxlength({alwaysShow: true});
	$('input[type="checkbox"]').checkbox();
	//-------------------------------------------------
	$('#banned_countries').tagsinput({
    typeahead: {
		
	afterSelect: function(val) { this.$element.val(""); },
    source: function(query) {return $.get("ajax?countrycodes&lang=en");}
	
    },
    });
	//-------------------------------------------------
	
    $('#banned_countries').on('itemAdded', function(event) {
    // event.item: contains the item
    setTimeout(function() {
    $('.bootstrap-tagsinput :input').val(''); // Patch: In my case when selecting an option, the input (with typeahead) added the suggested text twice)
    }, 0);
    });
    //-------------------------------------------------
	
	
	$('#username').keyup(function(){
		username = $('#username').val();
		$('#sitemail').val(username+'@gmail.com');

		if($('#username').val().length ==0)
			$('#sitemail').val('');
		})
	
	
	$('input').keyup(function(){
		username = $('#username').val();
		$('#twitter').val('https://twitter.com/'+username);
		$('#facebook').val('https://www.facebook.com/'+username);
		$('#gplus').val('https://plus.google.com/+'+username);
		if($('#sitemail').val().length && $('#username').val().length && $('#password').val().length )
			$('#settings').show();
		else
			$('#settings').hide();
		});
	
	$('#username').bind('keyup blur',function(){ 
    var self = $(this);
    self.val(self.val().replace(/[^A-Za-z0-9_.]/g,'') ); 
	});
	
    $('#siteclose').change(function() {
		if(!this.checked)
			$('#closemsg').summernote('disable');
		else
			$('#closemsg').summernote('enable');
		});
	
	});
	
	//Function to convert hex format to a rgb color
function rgb2hex(rgb){
 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
 return (rgb && rgb.length === 4) ? "" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}
	
	
function SelectStyleSheet(theme){ 
    $('body').fadeOut();
	$("#stylesheet").attr("href", "../assets/css/themes/"+theme.value +".min.css");
	$('body').fadeIn("slow",function(){	
	
	if ( $(".well").length )
		var WellColor = rgb2hex($(".well").css('backgroundColor'));
	
	if ( $(".panel").length )
		var BodyColor = rgb2hex($(".panel").css('backgroundColor'));
	
	if ( $("body").length )
		var FontColor = rgb2hex($("body").css('color'));
	
	
	$("#WellColor").val(WellColor);
	$("#BodyColor").val(BodyColor);
	$("#FontColor").val(FontColor);
	} );
	
}
	
	function httprequest()
	{
	var datastring = $("#settings_form").serialize();
	$("html, body").animate({ scrollTop: 0 }, "slow");
	$("#Results").html("<div class='alert alert-info'><i class='glyphicon glyphicon-hourglass'></i> <?php echo $lang[102] ?></div>"); 
$.ajax({
    type: "POST",
    url: "index.php?settings",
    data: datastring,
    dataType: "json",
    success: function(data) {
		if(data.settings=='general')
		setInterval(redirect('..'),1000); 
	else
		setInterval(redirect('.'),1000); 
        //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
        // do what ever you want with the server response
		$("#Results").html("<div class='alert alert-info'><i class='glyphicon glyphicon-hourglass'></i> <?php echo $lang[178] ?> ... </div>"); 
    },
    error: function() {
		$("#Results").html("<div class='alert alert-danger'><i class='glyphicon glyphicon-hourglass'></i> <?php echo $lang[103] ?></div>"); 
    }
});

	}


  </script>
</head>
<body>

<div class="container">
  <div class="col-md-8 col-md-offset-2 top60">
 <!-- panel-group-->

    <div class="panel-group">
    
      <div class="panel panel-default">
	 
        <div class="panel-heading" id="header">
		<?php if( !Mysqli_IsConnect) {?>
          <h4 class="modal-title"><?php echo $lang[252] .' / '.$lang[181] ?> </h4>
		 <?php } else { ?>
		  <h4 class="modal-title"><?php echo $lang[252] ?> </h4>
		 <?php }  ?>
        </div>
	 <div class="panel-body">
	   
     
 

<form id="settings_form" role="form" onsubmit="return false;" >	
<input id="IsLoad" value="0" type="hidden" >
<div class="form-group" id="Results"> </div>


	<ul class="nav nav-tabs">
      <li class="active"><a href="#connect" data-toggle="tab"><?php echo $lang[251] ?></a></li>
    </ul>

  <div class="tab-content">
  
	<div class="well tab-pane fade in active" id="connect">
	
   <?php if( !Mysqli_IsConnect) {?>
	
	  <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[181] ?></span>
        <input name="host" type="text" class="form-control" value="<?php echo isset($_SESSION['settings']['update']['host']['dbhost']) ?($_SESSION['settings']['update']['host']['dbhost']) : dbhost ?>" placeholder="<?php echo $lang[181] ?>" required>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[35] ?></span>
        <input type="text"  name="host_user" class="form-control" value="<?php echo isset($_SESSION['settings']['update']['host']['dbuser']) ? ($_SESSION['settings']['update']['host']['dbuser']) : dbuser ?>" placeholder="<?php echo $lang[35] ?>" required>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[37] ?></span>
        <input type="password" name="host_pass" class="form-control"  value="<?php echo isset($_SESSION['settings']['update']['host']['dbpass']) ? ($_SESSION['settings']['update']['host']['dbpass']) : dbpass ?>" placeholder="<?php echo $lang[37] ?>">
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[182] ?></span>
        <input type="text"  name="host_base" class="form-control" value="<?php echo isset($_SESSION['settings']['update']['host']['dbname']) ? ($_SESSION['settings']['update']['host']['dbname']) : dbname ?>" placeholder="<?php echo $lang[182] ?>" required>
    </div>
	


	<?php } else { ?>   
		

    <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[35] ?></span>
        <input name="username" id="username" maxlength="15" type="text" class="form-control"  placeholder="<?php echo $lang[35] ?>" required>
		<span style="min-width: 60px;" class="input-group-addon"><i class="icon-user"></i></span>
    </div>
	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[37] ?></span>
        <input type="password" name="password" id="password" maxlength="20" class="form-control" placeholder="<?php echo $lang[37] ?>" required>
		<span style="min-width: 60px;" class="input-group-addon"><i class="icon-lock"></i></span>
    </div>
	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[40] ?></span>
        <input type="text"  name="sitemail" id="sitemail"  maxlength="40" class="form-control" value="<?php echo sitemail ?>"  placeholder="<?php echo $lang[40] ?>" required>
		<span style="min-width: 60px;" class="input-group-addon"><i class="icon-gplus"></i></span>
    </div>
	
	</div> <!-- tab-connect-->
 </div> <!-- tab-content 1-->
	
<div id="settings">

	<hr>
	
	<ul class="nav nav-tabs">
      <li class="active"><a href="#setting" data-toggle="tab"><?php echo $lang[29] ?></a></li>
	  <li><a href="#permissions" data-toggle="tab"><?php echo $lang[250] ?></a></li>
	  <li><a href="#maxi" data-toggle="tab"><?php echo $lang[24] ?></a></li>
      <li><a href="#terms" data-toggle="tab"><?php echo $lang[152].' ...' ?></a></li>
	  <li><a href="#style" data-toggle="tab"><?php echo $lang[70] ?></a></li>
	  <li><a href="#closesite" data-toggle="tab"><?php echo $lang[64] ?></a></li>
    </ul>
	
<div class="tab-content">
	
	<div class="well tab-pane fade" id="style">
	
  	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[70] ?></span>
       <select onchange="SelectStyleSheet(this);" name="theme" class="selectpicker" data-live-search="true"  data-width="100%"  title="<?php echo $lang[70] ?>">
	    <option value="<?php echo str_replace(".min.css","",theme)  ?>" selected><?php echo str_replace(".min.css","",theme)  ?></option>
		<?php 
		    $lists=ListStyles(); 
		    for($i=0; $i<count($lists); $i++) 
				echo '<option value="'.$lists[$i].'">'.$lists[$i].'</option>';
		?>
      </select>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[191] ?></span>
        <input readonly name="WellColor" id="WellColor" type="text"  maxlength="255" class="form-control" value="<?php echo WellColor ?>" style="text-align: left;direction: ltr;" >
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[191] ?></span>
        <input readonly id="BodyColor" name="BodyColor" type="text"  maxlength="255" class="form-control" value="<?php echo BodyColor ?>" style="text-align: left;direction: ltr;" >
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[191] ?></span>
        <input readonly id="FontColor" name="FontColor" type="text"  maxlength="255" class="form-control" value="<?php echo FontColor ?>" style="text-align: left;direction: ltr;" >
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><input name="animated" type="checkbox" <?php if(animated) echo ' checked' ?>> <?php echo $lang[253] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[253] ?>" disabled>
    </div>
	
</div> <!-- tab-style -->


	<div class="well tab-pane fade" id="terms">
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[152] ?></span>
	    <textarea maxlength="21844" class="editor form-control" rows="5" name="terms" id="editor" placeholder="<?php echo $lang[152] ?>"><?php echo terms ?></textarea>
    </div>
	
  
    <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[153] ?></span>
	    <textarea maxlength="21844" class="editor form-control" rows="5" name="privacy" id="privacy" placeholder="<?php echo $lang[153] ?>"><?php echo privacy ?></textarea>
    </div>
	
	</div><!-- tab terms -->
	
	
    <div class="well tab-pane fade" id="closesite">
	
    <div class="input-group">
      <span class="input-group-addon"><input id="siteclose" name="siteclose" type="checkbox" <?php if(siteclose) echo ' checked' ?>> <?php echo $lang[64] ?> </span>
         <textarea maxlength="21844" class="editor form-control" rows="5" id="closemsg" name="closemsg"  placeholder="<?php echo $lang[64] ?>"><?php echo closemsg ?></textarea>
    </div>
	
	</div><!-- tab closesite -->
	

	<div class="well tab-pane fade" id="maxi">
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[24] ?></span>
        <input type="text"  name="maxsize" maxlength="255" class="form-control" value="<?php echo nbrOnly(maxsize) ?>" placeholder="<?php echo $lang[24] ?>">
	  <?php echo OptionSizeHtml('format_maxsize',(maxsize))?>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[173] ?></span>
        <input type="text"  name="userspacemax" maxlength="255" class="form-control" value="<?php echo nbrOnly(userspacemax) ?>" placeholder="<?php echo $lang[173] ?>">
	  <?php echo OptionSizeHtml('format_userspacemax',(userspacemax))?>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[234] ?></span>
        <input type="text"  name="speed" maxlength="255" class="form-control" value="<?php echo nbrOnly(speed) ?>" placeholder="<?php echo $lang[234] ?>">
	  <?php echo OptionSizeHtml('format_speed',(speed))?>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml" ><?php echo $lang[236] ?></span>
        <input type="text"  name="days_older" value="<?php echo days_older ?>" class="form-control" placeholder="<?php echo $lang[236].' 30 '.$lang[222].' ...' ?>">
	  <span style="min-width: 65px;" class="input-group-addon hidden-sml" ><?php echo $lang[222] ?></span>
    </div>
	
	 
	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[78] ?></span>
        <input type="text"  name="Interval" value="<?php echo Interval ?>" class="form-control" placeholder="<?php echo $lang[78] ?>">
	  <span style="min-width: 65px;" class="input-group-addon"><?php echo $lang[216] ?></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon" ><?php echo $lang[237] ?></span>
        <input type="text" name="maxUploads" value="<?php echo maxUploads ?>" class="form-control" placeholder="<?php echo $lang[237] ?>">
	  <span style="min-width: 65px;" class="input-group-addon" ><?php echo function_exists('ini_get') ? ini_get('max_file_uploads') : '' ?></span>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[69] ?></span>
        <input type="text" maxlength="255" name="rowsperpage" value="<?php echo rowsperpage ?>" class="form-control" placeholder="<?php echo $lang[69] ?>">
		<span style="min-width: 60px;" class="input-group-addon"><?php echo $lang[261] ?></span>
    </div>
	
	</div> <!-- tab-maxi -->
	
	<div class="well tab-pane fade" id="permissions">
	
		 <div class="input-group">
      <span class="input-group-addon hidden-sml"><input name="thumbnail" type="checkbox" <?php if(thumbnail) echo ' checked' ?>> <?php echo $lang[172] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[172] ?>" disabled>
    </div>
	
	
	 <div class="input-group">
      <span class="input-group-addon"><input name="register" type="checkbox" <?php if(register) echo ' checked' ?>> <?php echo $lang[55] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[55] ?>" disabled>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"><input name="enable_userfolder" type="checkbox" <?php if(enable_userfolder) echo ' checked' ?>> <?php echo $lang[65] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[65] ?>" disabled>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"><input name="enable_orgFilename" type="checkbox" <?php if(enable_orgFilename) echo ' checked' ?>> <?php echo $lang[265] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[265] ?>" disabled>
    </div>
	
	
	 <div class="input-group">
      <span class="input-group-addon"><input name="authorized" type="checkbox" <?php if(authorized) echo ' checked' ?>> <?php echo $lang[149] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[1].' / '.$lang[149] ?>" disabled>
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"><input name="directdownload" type="checkbox" <?php if(directdownload) echo ' checked' ?>> <?php echo $lang[51] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[51] ?>" disabled>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><input name="deletelink" type="checkbox" <?php if(deletelink) echo ' checked' ?>> <?php echo $lang[26] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[26] ?>" disabled>
    </div>
	
    <div class="input-group">
      <span class="input-group-addon"><input name="statistics" type="checkbox" <?php if(statistics) echo ' checked' ?>> <?php echo $lang[28] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[28] ?>" disabled>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><input name="multiple" type="checkbox" <?php if(multiple) echo ' checked' ?>> <?php echo $lang[248].'/'.$lang[174] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[259] ?>" disabled>
    </div>
	
	
	<div class="input-group">
      <span class="input-group-addon"><input name="multipleSelect" type="checkbox" <?php if(multipleSelect) echo ' checked' ?>> <?php echo $lang[248].'/'.$lang[158] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[260] ?>" disabled>
    </div>
	
	
	  <div class="input-group">
      <span class="input-group-addon"><input name="EnableComments" type="checkbox" <?php if(EnableComments) echo ' checked' ?>> <?php echo $lang[240] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[240] ?>" disabled>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><input name="EnableCaptcha" type="checkbox" <?php if(EnableCaptcha) echo ' checked' ?>> <?php echo $lang[254] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[254] ?>" disabled>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><input name="PlayMedia" type="checkbox" <?php if(PlayMedia) echo ' checked' ?>> <?php echo $lang[209] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[209] ?>" disabled>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><input name="ApiStatus" type="checkbox" <?php if(ApiStatus) echo ' checked' ?>> <?php echo $lang[281] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[281] ?>" disabled>
    </div>
	
	
	
	
	<div class="input-group">
      <span class="input-group-addon"><input name="access_contact" type="checkbox" <?php if(access_contact) echo ' checked' ?>> <?php echo $lang[282] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[282] ?>" disabled>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><input name="access_plans" type="checkbox" <?php if(access_plans) echo ' checked' ?>> <?php echo $lang[283] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[283] ?>" disabled>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><input name="access_forgot" type="checkbox" <?php if(access_forgot) echo ' checked' ?>> <?php echo $lang[284] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[284] ?>" disabled>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><input name="showUserfiles" type="checkbox" <?php if(showUserfiles) echo ' checked' ?>> <?php echo $lang[294] ?></span>
        <input type="text"  class="form-control" placeholder="<?php echo $lang[258].$lang[294] ?>" disabled>
    </div>
	
	
	
	</div> <!-- tab-permissions -->
	
	
  <div class="well tab-pane active in" id="setting">
	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[72] ?></span>
        <input name="sitename" type="text" maxlength="255" class="form-control" value="<?php echo sitename ?>" style="text-align: left;direction: ltr;"  placeholder="<?php echo $lang[72] ?>">
    </div>

	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[112] ?></span>
        <input name="rtlsitename" maxlength="255" type="text" class="form-control" value="<?php echo rtlsitename ?>" placeholder="<?php echo $lang[112] ?>">
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[132] ?></span>
		<textarea maxlength="255" class="form-control" rows="3" name="description"  placeholder="<?php echo $lang[132] ?>"><?php echo description ?></textarea>
    </div>

    <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[18] ?></span>
        <input name="siteurl" type="text" maxlength="255" class="form-control" value="<?php echo siteurl ?>" style="text-align: left;direction: ltr;" placeholder="<?php echo $lang[18] ?>">
		<span style="min-width: 60px;" class="input-group-addon"><i class="icon-link"></i></span>
    </div>
	
		<div class="input-group">
      <span class="input-group-addon">twitter</span>
        <input type="text" id="twitter" name="twitter" maxlength="255" class="form-control" placeholder="" style="text-align: left;direction: ltr;">
		<span style="min-width: 60px;" class="input-group-addon"><i class="icon-twitter"></i></span>
    </div>

	<div class="input-group">
      <span class="input-group-addon">facebook</span>
        <input name="facebook"  id="facebook" type="text" maxlength="255" class="form-control"  placeholder="" style="text-align: left;direction: ltr;">
		<span style="min-width: 60px;" class="input-group-addon"><i class="icon-facebook"></i></span>
    </div>

	<div class="input-group">
      <span class="input-group-addon">gplus</span>
        <input name="gplus" id="gplus" maxlength="255" type="text" class="form-control" placeholder="" style="text-align: left;direction: ltr;">
		<span style="min-width: 60px;" class="input-group-addon"><i class="icon-gplus"></i></span>
    </div>
	
	
	 <div class="input-group">
      <span class="input-group-addon"> <?php echo $lang[63] ?> </span>
        <input type="text" name="folderupload" maxlength="255" class="form-control" value="<?php echo folderupload ?>" style="text-align: left;direction: ltr;" placeholder="<?php echo $lang[63] ?>">
		<span style="min-width: 60px;" class="input-group-addon"><i class="icon-folder-open"></i></span>
    </div>
	
	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[68] ?></span>
       <select  name="language" class="selectpicker" data-live-search="true"  data-width="100%"  title="<?php echo $lang[68] ?>">
	    <option value="<?php echo language ?>" selected><?php echo GetLanguageCode(language)  ?></option>
        <option value="ar">العربية</option>
		<option value="en">English</option>
		<option value=""><?php echo $lang[114] ?></option>
      </select>
    </div>
	

	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[66] ?></span>
	  <select name="time_zone" class="selectpicker" data-live-search="true"  data-width="100%"  title="<?php echo $lang[66] ?>">
	    <option selected><?php echo time_zone ?></option>
        <?php echo LoadTimeZones(); ?>
      </select>
    </div>
	
	
	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[67] ?></span>
        <input type="text" maxlength="255"  name="prefixname" value="<?php echo prefixname ?>" class="form-control" style="text-align: left;direction: ltr;" placeholder="<?php echo $lang[67] ?>">
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon"><?php echo $lang[25] ?></span>
        <input type="text" maxlength="255" name="extensions" value="<?php echo extensions ?>" class="form-control" placeholder="<?php echo $lang[25] ?>" data-role="tagsinput" >
    </div>
	
	<div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[266] ?></span>
        <input type="text" maxlength="1000" name="banned_ips" value="<?php echo banned_ips ?>" class="form-control" placeholder="<?php echo $lang[266] ?>" data-role="tagsinput" >
    </div>
	
	 <div class="input-group">
      <span class="input-group-addon hidden-sml"><?php echo $lang[267] ?></span>
        <input type="text" maxlength="1000" id="banned_countries" name="banned_countries" value="<?php echo banned_countries ?>" class="form-control" placeholder="<?php echo $lang[267] ?>"  >
    </div>

	
	<div class="input-group">
      <span class="input-group-addon"><?php echo $lang[131] ?></span>
        <input type="text" maxlength="255" name="keywords" value="<?php echo keywords ?>" class="form-control" placeholder="<?php echo $lang[131] ?>" data-role="tagsinput" >
    </div>
	
	

	</div><!-- tab-settings -->
	
</div><!-- tab-content -->

	
	
	
	
	
	
	
	
	
	
	
	</div><!-- end div settings -->

<?php }?>  

 </form>

	
        </div>
        <div class="panel-footer">

		  <button type="submit" id="btn" class="btn btn-primary btn-block" onclick="httprequest();" ><?php echo $lang[71] ?></button>
		 
        </div>
      </div>
      
    </div>
   </div>
</div>
	
	