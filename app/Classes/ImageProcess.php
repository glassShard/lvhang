<?php

namespace App\Classes;

class ImageProcess
{
	public static function image_process($file_path, $extension, $dst_w, $dst_h, $contain = false) {
		$file = $file_path;
		$extension = strtolower($extension);

		$secondX = 0;
		$secondY = 0;

		// Megszerzi a kép adatait
		$dimensions   = GetImageSize($file);
		$src_w        = $dimensions[0];
		$src_h       = $dimensions[1];

		ini_set('memory_limit', '512M');


		switch ($extension) {
			case 'png':
				$src_image = @ImageCreateFromPng($file); // original image
			break;
			case 'gif':
				$src_image = @ImageCreateFromGif($file); // original image
			break;
			default:
				$src_image = @ImageCreateFromJpeg($file); // original image
				//ImageInterlace($dst_image, true); // Enable interlancing (progressive JPG, smaller size file)
			break;
		}
		
		// Kiolvassa az exif adatokat
		if ($extension === 'jpg') {

			$exif = @exif_read_data($file);

			// Automatikus forgatás exif alapján
			if (!empty($exif['Orientation'])) {
				switch($exif['Orientation']) {
					case 8:
						$src_image = imagerotate($src_image, 90, 0);
						$src_w = $dimensions[1];
						$src_h = $dimensions[0];
						break;
					case 3:
						$src_image = imagerotate($src_image, 180, 0);
						break;
					case 6:
						$src_image = imagerotate($src_image, -90, 0);
						$src_w = $dimensions[1];
						$src_h = $dimensions[0];
						break;
				}
			}	
		}

		if ($contain === false) {
			
			// Ha a dst_h fix (p.l. image gallery-nél 120px)
			if ($dst_w === 'auto') {
				$dst_w = $dst_h * $src_w / $src_h;
			}

			// Ha bármelyik méret maximálisan a megadott
			if ($dst_w === 'max') {
				if ($src_w >=$src_h) {
					$dst_w = $dst_h;
					$dst_h = $src_h * $dst_w / $src_w;
				} else {
					$dst_w = $src_w * $dst_h / $src_h;
				}
			}

			// Forrás szélesség / magasság > cél sz / m
			if ($src_w / $src_h > $dst_w / $dst_h) {
				$src_y = 0;
				$src_x = ($src_w - $src_h * $dst_w / $dst_h) / 2;
				$src_w = $src_h * $dst_w / $dst_h;
			}
			// Forrás sz / m < cél sz / m
			elseif ($src_w / $src_h < $dst_w / $dst_h) {
				$src_x = 0;
				$src_y = ($src_h - $src_w * $dst_h / $dst_w) / 2;
				$src_h = $src_w * $dst_h / $dst_w;
			}
			// Forrás sz / m = cél sz / m
			else {
				$src_x = 0;
				$src_y = 0;
			}
			
			$dst_x = 0;
			$dst_y = 0;

			$dst_image = imagecreatetruecolor($dst_w, $dst_h);
				 
			if($extension=='png'){
				imagealphablending($dst_image, false);
				imagesavealpha($dst_image,true);
				$transparent = imagecolorallocatealpha($dst_image, 255, 255, 255, 127);
				imagefilledrectangle($dst_image, 0, 0, $dst_w, $dst_h, $transparent);
			}
	
			imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
		
		} else {
			
			// ha bele kell, hogy férjen az egész forrás kép a célba
			$src_x = 0;
			$src_y = 0;

			$sm_src_h = 0;
			$sm_src_w = 0;

			if (($dst_w / $dst_h) > ($src_w / $src_h)) {
				
				$dst_x = ($dst_w - (($dst_h * $src_w) / $src_h)) / 2;
				$dst_y = 0;

				$secondX = $dst_x + $src_w;
				$sm_src_h = $dst_h;
				$sm_src_w = $sm_src_h * $src_w / $src_h;
			
			} else {
				
				$dst_x = 0;
				$dst_y = ($dst_h - (($src_h * $dst_w) / $src_w)) / 2;

				$secondY = $dst_y + $src_h;
				$sm_src_w = $dst_w;
				$sm_src_h = $sm_src_w * $src_h / $src_w;

			}

			$dst_image = imagecreatetruecolor($dst_w, $dst_h);

			// generate grey gradient on base image
			ImageProcess::gradient($dst_image);
		
		
			if($extension=='png') {
				imagealphablending($dst_image, false);
				imagesavealpha($dst_image,true);
				$transparent = imagecolorallocatealpha($dst_image, 255, 255, 255, 127);
				imagefilledrectangle($dst_image, 0, 0, $dst_w, $dst_h, $transparent);
			}

			$sm_src_image = imagecreatetruecolor($sm_src_w, $sm_src_h);
			
			imagecopyresampled($sm_src_image, $src_image, 0, 0, 0, 0, $sm_src_w, $sm_src_h, $src_w, $src_h);
	
			imagecopymerge($dst_image, $sm_src_image, $dst_x, $dst_y, 0, 0, $sm_src_w, $sm_src_h, 100);
		}

		ImageDestroy($src_image);

		switch ($extension) {
			case 'png':
				$gotSaved = ImagePng($dst_image, $file);
			break;
			case 'gif':
				$gotSaved = ImageGif($dst_image, $file);
			break;
			default:
				$gotSaved = ImageJpeg($dst_image, $file);
			break;
		}
		if ($gotSaved) { 
			return true;
		} else {
			return false;
		}
	}

	private static function gradient($base_image, $c=array('#ededed', '#606060', '#606060', '#373737'), $hex=true) {


		$w = imagesx($base_image);
		$h = imagesy($base_image);
		
		if($hex) {  // convert hex-values to rgb
			for($i=0;$i<=3;$i++) {
				$c[$i]=ImageProcess::hex2rgb($c[$i]);
			}
		}
		
		$rgb=$c[0]; // start with top left color
		for($x=0; $x<=$w; $x++) { // loop columns
			for($y=0; $y<=$h ;$y++) { // loop rows
				// set pixel color
				$col=imagecolorallocate($base_image, $rgb[0], $rgb[1], $rgb[2]);
				imagesetpixel($base_image, $x-1, $y-1, $col);
				// calculate new color 
				for($i=0; $i<=2; $i++) {
				$rgb[$i]=
					$c[0][$i]*(($w-$x)*($h-$y)/($w*$h)) +
					$c[1][$i]*($x     *($h-$y)/($w*$h)) +
					$c[2][$i]*(($w-$x)*$y     /($w*$h)) +
					$c[3][$i]*($x     *$y     /($w*$h));
				}
			}
		}
		return $base_image;
	}

	private static function hex2rgb($hex) {
		$rgb[0]=hexdec(substr($hex,1,2));
		$rgb[1]=hexdec(substr($hex,3,2));
		$rgb[2]=hexdec(substr($hex,5,2));
		
		return ($rgb);
	}
}

?>
