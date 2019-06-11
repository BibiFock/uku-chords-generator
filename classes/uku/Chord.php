<?php

namespace uku;

use uku\helpers\Image;

class Chord
{
    const BASE_WIDTH = 25;
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

        $this->img = Image::makeImage(static::BASE_WIDTH + 2.5 * 2, $fretBoard->getTotalHeight() + 10);

        imagecopy($this->img, $imgFretBoard, 2.5, 5, 0, 0, static::BASE_WIDTH, $fretBoard->getTotalHeight());

        return $this->img;
    }

    protected function drawFrets()
    {
        for ($i = 0; $i < $this->getNbFrets(); $i++) {
            $this->makeFrets($i);
        }
    }

    protected function makeFrets($line)
    {
        $grid = imagecolorallocate($this->img, 0, 0, 0);

        $y = $line * 10;
        if ($this->needFirstFrets()) {
            imagefilledrectangle(
                $this->img,
                $this->x,
                $this->y,
                static::BASE_WIDTH,
                $this->y + 2,
                $grid
            );
            $y += 2;
        }
        imageline($this->img, $this->x, $y, static::BASE_WIDTH, $y, $grid);
        imageline($this->img, $this->x, $y + static::BASE_HEIGHT, static::BASE_WIDTH, $y + static::BASE_HEIGHT, $grid);

        for ($i = 0; $i < 4; $i++) {
            $x = $this->x + $i*8;
            imageline($this->img, $x, $y, $x, $y + static::BASE_HEIGHT, $grid);
        }
    }

    protected function getTotalHeight()
    {
        return static::BASE_HEIGHT * $this->getNbFrets() + 1 + ($this->needFirstFrets() ? 2 : 0);
    }

    protected function getNbFrets()
    {
        return 4;
    }

    protected function needFirstFrets()
    {
        if (empty($this->frets)) {
            return true;
        }

        foreach ($this->frets as $fret) {
            if ($fret >= $this->getNbFrets()) {
                return false;
            }
        }

        return true;
    }
}
