<?php
require_once ('../includes/config.php');	
require_once ('../includes/session.php');	
require_once ('../includes/functions.php');
require_once ('../includes/connect.php');
require_once ('../includes/languages/'.LANG_FILE);
(!defined('Extensions_Html')) ? define('Extensions_Html' , ExtensionsHtml() ) : '' ;
(!defined('footerTxt'))       ? define('footerTxt',FooterInfo()) : '' ;
(!defined('StatsPanel'))      ? define('StatsPanel',StatsPanel('.'.folderupload)) : '' ;
$Public_user_id = (isGet('user')) ? (int)$_GET['user'] : UserID ;
header("Content-type: text/javascript; charset: UTF-8");
echo "
var IsLogin     = Boolean('".(bool)IsLogin."'),
    IsAdmin     = Boolean('".(bool)IsAdmin."'),
    IsClose     = Boolean('".(bool)(siteclose && !isGet('login'))."'),
	IsRtL       = Boolean('".(bool)IsRtL()."'),
	IsDirect    = Boolean('".(bool)directdownload."'),
	IsPlayMedia = Boolean('".(bool)PlayMedia."'),
	IsDeleteLink= Boolean('".(bool)deletelink."'),
	IsThumbnail = Boolean('".(bool)thumbnail."'),
	IsAnimated  = Boolean('".(bool)animated."'),
	IsOrgFilename = Boolean('".(bool)enable_orgFilename."'),
	IsOutputImage = Boolean('".(bool)OutputImage."'),
	IsStatsPanel  = Boolean('".(bool)StatsPanel."'),
	IsMultiple    = Boolean('".(bool)multiple."'),
	IsMultipleSelect = Boolean('".(bool)multipleSelect."'),
	IsGetEmpty  = Boolean('".(bool)GetIsEmpty."'),
	IsCaptcha   = Boolean('".(bool)EnableCaptcha."'),
	DirectoryChanged  = Boolean('".(bool)DirectoryChanged."'),
	UpdateBrowser  = Boolean('".(bool)UpdateBrowser."'),
	IsGetFiles     = Boolean('".(bool)(isGet('files'))."'),
	IsGetUser      = Boolean('".(bool)(isGet('user'))."'),
	IsGetProfile   = Boolean('".(bool)(isGet('profile'))."'),
	IsGetDownload  = Boolean('".(bool)(isGet('download'))."'),
	IsGetRegister  = Boolean('".(bool)(isGet('register'))."'),
	IsGetAbout     = Boolean('".(bool)(isGet('about'))."'),
	IsGetAuth      = Boolean('".(bool)(isGet('authorized'))."'),
	IsGetLogin     = Boolean('".(bool)(isGet('login'))."'),
	IsGetForgot    = Boolean('".(bool)(isGet('forgot'))."'),
	IsGetContact   = Boolean('".(bool)(isGet('contact'))."'),
	Extensions_Html = '".(defined('Extensions_Html') ? Extensions_Html : '')."',

	
	filetypes   = [ "."'".implode(explode(",",extensions),"','")."'"."],
	configSize  = parseInt('".(MaxFileSize /1024)."'),
	TimeLoading = parseInt('".Interval."'),
	maxUploads  = parseInt('".maxUploads."'),
	directionDiv= '".directionDiv2()."',
	DateLbl     = '".$lang[84]."',
	siteurl     = '".str_replace("/modals","",SERVER_HOST)."',
	_path_      = '".siteurl."',
	LoadingUrl  = '".siteurl.'/assets/css/images/ajax-loader.gif'."',
	SELF        = '".str_replace("modals/jsvariables.php","index.php",SELF)."',
	QUERY       = '".QUERY."',
	HashCode    = '".HashCode."',
	Language    = '".InterfaceLanguage."',
	Loading     = '".$lang[45]."',
	confirmMsg  = '".$lang[154]."',
	ErrorMsg    = '".$lang[14]."',
	PleaseWait  = '".$lang[102]."',
	ErrorSending= '".$lang[103]."',
	UploadingMsg= '".$lang[11]." ..',
	ChooseOMsg  = '".$lang[13]."',
	DragMsg     = '".$lang[7]."',
	DownloadWait= '".$lang[76]." <code id=".'"'.'time'.'"'.">5</code> ".$lang[77]."',
	uploadDir   = '".uploadDir.'/'."',
	ErrorHMsg   = '".$lang[17]."',
	UnableMsg   = '".$lang[15]."',
	UploadedMsg = '".$lang[16]."',
	ExtErrMsg   = '".$lang[120]."',
	FilesMsg    = '".$lang[109]."',
	ErrorSzMsg  = '".$lang[110]."', 
	ErrorAborted= '".$lang[233]."', 
	ExtensionsSt= '".extensions ."',
	FooterTxt   = '".footerTxt ."',
	UrlMsg      = '".$lang[18]."', 
	TitleClsMsg = '".$lang[64]."', 	
	UrlDeltMsg  = '".$lang[26]."', 
	UrlViewMsg  = '".$lang[164]."', 
	UrlthumMsg  = '".$lang[172]."', 
	DownLoadMsg = '".$lang[184]."', 
	ActionLabel = '".$lang[43]."',
	CopyLabel   = '".$lang[146]."', 
	UrlDrktMsg  = '".$lang[51]."',
	BrowserUpd  = '".$lang[163]."',
	UrlChanged  = '".$lang[195]."',
	RefLabel    = '".$lang[161]."',
	PassLabel   = '".$lang[37]."',
	queueLabel  = '".$lang[180]."',
	deleteLabel = '".$lang[32]."',
	Numberlbl   = '".$lang[157]."',
	_Yes        = '".$lang[104]."',
	_No         = '".$lang[156]."',
	PublicLbl   = '".$lang[176]."',
	PrivateLbl  = '".$lang[177]."',
	LblSuccessDeleted = '".$lang[197]."',
	Public_user_id    = '". $Public_user_id ."',
	WellColor   = '". (defined('WellColor') ? WellColor : 'ffffff') ."',
	BodyColor   = '". (defined('BodyColor') ? BodyColor : 'ffffff')."',
	FontColor   = '". (defined('FontColor') ? FontColor : '333333')."',
	_maxVisible = 10,	
	FilesTotal  = 0,
	LoadJsCheckbox = false,
	myChart     = null;
	
if (IsLogin) { 		
var currentpage = parseInt('".$currentpage."') ,
    totalpages  = parseInt('".$totalpages."') ,
	rowsperpage = parseInt('".rowsperpage."') ; 
} 

if(IsGetUser)
{
var totalpages  = parseInt('".$totalpages."') ;
}
";
unset($Public_user_id);
?>
