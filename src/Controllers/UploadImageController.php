<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/17/21
 * Time: 3:17 AM
 */


namespace App\Controllers;


use App\ImageColorsProcessor\RgbProcessor;
use App\ImageColorsProcessor\RgbProcessor1;
use App\Models\ImagesColorsModel;
use App\Models\ImagesModel;
use App\Validators\ImgValidator;

class UploadImageController
{
    private ImagesModel $image_model;
    private ImagesColorsModel $image_colors_model;


    public function __construct()
    {
        $this->image_model = new ImagesModel();/*get model object*/
        $this->image_colors_model = new ImagesColorsModel();

    }

    public function uploadImage()
    {
        if (isset($_FILES) && ImgValidator::validator($_FILES)) {
            $image_path = $this->saveImage($_FILES);/*save into target dir*/
            $id = $this->createImageRecording($_FILES, $image_path);/*save into DB*/
            $color_processor = new RgbProcessor($image_path);
            $colors_array = $color_processor->processor(); /* create percents array */
            $this->createImageColorsRecording($id, $colors_array);/*create colors-percents record*/
            header('Location:/gallery');
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
     * save uploaded image data into DB,
     * @params array $img - image data array, string $url -  image url
     * @return int $new_record_id
     * */
    private function createImageRecording(array $img, string $url): int
    {
        return $this->image_model->create($img, $url);
    }

    private function createImageColorsRecording(int $image_id, array $colors_array): bool
    {
        return $this->image_colors_model->create($image_id, $colors_array);
    }

}
