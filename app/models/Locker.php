<?php

class Locker
{
    private $tableLocker = 'lkr_locker';
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseAPI;
    }

    public function getAllLockers()
    {
        $sql = "SELECT * FROM {$this->tableLocker}";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
