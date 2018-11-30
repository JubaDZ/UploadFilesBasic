<?php 
require_once ('./includes/config.php');
require_once ('./includes/session.php');
require_once ('./includes/functions.php');
require_once ('./includes/connect.php');
require_once ('./includes/languages/'.LANG_FILE);
require_once ('./includes/loader.php');
?>
<!DOCTYPE html>
<html lang="<?php echo InterfaceLanguage ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo PageTitle ?></title>
	<meta name="description" content="<?php echo description ?>">
	<meta name="keywords" content="<?php echo keywords ?>">
	<meta name="author" id="author" content="onexite">
	
	<meta name="twitter:title" content="<?php echo PageTitle ?>"/>
	<meta name="twitter:description" content="<?php echo description ?>"/>
	<meta name="twitter:image" content="/assets/css/images/screenshot.png"/>
	
	<meta property="og:title" content="<?php echo PageTitle ?>"/>
	<meta property="og:image" content="/assets/css/images/screenshot.png"/>
	<meta property="og:description" content="<?php echo description ?>"/>

    <link rel="icon" type="image/png" href="./assets/css/images/favicon.png" />
    <link href="./assets/css/themes/<?php echo theme ?>" rel="stylesheet" type="text/css">
    <link href="./assets/css/styles.min.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/fontello.min.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/sticky.min.css" rel="stylesheet" type="text/css" />
	<?php if((defined('animated')) && animated){ ?>    
	<link href="./assets/css/animate.min.css" rel="stylesheet" type="text/css">
	<?php } ?>
	<?php if(isGet('download') || isGet('files')){ ?>
	<link href="./assets/css/famfamfam-flags.min.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/platforms.min.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/bootstrap-checkbox.min.css" rel="stylesheet" type="text/css">
	<?php } ?>
	<?php if(GetIsEmpty){ ?>    
	<link href="./assets/css/bootstrap-toggle.min.css" rel="stylesheet" type="text/css">
	<?php } ?>
	<?php if(IsRtL()){ ?>    
	<link href="./assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css">
	<?php } ?>
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	
    <!--[if lt IE 9]>
	<script src="./assets/js/html5shiv.min.js" type="text/javascript"></script>
	<script src="./assets/js/respond.min.js" type="text/javascript"></script>
	<![endif]-->
	
	<!--[if IE]>
	  <link rel="shortcut icon" href="./assets/css/images/favicon.ico">
	<![endif]-->
	
	<!--<script src="./assets/js/excanvas.min.js" type="text/javascript"></script>-->
  </head>
  <body>
 <?php
isGet('404') ? exit(require_once ('./modals/404.php')) : '';
isGet('403') ? exit(require_once ('./modals/403.php')) : '';
 ?>

  <div class="se-pre-con loading-spin"></div>
  
<div class="container">	
  <?php require_once ('./modals/logo.php');?> 
 <div class="row">  

   <?php require_once ('./modals/navbar.php');?> 
   <?php require_once ('./modals/sidemenu.php');?> 

<div class="col-sm-9 col-md-9" id="container">	

<?php 
GetIsEmpty ? Get_Ads ('ads_index') : '';
isGet('download') ? Get_Ads ('ads_download') : '';
?>

  <div id="main" class="panel panel-default <?php echo ClassAnimated ?> bounceInDown">
 
  <div class="panel-heading">  <span id="MainTitle">
    <?php 
	  echo ContainerTitle; 
	?> 
	</span>
	</div>

<div class="panel-body" id="htmlcontainer">

<?php
/*
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
print '<pre style="text-align: left;direction: ltr; ">' . print_r(get_defined_vars(), true) . '</pre>';
*/
if(isGet('reset_ok') || isGet('reset_failed'))
	require_once ('./modals/reset.php');
elseif(isGet('download'))
	require_once ('./modals/download.php');
elseif(isGet('files'))
    ( IsLogin ) ? require_once ('./modals/files.php') : Need_Login() ;  
elseif(isGet('about'))
    require_once ('./modals/about.php');
elseif(isGet('profile'))	
    ( IsLogin ) ? require_once ('./modals/profile.php') : Need_Login() ;
elseif(isGet('authorized') ) 
    ( !IsLogin && authorized ) ? require_once ('./modals/authorization.php') : Need_Logout() ;  
elseif(isGet('login')) 
    ( !IsLogin  ) ? require_once ('./modals/login.php') : Need_Logout() ;
elseif(isGet('register') && IsLogin) 
    ( IsLogin) ? Need_Logout() : ''  ;  	
/*elseif(isGet('register') && IsLogin) 
    ( register) ? require_once ('./modals/register.php') : Need_Logout() ;   */
elseif(isGet('register') && !IsLogin) 
    ( register ) ? require_once ('./modals/register.php') : Registration_Disabled() ;  	
elseif(isGet('forgot') && access_forgot) 
    ( !IsLogin  ) ? require_once ('./modals/forgot.php') : Need_Logout() ;  
elseif(isGet('forgot')) 
    ( !access_forgot ) ? Not_Allowed_to_Access() : '' ; 	
elseif(isGet('contact') ) 	
	(access_contact) ? require_once ('./modals/contact.php') : Not_Allowed_to_Access();
elseif(isGet('plans') ) 	
	(access_plans) ? require_once ('./modals/plans.php') : Not_Allowed_to_Access();
/*elseif(isGet('view')) 
    (!OutputImage) ? Function_disabled() : '' ;*/
elseif(isGet('api')) 	
	(ApiStatus) ? require_once ('./modals/api.php') : Api_Disabled() ; 	
else
	require_once ('./modals/dropzone.php');

?>    
 
 </div>    <!-- htmlcontainer-->
		  		 	  
  </div>  <!--div main -->
<?php
  (GetIsEmpty && ApiStatus && TotalStats) ? require_once ('./modals/totalstats.php')  : '';
  (GetIsEmpty) ? require_once ('./modals/uploadresult.php')  : '';
  isGet('download') && EnableComments ? require_once ('./modals/comments.php') : '';
?>  


  </div><!-- id container -->  
 </div> <!--div row -->
</div> <!--div container -->

  <!-- Modals -->
<?php
((IsAdmin || ((defined('statistics')) && statistics) )  && (isGet('download') || isGet('files'))) ? require_once ('./modals/stats.php')  : '';
(isGet('files')) ? require_once ('./modals/fileinfo.php')  : '';
 echo defined('SuccessfullyDeleted') ? '<div id="topalert" style="display:none;">'.SuccessfullyDeleted.'</div>' : '';
(siteclose && ! isGet('login'))  ? require_once ('./modals/siteclose.php') : '';
(IsLogin)    ? require_once ('./modals/logout.php')    : '';
(GetIsEmpty) ? require_once ('./modals/links.php')     : '';
/*(GetIsEmpty) ? require_once ('./modals/upload.php')    : '';*/
?> 
 <!-- footer -->
<?php
 require_once ('./modals/footer.php');
?> 
<!-- JavaScript -->

    <script src="./modals/jsvariables.php<?php echo (defined('QUERY') && strlen(QUERY) > 0 )? '?'.QUERY:'' ?>" type="text/javascript"></script>
    <!--<script src="./assets/js/modernizr-2.6.2-respond-1.1.0.min.js" type="text/javascript"></script>-->
	<script src="./assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/js/bootstrap.min.js" type="text/javascript"></script> 
	<script src="./assets/js/sticky.min.js" type="text/javascript"></script>	
	<?php if(GetIsEmpty){ ?>
	<script src="./assets/js/simpleajaxuploader.min.js" type="text/javascript"></script>
	<script src="./assets/js/bootstrap-toggle.min.js" type="text/javascript"></script>
	<script src="./assets/js/countup.min.js" type="text/javascript"></script> 
	<?php } ?>
	
	<?php if(isGet('download') || isGet('files') || isGet('profile')){ ?>
	<script src="./assets/js/jquery.bootpag.min.js" type="text/javascript"></script>
	<script src="./assets/js/bootstrap-checkbox.min.js" type="text/javascript"></script>

   <?php if(!IsIeBrowser()){ ?>
   <script src="./assets/js/chart.min.js" type="text/javascript"></script> 
   <?php } ?>
	
	<?php } ?>
	<script src="./assets/js/bootbox.min.js" type="text/javascript"></script>
	<script src="./assets/js/bootstrap-show-password.min.js" type="text/javascript"></script>
	<script src="./assets/js/bootstrap-maxlength.min.js" type="text/javascript"></script>
	<script src="./assets/js/global.min.js" type="text/javascript"></script>
	<script src="./assets/js/functions.min.js" type="text/javascript"></script>
  </body>
</html>
<?php 
mysqliClose_freeVars() ;
foreach (array_keys(get_defined_vars()) as $var) 
	unset($$var);
unset($var);
?>