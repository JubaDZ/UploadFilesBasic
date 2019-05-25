<?php 
session_start();

(isset($_SERVER['HTTP_ACCEPT_ENCODING']) && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') && function_exists('ini_get') && (strtolower(ini_get('zlib.output_compression'))=='off')) ? ob_start("ob_gzhandler"): ob_start();

(!defined('IsLogin')) ?  define('IsLogin',(isset($_SESSION['login']['status']) && isset($_SESSION['login']['username']) && isset($_SESSION['login']['user_id']) ) ? (bool)$_SESSION['login']['status'] : false) : '';  
(!isset($_GET['api'])) ? define('UserID',(isset($_SESSION['login']['user_id'])) ? $_SESSION['login']['user_id'] : 0) : '';
 
(isset($_SESSION['login']['user_space_used']) && !defined('UserSpaceUsed') && !isset($_GET['api'])) ? define('UserSpaceUsed',$_SESSION['login']['user_space_used']): '';
//(isset($_SESSION['login']['folder_id']) && !defined('FolderUploadId') && !isset($_GET['api']) )   ? define('FolderUploadId',$_SESSION['login']['folder_id']) : '';
//(isset($_SESSION['settings']['default_folder_id']) && !isset($_SESSION['login']['folder_id']) && !isset($_GET['api']) ) ? define('FolderUploadId',$_SESSION['settings']['default_folder_id']) : '';
(isset($_SESSION['settings']['HashCode'])) ? define('HashCode',$_SESSION['settings']['HashCode']) : '';

(isset($_SESSION['settings']["visitor"]["ip"]))          ? define('VisitorIp',$_SESSION['settings']["visitor"]["ip"]) : '';
(isset($_SESSION['settings']["visitor"]["countryName"])) ? define('VisitorCountryName',$_SESSION['settings']["visitor"]["countryName"]) : '';
(isset($_SESSION['settings']["visitor"]["city"]))        ? define('VisitorCity',$_SESSION['settings']["visitor"]["city"]) : '';
(isset($_SESSION['settings']["visitor"]["countryCode"])) ? define('VisitorCountryCode',$_SESSION['settings']["visitor"]["countryCode"]) : '';

//(!defined('FolderUploadName') && !isset($_GET['api'])) ? define('FolderUploadName',(isset($_SESSION['login']['folder_name'])) ? $_SESSION['login']['folder_name'] : '') : '' ;	
 define('IsAdmin', (isset($_SESSION['login']['user_level']))          ? (bool)$_SESSION['login']['user_level'] : false) ;
 define('UserName', (isset($_SESSION['login']['username']))           ? $_SESSION['login']['username'] : '') ;
 define('LastVisit', (isset($_SESSION['login']['last_visit']))        ? $_SESSION['login']['last_visit'] : '') ;
 define('LastIp', (isset($_SESSION['login']['last_ip']))              ? $_SESSION['login']['last_ip'] : '') ;
 define('UserEmail',(isset($_SESSION['login']['user_email']))         ? $_SESSION['login']['user_email'] : '') ;
 define('RegisterDate',(isset($_SESSION['login']['register_date']))   ? $_SESSION['login']['register_date'] : '') ;
 define('Plan_Id', (isset($_SESSION['login']['plan_id']))             ? $_SESSION['login']['plan_id'] : 0);
 define('PlanId',(Plan_Id==0 && IsLogin) ? 3 : Plan_Id); 
	
?>