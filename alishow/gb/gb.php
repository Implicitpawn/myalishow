<?php
header('content-type:image/png');
// $img = imagecreatetruecolor(200,200);
// $red = imagecolorallocate($img,255,0,0);
// $green = imagecolorallocate($img,0,255,0);
// $blue = imagecolorallocate($img,0,0,255);
// $black = imagecolorallocate($img,0,0,0);
// imagefill($img,199,100,$green);
// imagestring($img,7,30,30,'gbck',$red);
// imagefilledarc($img,100,100,200,60,0,360,$blue,IMG_ARC_EDGED);
// imagepng($img);
// imagedestroy($img);

// $img = imagecreatefromjpeg('./20180205193338-3835.jpg');
// $black = imagecolorallocate($img,0,0,0);
// // imagefill($img,200,200,$black);
// imagestringup($img,6,200,200,'LOVE',$black);
// imagefilledarc($img,100,200,100,100,0,360,$black,IMG_ARC_EDGED);
// imagejpeg($img);
// imagedestroy($img);

$echo = '2345678acdefghijkmnpqrstuvwxyz';
$len = strlen($echo);
$str = '';
// echo $len;
$img = imagecreatetruecolor(180,50);
$bg = imagecolorallocate($img,188,189,190);
$randColor = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
imagefill($img,0,49,$bg);
// die("./fonts/".rand(0,20).".ttf");
// $lu = './fonts/'+1+'.ttf';
for($i=0;$i<4;$i++) {
    $rands = rand(0,20);
    $str .= $echo[rand(0,$len-1)];
};
session_start();
$_SESSION['code'] = $str;
for($i=0;$i<strlen($str);$i++) {
    imagettftext(
        $img,  //画布
        rand(25,30), //字体大小
        rand(-30,30), // 倾斜角度
        20+$i*40, //字体X轴位置
        35, //字体Y轴位置
        imagecolorallocate($img,rand(0,150),rand(0,150),rand(0,150)), //字体颜色
        "./fonts/2.ttf",  //字体类型   引用window下面的fonts
        $str[$i]  //字体内容
    );
}
imagepng($img);
imagedestroy($img);

