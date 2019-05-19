<?php

namespace app;

spl_autoload_register(
    function ($classes) {
        include 'classes/' . str_replace('\\', '/', $classes) . '.php';
    }
);

use uku\Chord;

$options = [
    'frets' => str_split('0124'),
    'text' => 'C'
];

$chord = new Chord($options);
$img = $chord->getImage();

header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
