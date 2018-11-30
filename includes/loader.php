<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php 
UpdateVisitor();
define('IsArabicLang',($lang[0]=='ar') ? true : false )	;
if(isGet('reset'))
	(resetPassword($_GET['reset'])) ? exit(header('Location: ./?reset_ok')) : exit(header('Location: ./?reset_failed'));

	
(isGet('file')) ? forceDownload($_GET['file']) : '';
(isGet('view') && OutputImage) ? forceView($_GET['view']) : '' ;
(isGet('display_errors')) ? display_errors() : '';
if(!IsLogin)
	(defined('authorized') && authorized && empty($_GET)) ? exit(header('Location: ./?authorized')) : '';
	
if(isGet('delete'))
	(delete_file($_GET['id'],$_GET['delete'],'.')) ? exit(header('Location: ./?download=deleteFile&confirm')) : exit(header('Location: ./?download=deleteFile&notfound'));	
		
define('PageTitle'      , Get_Page_Title()) ; 
define('ContainerTitle' , get_main_title()) ; 
defined('days_older') ? delete_file_older_than( 0 , days_older , '.') : '';
?>