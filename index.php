<?php

namespace app;

spl_autoload_register(
    function ($classes) {
        include 'classes/' . str_replace('\\', '/', $classes) . '.php';
    }
);

use uku\Chord;

$options = [
    'fingers' => str_split($_REQUEST['fingers'] ?? '0124'),
    'text' => $_REQUEST['text'] ?? 'C'
];

$chord = new Chord($options);
$img = $chord->getImage();

if (empty($_REQUEST['debug'])) {
    header("Content-type: image/png");
}

imagepng($img);
imagedestroy($img);
