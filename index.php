<?php

namespace app;

spl_autoload_register(
    function ($classes) {
        include 'classes/' . str_replace('\\', '/', $classes) . '.php';
    }
);

use uku\Chord;

$frets = '0123';
$text = 'C';

$chord = new Chord();
$chord->drawFrets();
$img = $chord->getImage();

header( "Content-type: image/png" );
imagepng( $img );
imagedestroy( $img );


