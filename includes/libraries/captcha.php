<?php 
define('NumericCaptcha',true);
define('caracteres'    , NumericCaptcha ? "123456789" : "ABCDEF123456789");
define('LengthCaptcha' ,4);

define('largeur',80);
define('hauteur',25);
define('lignes' ,10);

session_start();

$rgb = (isset($_GET['background'])) ? hexargb($_GET['background']) : hexargb($_SESSION['settings']['color']);
$colorfont = (isset($_GET['font'])) ? hexargb($_GET['font']) : hexargb($_SESSION['settings']['font']);
$rgb = str_replace("#","",$rgb);
$colorfont = str_replace("#","",$colorfont);
//تحويل الالوان 
function hexargb($hex) 
{
    return array("r"=>hexdec(substr($hex,0,2)),"g"=>hexdec(substr($hex,2,2)),"b"=>hexdec(substr($hex,4,2)));
}


$image = imagecreatetruecolor(largeur, hauteur);
//تلوين الخلفية
imagefilledrectangle($image, 0, 0, largeur, hauteur, imagecolorallocate($image, $rgb['r'], $rgb['g'], $rgb['b']));


for($i=0;$i<=lignes;$i++){
    $rgb=hexargb(substr(str_shuffle("ABCDEF0123456789"),0,6));
    imageline($image,rand(1,largeur-25),rand(1,hauteur),rand(1,largeur+25),rand(1,hauteur),imagecolorallocate($image, $rgb['r'], $rgb['g'], $rgb['b']));
}


define('code' , substr(str_shuffle(caracteres),0,LengthCaptcha) );

$_SESSION['settings']['code'] = code;

$code="";

for($i=0;$i<=strlen(code);$i++)
    $code .=substr(code ,$i,1)." ";

header('Content-Type: image/png');
imagestring($image, 5, 10, 5, $code, imagecolorallocate($image, $colorfont['r'], $colorfont['g'], $colorfont['b']));
imagepng($image);
imagedestroy($image); 
?>