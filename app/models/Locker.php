<?php

class Locker
{
    private $tableLocker = 'lkr_locker';
    private $tableLog = 'lkr_log';
    private $tableLocation = 'lkr_location';
    private $tableAccess = 'lkr_access';
    private $tableEmployee = 'c_employee';
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseAPI;
    }

    public function getAllLockers()
    {
        $sql =
            "SELECT * FROM {$this->tableLocker}
            ORDER BY locker_name + 0";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getRangeLockers($start, $limit)
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



    public function getLog($start, $limit, $locker)
    {
        $sql =
            "SELECT
                CE.NAMA_KARYAWAN AS employee,
                LKR.locker_name,
                start_log.TIMESTAMP AS start_time,
                end_log.TIMESTAMP AS end_time
            FROM
                {$this->tableLog} start_log
            JOIN
                {$this->tableLog} end_log
                ON start_log.C_EMPLOYEE_ID = end_log.C_EMPLOYEE_ID
                AND start_log.LKR_LOCKER_ID = end_log.LKR_LOCKER_ID
                AND end_log.ACTION_TYPE = 2
                AND end_log.TIMESTAMP > start_log.TIMESTAMP
            LEFT JOIN
                {$this->tableEmployee} CE ON start_log.C_EMPLOYEE_ID = CE.C_EMPLOYEE_ID
            LEFT JOIN
                {$this->tableLocker} LKR ON start_log.LKR_LOCKER_ID = LKR.LKR_LOCKER_ID
            WHERE
                start_log.ACTION_TYPE = 1";

        if ($locker !== 'all') {
            $sql .= " AND start_log.LKR_LOCKER_ID = :locker";
        }

        $sql .=
            " AND NOT EXISTS (
                    SELECT 1
                    FROM {$this->tableLog} mid_log
                    WHERE mid_log.C_EMPLOYEE_ID = start_log.C_EMPLOYEE_ID
                    AND mid_log.LKR_LOCKER_ID = start_log.LKR_LOCKER_ID
                    AND mid_log.TIMESTAMP > start_log.TIMESTAMP
                    AND mid_log.TIMESTAMP < end_log.TIMESTAMP
                    AND mid_log.ACTION_TYPE = 1
                )
            ORDER BY
                start_log.TIMESTAMP DESC
            LIMIT :start, :limit";
        $this->db->query($sql);
        $this->db->bind("start", $start);
        $this->db->bind("limit", $limit);
        if ($locker !== 'all') {
            $this->db->bind("locker", $locker);
        }
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getLogActive()
    {
        $sql =
            "SELECT ll.locker_name, ce.nama_karyawan, ll.booked_at
            FROM {$this->tableLocker} ll 
            INNER JOIN {$this->tableEmployee} ce ON (ll.c_employee_id=ce.c_employee_id)
            WHERE ll.isavailable = 'N'
            ORDER BY ll.booked_at DESC";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getLocation()
    {
        $sql =
            "SELECT * FROM {$this->tableLocation}";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getAccessData($start, $limit, $keyword)
    {
        $sql =
            "SELECT 
                {$this->tableAccess}.lkr_access_id,
                {$this->tableEmployee}.nama_karyawan as employee,
                {$this->tableEmployee}.c_employee_id,
                {$this->tableAccess}.lkr_location_id
            FROM {$this->tableAccess}
            JOIN {$this->tableEmployee} ON {$this->tableAccess}.C_EMPLOYEE_ID = {$this->tableEmployee}.C_EMPLOYEE_ID ";
        if ($keyword) {
            $sql .= " WHERE {$this->tableEmployee}.nama_karyawan LIKE :keyword ";
        }
        $sql .= " LIMIT :start, :limit";
        $this->db->query($sql);
        if ($keyword) {
            $this->db->bind("keyword", "%$keyword%");
        }
        $this->db->bind("start", $start);
        $this->db->bind("limit", $limit);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function updateControl($data)
    {
        $sql =
            "UPDATE {$this->tableLocker}
            SET isactive = :isactive, lkr_location_id = :lkr_location_id
            WHERE lkr_locker_id = :lkr_locker_id";
        $this->db->query($sql);
        $this->db->bind("isactive", $data['isactive']);
        $this->db->bind("lkr_location_id", $data['location']);
        $this->db->bind("lkr_locker_id", $data['lkr_locker_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateAccess($data)
    {
        $sql =
            "UPDATE {$this->tableAccess}
            SET lkr_location_id = :lkr_location_id
            WHERE lkr_access_id = :lkr_access_id AND c_employee_id = :c_employee_id";
        $this->db->query($sql);
        $this->db->bind("lkr_location_id", $data['location']);
        $this->db->bind("c_employee_id", $data['c_employee_id']);
        $this->db->bind("lkr_access_id", $data['lkr_access_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
