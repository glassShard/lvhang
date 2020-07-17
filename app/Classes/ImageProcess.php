<?php

namespace App\Classes;

class ImageProcess
{
	public static function image_process($file_path, $extension, $dst_w, $dst_h) {
		$file = $file_path;
		$extension = strtolower($extension);

		// Megszerzi a kép adatait
		$dimensions   = GetImageSize($file);
		$src_w        = $dimensions[0];
		$src_h       = $dimensions[1];

		// Képkivágás beállítása
		$ratio      = $src_h/$src_w;
		
		if ($dst_w === 'auto') {
			$dst_w = $dst_h * $src_w / $src_h;
		}

		if ($dst_w === 'max') {
			if ($src_w >=$src_h) {
				$dst_w = $dst_h;
				$dst_h = $src_h * $dst_w / $src_w;
			} else {
				$dst_w = $src_w * $dst_h / $src_w;
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
	
		ini_set('memory_limit', '512M');

/* 		dump($extension);
		dump($file); */
		
		switch ($extension) {
			case 'png':
				$src_image = @ImageCreateFromPng($file); // original image
			break;
			case 'gif':
				$src_image = @ImageCreateFromGif($file); // original image
			break;
			default:
				$src_image = @ImageCreateFromJpeg($file); // original image
				ImageInterlace($dst_image, true); // Enable interlancing (progressive JPG, smaller size file)
			break;
		}
	
		if($extension=='png'){
			imagealphablending($dst_image, false);
			imagesavealpha($dst_image,true);
			$transparent = imagecolorallocatealpha($dst_image, 255, 255, 255, 127);
			imagefilledrectangle($dst_image, 0, 0, $dst_w, $dst_h, $transparent);
		}

		imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
		
		// Kiolvassa az exif adatokat
		if ($extension === 'jpg') {

			$exif = @exif_read_data($file);

			// Automatikus forgatás exif alapján
			if (!empty($exif['Orientation'])) {
				switch($exif['Orientation']) {
					case 8:
						$dst_image = imagerotate($dst_image, 90, 0);
						break;
					case 3:
						$dst_image = imagerotate($dst_image, 180, 0);
						break;
					case 6:
						$dst_image = imagerotate($dst_image, -90, 0);
						break;
				}
			}
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
}

?>
