<?php

namespace Task\Vladlink;

class Converter
{
    private $data;

    public function __construct($filePath)
    {
        $this->data = $this->parseData($filePath);
        print_r($this->data);
    }

    private function parseData($file)
    {
        $filePath = realpath($file);

        if ($filePath === false) {
            throw new \Exception("File not found");
        }
        $data = file_get_contents($filePath);
        return json_decode($data, true);
    }
}