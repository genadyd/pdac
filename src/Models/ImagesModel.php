<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/17/21
 * Time: 6:57 PM
 */


namespace App\Models;


use App\Traites\ImageDataProcessingTrait;
use PDO;

class ImagesModel extends MainAbstractModel
{
    use ImageDataProcessingTrait;

    /**
     * public method saveIntoDir
     * save img into directory and return target path
     * @return string $target_path : path to stored image
     * @var array $img
     */
    public function saveIntoDir(array $img): ?string
    {
        $img_arr = $this->getImageDataArray($img);
        $target_path = 'img/' . $img_arr['name'];
        /**
         * Save image
         */
        if (move_uploaded_file($img_arr['tmp_name'], $target_path)) {
            chmod($target_path, 0777);

        } else {
            $_SESSION['error_mess'] = 'Something went wrong';
            header('Location:/');
        }
        return $target_path;
    }

    /**
     * public method create - make new record in db
     * @table images
     * @param array $img
     * @param string $image_url
     * @return int|null
     */
    public function create(array $img, string $image_url): ?int
    {
        $img_arr = $this->getImageDataArray($img);
        $query = "INSERT INTO images (name, url) VALUES (:NAME, :URL)";
        $st = $this->db->prepare($query);
        $st->bindParam(":NAME", $img_arr['name'], PDO::PARAM_STR);
        $st->bindParam(":URL", $image_url, PDO::PARAM_STR);
        /** kill "Duplicate entry" exception */
        try {
            $st->execute();
        } catch (\Exception $e) {
            $_SESSION['error_mess'] = 'This file already exists';
            header('Location:/');
        }
        return $this->db->lastInsertId();
    }

    /**
     * @return array|null
     */
    public function getAll(): ?array
    {
        $query = "SELECT id, url FROM images ORDER BY created_at DESC ";
        $res = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        /** Restructuring images array */
        $images = array();
        foreach ($res as $val) {
            $images[$val['id']] = array(
                'url' => $val['url'],
                'colors' => array()
            );
        }
        return $images;
    }
}

