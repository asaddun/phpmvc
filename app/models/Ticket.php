<?php

class Ticket
{
    private $tableTicket = 'tickets';
    private $tableUser = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMyTicket($user_id)
    {
        $sql =
            "SELECT * FROM {$this->tableTicket} 
            WHERE user_id=:user_id
            ORDER BY created_at DESC";
        $this->db->query($sql);
        $this->db->bind('user_id', $user_id);
        return $this->db->resultSet();
    }

    public function countAllHistoryTicket()
    {
        $sql =
            "SELECT COUNT(*) AS total 
            FROM {$this->tableTicket}
            WHERE {$this->tableTicket}.status > 4";
        $this->db->query($sql);
        return $this->db->single()['total'];
    }

    public function getAllHistoryTicket($start, $limit)
    {
        $sql =
            "SELECT {$this->tableTicket}.*, {$this->tableUser}.fullname 
            FROM {$this->tableTicket} 
            INNER JOIN {$this->tableUser} 
            ON {$this->tableTicket}.user_id = {$this->tableUser}.id
            WHERE {$this->tableTicket}.status > 4
            ORDER BY {$this->tableTicket}.created_at DESC
            LIMIT :start, :limit";
        $this->db->query($sql);
        $this->db->bind("start", $start);
        $this->db->bind("limit", $limit);
        return $this->db->resultSet();
    }

    public function getAllQueueTicket()
    {
        $sql =
            "SELECT {$this->tableTicket}.*, {$this->tableUser}.fullname, {$this->tableUser}.username
            FROM {$this->tableTicket} 
            INNER JOIN {$this->tableUser} 
            ON {$this->tableTicket}.user_id = {$this->tableUser}.id
            WHERE {$this->tableTicket}.status BETWEEN 2 AND 4
            ORDER BY 
                CASE
                    WHEN {$this->tableTicket}.status = 4 THEN 1
                    ELSE 2
                END,
            {$this->tableTicket}.queued_at ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getLastTodayTicket()
    {
        $sql =
            "SELECT MAX(nomor_tiket) AS last_ticket
            FROM tickets
            WHERE nomor_tiket LIKE CONCAT('TWK', DATE_FORMAT(NOW(), '%Y%m%d'), '%');";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->single();
    }

    public function addTicket($data, $ticketNumber)
    {
        $sql =
            "INSERT INTO {$this->tableTicket}
            VALUES (NULL, :nomor_tiket, :subjek, :deskripsi, :status, :user_id, CURRENT_TIMESTAMP, NULL, NULL)";

        $this->db->query($sql);
        $this->db->bind("nomor_tiket", $ticketNumber);
        $this->db->bind("subjek", $data["subject"]);
        $this->db->bind("deskripsi", $data["description"]);
        $this->db->bind("status", $data["status"]);
        $this->db->bind("user_id", $data["user_id"]);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function sendTicket($ticketNumber)
    {
        $sql =
            "UPDATE {$this->tableTicket}
            SET status = 2, queued_at = CURRENT_TIMESTAMP
            WHERE nomor_tiket = :nomor_tiket";
        $this->db->query($sql);
        $this->db->bind("nomor_tiket", $ticketNumber);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cancelTicket($ticketNumber)
    {
        $sql =
            "UPDATE {$this->tableTicket}
            SET status = 6
            WHERE nomor_tiket = :nomor_tiket";
        $this->db->query($sql);
        $this->db->bind("nomor_tiket", $ticketNumber);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateTicket($data, $ticketNumber)
    {
        $sql =
            "UPDATE {$this->tableTicket}
            SET subjek = :subjek, deskripsi = :deskripsi
            WHERE nomor_tiket = :nomor_tiket";
        $this->db->query($sql);
        $this->db->bind("subjek", $data['subject']);
        $this->db->bind("deskripsi", $data['description']);
        $this->db->bind("nomor_tiket", $ticketNumber);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function processTicket($ticketNumber)
    {
        $sql =
            "UPDATE {$this->tableTicket}
            SET status = 3
            WHERE nomor_tiket = :nomor_tiket";
        $this->db->query($sql);
        $this->db->bind("nomor_tiket", $ticketNumber);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function holdTicket($data, $ticketNumber)
    {
        $sql =
            "UPDATE {$this->tableTicket}
            SET status = 4, tindakan = :tindakan
            WHERE nomor_tiket = :nomor_tiket";
        $this->db->query($sql);
        $this->db->bind("nomor_tiket", $ticketNumber);
        $this->db->bind("tindakan", $data['action']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function closeTicket($data, $ticketNumber)
    {
        $sql =
            "UPDATE {$this->tableTicket}
            SET status = 5, tindakan = :tindakan
            WHERE nomor_tiket = :nomor_tiket";
        $this->db->query($sql);
        $this->db->bind("nomor_tiket", $ticketNumber);
        $this->db->bind("tindakan", $data['action']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteTicket($ticketNumber)
    {
        $sql =
            "DELETE FROM {$this->tableTicket}
            WHERE nomor_tiket = :nomor_tiket";
        $this->db->query($sql);
        $this->db->bind("nomor_tiket", $ticketNumber);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
