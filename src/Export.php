<?php

namespace Task\Vladlink;

use Task\Vladlink\BuildTree;

class Export
{
    public static function export(string $fileName, bool $neadUrl, mixed $enclosure): void
    {
        $dir = 'result of work';
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $fileName = $dir . '/' . $fileName;
        $tree = new BuildTree($neadUrl, $enclosure);
        $text = $tree->buildTree();
        $file = fopen($fileName, 'w');
        fwrite($file, $text);
        fclose($file);
    }
}
