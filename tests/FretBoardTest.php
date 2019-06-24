<?php

namespace tests;

use PHPUnit\Framework\TestCase;
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
}
