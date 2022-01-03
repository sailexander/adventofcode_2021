<?php

namespace Solution;

use Solution\Day5\Board;
use Solution\Day5\Line;
use \Solution\Day5\Point;

/**
 * @see https://adventofcode.com/2021/day/5
 */
class Day5 extends Algorithm
{
    public function run()
    {
        // PART 1
        echo 'PUZZLE DAY 5 PART 1' . PHP_EOL;
        $data = $this->getDataArray();
        $lines = $this->readLines($data);

        $DIMENSION = 1000;
        $board = new Board($DIMENSION);
        $skipped = 0;

        foreach ($lines as $line) {
            if ($line instanceof Line) {
                //only use vertical and horizontal lines
                if (!$line->isHorizontal() && !$line->isVertical()) {
                    $skipped++;
                    continue;
                }
                //apply a line
                $points = $line->getPointArray();
                foreach ($points as $point) {
                    if ($point instanceof Point) {
                        try {
                            $board->increment($point->x, $point->y);
                        } catch (\Exception $e) {
                            echo $e->getMessage() . PHP_EOL;
                        }
                    }
                }
            }
        }
//        $board->print();
        echo "skipped $skipped diagonal lines" . PHP_EOL;
        echo 'board has ' . $board->countOverlaps() . ' overlaps' . PHP_EOL;

        // PART 2
        echo PHP_EOL . 'PUZZLE DAY 5 PART 2' . PHP_EOL;
        $board = new Board($DIMENSION);
        foreach ($lines as $line) {
            if ($line instanceof Line) {
                //apply a line
                $points = $line->getPointArray();
                foreach ($points as $point) {
                    if ($point instanceof Point) {
                        try {
                            $board->increment($point->x, $point->y);
                        } catch (\Exception $e) {
                            echo $e->getMessage() . PHP_EOL;
                        }
                    }
                }
            }
        }
//        $board->print();
        echo 'board has ' . $board->countOverlaps() . ' overlaps' . PHP_EOL;
    }

    private function readLines(array $data): array
    {
        $lines = array();
        foreach ($data as $value) {
            $points = explode(' -> ', $value);
            $p1 = explode(',', $points[0]);
            $p2 = explode(',', $points[1]);

            array_push(
                $lines,
                new Line($p1[0], $p1[1], $p2[0], $p2[1])
            );
        }
        return $lines;
    }
}

namespace Solution\Day5;

use Exception;

/**
 * Helpful data structures
 */
class Point
{
    public int $x;
    public int $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}

class Line
{
    private Point $p1;
    private Point $p2;

    public function __construct($x1, $y1, $x2, $y2)
    {
        $this->p1 = new Point($x1, $y1);
        $this->p2 = new Point($x2, $y2);
    }

    public function isHorizontal(): bool
    {
        return $this->p1->x == $this->p2->x;
    }

    public function isVertical(): bool
    {
        return $this->p1->y == $this->p2->y;
    }

    public function getPointArray() : array
    {
        $points = array();
        $x_range = range($this->p1->x, $this->p2->x);
        $y_range = range($this->p1->y, $this->p2->y);

        if($this->isVertical()) {
            foreach ($x_range as $x) {
                array_push($points, new Point($x, $this->p1->y));
            }
        } elseif ($this->isHorizontal()) {
            foreach ($y_range as $y) {
                array_push($points, new Point($this->p1->x, $y));
            }
        } else {
            foreach ($x_range as $index=>$x) {
                array_push($points, new Point($x, $y_range[$index]));
            }
        }

        return $points;
    }

    public function print()
    {
        echo $this->p1->x . ',' . $this->p1->y . ' to ' . $this->p2->x . ',' . $this->p2->y . PHP_EOL;
    }
}

class Board
{
    private int $size;
    private array $grid;

    public function __construct($size)
    {
        $this->size = $size;
        $this->grid = array_fill(
            0,
            $size,
            array_fill(0, $size, 0)
        );
    }

    /**
     * @throws Exception
     */
    public function get($x, $y)
    {
        if ($x < 0 || $y < 0 || $x >= $this->size || $y >= $this->size) {
            throw new Exception('Board out of bounds');
        }

        return $this->grid[$y][$x];
    }

    /**
     * @throws Exception
     */
    public function set($x, $y, $value)
    {
        if ($x < 0 || $y < 0 || $x >= $this->size || $y >= $this->size) {
            throw new Exception('Board out of bounds');
        }

        $this->grid[$y][$x] = $value;
    }

    /**
     * @throws Exception
     */
    public function increment($x, $y)
    {
        $this->set($x, $y, $this->get($x, $y) + 1);
    }

    public function print()
    {
        foreach ($this->grid as $row) {
            foreach ($row as $value) {
                //echo "$value ";
                if($value > 0) {
                    printf("%3d ", $value);
                } else {
                    echo '  . ';
                }
            }
            echo PHP_EOL;
        }
    }

    public function countOverlaps()
    {
        $count = 0;
        foreach ($this->grid as $row) {
            foreach ($row as $value) {
                if($value >= 2) {
                    $count++;
                }
            }
        }
        return $count;
    }
}



