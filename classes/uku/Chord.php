<?php

namespace uku;

use uku\helpers\Image;

class Chord
{
    const BASE_WIDTH = FretBoard::BASE_WIDTH + 10;
    const BASE_HEIGHT = 14;
    const NAME_HEIGHT = 12;

    protected $x = 0;
    protected $y = 0;

    protected $fingers = false;
    protected $name = false;
    protected $img = false;

    public function __construct($options = [])
    {
        foreach ($options as $key => $value) {
            if (isset($this->{$key})) {
                $this->{$key} = $value;
            }
        }
    }

    public function getImage()
    {
        $fretBoard = new FretBoard($this->fingers);
        $imgFretBoard = $fretBoard->getImage();

        $this->img = Image::makeImage(static::BASE_WIDTH, $fretBoard->getTotalHeight() + static::BASE_HEIGHT);

        imagecopy(
            $this->img,
            $imgFretBoard,
            5,
            static::BASE_HEIGHT,
            0,
            0,
            $fretBoard::BASE_WIDTH,
            static::BASE_HEIGHT + $fretBoard->getTotalHeight()
        );

        Image::writeText(
            $this->img,
            $this->name,
            floor(FretBoard::BASE_WIDTH / 2) - (mb_strlen($this->name) - 1) * 4,
            static::BASE_HEIGHT - 1,
            static::NAME_HEIGHT
        );


        return $this->img;
    }
}
