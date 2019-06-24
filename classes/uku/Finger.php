<?php

namespace uku;

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
        $this->img = imagecreate(static::BASE_WIDTH, static::BASE_HEIGHT);
        imagecolorallocate($this->img, 255, 0, 0);

        return $this->img;
    }
}
