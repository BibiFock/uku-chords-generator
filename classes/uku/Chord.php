<?php

namespace uku;

class Chord {
    const BASE_X = 0;
    const BASE_WIDTH = 25;
    const BASE_HEIGHT = 10;

    private $img = null;

    public function __construct()
    {
        $this->img = imagecreate(static::BASE_WIDTH, $this->getImgSize());
        imagecolorallocate($this->img, 255, 255, 255);
    }

    public function getImage()
    {
        return $this->img;
    }

    public function drawFrets()
    {
        for ($i = 0; $i < $this->getNbFrets(); $i++) {
            $this->makeFrets($i);
        }
    }

    protected function makeFrets($line)
    {
        $grid = imagecolorallocate($this->img, 0, 0, 0);

        $y = $line * 10;
        imageline($this->img, static::BASE_X, $y, static::BASE_WIDTH, $y, $grid);
        imageline($this->img, static::BASE_X, $y + static::BASE_HEIGHT, static::BASE_WIDTH, $y + static::BASE_HEIGHT, $grid);

        for ($i = 0; $i < 4; $i++) {
            $x = static::BASE_X + $i*8;
            imageline($this->img, $x, $y , $x, $y + static::BASE_HEIGHT, $grid);
        }
    }

    protected function getImgSize()
    {
        return static::BASE_HEIGHT * $this->getNbFrets() + 1;
    }

    protected function getNbFrets()
    {
        return 4;
    }
}
