<?php

namespace Tests;

use uku\Chord;

class ChordTest extends TestCase
{
    public function testValidFingersOptionsShouldBeTrue()
    {
        $set = [
            '0,0,0,0',
            '10,10,10,10',
            '99,99,10,10'
        ];

        foreach ($set as $fingers) {
            $this->assertEquals(
                Chord::validFingers($fingers),
                $fingers
            );
        }
    }

    public function testValidFingersOptionsShouldBeFalse()
    {
        $set = [
            ',0,0,0',
            '100,10,10,10',
            '00000'
        ];

        foreach ($set as $fingers) {
            $this->assertEquals(
                Chord::validFingers($fingers),
                null
            );
        }
    }

    public function testValidNameOptionsShouldBeTrue()
    {
        $set = [
            'C#sus4\'"sdf',
            'A',
            'Am7',
            'G#dim'
        ];

        foreach ($set as $name) {
            $this->assertEquals(
                Chord::validName($name),
                $name
            );
        }
    }

    public function testValidNameOptionsShouldBeFalse()
    {
        $set = [
            'amc7
de',
            'Am,7',
            'Am 12'
        ];

        foreach ($set as $name) {
            $this->assertEquals(
                Chord::validName($name),
                null
            );
        }
    }
}
