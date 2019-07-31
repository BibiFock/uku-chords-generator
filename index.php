<?php

namespace app;

define('ROOT_DIR', __DIR__ . '/');

spl_autoload_register(
    function ($classes) {
        include 'classes/' . str_replace('\\', '/', $classes) . '.php';
    }
);

use uku\Chord;

$debug = isset($_REQUEST['debug']) && $_REQUEST['debug'] === 'true';
$fingers = isset($_REQUEST['fingers']) ? $_REQUEST['fingers'] : null ;
$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null ;


$options = [
    'fingers' => explode(',', (Chord::validFingers($fingers) ?? '0,1,2,4')),
    'name' => Chord::validName($name) ?? 'C'
];

$chord = new Chord($options);
$img = $chord->getImage();

if (!$debug) {
    header('Content-type: image/png');
    header('Content-Disposition: inline; filename="' . $options['name'] . '"');
}

imagepng($img);
imagedestroy($img);
