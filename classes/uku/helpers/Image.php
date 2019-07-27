<?php

namespace uku\helpers;

class Image
{
    const FONT = ROOT_DIR . 'assets/UbuntuMono-R.ttf';

    public static function makeImage($width, $height)
    {
        $img = imagecreate($width, $height);
        imagecolorallocate($img, 255, 255, 255);

        return $img;
    }

    public static function writeText($img, $x, $y, $string)
    {
        $black = imagecolorallocate($img, 0, 0, 0);

        imagettftext(
            $img,
            10,
            0,
            $x,
            $y,
            $black,
            static::FONT,
            $string
        );
    }
}
