<?php

namespace Solution;

/**
 * @see https://adventofcode.com/2021/day/1
 */
class Day1 extends Algorithm
{
    public function run()
    {
        // PART 1
        echo 'PUZZLE DAY 1 PART 1' . PHP_EOL;
        $data = $this->getIntArray();

        $previous = $data[0];
        $increase = 0;
        $decrease = 0;

        foreach ($data as $value) {
            if ($value > $previous) {
                $increase++;
            } elseif ($value < $previous) {
                $decrease++;
            }
            $previous = $value;
        }

        echo "times increased: $increase" . PHP_EOL;
        echo "times decreased: $decrease" . PHP_EOL;

        // PART 2
        echo PHP_EOL . 'PUZZLE DAY 1 PART 1' . PHP_EOL;

        $SIZE = 3;
        $increase = 0;
        $decrease = 0;
        foreach ($data as $key => $value) {
            //last windows has nothing to compare to
            if ($key >= count($data) - $SIZE) {
                break;
            }

            if ($value > $data[$key + $SIZE]) {
                $decrease++;
            } elseif ($value < $data[$key + $SIZE]) {
                $increase++;
            }
        }

        echo "times increased: $increase" . PHP_EOL;
        echo "times decreased: $decrease" . PHP_EOL;
    }
}