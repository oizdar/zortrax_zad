<?php

class SumFinder
{
    protected const NUMBERS_TO_SUM = 3;

    protected $searchList = [];

    protected $sumArray = [];

    public function __construct(array $array)
    {
        if(!is_array($array) || !count($array) === static::NUMBERS_TO_SUM) {
            throw new InvalidArgumentException('Array must have at least three parameters.');
        }
        $this->searchList = $array;
    }

    protected function renderSumArray()
    {
        $n = count($this->searchList);
        $second = 1;
        $third = 2;
        for($i = 0; $i < $n - 2; $i++) {
            for($x = $second; $x < $n - 1; $x++) {
                for($y = $third; $y < $n; $y++) {
                    $sum = $this->searchList[$i] + $this->searchList[$x] + $this->searchList[$y];
                    $sumCounter = 0;
                    while(isset($this->sumArray[$sum][$sumCounter])) {
                        $sumCounter++;
                    }
                    $this->sumArray[$sum][$sumCounter] = [$i => $this->searchList[$i], $x => $this->searchList[$x], $y => $this->searchList[$y]];
                }
                $third++;
            }
            $second++;
            $third = $second+1;
        }
        ksort($this->sumArray);
    }

    public function findClosestSum(int $x)
    {
        $this->renderSumArray();
        $sumList = array_keys($this->sumArray);
        $y = $x;
        $lowest = reset($sumList);
        $highest = end($sumList);

        if($this->checkSumExists($x, $lowest, $highest)) {
            return $this->returnIfResultIsValid($x);
        }

        do {
            $x++;
            $y--;
            if($this->checkSumExists($x, $lowest, $highest)) {
                return $this->returnIfResultIsValid($x);
            }
            if($this->checkSumExists($y, $lowest, $highest)) {
                return $this->returnIfResultIsValid($y);
            }
        } while (true);

    }

    protected function checkSumExists(int $x, $lowest, $highest) : bool
    {
        if ($lowest <= $x && $x <= $highest) {
            return isset($this->sumArray[$x]);
        }
        return false;
    }

    protected function returnIfResultIsValid(int $sum)
    {
        if(count($this->sumArray[$sum]) > 1) {
            throw new InvalidArgumentException('Invalid array was given, more than one result is correct');
        }
        return $this->sumArray[$sum][0];
    }
}