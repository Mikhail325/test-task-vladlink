<?php

namespace Task\Vladlink;

use Task\Vladlink\db\RepositoryDB;

class BuildTree
{
    private $db;
    private $tab = "  ";
    private $neadUrl;
    private $enclosure;

    public function __construct(bool $neadUrl, mixed $enclosure)
    {
        $this->neadUrl = $neadUrl;
        $this->enclosure = $enclosure;
        $this->db = new RepositoryDB();
    }

    public function buildTree(): string
    {
        $result = '';
        $categories = $this->db->getCategories();
        foreach ($categories as $categore) {
            $name = $categore->{'name'};
            $data = $this->buildUrl($categore);
            $enclosure = substr_count($data, '/');

            if ($this->enclosure >= --$enclosure || $this->enclosure === null) {
                $url = $this->neadUrl ? " $data" : "\n";
                $data = str_repeat($this->tab, $enclosure) . $name . $url ;
                $result .= $data;
            }
        }
        return $result;
    }

    public function buildUrl(mixed $categore, string $url = ''): string
    {
        $idChild = $categore->{'id'};
        $idParent = $this->db->getParentId($idChild);
        $url = '/' . $categore->{'alias'} . $url;

        if ($idParent) {
            $categore = $this->db->getCategore($idParent);
            return $this->buildUrl($categore, $url);
        }

        return $url . "\n";
    }
}
