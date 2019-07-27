<?php

namespace Tests;

use uku\FretBoard;

class FretBoardTest extends TestCase
{
    public function testGetBaseLineShouldAtLeastReturn4FirstLines()
    {
        $this->getBaseLine('0,0,0,0', [0, 4]);
        $this->getBaseLine('5,6,7,8', [4, 8]);
    }

    public function testGetBaseLineShouldReturnClosest4Limit()
    {
        $this->getBaseLine('7,6,5,5', [4, 8]);
    }

    public function testGetBaseLineShouldIgnoreEmptyFrets()
    {
        $this->getBaseLine('0,5,6,7', [4, 8]);
        $this->getBaseLine('0,0,5,7', [4, 8]);
    }

    public function testGetBaseLineShouldCenterFinger()
    {
        $this->getBaseLine('0,0,5,0', [3, 7]);
        $this->getBaseLine('0,6,5,0', [3, 7]);
    }

    public function testGetBaseLineShouldTookShowAllFingers()
    {
        $this->getBaseLine('1,1,9,10', [0, 10]);
        $this->getBaseLine('4,0,9,10', [3, 10]);
    }

    protected function getBaseLine($in, $out)
    {
        $cls = new FretBoard(explode(',', $in));
        $method = static::getProtectedMethod($cls, 'getBaseLine');

        $result = $method->invokeArgs($cls, []);
        $this->assertEquals($out, $result);
    }
}
