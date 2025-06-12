<?php

class Locker
{
    private $tableLocker = 'lkr_locker';
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseAPI;
    }

    public function getAllLockers($start, $limit)
    {
        $sql =
            "SELECT * FROM {$this->tableLocker}
            ORDER BY locker_name + 0
            LIMIT :start, :limit";
        $this->db->query($sql);
        $this->db->bind("start", $start);
        $this->db->bind("limit", $limit);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
