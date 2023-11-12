<?php

namespace Task\Vladlink;

use Task\Vladlink\Parser;
use Task\Vladlink\Export;

class Converter
{
    private $data;

    public function __construct($filePath)
    {
        $this->data = $this->parseData($filePath);
    }

    private function parseData($file)
    {
        $filePath = realpath($file);

        if ($filePath === false) {
            throw new \Exception("File not found");
        }
        $data = file_get_contents($filePath);
        return json_decode($data, false);
    }

    public function parse()
    {
        $parser = new Parser();
        $parser->parse($this->data);
    }

    public function export()
    {
        $export = new Export();
        $export->data();
    }
}