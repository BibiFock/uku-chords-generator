<?php

namespace uku\helpers;

class Image
{
    const FONT = ROOT_DIR . 'assets/UbuntuMono-R.ttf';
    const FONT_SIZE = 10;

    public static function makeImage($width, $height)
    {
        $img = imagecreate($width, $height);
        imagecolorallocate($img, 255, 255, 255);

        return $img;
    }

    public static function writeText($img, $string, $x = 0, $y = 0, $size = null)
    {
        $black = imagecolorallocate($img, 0, 0, 0);

        imagettftext(
            $img,
            $size ?? static::FONT_SIZE,
            0,
            $x,
            $y,
            $black,
            static::FONT,
            $string
        );
    }
}
