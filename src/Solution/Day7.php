<?php

namespace Solution;

/**
 * @see https://adventofcode.com/2021/day/7
 */
class Day7 extends Algorithm
{
    public function run()
    {
        // PART 1
        echo 'PUZZLE DAY 7 PART 1' . PHP_EOL;
        $data = explode(',', $this->getDataArray()[0]);

        $median = $this->getMedian($data);
        echo 'median of ' . count($data) . ' crabs is ' . $median . PHP_EOL;

        $fuel_cost = 0;
        foreach ($data as $value) {
            $fuel_cost += abs($value - $median);
        }
        echo "fuel cost is $fuel_cost" . PHP_EOL;

        // PART 2
        echo PHP_EOL . 'PUZZLE DAY 7 PART 2' . PHP_EOL;
        $fuel_cost = pow(2, 100);
        $target_position = 0;
        $min_position = min($data);
        $max_position = max($data);
        //calculate fuel for every position
        foreach (range($min_position, $max_position) as $position) {
            $fuel = 0;
            foreach ($data as $crab) {
                $fuel += $this->calculateFuelCost(abs($crab - $position));
            }
            //keep min values
            if($fuel < $fuel_cost) {
                $fuel_cost = $fuel;
                $target_position = $position;
            }
        }

        echo "fuel cost is $fuel_cost for position $target_position" . PHP_EOL;
    }

    private function calculateFuelCost($distance): int
    {
        //return floor((pow($distance, 2) - 1) / 2);
        return ($distance * ($distance + 1)) / 2;
    }

    private function getMedian(array $data): int
    {
        sort($data);
        if (count($data) % 2 == 1) {
            return $data[floor(count($data) / 2)];
        } else {
            $upper = count($data) / 2;
            $lower = $upper - 1;
            return ($data[$upper] + $data[$lower]) / 2;
        }
    }
}