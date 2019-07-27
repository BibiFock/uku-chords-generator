<?php

namespace app;

define('ROOT_DIR', __DIR__ . '/');

spl_autoload_register(
    function ($classes) {
        include 'classes/' . str_replace('\\', '/', $classes) . '.php';
    }
);

use uku\Chord;

$options = [
    'fingers' => explode(',', ($_REQUEST['fingers'] ?? '0,1,2,4')),
    'name' => $_REQUEST['name'] ?? 'C'
];

$chord = new Chord($options);
$img = $chord->getImage();

if (empty($_REQUEST['debug'])) {
    header("Content-type: image/png");
}

imagepng($img);
imagedestroy($img);
