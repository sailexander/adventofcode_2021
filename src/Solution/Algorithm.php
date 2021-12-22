<?php

namespace Solution;

abstract class Algorithm
{
    protected string $datafile;

    /**
     * @param string $datafile
     */
    public function __construct(string $datafile)
    {
        $this->datafile = $datafile;
    }

    public abstract function run();

    protected function getDataArray(): array
    {
        return file($this->datafile, FILE_IGNORE_NEW_LINES);
    }

    protected function getIntArray(): array
    {
        return array_map('intval', $this->getDataArray());
    }
}