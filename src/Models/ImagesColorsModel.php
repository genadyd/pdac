<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/17/21
 * Time: 6:58 PM
 */


namespace App\Models;


use PDO;

class ImagesColorsModel extends MainAbstractModel
{
    /**
     * @param int $img_id
     * @param array $colors_array
     * @return bool
     */
    public function create(int $img_id, array $colors_array):bool{
        $query = "INSERT INTO images_colors (image_id, color, percent) VALUES (:IMAGE, :COLOR, :PERCENT )";
        $st = $this->db->prepare($query);
        foreach ($colors_array as $key =>$val){
            $st->bindParam(":IMAGE", $img_id);
            $st->bindParam(":COLOR",$key);
            $st->bindParam(":PERCENT", $val);
            try{
            $st->execute();
            }catch (\Exception $e){
                /*record exception to log file*/
            }
        }
        return true;
    }

    /**
     * @return array|null
     */
    public function getAll():?array{
        $query = "SELECT image_id, color, percent FROM images_colors";
        $colors = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        $this->setDarkOrLightColorValue($colors);
        return $colors;
    }

    /**
     * @param array $colors_array
     */
    private function setDarkOrLightColorValue(array &$colors_array):void{
        foreach ($colors_array as $key => $color){
            $rgb_arr = explode(',',$color['color']);
            $r = $rgb_arr[0];
            $g = $rgb_arr[1];
            $b = $rgb_arr[2];
            $res_num = sqrt(
              0.299*($r*$r) + 0.587*($g*$g) + 0.144*($b*$b)
            );
            $colors_array[$key]['is_dark'] = $res_num<=127.5;
        }

    }

}
