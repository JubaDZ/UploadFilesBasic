<?php 
/* Report all errors*/
/*error_reporting(E_ALL);*/
/*------------ini-------------------*/
$connection = mysqliconnect();
$InfoByIp   = getLocationInfoByIp_2();
LoadUserSettings();
LoadBannedconfig();
banned_ips($InfoByIp['ip']);
banned_countries($InfoByIp['countryCode'],$InfoByIp['countryName']);
Loadconfig();
LoadApiConfig();
CheckConnect();
Sql_mode();
// Change character set to utf8
//$connection ? mysqli_set_charset($connection,"utf8") : '';

/*
days_older_parameter
@ini_set('max_execution_time', 0);
@ini_set('memory_limit', '100G');
@ini_set('post_max_size', '100G');
@ini_set('upload_max_filesize', '100G');
@ini_set('max_input_time', '100G');
*/
 
 mysqli_connect_errno() ? define('Mysqli_IsConnect',false) : define('Mysqli_IsConnect',true);

(defined('time_zone')) ? date_default_timezone_set(time_zone) : date_default_timezone_set("UTC");
(isset($_SESSION['login']['user_space_used'])) ? $_SESSION['login']['user_space_left'] = user_space_max-(int)$_SESSION['login']['user_space_used']: '';
(isset($_SESSION['login']['user_space_left'])) ? define('UserSpaceLeft',$_SESSION['login']['user_space_left']): '';

(defined('UserSpaceUsed') && defined('user_space_max') && user_space_max>0) ? define('PercentageUsed', round((UserSpaceUsed/user_space_max)*100)) : '';
(defined('UserSpaceLeft') && defined('user_space_max') && user_space_max>0) ? define('PercentageFree', round((UserSpaceLeft/user_space_max)*100)) : '';

(!isset($_SESSION['settings']["visitor"]["ip"])) ? $_SESSION['settings']["visitor"]["ip"]=ip() : '';

 $_SESSION['settings']['default_folder_id'] = (Mysqli_IsConnect && TableExists('folders') ) ? (int)Get_folderId_By_UserId(0) : 0 ;
 $_SESSION['login']['plan_id'] = (Mysqli_IsConnect && TableExists('users') && ColumnExists('plan_id','users') && defined('UserID') ) ? Sql_Get_User_Plan_id(UserID) : 0 ;
 
(!isset($_SESSION['settings']['HashCode'])) ? $_SESSION['settings']['HashCode'] = GenerateRandomString(30) : '' ;

(!defined('FolderUploadId')) ? define('FolderUploadId',$_SESSION['settings']['default_folder_id']) : '';
(!defined('HashCode'))       ? define('HashCode',$_SESSION['settings']['HashCode']) : '';
(!defined('display_ads'))    ? define('display_ads',true) : '';

(defined('BodyColor')) ? $_SESSION['settings']['color'] = substr(BodyColor, 1, 6) : '';
(defined('FontColor')) ? $_SESSION['settings']['font'] = substr(FontColor, 1, 6) : '';
(defined('animated'))        ? define('ClassAnimated', animated ? 'animated' : '' ) : '' ;

(Mysqli_IsConnect) ? Sql_Create_Folder() : '';

define('szParameter','sz');
define('APP_DIR',dirname(__FILE__));
define('LANG_FILE',InterfaceLanguage.'.php');
define('SELF',isset($_SERVER['PHP_SELF'])?$_SERVER['PHP_SELF']:'');
define('QUERY',isset($_SERVER['QUERY_STRING'])? protect($_SERVER['QUERY_STRING']):'');

define('SERVER_HOST',  siteURL() );
define('GetIsEmpty' , ( IsGet('plans') || IsGet('about') || IsGet('api') || IsGet('register') ||  IsGet('forgot') || IsGet('files') || IsGet('login') || IsGet('profile') || IsGet('authorized') || IsGet('contact') || IsGet('download') ) ? false : true );

$DownloadID  = IsGet('download') ? protect(Decrypt($_GET['download'])) : 0 ;
$info        = IsGet('download') ? Sql_Get_info($DownloadID) : array('status'=>false,'public'=>'0','user_id'=>@UserID);
$currentpage = 1 ;
$totalpages  = 1 ;
(function_exists('ini_set'))    ? @ini_set('memory_limit', '-1') : '';
/*----------------------------------*/
?>