<?php


namespace App\Traites;


trait ImageDataArrayTrait
{
    private function getImageDataArray(array $img): array
    {
        $keys_arr = array_keys($img);
        return $img[$keys_arr[0]];
    }
}
