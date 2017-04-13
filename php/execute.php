<?php

include 'SumFinder.php';
$array = [-1, 2, 1, -4];
$x = 1;

if($argc > 1) {
    $x = $argv[1];
}

try {
    $sumFinder = new SumFinder($array);
    $closest = $sumFinder->findClosestSum($x);
    echo "============================================ \n"
        . "$closest[0] is closest sum to $x in given data array \n"
        . 'It is sum of numbers: '. implode(', ', $closest[1]) . ".\n"
        . "=========================================== \n";

} catch (InvalidArgumentException $e) {
    print_r("Error Occurred: {$e->getMessage()}\n");
}

