<?php

namespace Solution;

/**
 * @see https://adventofcode.com/2021/day/6
 */
class Day6 extends Algorithm
{
    private array $data;
    private array $days;

    public function run()
    {
        // PART 1
        echo 'PUZZLE DAY 6 PART 1' . PHP_EOL;
        $this->data = explode(',', $this->getDataArray()[0]);

        foreach (range(1, 80) as $day) {
            $this->simulateDay();
        }
        echo 'there are ' . count($this->data) . ' fish after 80 days' .  PHP_EOL;

        // PART 2
        echo PHP_EOL . 'PUZZLE DAY 6 PART 2' . PHP_EOL;
        $this->data = explode(',', $this->getDataArray()[0]);

        //save amount of fish by number of days until they reproduce
        $this->days = array_fill(0, 9, 0);
        foreach ($this->data as $fish_type) {
            $this->days[$fish_type]++;
        }

        foreach (range(1, 256) as $day) {
            $this->simulateDayPart2();
        }
        $this->printPart2();
        echo 'there are ' . array_sum($this->days) . ' fish after 256 days' .  PHP_EOL;
    }

    private function simulateDay()
    {
        $new_fish_list = array();
        foreach ($this->data as $key => $fish) {
            if ($fish > 0) {
                $this->data[$key]--;
            } else {
                $this->data[$key] = 6;
                array_push($new_fish_list, 8);
            }
        }

        if (count($new_fish_list) > 0) {
            $this->data = array_merge($this->data, $new_fish_list);
        }
    }

    private function simulateDayPart2() {
        $new_fish = $this->days[0];
        foreach (range(0,7) as $day) {
            $this->days[$day] = $this->days[$day + 1];
        }
        $this->days[6] += $new_fish;
        $this->days[8] = $new_fish;
    }

    private function print()
    {
        foreach ($this->data as $value) {
            echo "$value,";
        }
        echo PHP_EOL;
    }

    private function printPart2()
    {
        foreach ($this->days as $key=>$value) {
            if ($value > 0) {
                echo "Day $key| $value" . PHP_EOL;
            }
        }
    }
}