<?php

declare(strict_types=1);
namespace Utility;

class Stack
{

    private int $top;
    private array  $stack = array();

    public function __construct()
    {
        $this->top = -1;
    }

    public function isEmpty(): bool
    {
        return $this->top < 0;
    }

    public function size(): int {
        return $this->top + 1;
    }

    public function push($element) {
        $this->stack[++$this->top] = $element;
    }

    public function pop() {
        if($this->isEmpty()) {
            return null;
        }
        return $this->stack[$this->top--];
    }

    public function peek() {
        if($this->isEmpty()) {
            return null;
        }
        return $this->stack[$this->top];
    }

    public function clear() {
        $this->top = -1;
    }

    public function print() {
        if($this->isEmpty()) {
            echo 'stack is empty' . PHP_EOL;
        } else {
            for ($i=0; $i <= $this->top; $i++) {
                echo ' ' . $this->stack[$i];
            }
            echo PHP_EOL;
        }
    }
}