<?php

namespace Solution;

/**
 * @see https://adventofcode.com/2021/day/2
 */
class Day2 extends Algorithm
{
    public function run()
    {
        // PART 1
        echo 'PUZZLE 2 PART 1' . PHP_EOL;
        $data = $this->getDataArray();

        $horizontal = 0;
        $depth = 0;
        foreach ($data as $value) {
            $instruction = explode(' ', $value);
            switch($instruction[0]) {
                case "forward":
                    $horizontal += $instruction[1];
                    break;
                case "up":
                    $depth -= $instruction[1];
                    break;
                case "down":
                    $depth += $instruction[1];
                    break;
            }
        }

        echo "horizontal distance: $horizontal" . PHP_EOL;
        echo "depth: $depth" . PHP_EOL;
        echo 'horizontal distance * depth: ' .  $horizontal * $depth . PHP_EOL;

        //PART 2
        echo PHP_EOL . 'PUZZLE 2 PART 2' . PHP_EOL;

        $horizontal = 0;
        $depth = 0;
        $aim = 0;
        foreach ($data as $value) {
            $instruction = explode(' ', $value);
            switch($instruction[0]) {
                case "forward":
                    $horizontal += $instruction[1];
                    $depth += $aim * $instruction[1];
                    break;
                case "up":
                    $aim -= $instruction[1];
                    break;
                case "down":
                    $aim += $instruction[1];
                    break;
            }
        }

        echo "horizontal distance: $horizontal" . PHP_EOL;
        echo "depth: $depth" . PHP_EOL;
        echo 'horizontal distance * depth: ' .  $horizontal * $depth . PHP_EOL;
    }
}