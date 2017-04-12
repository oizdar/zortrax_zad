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
    print_r($closest);
} catch (InvalidArgumentException $e) {
    print_r("Error Occurred: {$e->getMessage()}\n");
}

