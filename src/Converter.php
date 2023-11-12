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

    public function parser()
    {
        $parser = new Parser();
        $parser->addDataParserInDB($this->data);
    }

    public function export($fileName, $neadUrl = true, $enclosure = null)
    {
        Export::export($fileName, $neadUrl, $enclosure);
    }
}