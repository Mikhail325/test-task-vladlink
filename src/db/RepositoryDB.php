<?php

namespace Task\Vladlink\db;

use Task\Vladlink\db\Connection;
use Carbon\Carbon;

class RepositoryDB
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
    }

    public function setCategories($category): void
    {
        $sql = 'INSERT INTO categories (id, name, alias, created_at) VALUES (:id, :name, :alias, :created_at)';
        $sqlRequest = $this->pdo->prepare($sql);
        $sqlRequest->execute([
            'id' => $category->{'id'},
            'name' => $category->{'name'},
            'alias' => $category->{'alias'},
            'created_at' => Carbon::now()
        ]);
    }

    public function setParents($parentId, $childrensId): void
    {
        $sql = 'INSERT INTO parents (parent_id, childrens_id, created_at) VALUES (:parent_id, :childrens_id, :created_at)';
        $sqlRequest = $this->pdo->prepare($sql);
        $sqlRequest->execute([
            'parent_id' => $parentId,
            'childrens_id' => $childrensId,
            'created_at' => Carbon::now()
        ]);
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM categories;";
        $sqlRequest = $this->pdo->prepare($sql);
        $sqlRequest->execute();
        return $sqlRequest->fetchAll(\PDO::FETCH_CLASS);
    }

    public function getCategore($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id;";
        $sqlRequest = $this->pdo->prepare($sql);
        $sqlRequest->execute([
            'id' => $id
        ]);
        return $sqlRequest->fetch(\PDO::FETCH_LAZY);
    }

    public function getParentId($childrensId)
    {
        $sql = "SELECT parent_id FROM parents WHERE childrens_id = :childrens_id;";
        $sqlRequest = $this->pdo->prepare($sql);
        $sqlRequest->execute([
            'childrens_id' => $childrensId
        ]);
        return $sqlRequest->fetch(\PDO::FETCH_COLUMN, 0);
    }
}