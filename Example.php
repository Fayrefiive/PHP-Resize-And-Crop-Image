<?php

/* 
* I've created this function for resize image after upload it on your website
* For example, for me it works like this :
*/

$docName = $_POST['docName'];
$target_dir = "/assets/img/";
$target_file = $target_dir . basename($_FILES["mImgFile"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$imgName = $docName . "." . $imageFileType;
$extensions_arr = array("jpg","jpeg","png");

if(in_array($imageFileType,$extensions_arr) ){
  if(move_uploaded_file($_FILES['mImgFile']['tmp_name'],$target_dir.$imgName)){
    
    /* 
    * $target_dir is the directory where you want to resize the image
    * $imgName is the current image name
    * $imageFileType is the file type
    * $w is weight you want for the resizing image
    * $h is heigth you want for the resizing image
    */
    resizeImage($target_dir.$imgName, $imageFileType, $w, $h);
    
  }
}

?>
