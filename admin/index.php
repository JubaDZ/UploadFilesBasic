<?php
define('IsAdminPage',true);
require_once ('../includes/config.php');
require_once ('../includes/session.php');	
require_once ('../includes/functions.php');
require_once ('../includes/connect.php');
CheckConnect();
require_once ('../includes/languages/'.LANG_FILE);

if (isGet('clearfilter')) 
{
	unset($_SESSION['login']['filter']);
	exit(header('Location: ./' ));	
}


// get the current page or set a default

$currentpage = (isGet('currentpage') && is_numeric($_GET['currentpage']))  ? (int) $_GET['currentpage'] : 1;

//print_r($_GET['files']);

$search_param = (isset($_SESSION['login']['filter']['search_param'])) ? $_SESSION['login']['filter']['search_param'] : '';
$order_file   = (isset($_SESSION['login']['filter']['order_file']))   ? $_SESSION['login']['filter']['order_file']   : '';	
$order_user   = (isset($_SESSION['login']['filter']['order_user']))   ? $_SESSION['login']['filter']['order_user']   : '';	
$order_comment= (isset($_SESSION['login']['filter']['order_comment']))? $_SESSION['login']['filter']['order_comment']: '';	
$order_report = (isset($_SESSION['login']['filter']['order_report'])) ? $_SESSION['login']['filter']['order_report'] : '';	
$order_folder = (isset($_SESSION['login']['filter']['order_folder'])) ? $_SESSION['login']['filter']['order_folder'] : '';	

define('AdminGetIsEmpty' , ( isGet('comments') || isGet('backup') || isGet('info') || isGet('users') || isGet('plans') || isGet('folders') ||  isGet('reports') || isGet('statistics') || isGet('update') || isGet('settings') || isGet('files') || isGet('publicity') ) ? false : true );

function TitleHeader()
{
	global $lang,$order_file,$order_user,$search_param,$order_report,$order_folder,$order_comment;
	

if(isGet('users')) 
		 $title= $lang[73];
     elseif(isGet('folders')) 
	     $title= $lang[74]; 
	 elseif(isGet('reports')) 
	     $title= $lang[101]; 
	 elseif(isGet('statistics')) 
	     $title= $lang[28]; 	
     elseif(isGet('update')) 
	     $title= $lang[133]; 
	 elseif(isGet('settings')) 
	     $title= $lang[29];  
	 elseif(isGet('files'))  
         $title= $lang[48]; 
	 elseif(isGet('publicity'))  
         $title= $lang[183]; 
	elseif(isGet('comments')) 
	     $title= $lang[240] ;	
	elseif(isGet('plans')) 
	     $title= $lang[230] ;
	elseif(isGet('backup')) 
	     $title= $lang[263] ;	
	elseif(isGet('info')) 
	     $title= $lang[105] ;
	 else 
		 $title= $lang[21]; 
	 

$TitleHeader = ( $search_param =='' && ( $order_folder == '`id` DESC' || empty($order_folder) )  && ( $order_comment == '`id` DESC' || empty($order_comment) ) && ( $order_file == '`id` DESC' || empty($order_file) ) && ( $order_user == '`id` DESC' || empty($order_user) ) && ($order_report == '`id` DESC' || empty($order_report) ) ) ? $title : $title .' / <a style="font-size: 14px;" href="?clearfilter">'.$lang[81].'</a>';

echo $TitleHeader;

/*
<ol class="breadcrumb">
  <li><a href="javascript:void(0)">Home</a></li>
  <li class="active">'.$TitleHeader.'</li>
</ol>
*/
}
	
	
(!IsLogin) ? exit(header('Location: ../' )):'';	
(!IsAdmin) ? exit(header('Location: ../?notadmin' )):'';	

/*-----------Charts---------*/

$disk_total_space =0;
$disk_free_space=0;

define('t_visitors'  ,Sql_Get_Visitors_Count() );
define('t_users'     ,Sql_Get_Users_Count() );
define('t_folders'   ,num_rows(Sql_query("SELECT * FROM `folders`")) );
define('t_reports'   ,num_rows(Sql_query("SELECT * FROM `reports`")) );
define('t_comments'  ,num_rows(Sql_query("SELECT * FROM `comments`")) );
define('t_statistics',num_rows(Sql_query("SELECT DISTINCT `file_id` FROM `stats`")) );
define('t_files'     ,num_rows(Sql_query("SELECT * FROM `files` $search_param")) );
define('t_size'      ,FileSizeConvert( Get_space_used() ) );
define('t_reports_o' ,num_rows(Sql_query("SELECT * FROM `reports` WHERE `status` = '0'")) );
define('t_comments_o',num_rows(Sql_query("SELECT * FROM `comments` WHERE `status` = '0'")) );
define('u_encrypt_url',Encrypt('https://raw.githubusercontent.com/onexite/SuUpdate/master/update.json'));
define('u_encrypt_author',Encrypt('<code>onexite</code>'));

if(isGet('users'))  
	$totalpages = ceil(t_users / rowsperpage);  
elseif(isGet('folders'))  
	$totalpages = ceil(t_folders/ rowsperpage) ;
elseif(isGet('reports'))  
	$totalpages = ceil(t_reports/ rowsperpage) ;
elseif(isGet('statistics'))  
	$totalpages = ceil(t_statistics/rowsperpage);   
elseif(isGet('files'))  
	$totalpages = ceil(t_files/ rowsperpage) ;
elseif(isGet('comments'))  
	$totalpages = ceil(t_comments/ rowsperpage) ;	
else 
    $totalpages = 1 ;	


$totalpages =  ($totalpages < 1) ? 1 : $totalpages;


/*
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
print '<pre style="text-align: left;direction: ltr; ">' . print_r(get_defined_vars(), true) . '</pre>';

*/
//echo "<script>alert('".ceil((count(array_filter(glob('../..'.folderupload.'/*'), 'is_dir')))/ rowsperpage) ."')</script>";
?>
<!DOCTYPE html>
<html lang="<?php echo InterfaceLanguage ?>">
<head>
  <title><?php echo $lang[47] ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="../assets/css/images/favicon.png"/>
  <link rel="stylesheet" type="text/css" href="../assets/css/themes/<?php echo theme ?>" id="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/styles.min.css">
  <!--<link href="../includes/styles.php" rel="stylesheet" type="text/css">-->
  <link rel="stylesheet" type="text/css" href="../assets/css/fontello.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-toggle.min.css">  
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-checkbox.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/mediaelementplayer.min.css">
  <?php if(isGet('statistics')){ ?>
  <link href="../assets/css/famfamfam-flags.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/platforms.min.css" rel="stylesheet" type="text/css">
  <?php } ?>
  
  <!--
  <?php if(!IsIeBrowser()){ ?>  
  <link rel="stylesheet" type="text/css" href="../assets/css/audioplayer.min.css">
  <?php }?>  
  -->
  
  <?php if(isGet('comments') || isGet('settings') || isGet('publicity') || isGet('plans') || isGet('users') || isGet('folders') || isGet('reports') ) { ?>  
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-tagsinput.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/summernote.min.css">
  <?php } ?>
  
  <?php if(animated){ ?>
  <link rel="stylesheet" type="text/css" href="../assets/css/animate.min.css">
  <?php } ?>
  
  <?php /*include_once ('../includes/styles.php');*/ ?> 

  <?php if(IsRtL()){ ?>
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-rtl.min.css"> 
  <?php } ?>
  <style>

    .navbar-default {
    border: 1px solid #ddd ;
	}
	
	.note-toolbar.panel-heading {
    background-color: #f5f5f5;
	border-color: #ddd;
	color:#777;
	}
  </style>
  
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
	
 <!--<script src="../assets/js/excanvas.min.js" type="text/javascript"></script>-->
 <!-- <script src="../assets/js/modernizr-2.6.2-respond-1.1.0.min.js" type="text/javascript"></script> -->
  <script src="../assets/js/jquery.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-checkbox.min.js" type="text/javascript"></script>
  <script src="../assets/js/jquery.bootpag.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootbox.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-show-password.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-maxlength.min.js" type="text/javascript"></script>
  <script src="../assets/js/mediaelement-and-player.min.js" type="text/javascript"></script>
  <script src="../assets/js/base64.min.js" type="text/javascript"></script>
  <!--
  <?php if(!IsIeBrowser()){ ?>  
  <script src="../assets/js/audioplayer.min.js" type="text/javascript"></script>
  <?php }?>  
  -->
  <script src="../assets/js/global.min.js" type="text/javascript"></script>
  <?php if(isGet('files') || isGet('reports') || isGet('statistics') ) { ?>  
  <script src="../assets/js/simpleajaxuploader.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-toggle.min.js" type="text/javascript"></script>
  <?php } ?>


  <?php if(AdminGetIsEmpty && (!IsIeBrowser())){ ?>  
  <script src="../assets/js/isocodeconverter.min.js" type="text/javascript"></script>
  <script src="../assets/js/d3.min.js" type="text/javascript"></script>
  <script src="../assets/js/topojson.min.js" type="text/javascript"></script>
  <script src="../assets/js/datamaps.world.min.js" type="text/javascript"></script>
  <script src="../assets/js/chart.min.js" type="text/javascript"></script> 
  <?php } ?>
  
   <?php if(AdminGetIsEmpty){ ?>
	<script src="../assets/js/countup.min.js" type="text/javascript"></script> 
  <?php } ?>
  
  <?php if(isGet('comments') || isGet('backup') ||isGet('settings') || isGet('publicity') || isGet('plans') || isGet('users') || isGet('folders') || isGet('reports')  ) { ?>  
  <script src="../assets/js/typeahead.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
  <script src="../assets/js/summernote.min.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap-select.min.js" type="text/javascript"></script>

  <?php if( InterfaceLanguage=='ar'){ ?>  
  <script src="../assets/js/i18n/defaults-ar_AR.js" type="text/javascript"></script>
  <script src="../assets/js/i18n/summernote-ar-AR.js" type="text/javascript"></script>
  <?php } } ?>
  
  
</head>
<body>
<div class="se-pre-con loading-spin"></div>
<div class="container">
    <div class="row">  
  
  <?php require_once ('../modals/navbar.php');?> 
  <?php require_once ('./modals/sidemenu.php');  ?>

        <div class="col-sm-9 col-md-9" id="container">	

            <div class="panel-group">
                <div class="panel panel-default">
                    <div id="Titleheader" class="panel-heading"><?php TitleHeader();?></div>
	                <div class="panel-body">
	

<?php
if(!IsAdmin)
	Not_Allowed_to_Access();
elseif(isGet('users')) 
	require_once ('./modals/users.php'); 
elseif(isGet('folders')) 
    require_once ('./modals/folders.php'); 
elseif(isGet('reports')) 
    require_once ('./modals/reports.php'); 
elseif(isGet('statistics')) 
	require_once ('./modals/statistics.php');  
elseif(isGet('update')) 
	require_once ('./modals/update.php');  
elseif(isGet('settings')) 
	require_once ('./modals/settings.php');  
elseif(isGet('backup')) 
	require_once ('./modals/backup.php'); 
elseif(isGet('info')) 
	require_once ('./modals/siteinfo.php');  	
elseif(isGet('files'))  
	require_once ('./modals/files.php');
elseif(isGet('publicity'))  
	require_once ('./modals/postedit.php');	
elseif(isGet('plans') ) 	
	require_once ('./modals/plans.php');
elseif(isGet('comments') ) 	
	require_once ('./modals/comments.php');			
else 
	require_once ('./modals/dashboard.php');

?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  
<?php 
/*require_once ('./modals/search.php');   */
require_once ('../modals/fileinfo.php');  
require_once ('../modals/logout.php');
require_once ('../modals/upload.php');  
require_once ('./modals/edituser.php');
(isGet('plans')) ? require_once ('./modals/editplan.php') : '';
require_once ('./modals/ipinfo.php');
require_once ('./modals/editfolder.php');
require_once ('./modals/script.php');  
?>
</body>
</html>
<?php 
mysqliClose_freeVars() ;
foreach (array_keys(get_defined_vars()) as $var) 
	        unset($$var);
unset($var);
?>