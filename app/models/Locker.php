<?php

class Locker
{
    private $tableLocker = 'lkr_locker';
    private $tableLog = 'lkr_log';
    private $tableEmployee = 'c_employee';
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseAPI;
    }

    public function getAllLockers($start, $limit)
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

    public function getLog($start, $limit)
    {
        $sql =
            "SELECT 
                s.lkr_log_id AS start_id,
                e.lkr_log_id AS end_id,
                s.lkr_locker_id,
                {$this->tableLocker}.locker_name,
                {$this->tableEmployee}.nama_karyawan AS employee,
                s.c_employee_id,
                s.timestamp AS start_time,
                e.timestamp AS end_time
            FROM {$this->tableLog} s
            JOIN 
                {$this->tableLog} e
                ON s.LKR_LOCKER_ID  = e.LKR_LOCKER_ID 
                AND s.C_EMPLOYEE_ID  = e.C_EMPLOYEE_ID
                AND e.ACTION_TYPE  = 2
                AND s.ACTION_TYPE  = 1
                AND e.`timestamp` > s.`timestamp`
            LEFT JOIN {$this->tableLocker} ON s.LKR_LOCKER_ID = {$this->tableLocker}.LKR_LOCKER_ID
            LEFT JOIN {$this->tableEmployee} ON s.C_EMPLOYEE_ID = {$this->tableEmployee}.C_EMPLOYEE_ID
            WHERE NOT EXISTS (
                SELECT 1 FROM {$this->tableLog} m
                WHERE m.ACTION_TYPE = 2
                AND m.timestamp > s.timestamp
                AND m.timestamp < e.timestamp
                AND m.LKR_LOCKER_ID = s.LKR_LOCKER_ID
                AND m.C_EMPLOYEE_ID = s.C_EMPLOYEE_ID
            )
            ORDER BY e.`timestamp` DESC
            LIMIT :start, :limit";
        $this->db->query($sql);
        $this->db->bind("start", $start);
        $this->db->bind("limit", $limit);
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
}
