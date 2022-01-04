<?php

declare(strict_types=1);

namespace Solution;

use \Utility\Stack;

/**
 * @see https://adventofcode.com/2021/day/10
 */
class Day10 extends Algorithm
{
    public function run()
    {
        // PART 1
        echo 'PUZZLE DAY 10 PART 1' . PHP_EOL;
        $data = $this->getDataArray();

        $stack = new Stack();
        $corruptedScore = 0;
        $incompleteScores = array();
        foreach ($data as $lineNumber => $line) {
            //echo PHP_EOL . $line . PHP_EOL;
            $stack->clear();

            foreach (str_split($line) as $char) {
                switch ($char) {
                    //opening bracket
                    case '(':
                    case '[':
                    case '{':
                    case '<':
                        $stack->push($char);
                        break;
                    default:
                        //closing bracket
                        switch ([$stack->peek(), $char]) {
                            case ['(', ')']:
                            case ['[', ']']:
                            case ['{', '}']:
                            case ['<', '>']:
                                $stack->pop();
                                break;
                            default:
                                //echo $line . PHP_EOL;
                                //echo '--> mismatch expected ' . $stack->peek() . ' found ' . $char . PHP_EOL;
                                switch ($char) {
                                    case ')':
                                        $corruptedScore += 3;
                                        break;
                                    case ']':
                                        $corruptedScore += 57;
                                        break;
                                    case '}':
                                        $corruptedScore += 1197;
                                        break;
                                    case '>':
                                        $corruptedScore += 25137;
                                        break;
                                }
                                continue 4;
                        }
                }
            }
            if (!$stack->isEmpty()) {
                //incomplete line
                //$stack->print();
                $score = 0;
                while (!$stack->isEmpty()) {
                    switch ($stack->pop()) {
                        case '(':
                            $score *= 5;
                            $score += 1;
                            break;
                        case '[':
                            $score *= 5;
                            $score += 2;
                            break;
                        case '{':
                            $score *= 5;
                            $score += 3;
                            break;
                        case '<':
                            $score *= 5;
                            $score += 4;
                            break;
                    }
                }
                //echo "score added $score" . PHP_EOL;
                array_push($incompleteScores, $score);
            }
        }
        echo "corrupted score is $corruptedScore" . PHP_EOL;

        // PART 2
        echo PHP_EOL . 'PUZZLE DAY 10 PART 2' . PHP_EOL;
        echo count($incompleteScores) . ' out of ' . count($data) . ' lines are incomplete' . PHP_EOL;
        echo 'incomplete score is ' . $this->getMedian($incompleteScores) . PHP_EOL;
    }

    private function getMedian(array $data): int
    {
        sort($data);
        return $data[floor(count($data) / 2)];
    }
}