<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/16/21
 * Time: 4:06 PM
 */


namespace App\Controllers;


class FormController extends MainDisplayAbstractController
{

    public function index()
    {
        $title = 'image form';
        $menu = $this->menu;
        $uri = $this->current_uri;
        $error = false;
        $styles = '/public/styles/form_styles.css';
        /*check if error exists*/
        if(isset($_SESSION['error_mess'])){
            /*if error message: display it*/
            $error = $_SESSION['error_mess'];
            /*remove message*/
            unset($_SESSION['error_mess']);
        }
        ob_start();
          require 'header.php';
          require 'form.php';
          require 'footer.php';
        return ob_get_clean();
    }
}
