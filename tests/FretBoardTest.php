<?php

namespace Tests;

use uku\FretBoard;

class FretBoardTest extends TestCase
{
    public function testHeigthShouldBeTheSameWithOrWithoutFirstFret()
    {
        $fret = new FretBoard(str_split('0000'));
        $fretWithoutFirst = new FretBoard(str_split('5555'));

        $this->assertEquals(
            $fret->getTotalHeight(),
            $fretWithoutFirst->getTotalHeight()
        );
    }

    public function testGetBaseLineShouldAtLeastReturn4FirstLines()
    {
        $this->testBaseLine('0,0,0,0', [1, 4]);
        $this->testBaseLine('5,6,7,8', [4, 8]);
    }

    public function testGetBaseLineShouldReturnClosest4Limit()
    {
        $this->testBaseLine('7,6,5,5', [4, 8]);
    }

    public function testGetBaseLineShouldIgnoreEmptyFrets()
    {
        $this->testBaseLine('0,5,6,7', [4, 8]);
        $this->testBaseLine('0,0,5,0', [4, 8]);
    }

    public function testGetBaseLineShouldTookShowAllFingers()
    {
        $this->testBaseLine('1,1,9,10', [0, 10]);
        $this->testBaseLine('4,0,9,10', [3, 10]);
    }

    protected function testBaseLine($in, $out)
    {
        $cls = new FretBoard(explode(',', $in));
        $method = static::getProtectedMethod($cls, 'getBaseLine');

        $result = $method->invokeArgs($cls, []);
        $this->assertEquals($out, $result);
    }
}
