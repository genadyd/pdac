<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/17/21
 * Time: 3:17 AM
 */


namespace App\Controllers;


use App\Validators\ImgValidator;

class UploadImageController
{
 public function uploadImage(){
    if(isset($_FILES) && ImgValidator::validator($_FILES)){
        var_dump($_FILES);
    }else{
        header('Location:/');
    }

//     $image_size = getimagesize($_FILES['img']['tmp_name']);
//     if()

//     var_dump(getimagesize($_FILES['img']['tmp_name']));
//     var_dump(filesize($_FILES['img']['tmp_name']));
 }
 private function saveImage(array $img){

 }

}
