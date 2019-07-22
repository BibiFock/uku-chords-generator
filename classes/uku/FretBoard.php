<?php

namespace uku;

class FretBoard
{
    const BASE_WIDTH = 35;
    const BASE_HEIGHT = 10;
    const BORDER = 5;

    protected $x = FretBoard::BORDER;
    protected $y = 0;

    protected $fingers = false;
    protected $img = false;

    public function __construct($fingers = [])
    {
        $this->fingers = array_map(
            function ($finger) {
                return (int) $finger;
            },
            $fingers
        );
    }

    public function getImage()
    {
        $this->draw();

        return $this->img;
    }

    public function getTotalHeight()
    {
        return static::BASE_HEIGHT * $this->getNbFrets() + 3;
    }

    protected function draw()
    {
        $this->img = imagecreate(static::BASE_WIDTH, $this->getTotalHeight());
        imagecolorallocate($this->img, 255, 255, 255);

        for ($i = 0; $i < $this->getNbFrets(); $i++) {
            $this->makeFrets($i, $this->getFingersByFret($i));
        }
    }

    protected function makeFrets($line, $fingers)
    {
        $black = imagecolorallocate($this->img, 0, 0, 0);
        $grid = imagecolorallocate($this->img, 140, 120, 100);

        $y = $line * 10;
        if ($this->needFirstFrets()) {
            imagefilledrectangle(
                $this->img,
                $this->x,
                $this->y,
                static::BASE_WIDTH - static::BORDER - 1,
                $this->y + 2,
                $black
            );
        }
        $y += 2;
        imageline($this->img, $this->x, $y, static::BASE_WIDTH - static::BORDER - 1, $y, $grid);
        imageline($this->img, $this->x, $y + static::BASE_HEIGHT, static::BASE_WIDTH - static::BORDER - 1, $y + static::BASE_HEIGHT, $grid);

        for ($i = 0; $i < 4; $i++) {
            $x = $this->x + $i*8;
            imageline($this->img, $x, $y, $x, $y + static::BASE_HEIGHT, $grid);
            if (!in_array($i, $fingers)) {
                continue;
            }
            $finger = new Finger();
            imagecopy(
                $this->img,
                $finger->draw(),
                $x - floor($finger::BASE_WIDTH / 2),
                $y - floor($finger::BASE_HEIGHT / 2) + static::BASE_HEIGHT / 2,
                0,
                0,
                $finger::BASE_WIDTH,
                $finger::BASE_HEIGHT
            );
        }
    }

    protected function getNbFrets()
    {
        return 4;
    }

    protected function getFingersByFret($fret)
    {
        return array_keys(array_filter(
            $this->fingers,
            function ($finger) use ($fret) {
                return $finger === ($fret + 1);
            }
        ));
    }

    protected function needFirstFrets()
    {
        if (empty($this->fingers)) {
            return true;
        }

        foreach ($this->fingers as $fret) {
            if ($fret > $this->getNbFrets()) {
                return false;
            }
        }

        return true;
    }
}
