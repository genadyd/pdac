<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/17/21
 * Time: 1:55 PM
 */


namespace App\Validators;


use App\Traites\ImageDataArrayTrait;

class ImgValidator
{
    /*
     * validation method
     * static method - not need any class entity
     * @var array $image - $_FILES
     * @retrieve true if validation success, or set error message and go back if it failed
     * */
    static public function validator(array $image):bool{
        $keys_array = array_keys($image);
        if(count($keys_array) === 0){/*check if file size bigger than server setting*/
            $_SESSION['error_mess'] = 'Something went wrong';
        }else if ($image[$keys_array[0]]['error']>0){/*file not selected*/
            $_SESSION['error_mess'] = 'No file selected';
        }else if(!getimagesize($image[$keys_array[0]]['tmp_name'])){/*file is not image*/
            $_SESSION['error_mess'] = 'The file is not an image';
        }else if(filesize($image[$keys_array[0]]['tmp_name'])>2000000){/*check if file size bigger than 2M*/
            $_SESSION['error_mess'] = 'File size should not exceed 2 megabytes';
        }else{
            return true;
        }
        header('Location:/');
         /*
          * In this section I must return something to avoid the warning of IDE.
          * In PHP8 I can set in return type "multi type" as bool|void
         */
        return false;
    }

}
