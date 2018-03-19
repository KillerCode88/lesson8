<?php

include __DIR__ . '/certificate-text.php';


$image = imagecreatetruecolor(595, 842);

$backColor = imagecolorallocate($image, 28, 25, 206);
$textColor = imagecolorallocate($image, 210, 45, 45);

$boxFile = __DIR__ . '/cert1.png';
if (!file_exists($boxFile)) {
    echo 'Файл не найден!';
    exit;
}
$imBox = imagecreatefrompng($boxFile);

imagefill($image, 0, 0, $backColor);
imagecopy($image, $imBox, 0, 0, 0, 0, 595, 842);

$fontFile = __DIR__ . '/andantino.ttf';
if (!file_exists($fontFile)) {
    echo 'Шрифт не найден!';
    exit;
}
imagettftext($image, 50, 0, 170, 400, $textColor, $fontFile, $name);
imagettftext($image, 30, 0, 100, 600, $textColor, $fontFile, $correctString);
header('Content-Type: image/png');

imagepng($image);

