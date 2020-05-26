<?php
require_once ('../../includes/config.php');	
require_once ('../../includes/session.php');	
require_once ('../../includes/functions.php');
require_once ('../../includes/connect.php');
require_once ('../../includes/languages/'.LANG_FILE);
require_once ('../../includes/libraries/uploader.php'); //dirname(__FILE__) .
if(thumbnail)
require_once ('../../includes/libraries/thumbnail.php');

/* AJAX check  
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$data['error_msg'] = ($lang[99]);
	PrintArray($data) ;
}	
*/	

// get the current page or set a default

$currentpage = (isGet('currentpage') && is_numeric($_GET['currentpage']))  ? (int) $_GET['currentpage'] : 1;

(!isset($_SESSION['login'])) ? PrintArray(array('error_msg'=> '<'.$lang[98].'>')) : '';
(!IsLogin)                   ? PrintArray(array('error_msg'=> $lang[98])) : '';
(!IsAdmin)                   ? PrintArray(array('error_msg'=> $lang[100])) : '';
(!Mysqli_IsConnect)          ? PrintArray(array('error_msg'=> 'Mysqli '.$lang[179])) : '';



$html      ='';

//*********************************************		

if(isGet('updatefile'))
{
AJAX_check();	
/*
Copyright 2012-2016 LPology, LLC
*/	
	
(function_exists('ini_set'))    ? @ini_set('max_execution_time', 0) : '';
$extensions      = explode(",",extensions);
$Upload          = new FileUpload('uploadfile');

$_UploadFileName = protect($_GET['updatefile']);	
$orgfilename     = protect($Upload->getFileName());
$_new_ext        = strtolower(substr(strrchr($orgfilename,"."),1));	
$_old_ext        = strtolower(substr(strrchr($_UploadFileName,"."),1));
$_folder         = Get_folderName_By_FolderId(Get_folderId_by_Filename($_UploadFileName));
$passwordfile    = (isPost('passwordfile')) ? protect($_POST['passwordfile']) : '';
$code            = (isPost('code')) ? $_POST['code'] : '' ;
$ispublic        = (isPost('ispublic') && IsLogin ) ? (int)$_POST['ispublic'] : 1 ;
$ThumbnailDir    = (thumbnail) ? '../..'.uploadDir.'/_thumbnail/'.get_thumbnail($_UploadFileName) : ''; 

(defined('HashCode') && HashCode !== $code )            ? IePrintArray(array('success' => false, 'msg' => $lang[103].' / HashCode'  )) : '' ; 
($_new_ext !== $_old_ext)                               ? IePrintArray(array('success' => false, 'msg' => $lang[120] )) : '' ;  
//(!file_exists('../..'. $_folder .'/'.$_UploadFileName)) ? IePrintArray(array('success' => false, 'msg' => $lang[46] )) : '' ;   

//@unlink('../..'. uploadDir.'/'.$_UploadFileName);

$Upload->Language    = $lang;
$Upload->sizeLimit   = MaxFileSize;
$Upload->newFileName = $_UploadFileName;
$result              = $Upload->handleUpload('../..'.uploadDir, $extensions);
if(thumbnail)
	{
	 if (!file_exists('../..'.uploadDir.'/_thumbnail')) 
	 {
		 @mkdir('../..'.uploadDir.'/_thumbnail' , 0777, true);
		 WriteHtaccessThumbnailFolder('../..'.uploadDir.'/_thumbnail');
	 }
		 
	 (file_exists($ThumbnailDir)) ? unlink($ThumbnailDir) : '';
	 
	 $tg = new thumbnailGenerator;
	 $tg->generate('../..'.uploadDir.'/'.$Upload->getFileName(), 100, 100, $ThumbnailDir );
	}
	
	(function_exists('ini_set') && function_exists('ini_get')) ? @ini_set('max_execution_time', @ini_get('max_execution_time')) : '';
	(function_exists('ini_set') && function_exists('ini_get')) ? @ini_set('memory_limit', @ini_get('memory_limit')) : '';
	
if (!$result) 
    IePrintArray(array('success' => false, 'msg' => $Upload->getErrorMsg() )) ;   
 else 
 {
     Sql_Update_File($Upload->getFileName(),$Upload->getFileSize(),$passwordfile,$ispublic);
     IePrintArray(array('success' => true, 'FileName' => $Upload->getFileName() ,'Size' => $Upload->getFileSize() ,'SavedFile' => $Upload->getSavedFile() , 'Extension' => $Upload->getExtension() ) ) ;
	 //Clear cache and check filesize again
	 clearstatcache();
 }
}


//*********************************************	

	
if (isGet('folders'))
{	
    AJAX_check();
	/*
	$totalpages  = 0;
    $blacklist = array('.', '..');
	$dirs = array_filter(glob('../..'.folderupload.'/*'), 'is_dir');
	//print_r($dirs);
foreach($dirs as $x => $file) {
    		$totalpages ++;
			$_file_="'".$file."'";
			 if (!in_array($file, $blacklist)) 
            $html.= '<tr id="file_'.md5($file).'">
		             <td><input value="'.$file.'" type="checkbox" class="checkbox" name="folders[]" onclick="calcItems()" /></td>
		             <td><i class="icon-folder-empty"></i> '.$file.'</td>
		             <td>'.date("d/m/Y H:i:s", @filemtime($file)).'</td>
					 <td>'.FileSizeConvert(folderSize($file)).'</td>
					 <td><a href="javascript:void(0)" onclick="deleteFolder('.$_file_.','.$currentpage.')"  ><span class="glyphicon glyphicon-trash"></span></a> </td>
					 </tr>';
					 }
	
*/

if(isGet('order'))
{
	AJAX_check();
	$order = protect($_GET['order']);
	$order_str ="`$order` DESC";
	if(isset($_SESSION['login']['filter']['order_folder']))
		$order_str =($_SESSION['login']['filter']['order_folder']==$order_str) ? "`$order` ASC" : $order_str ;
		
	$_SESSION['login']['filter']['order_folder'] = $order_str;
}
else
	$order_str = isset($_SESSION['login']['filter']['order_folder']) ? $_SESSION['login']['filter']['order_folder'] : "`id` DESC";

// find out total pages
$total      =  num_rows(Sql_query("SELECT 1 FROM `folders`")) ;
$totalpages =  ceil($total/rowsperpage);    
$_folder_id_=  Get_folderId_By_UserId(0);

$currentpage = ($currentpage > $totalpages) ? $totalpages : $currentpage;
$currentpage = ($currentpage < 1) ? 1 : $currentpage;
$totalpages  = ($totalpages < 1) ? 1 :$totalpages;


$offset = ($currentpage - 1) * rowsperpage;

$sql="SELECT * FROM `folders` ORDER BY $order_str  LIMIT $offset, ".rowsperpage;


if ($result=Sql_query($sql))
  {// Fetch one and one row
  while($row = mysqli_fetch_assoc($result))
  {
	  if($row["id"]!==$_folder_id_){
          $_folder_ = "'../..".$row["folderName"]."'";
		  $html.= '<tr id="file_'.$row["id"].'">
				<td><input value="'.$row["id"].'" type="checkbox"  name="folders[]" class="checkbox" onclick="calcItems()" /></td>
		        <td><a href="javascript:void(0)" onclick="EditUserModal('.$row["userId"].',false)">'.Sql_Get_Username($row["userId"]).'</a></td>
				<td><i class="icon-folder-empty"></i><a href="javascript:void(0)" onclick="EditFolderInfoModal('.$row["id"].')">'.$row["folderName"].'</a></td>
			    <td>'.FileSizeConvert(folderSize('../..'.$row["folderName"])).'</td>
			    <td>'.date('Y-m-d H:i:s',$row["date_added"]).'</td>	
				<td><div id="Status_'.$row["id"].'">'.glyphiconIsPublic($row["isPublic"]).'</div></td>
                <td>
				 <a href="javascript:void(0)" onclick="deleteFolder('.$row["id"].','.$_folder_.','.$currentpage.')"><span class="glyphicon glyphicon-trash"></span></a> 
				 <a href="javascript:void(0)" onclick="EditFolderInfoModal('.$row["id"].')"><span class="glyphicon glyphicon-pencil"></span></a>
				 
				</td>
	  </tr>';}
  }
  }
 if($total == 0 || $total == 1)
	$html = '<tr><td colspan="7">'.$lang[111].'</td></tr>';

$data['success_msg'] = $html;
$data['totalpages'] = $totalpages ;
($result) ? mysqli_free_result($result) : '';
mysqli_close($connection);
PrintArray($data) ;

}
	
//*********************************************	

if (isGet('backup'))
{	

//AJAX_check();
   	$target_tables = getTables( ) ;
		
	//	print_r($target_tables);
	
	    foreach($target_tables as $table)
		     $html.=  '<tr>
			             <td>
						 
						  <input value="'.$table.'"type="checkbox" name="tables[]" onclick="calcItems()" class="checkbox">
						 </td>
						 <td>'.$table.'</td>
						</tr>';
			 
$data['success_msg'] = $html;
$data['totalpages'] = $totalpages ;
mysqli_close($connection);
PrintArray($data) ;	

}
//*********************************************	

	
if (isGet('settings'))
{	

AJAX_check();
$siteurl      = protect($_POST['siteurl']);
$sitemail     = protect($_POST['sitemail']);
$language     = protect($_POST['language']);
$time_zone    = protect($_POST['time_zone']);
$sitename     = protect($_POST['sitename']);
$rtlsitename  = protect($_POST['rtlsitename']);
$privacy      = $_POST['privacy'];	
$terms        = $_POST['terms'];
$theme        = protect($_POST['theme']).'.min.css';	


$BodyColor    = protect($_POST['BodyColor']);
$WellColor    = protect($_POST['WellColor']);
$FontColor    = protect($_POST['FontColor']);

if (isPost('siteclose'))
{
$siteclose = 1;	
$closemsg = ($_POST['closemsg']);
}
 else {
	 $siteclose = 0 ;
	 $closemsg = closemsg;
	 }
 



$register           = isPost('register') ?  1 : 0 ;
$authorized         = isPost('authorized') ?  1 : 0 ;
$directdownload     = isPost('directdownload') ?  1 : 0 ;
$enable_userfolder  = isPost('enable_userfolder') ?  1 : 0 ;
$statistics         = isPost('statistics') ?  1 : 0 ;
$thumbnail          = isPost('thumbnail') ?  1 : 0 ;
$multiple           = isPost('multiple') ?  1 : 0 ;
$multipleSelect     = isPost('multipleSelect') ?  1 : 0 ;  
$deletelink         = isPost('deletelink') ?  1 : 0 ;
$EnableComments     = isPost('EnableComments') ?  1 : 0 ;
$EnableCaptcha      = isPost('EnableCaptcha') ?  1 : 0 ;
$animated           = isPost('animated') ?  1 : 0 ;
$enable_orgFilename = isPost('enable_orgFilename') ?  1 : 0 ;

$PlayMedia          = isPost('PlayMedia') ?  1 : 0 ;
$ApiStatus          = isPost('ApiStatus') ?  1 : 0 ;
$access_contact     = isPost('access_contact') ?  1 : 0 ;
$access_plans       = isPost('access_plans') ?  1 : 0 ;
$access_forgot      = isPost('access_forgot') ?  1 : 0 ;
$showUserfiles      = isPost('showUserfiles') ?  1 : 0 ;

$folderupload       = protect($_POST['folderupload']);
$prefixname         = protect($_POST['prefixname']);
$extensions         = protect($_POST['extensions']);
$rowsperpage        = protect($_POST['rowsperpage']);



$banned_countries   = protect($_POST['banned_countries']);
$banned_ips         = protect($_POST['banned_ips']);

$Interval           =(int)$_POST['Interval'];
$days_older         =(int)$_POST['days_older'];
$maxUploads         =(int)$_POST['maxUploads'];

$maxsize = ($_POST['maxsize']!=='') ? protect($_POST['maxsize'].$_POST['format_maxsize']) : '';
$userspacemax = ($_POST['userspacemax']!=='') ? protect($_POST['userspacemax'].$_POST['format_userspacemax']) : '';
$speed = ($_POST['speed']!=='') ? protect($_POST['speed'].$_POST['format_speed']) : '';

/*SELECT 1 FROM `settings` WHERE `name` = 'language';*/
Sql_query("UPDATE `settings` SET `value` = '$Interval' WHERE `name` = 'Interval';");
Sql_query("UPDATE `settings` SET `value` = '$sitename' WHERE `name` = 'sitename';");
Sql_query("UPDATE `settings` SET `value` = '$siteurl' WHERE `name` = 'siteurl';");
Sql_query("UPDATE `settings` SET `value` = '$sitemail' WHERE `name` = 'sitemail';");
Sql_query("UPDATE `settings` SET `value` = '$language' WHERE `name` = 'language';");
Sql_query("UPDATE `settings` SET `value` = '$time_zone' WHERE `name` = 'time_zone';");
Sql_query("UPDATE `settings` SET `value` = '$siteclose' WHERE `name` = 'siteclose';");
Sql_query("UPDATE `settings` SET `value` = '$closemsg' WHERE `name` = 'closemsg';");
Sql_query("UPDATE `settings` SET `value` = '$register' WHERE `name` = 'register';");
Sql_query("UPDATE `settings` SET `value` = '$enable_userfolder' WHERE `name` = 'enable_userfolder';");
Sql_query("UPDATE `settings` SET `value` = '$folderupload' WHERE `name` = 'folderupload';");
Sql_query("UPDATE `settings` SET `value` = '$prefixname' WHERE `name` = 'prefixname';");
Sql_query("UPDATE `settings` SET `value` = '$maxsize' WHERE `name` = 'maxsize';");
Sql_query("UPDATE `settings` SET `value` = '$extensions' WHERE `name` = 'extensions';");
Sql_query("UPDATE `settings` SET `value` = '$rowsperpage' WHERE `name` = 'rowsperpage';");
Sql_query("UPDATE `settings` SET `value` = '$rtlsitename' WHERE `name` = 'rtlsitename';"); 
Sql_query("UPDATE `settings` SET `value` = '$authorized' WHERE `name` = 'authorized';"); 
Sql_query("UPDATE `settings` SET `value` = '$terms' WHERE `name` = 'terms';"); 
Sql_query("UPDATE `settings` SET `value` = '$privacy' WHERE `name` = 'privacy';"); 
Sql_query("UPDATE `settings` SET `value` = '$directdownload' WHERE `name` = 'directdownload';"); 
Sql_query("UPDATE `settings` SET `value` = '$statistics' WHERE `name` = 'statistics';"); 
Sql_query("UPDATE `settings` SET `value` = '$userspacemax' WHERE `name` = 'userspacemax';"); 
Sql_query("UPDATE `settings` SET `value` = '$thumbnail' WHERE `name` = 'thumbnail';");

Sql_query("UPDATE `settings` SET `value` = '$banned_ips' WHERE `name` = 'banned_ips';"); 
Sql_query("UPDATE `settings` SET `value` = '$banned_countries' WHERE `name` = 'banned_countries';");

/* 
Sql_query("UPDATE `settings` SET `value` = '$BodyColor' WHERE `name` = 'BodyColor';"); 
Sql_query("UPDATE `settings` SET `value` = '$PanelColor' WHERE `name` = 'PanelColor';"); 
Sql_query("UPDATE `settings` SET `value` = '$CodeColor' WHERE `name` = 'CodeColor';"); 
*/

Sql_query("UPDATE `settings` SET `value` = '$BodyColor' WHERE `name` = 'BodyColor';"); 
Sql_query("UPDATE `settings` SET `value` = '$WellColor' WHERE `name` = 'WellColor';"); 
Sql_query("UPDATE `settings` SET `value` = '$FontColor' WHERE `name` = 'FontColor';"); 

Sql_query("UPDATE `settings` SET `value` = '$speed' WHERE `name` = 'speed';"); 
Sql_query("UPDATE `settings` SET `value` = '$days_older' WHERE `name` = 'days_older';"); 
Sql_query("UPDATE `settings` SET `value` = '$maxUploads' WHERE `name` = 'maxUploads';"); 
Sql_query("UPDATE `settings` SET `value` = '$multiple' WHERE `name` = 'multiple';"); 
Sql_query("UPDATE `settings` SET `value` = '$multipleSelect' WHERE `name` = 'multipleSelect';"); 
Sql_query("UPDATE `settings` SET `value` = '$deletelink' WHERE `name` = 'deletelink';"); 
Sql_query("UPDATE `settings` SET `value` = '$theme' WHERE `name` = 'theme';");
Sql_query("UPDATE `settings` SET `value` = '$EnableComments' WHERE `name` = 'EnableComments';"); 
Sql_query("UPDATE `settings` SET `value` = '$EnableCaptcha' WHERE `name` = 'EnableCaptcha';"); 
Sql_query("UPDATE `settings` SET `value` = '$animated' WHERE `name` = 'animated';");
Sql_query("UPDATE `settings` SET `value` = '$enable_orgFilename' WHERE `name` = 'enable_orgFilename';");

Sql_query("UPDATE `settings` SET `value` = '$PlayMedia' WHERE `name` = 'PlayMedia';"); 
Sql_query("UPDATE `settings` SET `value` = '$ApiStatus' WHERE `name` = 'ApiStatus';"); 
Sql_query("UPDATE `settings` SET `value` = '$access_contact' WHERE `name` = 'access_contact';"); 
Sql_query("UPDATE `settings` SET `value` = '$access_plans' WHERE `name` = 'access_plans';"); 
Sql_query("UPDATE `settings` SET `value` = '$access_forgot' WHERE `name` = 'access_forgot';"); 
Sql_query("UPDATE `settings` SET `value` = '$showUserfiles' WHERE `name` = 'showUserfiles';"); 

Sql_query("UPDATE `folders` SET `folderName` = '$folderupload', `date_added` = '".timestamp()."' WHERE `id` = '".(int)Get_folderId_By_UserId(0)."';");
//Sql_query("UPDATE `settings` SET `value` = '12/10/2016' WHERE `name` = 'installdate';");
if (!file_exists('../..'.$folderupload )) 
	@mkdir('../..'.$folderupload , 0777, true);

WriteHtaccessUploadFolder('../..'.$folderupload,!$directdownload);
//Loadconfig();
PrintArray(array('success_msg' => $lang[178]));

	
}	
	
//*********************************************	
if (isGet('stats'))
{
	$nb_total         = num_rows(Sql_query("SELECT 1 FROM `stats`")) ;
	$nb_total         = ($nb_total==0) ? 1 : $nb_total;
	
	$dates            = '';
	$uploads          = '';
	$countries   = '';
	$extensions  = '';
	//$extensions   = explode(",",extensions);
	$chart_dates_labels      = array();
	$chart_dates_data        = array();

	$chart_countries_labels  = array();
	$chart_countries_data    = array();

	$chart_uploads_labels    = array();
	$chart_uploads_data      = array();

	$chart_extensions_labels = array();
	$chart_extensions_data   = array();
	
	 
	$result = Sql_query("SELECT SUBSTRING_INDEX(`filename`,'.',-1) as `_extensions_` , count(`filename`) as `_count_` FROM `files` GROUP BY `_extensions_` ORDER BY `_count_` DESC ,`_extensions_` DESC LIMIT 15");
	while ($data = mysqli_fetch_array($result))
	{
		$chart_extensions_labels[] = strtoupper($data['_extensions_']);
		$chart_extensions_data[]   = $data['_count_']; 
		$extensions.='<tr><td>'.$data['_extensions_'].'</td> <td><code>'.$data['_count_'].'</code></td><td>'.percent($data['_count_']/$nb_total).'</td></tr>'; 
	}
	
	
	$result = Sql_query("SELECT distinct(`country_code`) as `_country_code_` , count(`country_code`) as `_count_` FROM `stats` GROUP BY `_country_code_` ORDER BY `_count_` DESC ,`_country_code_` DESC LIMIT 15");
	while ($data = mysqli_fetch_array($result))
	{
		$chart_countries_labels[] = $data['_country_code_'];
		$chart_countries_data[]   = $data['_count_']; 
		$countries.='<tr><td>'.$data['_country_code_'].'</td> <td><code>'.$data['_count_'].'</code></td><td>'.percent($data['_count_']/$nb_total).'</td></tr>'; 
	}
	
	$result = Sql_query("SELECT distinct(FROM_UNIXTIME(`date`,'%Y-%m-%d')) as `_date_` , count(FROM_UNIXTIME(`date`,'%Y-%m-%d')) as `_count_` FROM `stats` GROUP BY `_date_` ORDER BY `date` DESC LIMIT 15");
	while ($data = mysqli_fetch_array($result))
	{
		$chart_dates_labels[] = $data['_date_'];
		$chart_dates_data[]   = $data['_count_']; 
		$dates.='<tr><td>'.$data['_date_'].'</td> <td><code>'.$data['_count_'].'</code></td><td>'.percent($data['_count_']/$nb_total).'</td></tr>'; 
	}
	
	$result = Sql_query("SELECT distinct(FROM_UNIXTIME(`uploadedDate`,'%Y-%m-%d')) as `_date_` , count(FROM_UNIXTIME(`uploadedDate`,'%Y-%m-%d')) as `_count_` FROM `files` GROUP BY `_date_` ORDER BY `uploadedDate` DESC LIMIT 15");
	while ($data = mysqli_fetch_array($result))
	{
		$chart_uploads_labels[] = $data['_date_'];
		$chart_uploads_data[]   = $data['_count_']; 
		$uploads.='<tr><td>'.$data['_date_'].'</td> <td><code>'.$data['_count_'].'</code></td><td>'.percent($data['_count_']/$nb_total).'</td></tr>'; 	
	}
	
$disk_free_space = function_exists('disk_free_space') ? round(@disk_free_space("/") / pow(1024,2), 2) : 0 ;
$disk_total_space = function_exists('disk_total_space') ? round(@disk_total_space("/") / pow(1024,2), 2) : 0 ;	
	
	/*------------------------------------------------------------*/
$data['uploads']     = array('labels' => $chart_uploads_labels     , 'data'  => $chart_uploads_data     ,'table' => $uploads );
$data['dates']       = array('labels' => $chart_dates_labels       , 'data'  => $chart_dates_data       ,'table' => $dates   );
$data['extensions']  = array('labels' => $chart_extensions_labels  , 'data'  => $chart_extensions_data  ,'table' => $extensions );
$data['countries']   = array('labels' => $chart_countries_labels   , 'data'  => $chart_countries_data   ,'table' => $countries );
$data['disk_space']  = array('free'   => $disk_free_space          , 'total' => $disk_total_space    );

/*------------------------------------------------------------*/
$data['status'] = true;

($result) ? mysqli_free_result($result) : '';
mysqli_close($connection);
PrintArray($data);
	    
}		
	
	
	
/******************************************************************/
	
if (isGet('statistics'))
{	


if(isGet('order'))
{
	AJAX_check();
	$order = protect($_GET['order']);
	$order_str ="`$order` DESC";
	if(isset($_SESSION['login']['filter']['order_stat']))
		$order_str =($_SESSION['login']['filter']['order_stat']==$order_str) ? "`$order` ASC" : $order_str ;

	$_SESSION['login']['filter']['order_stat'] = $order_str;
}
else
	$order_str = isset($_SESSION['login']['filter']['order_stat']) ? $_SESSION['login']['filter']['order_stat'] : "`id` DESC";

// find out total pages
$total      =  num_rows(Sql_query("SELECT DISTINCT `file_id` FROM `stats`")) ;
$totalpages =  ceil($total/rowsperpage);    

$currentpage = ($currentpage > $totalpages) ? $totalpages : $currentpage;
$currentpage = ($currentpage < 1) ? 1 : $currentpage;
$totalpages  = ($totalpages < 1) ? 1 :$totalpages;

$offset = ($currentpage - 1) * rowsperpage;

if ($result=Sql_query("SELECT DISTINCT `file_id` FROM `stats` ORDER BY $order_str  LIMIT $offset, ".rowsperpage))
  while($row = mysqli_fetch_assoc($result))
  {
	 $file_name  = (enable_orgFilename) ? Sql_Get_originalFilename($row["file_id"]) : Sql_Get_Filename($row["file_id"]);
	 $_filename_ = "'".$file_name."'";
	 $file_id    = $row["file_id"];
	 $_crypt_id  = "'".Encrypt($file_id)."'";
	 
		   $html.= '<tr id="file_'.$file_id.'">
		        <td></span><input value="'.$row["file_id"].'" type="checkbox"  name="stats[]" class="checkbox" onclick="calcItems()" /></td>
				<td class="cell-collapse"><a href="javascript:void(0)" onclick="ShowFileInfoModal('.$file_id.','.$_crypt_id.',1)">'.icon($file_name).' '.$file_name.'</a></td>  
				<td><table id="statsTable" class="table table-striped">';
		if ($_result=Sql_query("SELECT * FROM `stats` WHERE `file_id`='$file_id' LIMIT 15")) /*LIMIT $offset, ".rowsperpage*/
  while($_row = mysqli_fetch_assoc($_result))
  {
		  $html.= '<tr class="small">
				<td><i class="famfamfam-flag-'.strtolower($_row['country_code']).'"></i> '.GetCountryName($_row["country_code"]).'</td>
				<td><i class="platforms platforms-'.strtolower($_row['browser']).'"></i> '.$_row["browser"].'</td>
				<td><i class="platforms platforms-'.strtolower($_row['platform']).'"></i> '.$_row["platform"].'</td>
				<td><a href="'.$_row["referrer"].'" target="_blank" >'.GetUrlHost($_row["referrer"]).'</a></td> 
				<!--<td><a href="javascript:void(0)" onclick="ShowIpInfos('."'".longtoip($_row["ip"])."'".')">'.longtoip($_row["ip"]).'</a></td>-->
				<td class="small">'.date('Y-m-d H:i:s',$_row["date"]).'</td>
				</tr>';
  }		
			
	
				
		  $html.='</table></td>
			
				
               <!-- <td>
				 <a href="javascript:void(0)" onclick="deleteStat('.$row["file_id"].','.$currentpage.','.$_filename_.')"><span class="glyphicon glyphicon-trash"></span></a> 				 
				</td>-->
				</tr>';
  }

if($total==0)
	$html = '<tr><td colspan="7">'.$lang[111].'</td></tr>';

$data['success_msg'] = $html;
$data['totalpages'] = $totalpages ;
($result) ? mysqli_free_result($result) : '';
mysqli_close($connection);
PrintArray($data) ;

}


if (isGet('reports')){	
 
if(isGet('order'))
{
	AJAX_check();
	$order = protect($_GET['order']);
	$order_str ="`$order` DESC";
	if(isset($_SESSION['login']['filter']['order_report']))
		$order_str =($_SESSION['login']['filter']['order_report']==$order_str) ? "`$order` ASC" : $order_str ;

	$_SESSION['login']['filter']['order_report'] = $order_str;
}
else
	$order_str = isset($_SESSION['login']['filter']['order_report']) ? $_SESSION['login']['filter']['order_report'] : "`id` DESC";

// find out total pages
$total      =  num_rows(Sql_query("SELECT 1 FROM `reports`")) ;
$totalpages =  ceil($total/rowsperpage);    

$currentpage = ($currentpage > $totalpages) ? $totalpages : $currentpage;
$currentpage = ($currentpage < 1) ? 1 : $currentpage;
$totalpages  = ($totalpages < 1) ? 1 :$totalpages;

$offset = ($currentpage - 1) * rowsperpage;

$sql="SELECT * FROM `reports` ORDER BY $order_str  LIMIT $offset, ".rowsperpage;


if ($result=Sql_query($sql))
  {// Fetch one and one row
  while($row = mysqli_fetch_assoc($result))
  { 
     $file_id    = $row["file_id"];
	 $file_name  = (enable_orgFilename) ? Sql_Get_originalFilename($row["file_id"]) : Sql_Get_Filename($row["file_id"]);
	 $_filename_ = "'".$file_name."'";
	 $_crypt_id  = "'".Encrypt($file_id)."'";
	 
		  $html.= ($row["status"]) ? '<tr id="file_'.$row["id"].'">' : '<tr id="file_'.$row["id"].'" class="active">';
		  $html.=
			   '<td><input value="'.$row["id"].'" type="checkbox"  name="reports[]" class="checkbox" onclick="calcItems()" /></td>
		        <td><a href="javascript:void(0)" onclick="EditUserModal('.$row["user_id"].',false)">'.Sql_Get_Username($row["user_id"]).'</a></td>
				<td><a href="javascript:void(0)" onclick="ShowFileInfoModal('.$file_id.','.$_crypt_id.',1)">'.icon($file_name).' '.$file_name.'</a></td>
				<td>'.getReason($row["reason"]).'</td>
				<td>'.date('Y-m-d H:i:s',$row["date"]).'</td>
				<td><div id="Status_'.$row["id"].'">'.glyphiconOK($row["status"]).'</div></td>
				<td><a href="javascript:void(0)" onclick="ShowIpInfos('."'".longtoip($row["ip"])."'".')">'.longtoip($row["ip"]).'</a></td>
                <td>
				 <a href="javascript:void(0)" onclick="deleteReport('.$row["id"].','.$currentpage.','.$_filename_.')"><span class="glyphicon glyphicon-trash"></span></a> 
				 <a href="javascript:void(0)" onclick="acceptReport('.$row["id"].','.$currentpage.')"><span class="glyphicon glyphicon-ok"></span></a>
				 
				</td>
				</tr>';
  }
  }
 if($total==0)
	$html = '<tr><td colspan="8">'.$lang[111].'</td></tr>';

$data['success_msg'] = $html;
$data['totalpages'] = $totalpages ;
($result) ? mysqli_free_result($result) : '';
mysqli_close($connection);
PrintArray($data) ;
}

//*********************************************	
if (isGet('plans')){	 

$translate = translate();
$result = Sql_query("SELECT * FROM `plans`");
//foreach($languages as $lang)
if($result)
while($row = mysqli_fetch_assoc($result))
{
		if($row['name']=='extensions')
	{
	   $html.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td><code>'.count(explode( ',', $row["free"] )).'</code></td>
				<td><code>'.count(explode( ',', $row["register"] )).'</code></td>
				<td><code>'.count(explode( ',', $row["premium"] )).'</code></td>
				<td><code>'.count(explode( ',', $row["gold"] )).'</code></td>
				</tr>';
				continue;	
	}
	
	   $html.= '<tr>
		        <td>'.$translate[$row['name']].'</td>
				<td>'.IntToIcon($row["free"]).'</td>
				<td>'.IntToIcon($row["register"]).'</td>
				<td>'.IntToIcon($row["premium"]).'</td>
				<td>'.IntToIcon($row["gold"]).'</td>
				</tr>';

}
       $html.= '<tr>
                <td class="active"></td>
		        <td><a href="javascript:void(0)" onclick="EditPlanModal('."'free'".')"><i class="icon-edit"></i></a></td>
				<td><a href="javascript:void(0)" onclick="EditPlanModal('."'register'".')"><i class="icon-edit"></i></a></td>
				<td><a href="javascript:void(0)" onclick="EditPlanModal('."'premium'".')"><i class="icon-edit"></i></a></td>
				<td><a href="javascript:void(0)" onclick="EditPlanModal('."'gold'".')"><i class="icon-edit"></i></a></td>
				</tr>';
				
$data['success_msg'] = $html;
$data['totalpages'] = 1 ;
($result) ? mysqli_free_result($result) : '';
mysqli_close($connection);
PrintArray($data) ;
}	
//*********************************************	
if(isGet('commentstatus'))
{
AJAX_check();	
$comment_id = (int)$_GET['commentstatus'];
$status = !Get_comment_status($comment_id);
Sql_query("UPDATE `comments` SET `status` = '$status' WHERE `id` = '$comment_id'");  
(!affected_rows()) ? PrintArray(array('icon' => '<i class="glyphicon glyphicon-alert text-muted"></i>')) : '';
PrintArray(array('icon' => glyphiconOK($status,true) ));
}	
//*********************************************	
if (isGet('comments')){	 

if(isGet('order'))
{
	AJAX_check();
	$order = protect($_GET['order']);
	$order_str ="`$order` DESC";
	if(isset($_SESSION['login']['filter']['order_user']))
		$order_str =($_SESSION['login']['filter']['order_comment']==$order_str) ? "`$order` ASC" : $order_str ;
	
	$_SESSION['login']['filter']['order_comment'] = $order_str;
}
else
	$order_str = isset($_SESSION['login']['filter']['order_comment']) ? $_SESSION['login']['filter']['order_comment'] : "`id` DESC";

// find out total pages
$total      =  Sql_Get_Comments_Count() ;
$totalpages =  ceil($total/rowsperpage);    

$currentpage = ($currentpage > $totalpages) ? $totalpages : $currentpage;
$currentpage = ($currentpage < 1) ? 1 : $currentpage;
$totalpages  = ($totalpages < 1) ? 1 :$totalpages;

$offset = ($currentpage - 1) * rowsperpage;

$sql="SELECT * FROM `comments` ORDER BY $order_str  LIMIT $offset, ".rowsperpage;


if ($result=Sql_query($sql))
  {// Fetch one and one row
  while($row = mysqli_fetch_assoc($result))
  {
	$file_name  = (enable_orgFilename) ? Sql_Get_originalFilename($row["file_id"]) : Sql_Get_Filename($row["file_id"]);
	$file_id    = $row["file_id"];
	$_crypt_id  = "'".Encrypt($file_id)."'";
	$_comment_= "'".$row["comment"]."'";
		  $html.= '<tr id="file_'.$row["id"].'">
		  	    <td><input value="'.$row["id"].'" type="checkbox"  name="comments[]" class="checkbox" onclick="calcItems()" /></td>
		        <td><a href="javascript:void(0)" onclick="EditUserModal('.$row["user_id"].',false)"><i class="icon-user"></i> '.Sql_Get_Username($row["user_id"]).'</a></td>
				<td class="cell-collapse"><a href="javascript:void(0)" onclick="ShowFileInfoModal('.$file_id.','.$_crypt_id.',1)">'.icon($file_name).' '.$file_name.'</a></td>
				
				<td>'.date('Y-m-d H:i:s',$row["date"]).'</td>
				<td class="comment">'.($row["comment"]).'</td>
				<td>
				  <a href="javascript:void(0)" onclick="deleteComment('.$row["id"].','.$currentpage.','.$_comment_.')"><span class="glyphicon glyphicon-trash"></span></a> 
				  <a id="Status_'.$row["id"].'" href="javascript:void(0)" onclick="CommentStatus('.$row["id"].')">'.glyphiconOK($row["status"],true).'</a>
				</td>
				
				</tr>';
  }
  }
 if($total==0)
	$html = '<tr><td colspan="6">'.$lang[111].'</td></tr>';

$data['success_msg'] = $html;
$data['totalpages'] = $totalpages ;
($result) ? mysqli_free_result($result) : '';
mysqli_close($connection);
PrintArray($data) ;
}

//*********************************************
	
if (isGet('users')){	 

if(isGet('order'))
{
	AJAX_check();
	$order = protect($_GET['order']);
	$order_str ="`$order` DESC";
	if(isset($_SESSION['login']['filter']['order_user']))
		$order_str =($_SESSION['login']['filter']['order_user']==$order_str) ? "`$order` ASC" : $order_str ;
	
	$_SESSION['login']['filter']['order_user'] = $order_str;
}
else
	$order_str = isset($_SESSION['login']['filter']['order_user']) ? $_SESSION['login']['filter']['order_user'] : "`id` DESC";

// find out total pages
$total      =  Sql_Get_Users_Count() ;
$totalpages =  ceil($total/rowsperpage);    

$currentpage = ($currentpage > $totalpages) ? $totalpages : $currentpage;
$currentpage = ($currentpage < 1) ? 1 : $currentpage;
$totalpages  = ($totalpages < 1) ? 1 :$totalpages;

$offset = ($currentpage - 1) * rowsperpage;

$sql="SELECT * FROM `users` ORDER BY $order_str  LIMIT $offset, ".rowsperpage;


if ($result=Sql_query($sql))
  {// Fetch one and one row
  while($row = mysqli_fetch_assoc($result))
  {
	$_username_ = "'".$row["username"]."'";
	$htmlStatus = (($row["status"]=='2') ) ? ' class="active" ' : '' ;
		  $html.= '<tr '.$htmlStatus.' id="file_'.$row["id"].'">
		  	    <td><input value="'.$row["id"].'" type="checkbox"  name="users[]" class="checkbox" onclick="calcItems()" /></td>
		        <td><a href="javascript:void(0)" onclick="EditUserModal('.$row["id"].',false)"><i class="icon-user"></i> '.$row["username"].'</a></td>
				<td>'.user_level($row["level"]).'</td>
				<td>'.user_plan($row["plan_id"]).'</td>
				<td>'.$row["email"].'</td>
				<td>'.date('Y-m-d H:i:s',$row["last_visit"]).'</td>
				<td>'.Sql_Get_Files_user_Count($row["id"]).'</td>
				<td>
				  <a href="javascript:void(0)" onclick="deleteUser('.$row["id"].','.$currentpage.','.$_username_.')"><span class="glyphicon glyphicon-trash"></span></a> 
				  <a href="javascript:void(0)" onclick="EditUserModal('.$row["id"].')"><span class="glyphicon glyphicon-pencil"></span></a>
				</td>
				
				</tr>';
  }
  }
 if($total==0)
	$html = '<tr><td colspan="8">'.$lang[111].'</td></tr>';

$data['success_msg'] = $html;
$data['totalpages'] = $totalpages ;
($result) ? mysqli_free_result($result) : '';
mysqli_close($connection);
PrintArray($data) ;
}

//*********************************************
if (isGet('files') || isGet('search')){	 


if(isGet('order'))
{
	AJAX_check();
	$order = protect($_GET['order']);
	$order_str ="`$order` DESC";
	if(isset($_SESSION['login']['filter']['order_file']))
		$order_str =($_SESSION['login']['filter']['order_file']==$order_str) ? "`$order` ASC" : $order_str ;
	
	$_SESSION['login']['filter']['order_file'] = $order_str;
}
else
	$order_str = isset($_SESSION['login']['filter']['order_file']) ? $_SESSION['login']['filter']['order_file'] : "`id` DESC";



if(isGet('search'))
{
AJAX_check();	
$search_param = protect($_POST['search_param']);
$q            = protect($_POST['q']);

   if($search_param=='username')
   {
	   $q=Sql_Get_Username_id($_POST['q']);
	   $q=($q=='') ? '-1' : $q;
	   $search_param=" WHERE `userId` =  '$q'";	
	}
	elseif($search_param=='folderId')
	{
		$q=Get_FolderId_By_folderName($_POST['q']);
		$search_param=" WHERE `folderId` =  '$q'";	
	}
    else
		$search_param=" WHERE `$search_param` LIKE '%$q%'";
	
$_SESSION['login']['filter']['search_param'] = $search_param;

} 
else
{
	$search_param = isset($_SESSION['login']['filter']['search_param']) ? $_SESSION['login']['filter']['search_param'] : "";
}

// find out total pages
$total = num_rows(Sql_query("SELECT * FROM `files` $search_param"));
//echo "SELECT * FROM `files` $search_param";
$totalpages =  ceil( $total / rowsperpage);

$currentpage = ($currentpage > $totalpages) ? $totalpages : $currentpage;
$currentpage = ($currentpage < 1) ? 1 : $currentpage;
$totalpages  = ($totalpages < 1) ? 1 :$totalpages;
$count       = 0;
$offset = ($currentpage - 1) * rowsperpage;

$sql="SELECT * FROM `files` $search_param ORDER BY $order_str LIMIT $offset, ".rowsperpage;

//print($sql);$data['sql'] = $sql;

if ($result=Sql_query($sql))
  {
  $num_rows =	num_rows($result);  
  // Fetch one and one row
  while($row = mysqli_fetch_assoc($result))
  {
	  $_fileName_    = (enable_orgFilename) ? "'".$row["originalFilename"]."'" : "'".$row["filename"]."'";
	  $_file_id      = $row["id"];
	  $_crypt_id     = "'".Encrypt($_file_id)."'";
	  $folder        = Sql_Get_folder($row['folderId']);
	  $org_filename  = (enable_orgFilename) ? $row["originalFilename"] : $row["filename"] ;
	  $count++;
	  
	  if(file_exists('../..'.$folder.'/'.$row["filename"]))
		  $html.= '<tr id="file_'.$row["id"].'">';
	  else
		  $html.='<tr class="danger" id="file_'.$_file_id.'">';
		  $html.='<td><input value="'.$_file_id.'" type="checkbox"  name="files[]" class="checkbox" onclick="calcItems()"  /></td>
		 
		        <td>'.Sql_Get_Username($row["userId"]).'</td>
		        <td><a data-numrows="'.$num_rows.'" id="showfile_'.$count.'" href="javascript:void(0)" onclick="ShowFileInfoModal('.$_file_id.','.$_crypt_id.','.$count .')">'.icon($row["filename"]).' '.$org_filename.'</a></td>
				<td>'.FileSizeConvert($row["fileSize"]).'</td>
				<td class="hidden-xs"><span class="badge">'.$row["totalDownload"].'</span></td>
				<td class="hidden-xs"><span class="badge">'.Sql_Get_Reports_Count($_file_id).'</span></td>
				<td class="hidden-xs"><span class="badge">'.Sql_Get_Comments_Count($_file_id).'</span></td>
				<td class="hidden-xs">'.date('Y-m-d H:i:s',$row["uploadedDate"]).'</td>
				<td>
				 <a href="javascript:void(0)" onclick="deleteFile('.$_file_id.','."'".$row["deleteHash"]."'".','.$currentpage.','. $_fileName_.')"><span class="glyphicon glyphicon-trash"></span></a> 
				<!-- <a href="javascript:void(0)"><span class="glyphicon glyphicon-pencil text-muted"></span></a> -->
				 <a href="javascript:void(0)" onclick="updateFile('."'".$row["filename"]."'".')" ><span class="glyphicon glyphicon-cloud-upload"></span></a>
				</td>
				</tr>';
  }
  } 
if($total==0)
	$html = '<tr><td colspan="9">'.$lang[59].'(0)</td></tr>';

$data['success_msg'] = $html;
$data['totalpages'] = $totalpages ;
($result) ? mysqli_free_result($result) : '';
mysqli_close($connection);
PrintArray($data) ;

}


if(isGet('delete_selected'))
{
	
	AJAX_check();
	
	if(isPost('files'))
	{
	$result=array();	
     foreach ($_POST['files'] as $id) {
		    $info = Sql_Get_info($id,'../..');
			if(!$info["status"]) continue ;	
			if(file_exists('../..'. $info["fullpath"] ))	
				@unlink('../..'. $info["fullpath"] );
	        if(file_exists('../..'. $info["thumbnail_dir"] ))	
				@unlink('../..'. $info["thumbnail_dir"]  );
			if(Sql_Delete_File($id))
				if(Sql_Delete_Report_File_Id($id))
					if(Sql_Delete_Stat_File_Id($id))
						if(Sql_Delete_Comment_Id($id))
							$result[]=  $id ;
			}
	PrintArray(array('success_msg' => $result ,'totalpages' => ceil(num_rows(Sql_query("SELECT 1 FROM `files`"))/rowsperpage) ));	
	}
	
	if(isPost('users'))
	{
	 $result=array();		
     foreach ($_POST['users'] as $id) {
			if(Sql_Delete_User($id)) $result[]=  $id ; 
			}
	PrintArray(array('success_msg' => $result ,'totalpages' =>   ceil(num_rows(Sql_query("SELECT 1 FROM `users`"))/rowsperpage) ));	
	}
	
	if(isPost('comments'))
	{
	 $result=array();		
     foreach ($_POST['comments'] as $id) {
			if(Sql_Delete_Comment($id)) $result[]=  $id ; 
			}
	PrintArray(array('success_msg' => $result ,'totalpages' =>   ceil(num_rows(Sql_query("SELECT 1 FROM `comments`"))/rowsperpage) ));	
	}
	
	
	if(isPost('reports'))
	{
	 $result=array();		
     foreach ($_POST['reports'] as $id) {
			if(Sql_Delete_Report($id)) $result[]=  $id ; 
			}
	PrintArray(array('success_msg' => $result ,'totalpages' =>  ceil(num_rows(Sql_query("SELECT 1 FROM `reports`"))/rowsperpage)   ));	
	}
	
	if(isPost('stats'))
	{
	$result=array();		
     foreach ($_POST['stats'] as $id) {
			if(Sql_Delete_Stat_File_Id($id)) $result[]=  $id ; 
			}
	PrintArray(array('success_msg' => $result ,'totalpages' =>  ceil(num_rows(Sql_query("SELECT DISTINCT `file_id` FROM `stats`"))/rowsperpage)   ));	
	}
	
	if(isPost('folders'))
	{
	$result=array();		
     foreach ($_POST['folders'] as $id) {
		 $folderName = Get_folderName_By_FolderId($id) ;
		 if(($folderName !=='') && ($folderName !=='/') && ($folderName !=='..') && ($folderName !=='.'))
			 unlinkRecursive('../..'.$folderName, true);
				if(Sql_Delete_Folder($id))
					$result[]=  $id ; 
			}
	PrintArray(array('success_msg' => $result ,'totalpages' =>  ceil(num_rows(Sql_query("SELECT * FROM `folders`"))/rowsperpage)   ));	
	}
	
		
}


if(isGet('delete_comment_id'))
{
	AJAX_check();
    Sql_Delete_Comment($_GET['delete_comment_id']) ? PrintArray(array('success_msg' => $lang[178])) : PrintArray(array('success_msg' => $lang[179])) ;
}

if(isGet('delete_user_id'))
{
	AJAX_check();
    Sql_Delete_User($_GET['delete_user_id']) ? PrintArray(array('success_msg' => $lang[178])) : PrintArray(array('success_msg' => $lang[179])) ;
}

if(isGet('delete_stat_id'))
{
	AJAX_check();
    Sql_Delete_Stat_File_Id($_GET['delete_stat_id']) ? PrintArray(array('success_msg' => $lang[178])) : PrintArray(array('success_msg' => $lang[179])) ;	
}

if(isGet('delete_report_id'))
{
	AJAX_check();
    Sql_Delete_Report($_GET['delete_report_id']) ? PrintArray(array('success_msg' => $lang[178])) : PrintArray(array('success_msg' => $lang[179]));	
}

if(isGet('accept_report_id'))
{
	AJAX_check();
    Sql_Update_Report($_GET['accept_report_id']) ? PrintArray(array('success_msg' => $lang[178])) : PrintArray(array('success_msg' => $lang[179])) ;
}


if(isGet('delete_folder'))
{
	AJAX_check();
	$id = (int)$_GET['folder_id'] ;
	$folder = protect($_GET['delete_folder']) ;
	if(Sql_Delete_Folder($id ))
		if($folder !=='.' && $folder !=='..' && $folder !=='' && $folder !=='/')
			if(unlinkRecursive($folder, true))
				PrintArray(array('success_msg' => $lang[178]));
	else 
		PrintArray(array('success_msg' => $lang[179]));	
}

  if(isGet('delete_file_id'))
{
	AJAX_check();
    $info = Sql_Get_info($_GET['delete_file_id'],'../..');
    if( $info['status'] && $info['deleteHash'] == $_GET['delete'] )
	{		
	if(file_exists('../..'. $info["fullpath"] ))	
		@unlink('../..'. $info["fullpath"] );
	if(file_exists('../..'. $info["thumbnail_dir"] ))	
		@unlink('../..'. $info["thumbnail_dir"] );
	Sql_Delete_File($_GET['delete_file_id']);
	Sql_Delete_Report_File_Id($_GET['delete_file_id']);
	Sql_Delete_Stat_File_Id($_GET['delete_file_id']);
	Sql_Delete_Comment_Id($_GET['delete_file_id']);
	PrintArray(array('success_msg' => $lang[178]));
	} else PrintArray(array('success_msg' => $lang[179]));	
} 

  if(isGet('backup_db'))
{
	//AJAX_check();$_POST['tables']
    Export_Database(  $_GET['tables'] );
	PrintArray(array('success_msg' => $lang[178]  ));
	
} 


if(isGet('getpublicity'))
{
	AJAX_check();
	$name = protect($_GET['getpublicity']);
	$publicity = Sql_Get_publicity($name);
	PrintArray(array('status' => $publicity['status'],
	                 'content' => $publicity['content'],
					 'title' => $publicity['title']
                        	));		
}



if(isGet('userinfo'))
{
AJAX_check();
$id = (int)$_GET['userinfo'];
$sql = Sql_query("SELECT * FROM `users` WHERE `id`='$id'");
if(num_rows($sql)>0) {
	$row = mysqli_fetch_array($sql);

		$data['username']   = $row['username'];
		$data['password']   = $row['password'];
		$data['user_id']    = $row['id'];
		$data['level']      = $row['level']; //(bool)
		$data['status']     = $row['status'];
		$data['email']      = $row['email'];
	
	} else $data['username'] = $lang[111] ;
PrintArray($data) ;	

}



if(isGet('planinfo'))
{
//AJAX_check();
$translate = translate();
$plan = protect($_GET['planinfo']);
$data['name'] = $translate[$plan];
$sql = Sql_query("SELECT `name`,`$plan` FROM `plans`");
if(num_rows($sql)>0) {
   while($row = mysqli_fetch_assoc($sql))
		$data[$row['name']]   = $row[$plan];	
	} 
PrintArray($data) ;	

}




if(isGet('publicity'))
{
AJAX_check();

$page_name = protect($_POST['page_name']) ;
$title     = isPost('title') ? protect($_POST['title']) : '';
$content   = Encrypt($_POST['content']);


Sql_query("UPDATE `settings` SET `value` = '$content', `parameter` = '$title' WHERE `name` = '$page_name';");
PrintArray(array('success_msg' => $lang[178]));
}

if(isGet('folderinfo'))
{
AJAX_check();
$id = (int)$_GET['folderinfo'];
$sql = Sql_query("SELECT * FROM `folders` WHERE `id`='$id'");
if(num_rows($sql)>0) {
	$row = mysqli_fetch_array($sql);

        $data['_folderName'] = $row["folderName"];
		$data['_username']   = Sql_Get_Username($row["userId"]);
		$data['_date']       = date('Y-m-d H:i:s',$row['date_added']);
		$data['_password']   = $row["accessPassword"];
		$data['_public']     = (bool)$row["isPublic"];	
	
	} else $data['_filename']   = icon('').' '.$lang[46];
PrintArray($data) ;	

}

if(isGet('fileinfo'))
{
AJAX_check();
$id = (int)$_GET['fileinfo'];
$sql = Sql_query("SELECT * FROM `files` WHERE `id`='$id'");
if(num_rows($sql)>0) {
	$row = mysqli_fetch_array($sql);
	$_fileName_= (enable_orgFilename) ? "'".$row["originalFilename"]."'" : "'".$row["filename"]."'";
	$folder    = Sql_Get_folder($row['folderId']);
//	$thumbnail = (file_exists('../..'. $folder .'/_thumbnail/'. get_thumbnail($row['filename'])) && ext_is_image('../..'.$folder.'/'.$row["filename"]) ) ? $folder .'/_thumbnail/'. get_thumbnail($row['filename']) : '';
    $thumbnail = (file_exists('../..'. $folder .'/_thumbnail/'. get_thumbnail($row['filename'])) && is_image('../..'.$folder.'/'.$row["filename"]) ) ? $folder .'/_thumbnail/'. get_thumbnail($row['filename']) : '';
    $ext       = strtolower(pathinfo($row["filename"], PATHINFO_EXTENSION));
	$data['_filename']   = (!is_file('../..'.$folder.'/'.$row["filename"]) ) ? icon($row["filename"]).' '.$lang[46] : icon($row["filename"]).' '.$row["originalFilename"];
	$data['_thumbnail']  = ($thumbnail =='' ) ? '' : $folder .'/_thumbnail/'. get_thumbnail($row['filename']) ;
    $data['_media']      = (in_array($ext, array("mp3", "ogg", "oga" , "wav" , "mp4" , "webm" , "ogv" ))) ? true : false ;
	$data['_audio']      = (in_array($ext, array("mp3", "ogg", "oga" , "wav"  ))) ? true : false ;
	$data['_video']      = (in_array($ext, array("mp4" , "webm" , "ogv" ))) ? true : false ;
        $data['_file']       = $row["filename"];
		$data['_orgfile']    = $row["originalFilename"];
		$data['_username']   = '<mark>'.Sql_Get_Username($row["userId"]).'</mark>';
		$data['_date']       = date('Y-m-d H:i:s',$row['uploadedDate']);
		$data['_download']   = $row['totalDownload']; //(bool)
		$data['_report']     = Sql_Get_Reports_Count($row["id"]); //(bool)
		$data['_size']       = FileSizeConvert($row["fileSize"]);
		$data['_url']        = $folder.'/'.$row["filename"];	
		$data['_urlhtml']    = '<a href="..'.$folder.'/'.$row["filename"].'" target="_blank">'.$row["filename"].'</a>';	
		$data['_delete']     = '<a href="javascript:void(0)" onclick="deleteFile('.$row["id"].','."'".$row["deleteHash"]."'".','.$currentpage.','. $_fileName_.')">'.$lang[32].'</a>';
		$data['_folder']     = $folder ;
		$data['_stats']      = '<a href="javascript:void(0)" onclick="StatsFile('.$row["id"].','.$_fileName_.')">'.$lang[28].'</a>';
		$data['_password']   = $row["accessPassword"];
		$data['_ip']         = longtoip($row["uploadedIP"]);
	
	} else $data['_filename']   = icon('').' '.$lang[46];
PrintArray($data) ;	

}

if (isGet('editfolder'))
{	
AJAX_check();
$folderName = protect($_POST['folderName']);
$accessPassword = protect($_POST['password']);
$folder_id = (int)$_POST['folder_id'];
$_folder_old = Get_folderName_By_FolderId( $folder_id );
$userId = protect(Sql_Get_Username_id($_POST['username']));
$ispublic = isPost('ispublic') ? 1 : 0 ;

if (file_exists('../..'.$_folder_old))
rename('../..'.$_folder_old,'../..'.$folderName);

if(Sql_query("UPDATE `folders` SET `userId` = '$userId', `folderName` = '$folderName', `isPublic` = '$ispublic', `accessPassword` = '$accessPassword', `date_added` = '".timestamp()."' WHERE `id` = '$folder_id';"))
	PrintArray(array('success_msg' => $lang[178]));
else 
	PrintArray(array('success_msg' => $lang[179]));	
}

if (isGet('edituser'))
{	
AJAX_check();
$username = protect($_POST['username']);
$password = protect($_POST['password']);

$password = ($password !== '') ? " `password` = '".md5($password)."' , " : $password ;


$email   = protect($_POST['email']);
$user_id = (int)$_POST['user_id'];
$plan_id = (int)$_POST['plan_id'];
$level   = isPost('level') ? 1 : 0 ;
$status  = isPost('status') ? 2 : 1 ;

if(Sql_query("UPDATE `users` SET `username` = '$username' , $password `email` = '$email' , `plan_id` = '$plan_id' , `level` = '$level' , `status` = $status  WHERE `id` = '$user_id'"))
	PrintArray(array('success_msg' => $lang[178]));
else 
	PrintArray(array('success_msg' => $lang[179]));	
}

if(isGet('editplan'))
{
AJAX_check();
$plan = protect($_POST['plan_id']);
$directdownload     = isPost('directdownload') ?  1 : 0 ;
$enable_userfolder  = isPost('enable_userfolder') ?  1 : 0 ;
$statistics         = isPost('statistics') ?  1 : 0 ;
$thumbnail          = isPost('thumbnail') ?  1 : 0 ;
$display_ads        = isPost('display_ads') ?  1 : 0 ;
$multiple           = isPost('multiple') ?  1 : 0 ;
$multipleSelect     = isPost('multipleSelect') ?  1 : 0 ;
$deletelink         = isPost('deletelink') ?  1 : 0 ;

$price              = isPost('price') ? protect($_POST['price']) : '';
$extensions         = protect($_POST['extensions']);

$Interval           = (int)$_POST['Interval'];
$maxUploads         = !empty($_POST['maxUploads']) ? (int)$_POST['maxUploads'] : '';
$days_older         = isPost('days_older') ? (int)$_POST['days_older'] : '';

$maxsize            = (isPost('maxsize') && $_POST['maxsize']!=='') ? protect($_POST['maxsize'].$_POST['format_maxsize']) : '';
$userspacemax       = (isPost('userspacemax') && $_POST['userspacemax']!=='') ? protect($_POST['userspacemax'].$_POST['format_userspacemax']) : '';
$speed              = (isPost('speed') && $_POST['speed']!=='') ? protect($_POST['speed'].$_POST['format_speed']) : '';

/*SELECT 1 FROM `settings` WHERE `name` = 'language';*/
Sql_query("UPDATE `plans` SET `$plan` = '$Interval' WHERE `name` = 'Interval';");
Sql_query("UPDATE `plans` SET `$plan` = '$enable_userfolder' WHERE `name` = 'enable_userfolder';");
Sql_query("UPDATE `plans` SET `$plan` = '$maxsize' WHERE `name` = 'maxsize';");
Sql_query("UPDATE `plans` SET `$plan` = '$extensions' WHERE `name` = 'extensions';");
Sql_query("UPDATE `plans` SET `$plan` = '$directdownload' WHERE `name` = 'directdownload';"); 
Sql_query("UPDATE `plans` SET `$plan` = '$statistics' WHERE `name` = 'statistics';"); 
Sql_query("UPDATE `plans` SET `$plan` = '$userspacemax' WHERE `name` = 'userspacemax';"); 
Sql_query("UPDATE `plans` SET `$plan` = '$thumbnail' WHERE `name` = 'thumbnail';"); 
Sql_query("UPDATE `plans` SET `$plan` = '$price' WHERE `name` = 'price';"); 
Sql_query("UPDATE `plans` SET `$plan` = '$speed' WHERE `name` = 'speed';");
Sql_query("UPDATE `plans` SET `$plan` = '$days_older' WHERE `name` = 'days_older';");
Sql_query("UPDATE `plans` SET `$plan` = '$maxUploads' WHERE `name` = 'maxUploads';");
Sql_query("UPDATE `plans` SET `$plan` = '$display_ads' WHERE `name` = 'display_ads';");
Sql_query("UPDATE `plans` SET `$plan` = '$multiple' WHERE `name` = 'multiple';");
Sql_query("UPDATE `plans` SET `$plan` = '$deletelink' WHERE `name` = 'deletelink';");
PrintArray(array('success_msg' => $lang[178]));
}

if(isGet('countrycodes'))
{
require('../../includes/libraries/countrycodes.php');
/*print_r($countrycodes);
exit;*/
PrintArray(array_values($countrycodes));
}
?>