<?php

class Problem
{
    private $tableProblem = 'problems';
    private $tableLog = 'problems_action_log';
    private $tableMesin = 'mesin';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function addProblem($data)
    {
        $sql =
            "INSERT INTO {$this->tableProblem}
            VALUES (NULL, :deskripsi, CURRENT_TIMESTAMP, :status, :user_id, NULL)";

        $this->db->query($sql);
        $this->db->bind("deskripsi", $data["description"]);
        $this->db->bind("status", $data["status"]);
        $this->db->bind("user_id", $data["user_id"]);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
