<?php

use Task\Vladlink\Converter;
use Task\Vladlink\db\Connection;
use Task\Vladlink\db\Migration;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';

if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

$pdo = Connection::connect();
Migration::migrate($pdo);

$doc = <<<DOC
converter -h

Generate diff

Usage:
  converter (-h|--help)
  converter (-v|--version)
  converter <fileJson> [--Url] [-n|--nested <namder>] [--nameFile <nameFile>] 

Options:
  -h --help                     Show this screen
  -v --version                  Show version
  -n --nested                   Specify the nesting limit
  --nameFile                    Specify the file name to save
  --Url                         Add URL to category
DOC;


$args = \Docopt::handle($doc, array('version' => 'converter 1.0'));

$fileJson = $args['<fileJson>'];
$neadUrl = $args['--Url'];
$nested = $args['<namder>'] ?? null;
$nameSaveFile = $args['<nameFile>'] ?? 'text.txt';

$parser = new Converter($fileJson);
$parser->parser();
$parser->export($nameSaveFile, $neadUrl, $nested);