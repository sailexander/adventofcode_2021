<?php

namespace Solution;

/**
 * @see https://adventofcode.com/2021/day/4
 */
class Day4 extends Algorithm
{
    public function run()
    {
        // PART 1
        echo 'PUZZLE DAY 4 PART 1' . PHP_EOL;

        $data = $this->getBingoData();
        $numbers = $data['numbers'];
        $game = array(
            $data['boards'],
            array_fill(
                0,
                $data['count'],
                array_fill(
                    0,
                    5,
                    array_fill(0, 5, false)
                )
            )
        );

        //main bingo loop
        foreach ($numbers as $key_n => $number) {
            echo "$number ";
            $this->drawNumber($game, $number);

            foreach ($game[1] as $key => $matches) {
                if ($this->checkBingo($matches)) {
                    echo PHP_EOL . "#$key_n BINGO at bord $key" . PHP_EOL;
                    $this->printBoard($game[0][$key], $game[1][$key]);
                    $sum_unmarked = $this->countUnmarked($game, $key);
                    echo "SUM unmarked at board $key: $sum_unmarked" . PHP_EOL;
                    echo "multiplied by last number $number: " . $sum_unmarked * $number . PHP_EOL;
                    return;
                }
            }
        }
    }

    private function getBingoData(): array
    {
        $input = $this->getDataArray();

        $STEP = 6;
        $bingo_numbers = explode(',', $input[0]);
        $board_count = 0;
        $bingo_boards = array();

        for ($i = 1; $i <= count($input) - $STEP; $i += $STEP) {
            array_push($bingo_boards, array(
                preg_split('/\s+/', trim($input[$i + 1])),
                preg_split('/\s+/', trim($input[$i + 2])),
                preg_split('/\s+/', trim($input[$i + 3])),
                preg_split('/\s+/', trim($input[$i + 4])),
                preg_split('/\s+/', trim($input[$i + 5]))
            ));
            $board_count++;
        }

        return array(
            'numbers' => $bingo_numbers,
            'boards' => $bingo_boards,
            'count' => $board_count
        );
    }

    private function printBoard(array $board, array $markers)
    {
        $GREEN = "\033[32m";
        $RESET = "\033[39m";
        foreach ($board as $key_r => $row) {
            foreach ($row as $key_v => $value) {
                if ($markers[$key_r][$key_v]) {
                    printf("$GREEN%3d $RESET", $value);
                } else {
                    printf("%3d ", $value);
                }
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

    private function printGame(array $game)
    {
        foreach ($game[0] as $key => $board) {
            $this->printBoard($board, $game[1][$key]);
        }
    }

    private function drawNumber(array &$game, int $number)
    {
        foreach ($game[0] as $key_b => $board) {
            foreach ($board as $key_r => $row) {
                foreach ($row as $key_v => $value) {
                    if ($value == $number) {
                        $game[1][$key_b][$key_r][$key_v] = true;
                    }
                }
            }
        }
    }

    private function checkBingo(array $matches): bool
    {

        //check columns
        $result = true;
        for ($col = 0; $col < 5; $col++) {
            for ($row = 0; $row < 5; $row++) {
                if ($matches[$row][$col] === false) {
                    $result = false;
                    break;
                }
            }
            if ($result) {
                return true;
            }
        }

        //check rows
        /*
        $result = true;
        foreach ($matches as $row) {
            foreach ($row as $value) {
                if ($value === false) {
                    $result = false;
                    break;
                }
            }
            if ($result) {
                return true;
            }
        }*/

        return false;
    }

    private function countUnmarked(array $game, int $index): int
    {
        $result = 0;
        foreach ($game[0][$index] as $key_r => $row) {
            foreach ($row as $key_v => $value) {
                if ($game[1][$index][$key_r][$key_v] === false) {
                    $result += $value;
                }
            }
        }
        return $result;
    }
}