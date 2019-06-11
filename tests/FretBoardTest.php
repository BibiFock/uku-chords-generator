<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use uku\FretBoard;

class FretBoardTest extends TestCase
{
    public function testGetTotalHeight()
    {
        $fret = new FretBoard([ 0, 1, 2,3 ]);

        $this->assertEquals(
            $fret->getTotalHeight(),
            43
        );
    }
}
