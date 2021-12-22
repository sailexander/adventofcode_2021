#!/usr/bin/env php
<?php
declare(strict_types=1);

$ROOT = __DIR__ . '/..';
require $ROOT . '/vendor/autoload.php';

if ($argc === 1) {
    echo "usage: main.php [1-25]" . PHP_EOL;
    return;
}

//run task for the day
$day = $argv[1];
$name = 'Solution\Day' . $day;

if (!file_exists($ROOT . '/src/Solution/Day' . $day . '.php')) {
    echo 'file for day ' . $day . ' does not exist.' . PHP_EOL;
    return;
}

$instance = new $name($ROOT . '/data/day' . $day);
$instance->run();
