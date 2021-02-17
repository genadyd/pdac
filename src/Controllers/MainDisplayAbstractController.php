<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/16/21
 * Time: 5:59 PM
 */


namespace App\Controllers;


abstract class MainDisplayAbstractController
{
    protected array $menu;
    protected string $current_uri;

   abstract function index();
   public function __construct()
   {
      $this->menu=$this->getMenu();
      $this->current_uri = $_SERVER['REQUEST_URI'];
   }

    protected function getMenu():array{
        return array(
          ['text'=>'add image', 'href'=>'/','is_current'=>false],
          ['text'=>'gallery', 'href'=>'/gallery','is_current'=>false]
   ) ;


   }
}
