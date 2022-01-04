<?php

namespace Solution;

/**
 * @see https://adventofcode.com/2021/day/9
 */
class Day9 extends Algorithm
{
    private array $basins;

    public function run()
    {
        // PART 1
        echo 'PUZZLE DAY 9 PART 1' . PHP_EOL;
        $this->data = $this->getDataArray();

        //find low points
        $riskLevel = 0;
        $xMax = strlen($this->data[0]) - 1;
        $yMax = count($this->data) - 1;
        $lowPoints = array();
        foreach (range(0, $yMax) as $y) {
            foreach (range(0, $xMax) as $x) {
                $height = $this->data[$y][$x];

                //check left
                if ($x > 0 && $this->data[$y][$x - 1] <= $height) {
                    echo '.';
                    continue;
                }
                //check right
                if ($x < $xMax && $this->data[$y][$x + 1] <= $height) {
                    echo '.';
                    continue;
                }
                //check top
                if ($y > 0 && $this->data[$y - 1][$x] <= $height) {
                    echo '.';
                    continue;
                }
                //check bottom
                if ($y < $yMax && $this->data[$y + 1][$x] <= $height) {
                    echo '.';
                    continue;
                }
                $riskLevel += $height + 1;
                array_push($lowPoints, array('x' => $x, 'y' => $y));
                echo $height;
            }
            echo PHP_EOL;
        }
        echo 'found ' . count($lowPoints) . ' low points' . PHP_EOL;
        echo "total risk level of all low points is $riskLevel" . PHP_EOL;

        // PART 2
        echo PHP_EOL . 'PUZZLE DAY 9 PART 2' . PHP_EOL;

        //$this->printMap($this->data);
        //mark basis per low point
        $this->basins = array_fill(
            0,
            $yMax + 1,
            array_fill(0, $xMax + 1, -1)
        );
        foreach ($lowPoints as $key => $point) {
            $x = $point['x'];
            $y = $point['y'];
            $this->explore($x, $y, $key+1);
        }
        //$this->printMap($this->basins);

        //count basin sizes
        $basinSizes = array_fill(1,count($lowPoints), 0);
        foreach ($this->basins as $row) {
            foreach ($row as $value) {
                if($value >= 0) {
                    $basinSizes[$value]++;
                }
            }
        }
        arsort($basinSizes);
        $total_size = 1;
        $count = 0;
        foreach ($basinSizes as $key=>$size) {
            if($count >= 3) {
                break;
            }
            echo "$key has $size blocks" . PHP_EOL;
            $total_size *= $size;
            $count++;
        }
        echo "total size is $total_size" .  PHP_EOL;
    }

    private function explore($x, $y, $key) {
//        echo $this->basins[$y][$x] . " at $x $y" . PHP_EOL;
        if($x < 0 || $y < 0 || $x >= count($this->basins[0]) || $y >= count($this->basins)) {
            return;
        }
        if($this->data[$y][$x] == 9 || $this->basins[$y][$x] == $key) {
            return;
        }
        $this->basins[$y][$x] = $key;
        $this->explore($x-1, $y, $key);
        $this->explore($x, $y-1, $key);
        $this->explore($x+1, $y, $key);
        $this->explore($x, $y+1, $key);
    }

    private function printMap(array $map)
    {
        echo PHP_EOL;
        foreach ($map as $row) {
            if(is_string($row)) {
                $row = str_split($row);
            }
            foreach ($row as $value) {
                if ($value == 9 || $value == -1) {
                    echo '████';
                } else {
                    printf("%3d ", $value);
                    //echo $value;
                    //echo ' ';
                }
            }
            echo PHP_EOL;
        }
    }
}