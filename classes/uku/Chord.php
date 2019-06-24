<?php

namespace uku;

use uku\helpers\Image;

class Chord
{
    const BASE_WIDTH = FretBoard::BASE_WIDTH + 10;
    const BASE_HEIGHT = 10;

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

        $this->img = Image::makeImage(static::BASE_WIDTH, $fretBoard->getTotalHeight() + 10);

        imagecopy($this->img, $imgFretBoard, 5, 5, 0, 0, $fretBoard::BASE_WIDTH, $fretBoard->getTotalHeight());

        return $this->img;
    }
}
