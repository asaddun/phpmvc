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
            VALUES (NULL, :deskripsi, :asset_id, CURRENT_TIMESTAMP, :status, :user_id, NULL)";

        $this->db->query($sql);
        $this->db->bind("deskripsi", $data["description"]);
        $this->db->bind("asset_id", $data["mesin"]);
        $this->db->bind("status", $data["status"]);
        $this->db->bind("user_id", $data["user_id"]);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function checkActive($asset_id)
    {
        $sql =
            "SELECT * FROM {$this->tableProblem}
            WHERE asset_id = :asset_id AND status < 2";
        $this->db->query($sql);
        $this->db->bind("asset_id", $asset_id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAllMesin()
    {
        $sql = "SELECT * FROM {$this->tableMesin}";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getAllProblem()
    {
        $sql =
            "SELECT {$this->tableProblem}.*, {$this->tableMesin}.value
            FROM {$this->tableProblem} 
            INNER JOIN {$this->tableMesin} 
            ON {$this->tableProblem}.asset_id = {$this->tableMesin}.asset_id
            WHERE {$this->tableProblem}.status > 0";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
