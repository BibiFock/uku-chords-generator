<?php

namespace uku\helpers;

class Image
{
    public static function makeImage($width, $height)
    {
        $img = imagecreate($width, $height);
        imagecolorallocate($img, 255, 255, 255);

        return $img;
    }
}
