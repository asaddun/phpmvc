<?php

class Meeting
{
    private $tableBook = 'booking_meets';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTodayBooks($date)
    {
        $sql =
            "SELECT * FROM {$this->tableBook} 
            WHERE DATE(start_time) = :date
            ORDER BY room, start_time";
        $this->db->query($sql);
        $this->db->bind('date', $date);
        return $this->db->resultSet();
    }

    public function bookingMeet($data, $start, $end)
    {
        $sql =
            "INSERT INTO {$this->tableBook} 
            VALUES (NULL, :room, :start_time, :end_time, :user, CURRENT_TIMESTAMP)";
        $this->db->query($sql);
        $this->db->bind('room', $data["room"]);
        $this->db->bind('start_time', $start);
        $this->db->bind('end_time', $end);
        $this->db->bind('user', $data["name"]);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function isConflict($room, $start, $end)
    {
        $sql =
            "SELECT COUNT(*) as count FROM {$this->tableBook} 
            WHERE room = :room 
            AND NOT (:start >= end_time OR :end <= start_time)";

        $this->db->query($sql);
        $this->db->bind('room', $room);
        $this->db->bind('start', $start);
        $this->db->bind('end', $end);
        $result = $this->db->single();

        return $result['count'] > 0; // True jika ada bentrok
    }

    public function updateBooking($data, $start, $end)
    {
        $sql =
            "UPDATE {$this->tableBook}
            SET room = :room, start_time = :start_time, end_time = :end_time , user = :user
            WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind('room', $data["room"]);
        $this->db->bind('start_time', $start);
        $this->db->bind('end_time', $end);
        $this->db->bind('user', $data["name"]);
        $this->db->bind('id', $data["id"]);
        $this->db->execute();
        return $this->db->rowCount();
    }

    function deleteBook($id)
    {
        $sql =
            "DELETE FROM {$this->tableBook}
            WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
