<?php
$supportedLangs  = array('ar','en','') ;

define('sitename','File Sharing and Storage'); // موقعي للرفع
define('rtlsitename','مشاركة وتخزين الملفات');
define('sitemail','');
define('time_zone','Africa/Algiers');
define('Interval','0');
define('siteclose','0');
define('language','');
define('closemsg','Closed for maintenance'); //الموقع مغلق للصيانة
define('register','1');
define('enable_userfolder','0');
define('folderupload','/uploads');
define('prefixname','file_');
define('maxsize','20M');
define('extensions','gif,jpg,jpeg,png,zip,rar,pdf,doc,docx,flv,3gp,wmv,mp4,mp3');
define('rowsperpage','10');
define('style','styles.css');	
define('scriptversion','0.9.6');	
define('authorized','0');	
define('terms','');	
define('privacy','');
define('directdownload','0');
define('statistics','1');
define('userspacemax','500M');
define('speed','0');
define('thumbnail','1');
define('days_older','30');
define('maxUploads','1');
define('multiple','1');
define('multipleSelect','1');
define('deletelink','1');
define('EnableComments','1');
define('EnableCaptcha','0');
define('animated','1');
define('enable_orgFilename','1');
define('banned_countries','Israel');
define('banned_ips','');
define('ApiStatus','1');
define('access_contact','1');
define('access_plans','1');
define('access_forgot','1');

//define('dbprefix','db_');
(!defined('dbhost')) ? define('dbhost','localhost'): '';
(!defined('dbuser')) ? define('dbuser','root'): '';
(!defined('dbpass')) ? define('dbpass',''): ''; 
(!defined('dbname')) ? define('dbname','db_uploads'): ''; 

define('keywords','online storage,free storage,cloud Storage,share Files,photo sharing,send large files');	
define('description','Free service that lets you put all your files.');	
?>