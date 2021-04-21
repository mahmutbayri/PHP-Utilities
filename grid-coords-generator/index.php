<?php

/**
 * Command
 * php index.php
 *
 * OPTIONS
 */
$totalWith = 600;
$totalHeight = 600;
$cols = 8;
$rows = 8;
$background = [150, 0, 0];
$textColor = [0, 0, 0];
$output = __DIR__ . '/grid-coords-generator.png';

####
$gridWith = $totalWith / $cols;
$gridHeight = $totalHeight / $rows;

$image = imagecreatetruecolor($totalWith, $totalHeight);
$bgColor = imagecolorallocate($image, ...$background);
$tColor = imagecolorallocate($image, ...$textColor);

foreach (range(0, $cols) as $col) {
    foreach (range(0, $rows) as $row) {

        $overlayText = sprintf('%s_%s', $col, $row);
        $fontWidth = imagefontwidth(4);
        $fontHeight = imagefontheight(4);

        imagefilledrectangle(
            $image,
            $col * $gridWith,
            $row * $gridHeight,
            $col * $gridWith + $gridWith,
            $row * $gridHeight + $gridHeight,
            $bgColor
        );

        imagestring(
            $image,
            4,
            $col * $gridWith + $gridWith / 2 - strlen($fontWidth) * $fontWidth,
            $row * $gridHeight + $gridHeight / 2 - $fontHeight,
            $overlayText,
            $tColor
        );
    }
}

imagepng($image, $output);
imagedestroy($image);
