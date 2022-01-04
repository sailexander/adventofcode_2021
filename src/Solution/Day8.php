<?php

namespace Solution;

/**
 * @see https://adventofcode.com/2021/day/8
 */
class Day8 extends Algorithm
{
    public function run()
    {
        // PART 1
        echo 'PUZZLE DAY 8 PART 1' . PHP_EOL;
        $data = $this->getDataArray();

        $output_codes = array();
        foreach ($data as $line) {
            $output_value = explode(' | ', $line)[1];
            $output_codes = array_merge($output_codes, explode(' ', $output_value));
        }
        //unique lengths: 1=>2 4=>4 7=>3 8=>7
        $count = 0;
        foreach ($output_codes as $code) {
            $length = strlen($code);
            if( $length == 2 || $length == 3 || $length == 4 || $length == 7) {
                $count++;
            }
        }
        echo "the output codes contain $count unique numbers" . PHP_EOL;
    }
}