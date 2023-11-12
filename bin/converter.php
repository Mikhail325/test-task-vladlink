<?php

use Task\Vladlink\Converter;
use Task\Vladlink\Connection;
use Task\Vladlink\Migration;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';

if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

$pdo = Connection::connect();
Migration::migrate($pdo);

// $doc = <<<DOC
// gendiff -h

// Generate diff

// Usage:
//   gendiff (-h|--help)
//   gendiff (-v|--version)
//   gendiff [--format <fmt>] <firstFile>

// Options:
//   -h --help                     Show this screen
//   -v --version                  Show version
// DOC;


// $args = \Docopt::handle($doc, array('version' => 'GenDiff 1.0'));
// $diff = genDiff($args['<firstFile>'], $args['--format']);
// print_r($diff);

$parser = new Converter('categories.json');
$parser->parse();
$parser->export();