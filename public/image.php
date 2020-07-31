<?php

function gradient($w=1200, $h=630, $c=array('#dadada','#121212','#00FF00','#0000FF'), $hex=true) {

$im=imagecreatetruecolor($w,$h);

if($hex) {  // convert hex-values to rgb
  for($i=0;$i<=3;$i++) {
   $c[$i]=hex2rgb($c[$i]);
  }
}

$rgb=$c[0]; // start with top left color
for($x=0;$x<=$w;$x++) { // loop columns
  for($y=0;$y<=$h;$y++) { // loop rows
   // set pixel color
   $col=imagecolorallocate($im,$rgb[0],$rgb[1],$rgb[2]);
   imagesetpixel($im,$x-1,$y-1,$col);
   // calculate new color 
   for($i=0;$i<=2;$i++) {
    $rgb[$i]=
      $c[0][$i]*(($w-$x)*($h-$y)/($w*$h)) +
      $c[1][$i]*($x     *($h-$y)/($w*$h)) +
      $c[2][$i]*(($w-$x)*$y     /($w*$h)) +
      $c[3][$i]*($x     *$y     /($w*$h));
   }
  }
}
return $im;
}

function hex2rgb($hex)
{
$rgb[0]=hexdec(substr($hex,1,2));
$rgb[1]=hexdec(substr($hex,3,2));
$rgb[2]=hexdec(substr($hex,5,2));
return($rgb);
}

// usage example

$image=gradient(1200, 630, array('#ededed', '#606060', '#606060', '#373737'));

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);

?>