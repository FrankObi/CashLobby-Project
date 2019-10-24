<?php
session_start();
header('Content-type: image.jpeg');
$Captcha_text=$_SESSION['secure'];
$F_S=30;
$I_W=160;
$I_H=40;

$image=imagecreate($I_W,$I_H);
imagecolorallocate($image,255,255,255);
$T_C=imagecolorallocate($image,100,150,200);

for($x=0;$x<70;$x++){
$x1=rand(1,300);
$y1=rand(1,300);
$x2=rand(1,100);
$y2=rand(1,100);
imageline($image,$x1,$y1,$x2,$y2,$T_C);
}

imagettftext($image,$F_S,0,15,37,$T_C,'JOKERMAN.ttf',$Captcha_text);
imagejpeg($image);
?>