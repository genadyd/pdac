<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/16/21
 * Time: 1:02 PM
 */

use App\Controllers\FormController;
use App\Controllers\GalleryController;
use App\Controllers\UploadImageController;
use Bramus\Router\Router;
/*
 * bramus/router composer package
 * */
$router = new Router();
$router->get('/',
    function(){
        $controller = new FormController();
        echo $controller->index();
}
);
$router->get('/gallery',
    function(){
        $controller = new GalleryController();
        echo $controller->index();

    }
);
$router->post('/form_input',
    function(){
        $controller = new UploadImageController();
        $controller->uploadImage();
    }
);
$router->set404(function() {
    $controller = new FormController();
    echo $controller->index();
});
$router->run();
