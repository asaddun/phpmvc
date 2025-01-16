<?php

class Todo
{
    private $table = 'todolist';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllTask()
    {
        $sql =
            "SELECT * 
            FROM {$this->table}";

        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getTaskById($id)
    {
        $sql =
            "SELECT * FROM {$this->table} 
            WHERE id=:id";

        $this->db->query($sql);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addTask($data)
    {
        $sql =
            "INSERT INTO {$this->table}
            VALUES (NULL, :title, :deskripsi, :status)";

        $this->db->query($sql);
        $this->db->bind("title", $data["title"]);
        $this->db->bind("deskripsi", $data["description"]);
        $this->db->bind("status", $data["status"]);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteTask($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id=:id";

        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateTask($data)
    {
        $data["status"] = isset($data["status"]) ? "1" : "0";

        $sql =
            "UPDATE {$this->table} SET
            judul=:judul,
            deskripsi=:deskripsi,
            status=:status
            WHERE id=:id";

        $this->db->query($sql);
        $this->db->bind("judul", $data["title"]);
        $this->db->bind("deskripsi", $data["description"]);
        $this->db->bind("status", $data["status"]);
        $this->db->bind("id", $data["id"]);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function searchTask()
    {
        $keyword = $_POST['keyword'];

        $sql =
            "SELECT * 
            FROM {$this->table}
            WHERE judul LIKE :keyword
            OR deskripsi LIKE :keyword";

        $this->db->query($sql);
        $this->db->bind("keyword", "%$keyword%");
        return $this->db->resultSet();
    }
}
