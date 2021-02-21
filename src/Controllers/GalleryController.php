<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/16/21
 * Time: 6:42 PM
 */


namespace App\Controllers;


use App\Models\ImagesColorsModel;
use App\Models\ImagesModel;

class GalleryController extends MainDisplayAbstractController
{
    private ImagesModel $images_model;
    private ImagesColorsModel $images_colors_model;
    public function __construct()
    {
        parent::__construct();
        $this->images_model = new ImagesModel();
        $this->images_colors_model = new ImagesColorsModel();
    }

    function index()
    {
        $images = $this->getGalleryObject();
        $title = 'image form';
        $menu = $this->menu;
        $uri = $this->current_uri;
        $styles = '/public/styles/gallery_styles.css';
        ob_start();
        require 'header.php';
        require 'gallery.php';
        require 'footer.php';
        return ob_get_clean();
    }
    private function getGalleryObject():array{
        $images = $this->images_model->getAll();/*get images*/
        $colors = $this->images_colors_model->getAll();/*get colors*/
        if($images && $colors){
            foreach ($colors as $color){
                $images[$color['image_id']]['colors'][] = $color;
            }
        }
       return $images;
    }
}
