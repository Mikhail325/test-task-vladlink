<?php

namespace Task\Vladlink;

class Export
{
    private $db;
    private $tab = "  ";

    public function __construct()
    {
        $this->db = new RepositoryDB();
    }

    public function data()///111111111111111111111111111111111111111111
    {
        $result = '';
        $categories = $this->db->getCategories();
        foreach ($categories as $categore) {
            $name = $categore->{'name'};
            $data = $this->export($categore);
            $enclosure = substr_count($data, '/');
            $data = str_repeat($this->tab, $enclosure) . $name . " $data";
            $result .= $data;
        }
        print_r($result);
        return $result;
    }

    public function export($categore, $url = '')
    {
        $idChild = $categore->{'id'};
        $idParent = $this->db->getParentId($idChild);
        $url = '/' . $categore->{'alias'} . $url;

        if ($idParent) {
            $categore = $this->db->getCategore($idParent);
            return $this->export($categore, $url);
        }

        return $url . "\n";
    }
}