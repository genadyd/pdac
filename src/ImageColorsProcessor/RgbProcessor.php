<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/18/21
 * Time: 1:48 PM
 */


namespace App\ImageColorsProcessor;

use App\Traites\ImageDataProcessingTrait;

class RgbProcessor
{
    use ImageDataProcessingTrait;

    private string $image_url;
    private array $image_data_array;

    public function __construct($image_url)
    {
        $this->image_url = realpath($image_url);
        $this->image_data_array = getimagesize($this->image_url);

    }

    public function processor(): array
    {
        $file_resource = $this->createImgResource();/*get image resource by url*/
        $colors_array = $this->getColorsArray($this->createMiniature($file_resource)); /* get pixels quantity of each color in the image */
        return ($this->percentCalculate($colors_array));/* retrieve colors-percents array where key:color, val:percent*/
    }

    /**
     * @return false|\GdImage|resource
     */
    private function createImgResource()
    {
        return $this->image_data_array['mime'] === "image/png" ? imagecreatefrompng($this->image_url) : imagecreatefromjpeg($this->image_url);
    }

    /**
     * @param $resource
     * @param int $new_width : this parameter was selected empirically
     * @return false|\GdImage|resource
     */
    private function createMiniature($resource, int $new_width = 12)
    {
        list($height, $width) = $this->getImageSizesByResourse($resource);

        /**
         * if res image equal or bigger than original
         * do nothing, just return resource of original image
         * */
        if ($width <= $new_width) return $resource;

//     miniature size calc ===============
        $new_height = floor($height * ($new_width / $width));

//      make temp img ===================
        $tmp_img = imagecreatetruecolor($new_width, $new_height);

//      save resized image ========================
        imagecopyresized($tmp_img, $resource, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        return $tmp_img;
    }

    private function getColorsArray($img_resource): array
    {
        list($height, $width) = $this->getImageSizesByResourse($img_resource);

        $colors_array = array();

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $color = imagecolorat($img_resource, $x, $y);
                $r = ($color >> 16) & 0xFF;
                $g = ($color >> 8) & 0xFF;
                $b = $color & 0xFF;
                $colors_str = $r . ',' . $g . ',' . $b;

                if (!isset($colors_array[$colors_str])) {
                    $colors_array[$colors_str] = 1;
                } else
                    $colors_array[$colors_str]++;

            }
        }
        return $colors_array;
    }

    private function percentCalculate(array $colors_array): array
    {
        $array_res = array();
        $values_sum = array_sum($colors_array);
        foreach ($colors_array as $key => $value) {
            // percent_calc and res array save ==========================
            $array_res[$key] = round(($value / $values_sum) * 100, 3);
        }
        arsort($array_res);
        return array_slice($array_res, 0, 5);
    }
}
