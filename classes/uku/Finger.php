<?php

namespace uku;

use uku\helpers\Image;

class Finger
{
    const BASE_WIDTH = 5;
    const BASE_HEIGHT = 5;

    protected $empty = false;
    protected $img = false;

    public function __construct($empty = false)
    {
        $this->empty = $empty;
    }

    public function draw()
    {
        $this->img = Image::makeImage(static::BASE_WIDTH, static::BASE_HEIGHT);

        if ($this->empty) {
            $this->drawEmpty();
        } else {
            $this->drawFill();
        }

        return $this->img;
    }

    protected function drawEmpty()
    {
        imagefilledrectangle($this->img, 1, 0, static::BASE_WIDTH - 2, 0, $this->getColorDark());
        imagefilledrectangle($this->img, 1, static::BASE_HEIGHT - 1, static::BASE_WIDTH - 2, static::BASE_HEIGHT - 1, $this->getColorDark());

        imagefilledrectangle($this->img, 0, 1, 0, static::BASE_HEIGHT - 2, $this->getColorDark());
        imagefilledrectangle($this->img, static::BASE_WIDTH - 1, 1, static::BASE_WIDTH - 1, static::BASE_HEIGHT - 2, $this->getColorDark());
    }

    protected function drawFill()
    {
        imagefilledrectangle($this->img, 1, 0, static::BASE_WIDTH - 2, static::BASE_HEIGHT, $this->getColorDark());

        imagefilledrectangle($this->img, 0, 1, static::BASE_WIDTH, static::BASE_HEIGHT - 2, $this->getColorDark());

        imagefilledrectangle($this->img, 1, 1, 1, 1, $this->getColorLight());
    }

    protected function getColorLight()
    {
        return imagecolorallocate($this->img, 255, 255, 255);
    }

    protected function getColorDark()
    {
        return imagecolorallocate($this->img, 0, 0, 0);
    }
}
