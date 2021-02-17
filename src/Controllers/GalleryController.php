<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/16/21
 * Time: 6:42 PM
 */


namespace App\Controllers;


class GalleryController extends MainDisplayAbstractController
{

    function index()
    {
        $title = 'image form';
        $menu = $this->menu;
        $uri = $this->current_uri;
        ob_start();
        require 'header.php';
        require 'gallery.php';
        require 'footer.php';
        return ob_get_clean();
    }
}
