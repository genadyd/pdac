<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/17/21
 * Time: 3:17 AM
 */


namespace App\Controllers;


use App\Models\ImagesModel;
use App\Validators\ImgValidator;

class UploadImageController
{
    private ImagesModel $image_model;

    public function __construct()
    {
        $this->image_model = new ImagesModel();
    }

    public function uploadImage()
    {
        if (isset($_FILES) && ImgValidator::validator($_FILES)) {
            $image_path = $this->saveImage($_FILES);
            $id = $this->createImageRecording($_FILES ,$image_path);

        } else {
            header('Location:/');
        }
    }

    /*
     * private method saveImage
     * move uploaded image to "img" directory,
     * return path to saved image
     * @param array $img
     * @return string $image_path
     * */
    private function saveImage(array $img): string
    {
        return $this->image_model->saveIntoDir($img);
    }

    /*
     * private method createImageRecording
     * save uploaded image into DB,
     * @params array $img - image data array, string $url -  image url
     * @return int $new_record_id
     * */
    private function createImageRecording(array $img, string $url):int
    {
         return $this->image_model->create($img, $url);
    }

}
