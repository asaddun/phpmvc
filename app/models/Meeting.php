<?php

class Meeting
{
    private $tableBook = 'booking_meets';
    private $db;
    private $rooms = [
        ["nama" => "Ruang Meeting 1", "nomor" => 1],
        ["nama" => "Ruang Meeting 2", "nomor" => 2],
        ["nama" => "Ruang Meeting 3", "nomor" => 3],
        ["nama" => "Ruang Meeting 4", "nomor" => 4],
    ];

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getRooms()
    {
        return $this->rooms;
    }

    public function getTimeSlots()
    {
        $timeslots = [];
        for ($h = 8; $h < 21; $h++) {
            foreach (["00", "30"] as $m) {
                $timeslots[] = sprintf("%02d:%s", $h, $m);
            }
        }
        return $timeslots;
    }

    public function isBooked($room, $time, $bookings, $date)
    {
        $timeInMinutes = strtotime("$date $time");

        foreach ($bookings as $booking) {
            if ($booking["room"] == $room) {
                $startTime = strtotime($booking["start_time"]);
                $endTime = strtotime($booking["end_time"]);

                if ($timeInMinutes >= $startTime && $timeInMinutes < $endTime) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getBookingData($room, $time, $bookings, $date)
    {
        foreach ($bookings as $booking) {
            if ($booking["room"] == $room && strtotime("$date $time") >= strtotime($booking["start_time"]) && strtotime("$date $time") < strtotime($booking["end_time"])) {
                return $booking;
            }
        }
        return NULL;
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
