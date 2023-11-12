<?php

namespace Task\Vladlink\db;

class Migration
{
    public static function migrate(\PDO $pdo): void
    {
        $data = file_get_contents('config/database.sql');
        /** @var string $data */
        $pdo->exec($data);
    }
}
