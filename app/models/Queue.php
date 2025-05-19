<?php

class Queue
{
    private $table = 'queue';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMaxNumberByType($type, $date)
    {
        $sql =
            "SELECT MAX(number) as max_number 
            FROM {$this->table} 
            WHERE type = :type AND DATE(created_at) = :date";
        $this->db->query($sql);
        $this->db->bind("type", $type);
        $this->db->bind("date", $date);
        $this->db->execute();
        return $this->db->single()['max_number'] ?? 0;
    }

    public function addQueue($data)
    {
        $sql =
            "INSERT INTO {$this->table}
            VALUES (NULL, :code, :type, :number, 1, CURRENT_TIMESTAMP, NULL, NULL)";
        $this->db->query($sql);
        $this->db->bind("code", $data["code"]);
        $this->db->bind("type", $data["type"]);
        $this->db->bind("number", $data["number"]);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getCounterData($date)
    {
        $sql =
            "SELECT t1.id, t1.counter, t1.code, t1.status, t1.called_at
            FROM {$this->table} t1
            LEFT JOIN {$this->table} t2
            ON t1.counter = t2.counter
            AND t1.called_at < t2.called_at
            AND t2.status > 1
            WHERE t1.status > 1 AND t2.counter IS NULL AND DATE(t1.called_at) = :date";
        $this->db->query($sql);
        $this->db->bind("date", $date);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getActiveType($date)
    {
        $sql =
            "SELECT DISTINCT type
            FROM {$this->table} 
            WHERE status = 1 AND DATE(created_at) = :date
            ORDER BY type ASC";
        $this->db->query($sql);
        $this->db->bind("date", $date);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getWaitingQueues($date)
    {
        $sql =
            "SELECT code, type 
            FROM {$this->table} 
            WHERE status = 1 AND DATE(created_at) = :date
            ORDER BY type, number";
        $this->db->query($sql);
        $this->db->bind("date", $date);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getActiveQueueByType($type, $date)
    {
        $sql =
            "SELECT * FROM {$this->table}
            WHERE type = :type AND status = 1 AND DATE(created_at) = :date
            ORDER BY created_at ASC";
        $this->db->query($sql);
        $this->db->bind("type", $type);
        $this->db->bind("date", $date);
        $this->db->execute();
        return $this->db->single();
    }

    public function updateQueueStatusCalling($data)
    {
        $sql =
            "UPDATE {$this->table}
            SET status = 2, called_at = CURRENT_TIMESTAMP, counter = :counter
            WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $data['id']);
        $this->db->bind("counter", $data['counter']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateQueueStatusProcess($data)
    {
        $sql =
            "UPDATE {$this->table}
            SET status = 3, counter = :counter
            WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $data['id']);
        $this->db->bind("counter", $data['counter']);
        $this->db->execute();
    }

    public function updateQueueStatusDone($data)
    {
        $sql =
            "UPDATE {$this->table}
            SET status = 4
            WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $data['id']);
        $this->db->execute();
    }
}
