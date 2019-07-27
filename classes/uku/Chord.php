<?php

namespace uku;

use uku\helpers\Image;

class Chord
{
    const BASE_WIDTH = FretBoard::BASE_WIDTH + 10;
    const BASE_HEIGHT = 14;
    const FONT_SIZE = 12;
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
            static::BASE_HEIGHT + static::BORDER_Y + $fretBoard->getTotalHeight()
        );

        $y = static::BASE_HEIGHT - 1;
        $nameLength = mb_strlen($this->name);
        $fontSize = static::FONT_SIZE;

        Image::writeText(
            $this->img,
            $this->name,
            ceil(FretBoard::BASE_WIDTH / 2) - ($nameLength - 1) * 4,
            $y,
            $fontSize
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
