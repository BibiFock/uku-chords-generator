<?php

namespace uku;

use uku\helpers\Image;

class Chord
{
    const BASE_WIDTH = FretBoard::BASE_WIDTH + 10;
    const BASE_HEIGHT = 14;
    const NAME_HEIGHT = 12;
    const BORDER_Y = 10;

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

        $this->img = Image::makeImage(
            static::BASE_WIDTH,
            $fretBoard->getTotalHeight() + static::BASE_HEIGHT + static::BORDER_Y
        );

        $y = static::BASE_HEIGHT - 1;
        Image::writeText(
            $this->img,
            $this->name,
            floor(FretBoard::BASE_WIDTH / 2) - (mb_strlen($this->name) - 1) * 4,
            $y,
            static::NAME_HEIGHT
        );

        $y += 6;

        imagecopy(
            $this->img,
            $imgFretBoard,
            5,
            $y,
            0,
            0,
            $fretBoard::BASE_WIDTH,
            static::BASE_HEIGHT + $fretBoard->getTotalHeight()
        );

        return $this->img;
    }
}
