<?php

class Service
{
    private $tableLog = 'services_log';
    private $tablePrice = 'services_prices';
    private $tableCategory = 'services_category';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addBooking($data, $services)
    {
        $sql =
            "INSERT INTO {$this->tableLog} 
            VALUES (NULL, :name, :phone, :vehicle, :services, :total, CURRENT_TIMESTAMP)";
        $this->db->query($sql);
        $this->db->bind('name', $data["name"]);
        $this->db->bind('phone', $data["phone"]);
        $this->db->bind('vehicle', $data["vehicle"]);
        $this->db->bind('services', $services);
        $this->db->bind('total', $data["total"]);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function countAllServiceLog()
    {
        $sql =
            "SELECT COUNT(*) AS total 
            FROM {$this->tableLog}";
        $this->db->query($sql);
        return $this->db->single()['total'];
    }

    public function getAllServicesLog($start, $limit)
    {
        $sql =
            "SELECT * FROM {$this->tableLog}
            LIMIT :start, :limit";
        $this->db->query($sql);
        $this->db->bind("start", $start);
        $this->db->bind("limit", $limit);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getServicesLogById($id)
    {
        $sql =
            "SELECT * FROM {$this->tableLog}
            WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function getAllPrices()
    {
        $sql =
            "SELECT id, name, price, category, level 
            FROM {$this->tablePrice}
            ORDER BY category ASC, level ASC";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getPriceById($id)
    {
        $sql =
            "SELECT * FROM {$this->tablePrice}
            WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function getPriceByLevel($category, $level)
    {
        $sql =
            "SELECT * FROM {$this->tablePrice}
            WHERE category = :category AND level = :level";
        $this->db->query($sql);
        $this->db->bind("category", $category);
        $this->db->bind("level", $level);
        $this->db->execute();
        return $this->db->single();
    }

    public function updatePriceLevel($id, $level)
    {
        $sql =
            "UPDATE {$this->tablePrice} 
            SET level = :level 
            WHERE id = :id";

        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->bind("level", $level);
        $this->db->execute();
    }

    public function getMaxLevelByCategory($category)
    {
        $sql =
            "SELECT MAX(level) as max_level 
            FROM {$this->tablePrice} 
            WHERE category = :category";
        $this->db->query($sql);
        $this->db->bind("category", $category);
        $this->db->execute();
        return $this->db->single()['max_level'];
    }

    public function getAllCategory()
    {
        $sql =
            "SELECT * FROM {$this->tableCategory}";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function addPrice($data, $level)
    {
        $sql =
            "INSERT INTO {$this->tablePrice} 
            VALUES (NULL, :name, :price, :category, :level)";
        $this->db->query($sql);
        $this->db->bind('name', $data["service"]);
        $this->db->bind('price', $data["price"]);
        $this->db->bind('category', $data["category"]);
        $this->db->bind('level', $level);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editPrice($data, $level)
    {
        $sql =
            "UPDATE {$this->tablePrice}
            SET name = :name, price = :price, category = :category, level = :level
            WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind('name', $data["service"]);
        $this->db->bind('price', $data["price"]);
        $this->db->bind('category', $data["category"]);
        $this->db->bind('level', $level);
        $this->db->bind('id', $data["id"]);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletePrice($id)
    {
        $sql = "DELETE FROM {$this->tablePrice} WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
