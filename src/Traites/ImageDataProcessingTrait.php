<?php


namespace App\Traites;

/*
 * helper for repetitive operations
 * */

trait ImageDataProcessingTrait
{
    private function getImageDataArray(array $img): array
    {
        $keys_arr = array_keys($img);
        return $img[$keys_arr[0]];
    }
    private function getImageSizesByResourse($resource):array{
        return array(imagesy($resource), imagesx($resource));
    }
}
