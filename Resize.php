<?php

function resizeImage($src, $fileType, $w, $h)
{
    switch ($fileType) {
        case "jpg":
            $image = imagecreatefromjpeg($src); 
            break;
        case "jpeg":
            $image = imagecreatefromjpeg($src); 
            break;
        case "png":
            $image = imagecreatefrompng($src); 
            break;
        case "gif":
            $image = imagecreatefromgif($src); 
            break;
    }
    $width = imagesx($image);
    $height = imagesy($image);
    $thumb_width = $w; 
    $thumb_height = $h; 
    $original_aspect = $width / $height; 
    $thumb_aspect = $thumb_width / $thumb_height; 
    if ( $original_aspect >= $thumb_aspect ) { 
        $new_height = $thumb_height; 
        $new_width = $width / ($height / $thumb_height); 
    } 
    else {
        $new_width = $thumb_width; 
        $new_height = $height / ($width / $thumb_width); 
    } 
    $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
    if ($fileType == "png") {
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);
        $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
        imagefilledrectangle($thumb, 0, 0, $width, $height, $transparent);
        imagecopyresampled($thumb, 
            $image, 
            0 - ($new_width - $thumb_width) / 2,
            0 - ($new_height - $thumb_height) / 2,
            0, 0, 
            $new_width, $new_height, 
            $width, $height
        ); 
        imagepng($thumb, $src, 9);
    }
    else {
        imagecopyresampled($thumb, 
            $image, 
            0 - ($new_width - $thumb_width) / 2,
            0 - ($new_height - $thumb_height) / 2,
            0, 0, 
            $new_width, $new_height, 
            $width, $height
        );
        imagejpeg($thumb, $src, 100);
    } 
}

?>
