<?php

class Employee
{
    private $table = 'employee';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllEmployee()
    {
        $sql = "SELECT * FROM {$this->table}";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getEmployeeById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addEmployee($data)
    {
        $sql =
            "INSERT INTO {$this->table}
            VALUES (NULL, :nama, :nomor, :pekerjaan, :email)";

        $this->db->query($sql);
        $this->db->bind("nama", $data["name"]);
        $this->db->bind("nomor", $data["number"]);
        $this->db->bind("pekerjaan", $data["position"]);
        $this->db->bind("email", $data["email"]);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteEmployee($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateEmployee($data)
    {
        $sql = "UPDATE {$this->table} SET
                nama=:nama,
                nomor=:nomor,
                pekerjaan=:pekerjaan,
                email=:email
                WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind("nama", $data["name"]);
        $this->db->bind("nomor", $data["number"]);
        $this->db->bind("pekerjaan", $data["position"]);
        $this->db->bind("email", $data["email"]);
        $this->db->bind("id", $data["id"]);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function searchEmployee()
    {
        $keyword = $_POST['keyword'];
        $sql = "SELECT * FROM {$this->table} WHERE nama LIKE :keyword";
        $this->db->query($sql);
        $this->db->bind("keyword", "%$keyword%");
        return $this->db->resultSet();
    }
}
