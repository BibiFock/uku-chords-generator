<?php

namespace uku;

use uku\helpers\Image;

class FretBoard
{
    const BASE_WIDTH = 45;
    const BASE_HEIGHT = 10;
    const FRET_WIDTH = 8;
    const FIRST_FRET_HEIGHT = 2;

    const BORDER = 10;
    const NB_FRET_MIN = 4;

    protected $x = FretBoard::BORDER;
    protected $y = 6;

    protected $fretMin = false;
    protected $fretMax = false;
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
        [$this->fretMin, $this->fretMax] = $this->getBaseLine();
    }

    public function getImage()
    {
        $this->draw();

        return $this->img;
    }

    public function getTotalHeight()
    {
        return static::FIRST_FRET_HEIGHT + static::BASE_HEIGHT * $this->getNbFrets() + 8;
    }

    protected function draw()
    {
        $this->img = imagecreate(static::BASE_WIDTH, $this->getTotalHeight());
        imagecolorallocate($this->img, 255, 255, 255);

        if ($this->needFirstFrets()) {
            imagefilledrectangle(
                $this->img,
                $this->x,
                $this->y,
                static::BASE_WIDTH - static::BORDER - 1,
                $this->y + 2,
                imagecolorallocate($this->img, 0, 0, 0)
            );
            $this->y += 2;
        } else {
            Image::writeText(
                $this->img,
                $this->fretMin + 2,
                $this->x - static::BORDER,
                $this->y + 2 * static::BASE_HEIGHT
            );
        }

        // first empty fret
        foreach ($this->getFingersByFret(0) as $idString) {
            $this->addFinger(
                $this->getFingerX($idString),
                -ceil(Finger::BASE_HEIGHT/2),
                true
            );
        }
        // then the other frets
        for ($i = 0; $i < $this->getNbFrets(); $i++) {
            $this->makeFrets(
                $i,
                $this->fretMin + $i +1
            );
        }
    }

    protected function makeFrets($line, $fret)
    {
        $black = imagecolorallocate($this->img, 0, 0, 0);
        $grid = imagecolorallocate($this->img, 140, 120, 100);

        $fingers = $this->getFingersByFret($fret);

        $y = $this->y + $line * static::BASE_HEIGHT;
        imageline($this->img, $this->x, $y, static::BASE_WIDTH - static::BORDER - 1, $y, $grid);
        imageline($this->img, $this->x, $y + static::BASE_HEIGHT, static::BASE_WIDTH - static::BORDER - 1, $y + static::BASE_HEIGHT, $grid);
        for ($i = 0; $i < 4; $i++) {
            $x = $this->getFingerX($i);
            imageline($this->img, $x, $y, $x, $y + static::BASE_HEIGHT, $grid);
            if (!in_array($i, $fingers)) {
                continue;
            }
            $this->addFinger($x, $y);
        }
    }

    protected function getFingerX($idString)
    {
        return $this->x + $idString * static::FRET_WIDTH;
    }

    protected function addFinger($x, $y, $empty = false)
    {
        imagecopy(
            $this->img,
            Finger::getImg($empty),
            $x - floor(Finger::BASE_WIDTH / 2),
            $y - floor(Finger::BASE_HEIGHT / 2) + static::BASE_HEIGHT / 2,
            0,
            0,
            Finger::BASE_WIDTH,
            Finger::BASE_HEIGHT
        );
    }

    protected function getNbFrets()
    {
        return $this->fretMax - $this->fretMin;
    }

    /**
     * get the max and min line to show for the fret
     * @return array [ min, max ]
     */
    protected function getBaseLine()
    {
        $fingers = array_filter(
            $this->fingers,
            function ($finger) {
                return $finger != 0;
            }
        );
        if (empty($fingers)) {
            return [0, static::NB_FRET_MIN];
        }
        $min = min($fingers) - 1;
        $max = max($fingers);

        $diff = $max - $min;
        if ($diff < static::NB_FRET_MIN) {
            $max = $min + static::NB_FRET_MIN;
            if ($diff <= 2) {
                $min--;
                $max--;
            }
        }
        return [ $min, $max ];
    }

    protected function getFingersByFret($fret)
    {
        return array_keys(array_filter(
            $this->fingers,
            function ($finger) use ($fret) {
                return $finger === $fret;
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
