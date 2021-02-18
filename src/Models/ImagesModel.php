<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/17/21
 * Time: 6:57 PM
 */


namespace App\Models;


use App\Db\DbConnection;
use App\Traites\ImageDataArrayTrait;
use PDO;

class ImagesModel
{
    use ImageDataArrayTrait;
    private ?PDO $db;
    public function __construct()
    {
        $this->db = DbConnection::getConnection();
    }

    public function saveIntoDir(array $img):?string{

        $img_arr = $this->getImageDataArray($img);
        $target_path ='img/'.$img_arr['name'];
        /*
         * save image
         * */
        if(move_uploaded_file($img_arr['tmp_name'], $target_path)) {
            chmod($target_path, 0777);
            return $target_path;
        }else{
            echo $_SESSION['error_mess'] = 'Something went wrong';
            header('Location:/');
        }
    }
  public function create(array $img, string $image_url):?int{
        $img_arr = $this->getImageDataArray($img);
        $query = "INSERT INTO images (name, url) VALUES (:NAME, :URL)";
        $st = $this->db->prepare($query);
        $st->bindParam(":NAME", $img_arr['name'], PDO::PARAM_STR);
        $st->bindParam(":URL", $image_url, PDO::PARAM_STR);
        $st->execute();
        return $this->db->lastInsertId();

  }
}
