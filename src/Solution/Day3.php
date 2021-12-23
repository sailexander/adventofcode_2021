<?php

namespace Solution;

/**
 * @see https://adventofcode.com/2021/day/3
 */
class Day3 extends Algorithm
{
    public function run()
    {
        // PART 1
        echo 'PUZZLE 3 PART 1' . PHP_EOL;
        $data = $this->getDataArray();

        $gamma = '';
        $epsilon = '';
        //calculate most common bit per column
        for ($i = 0; $i < strlen($data[0]); $i++) {
            $result = $this->countBits($data, $i);
            $gamma .= strval($result['most']);
            $epsilon .= strval(1 - $result['most']);
        }
        echo "gamma (most): $gamma" . PHP_EOL;
        echo "epsilon (least): $epsilon" . PHP_EOL;
        echo 'power consumption: ' . bindec($gamma) * bindec($epsilon) . PHP_EOL;

        //PART 2
        echo PHP_EOL . 'PUZZLE 3 PART 2' . PHP_EOL;

        $new_data = array();
        //step through columns
        for ($i = 0; $i < strlen($data[0]); $i++) {
            $bit = $this->countBits($data, $i)['most'];
            //keep entries that match the most common bit on that column
            foreach ($data as $value) {
                if ($value[$i] == "$bit") array_push($new_data, $value);
            }
            if (count($new_data) == 1) break;
            $data = $new_data;
            $new_data = array();
        }
        $oxygen_rating = $new_data[0];
        echo "oxygen: $oxygen_rating" . PHP_EOL;

        $data = $this->getDataArray();
        $new_data = array();
        //step through columns
        for ($i = 0; $i < strlen($data[0]); $i++) {
            $bit = $this->countBits($data, $i)['most'];
            //keep entries that match the least common bit on that column
            foreach ($data as $value) {
                if ($value[$i] == 1 - $bit) array_push($new_data, $value);
            }
            if (count($new_data) == 1) break;
            $data = $new_data;
            $new_data = array();
        }
        $scrubber_rating = $new_data[0];
        echo "co2: $scrubber_rating" . PHP_EOL;

        echo 'life support rating: ' . bindec($oxygen_rating) * bindec($scrubber_rating) . PHP_EOL;
    }

    private function countBits(array $list, int $index) {
        $zeros = 0;
        $ones = 0;

        foreach ($list as $value) {
            if ($value[$index] == '0') {
                $zeros++;
            } else if ($value[$index] == '1') {
                $ones++;
            }
        }

        return array(
            0 => $zeros,
            1 => $ones,
            'most' => ($zeros > $ones ? 0 : 1)
        );
    }

    private function getSampleData() {
        return array(
            '00100',
            '11110',
            '10110',
            '10111',
            '10101',
            '01111',
            '00111',
            '11100',
            '10000',
            '11001',
            '00010',
            '01010'
        );
    }
}