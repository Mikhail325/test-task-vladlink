<?php

namespace Task\Vladlink;

use Task\Vladlink\db\RepositoryDB;

class Parser
{
    private $db;
    private $parentId = [];

    public function __construct()
    {
        $this->db = new RepositoryDB();
    }

    public function addDataParserInDB($childrens)
    {
        foreach ($childrens as $categore) {
            $this->db->setCategories($categore);

            if (!empty($this->parentId)) {
                $this->db->setParents(end($this->parentId), $categore->{'id'});
            }

            if (property_exists($categore, 'childrens')) {
                array_push($this->parentId, $categore->{'id'});
                $this->addDataParserInDB($categore->{'childrens'});
            }
        }
        array_pop($this->parentId);
    }
}