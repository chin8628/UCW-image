<?php

if (isset($_POST['data']))
{
	$pre_image = $_POST['data'];

	$max_size = 600; //max image size in Pixels
	$destination_folder = 'processed';
	$watermark_png_file = 'resources/overlay.png'; //watermark png file

	$image_resource =  imagecreatefrompng($pre_image);

	if($image_resource){
		//Copy and resize part of an image with resampling
		$img_width = imagesx($image_resource);
		$img_height = imagesy($image_resource);

	    //Construct a proportional size of new image
		$image_scale        = min($max_size / $img_width, $max_size / $img_height);
		$new_image_width    = ceil($image_scale * $img_width);
		$new_image_height   = ceil($image_scale * $img_height);
		$new_canvas         = imagecreatetruecolor($new_image_width , $new_image_height);

		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height))
		{

			//center watermark
			$watermark_left = $new_image_width  - 499; //watermark left
			$watermark_bottom = $new_image_height - 192; //watermark bottom

			$watermark = imagecreatefrompng($watermark_png_file); //watermark image
			imagecopy($new_canvas, $watermark, $watermark_left, $watermark_bottom, 0, 0, 499, 192); //merge image

			//output image direcly on the browser.
			header('Content-Type: image/jpeg');
			imagejpeg($new_canvas, NULL , 90);

			//Or Save image to the folder
			//imagejpeg($new_canvas, $destination_folder.'/'.$image_name , 90);

			//free up memory
			imagedestroy($new_canvas);
			imagedestroy($image_resource);
			die();
		}
	}
}

?>