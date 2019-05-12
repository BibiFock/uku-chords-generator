<?php
const BASE_X = 4;
const BASE_WIDTH = 28;
const BASE_HEIGHT = 10;

$frets = '0123';
$text = 'C';

function makeFrets($img, $line) {
    $grid = imagecolorallocate($img, 0, 0, 0);

    $y = $line * 10;
    imageline($img, BASE_X, $y, BASE_WIDTH, $y, $grid);
    imageline($img, BASE_X, $y + BASE_HEIGHT, BASE_WIDTH, $y + BASE_HEIGHT, $grid);

    for ($i = 0; $i < 4; $i++) {
        $x = BASE_X + $i*8;
        imageline($img, $x, $y , $x, $y + BASE_HEIGHT, $grid);
    }
}

$img = imagecreate(BASE_WIDTH + BASE_X, BASE_HEIGHT*3 + 20);

imagecolorallocate($img, 255, 255, 255);

makeFrets($img, 1);
makeFrets($img, 2);
makeFrets($img, 3);
// die('oki');



// imageline($img, 10, 10, 10, 19, $grid);
// imageline($img, 18, 10, 18, 19, $grid);
// imageline($img, 26+1, 10, 26+1, 19, $grid);
// imageline($img, 34+2, 10, 34+2, 19, $grid);
// imageline($img, 34+2, 10, 34+2, 19, $grid);

header( "Content-type: image/png" );
imagepng( $img );
imagedestroy( $img );


