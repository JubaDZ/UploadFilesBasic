<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<div class="table-responsive top20 <?php echo ClassAnimated ?> swing">
  <table class="table table-hover">
    <tbody>	
<?php 
//$DownloadID    = protect(Decrypt($_GET['download']));
//$info  = Sql_Get_info($DownloadID);
//$DownloadID   = (is_numeric($_GET['download'])) ? (int)$_GET['download'] : protect(Decrypt($_GET['download']));
$_crypt_id  = "'".Encrypt($DownloadID)."'";
$Continue   = false;
$confirm  = (isGet('confirm')) ? true : false ;
$notfound = (isGet('notfound')) ? true : false ;
$referrer = (isset($_SERVER['HTTP_REFERER'])) ? Encrypt($_SERVER['HTTP_REFERER']) : "";
$string   = (!isset($_SESSION['settings']['files'][$DownloadID])) ? GenerateRandomString() : $_SESSION['settings']['files'][$DownloadID];
(!isset($_SESSION['settings']['files'][$DownloadID])) ? $_SESSION['settings']['files'][$DownloadID]	= $string : '';
			
//print_r($info);

if(!empty($info['password']))
{
	if(isset($_SESSION['settings']['passwordfiles'][$DownloadID]))
		$Continue = ( $_SESSION['settings']['passwordfiles'][$DownloadID] == $info['password'] )  ? true : false ;	
} else 
	$Continue = true;	
	
/*--------------------------------------*/	
if (!$info["status"] && $confirm )
	 ShowMessage($lang[197]) ;

elseif(!$info["status"] && $notfound )
	 ShowMessage($lang[46]) ;

elseif(!$info['status'])
	 ShowMessage($lang[46],true);

elseif(!$info['public'] && ((int)UserID !== (int)$info['user_id']) )
     ShowMessage($lang[177],true);
	
/*elseif(!IsLogin)
     echo '<tr><td colspan="2" class="active"><h2><i class="glyphicon glyphicon-question-sign"></i> '.$lang[49].'.</h2></td></tr>';	*/
	 
elseif(!$Continue)
    include_once('filepass.php');
		
elseif (!$info["isfile"])
	 ShowMessage($lang[46],true);
	

else
	{
		
	$_username_html =	showUserfiles && ((int)$info['user_id']<>0) ? '<a href="javascript:void(0)" onclick="pageUserFiles('.$info['user_id'].')">'.$info["username"].'</a>': $info["username"] ;
		//مجلد ملفات العضو:pageUserFiles
	echo 
	  '<tr>
        <th>'.$lang[35] .'</th>
        <td><span id="userTD" class="text-warning">'.$_username_html.'</span></td>
      </tr>'; 
	  echo (thumbnail && $info["thumbnail"]) ?  
	  '<tr>
        <th>'.$lang[172]  .'</th>
        <td><img id="thumbnail_dir" src=".'.$info["thumbnail_dir"].'" class="img-thumbnail" alt=""></td>
      </tr>' : '';
		   
      echo
	 '<tr>
        <th>'.$lang[36] .'</th>
        <td id="orgfilenameTD">'.icon($info["filename"]).' '.$info["orgfilename"].' / ( '.isPublic($info['public']).' ) </td>
      </tr>
	  
	  <tr>
        <th>'.$lang[33] .'</th>
        <td id="dateTD">'.time_elapsed_string(date('Y-m-d H:i:s',$info["date"])).'</td>
      </tr>	 
	  
	  <tr>
        <th>'.$lang[34] .'</th>
        <td id="downloadcountTD">'.$info["download"].'</td>
      </tr>
	  
	  <tr>
        <th>'.$lang[42] .'</th>
        <td id="sizeTD"><span class="label label-default">'.FileSizeConvert($info["size"]).'</span></td>
      </tr> 
	  
	  <tr>
        <th>'.$lang[184] .'</th>
		  <td><div id="dowloadDiv" class="btnDowload"><a href="javascript:void(0)" onclick="downloadFile('.$_crypt_id.','."'".$string."'".','."'".$referrer."'".')"><i class="glyphicon glyphicon-download-alt"></i>&nbsp;'.$lang[128].'</a></div></td>
      </tr> 
	 ';
	  	  

	echo ( ((IsLogin) && ((int)UserID==(int)$info["user_id"])) || IsAdmin ) ? 
     '<tr>
        <th>'.$lang[32] .'</th>
        <td><div id="deleteDiv"><a href="javascript:void(0)" onclick="deleteFile2('.$DownloadID.','."'".$info["deleteHash"]."'".','."'".$info["xfilename"]."'".')"><code><i class="glyphicon glyphicon-remove"></i> '.$lang[32].'</code></a></div></td>
      </tr>' : '';
	 
	 echo 
	 '<tr>
        <th>'.$lang[82] .'</th>
        <td>
		<div id="reportDiv">
		 <div class="dropup">
		     <a href="javascript:void(0)" data-toggle="dropdown"><code><i class="glyphicon glyphicon-thumbs-down"></i> '.$lang[82].' <span class="caret"></span></code></a>
		    <ul class="dropdown-menu">
		       <li><a href="javascript:void(0)" onclick="reportFile('.$DownloadID.',1)" >'.$lang[201].'</a></li>
		       <li><a href="javascript:void(0)" onclick="reportFile('.$DownloadID.',2)" >'.$lang[202].'</a></li>
		       <li><a href="javascript:void(0)" onclick="reportFile('.$DownloadID.',3)" >'.$lang[203].'</a></li>
			   <li><a href="javascript:void(0)" onclick="reportFile('.$DownloadID.',4)" >'.$lang[204].'</a></li>
		    </ul>
		  </div>
		 </div>
		 </td>
      </tr>';

	 echo ((IsAdmin || statistics) && ($info["download"]>0) && ($info["stats"]>0)) ? 
      '<tr>
        <th>'.$lang[28] .'</th>
        <td><div id="statsDiv"><a href="javascript:void(0)" onclick="StatsFile('.$DownloadID.','."'".$info["orgfilename"]."'".')" ><span><i class="glyphicon glyphicon-stats"></i> '.$lang[28].'</span></a></div></td>
      </tr>' : ''; 
	  
	  }
//echo  '<span class="badge"><small>'.time_elapsed_string(date('Y-m-d H:i:s',Sql_Get_Last_date_Download($DownloadID))).'</small></span>';	  
//unset($DownloadID);
unset($_crypt_id);
unset($userId);

//mysqli_close($connection);

?>

	
    </tbody>
  </table>
 </div>