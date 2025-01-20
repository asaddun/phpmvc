<?php

class User
{
    private $tableUser = 'users';
    private $tableToken = 'token';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addUser($data)
    {
        $passwordHash = password_hash($data["password"], PASSWORD_BCRYPT);
        $sql =
            "INSERT INTO {$this->tableUser}
            VALUES (NULL, :username, :fullname, :email, :password, 1, CURRENT_TIMESTAMP)";

        $this->db->query($sql);
        $this->db->bind("username", $data["username"]);
        $this->db->bind("fullname", $data["fullname"]);
        $this->db->bind("email", $data["email"]);
        $this->db->bind("password", $passwordHash);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function checkExistUser($username, $email)
    {
        $sql =
            "SELECT *
            FROM  {$this->tableUser}
            WHERE username=:username OR email=:email";

        $this->db->query($sql);
        $this->db->bind("username", $username);
        $this->db->bind("email", $email);
        $this->db->execute();
        return $this->db->single();
    }

    public function checkExistEmailUser($email)
    {
        $sql =
            "SELECT *
            FROM  {$this->tableUser}
            WHERE email=:email";

        $this->db->query($sql);
        $this->db->bind("email", $email);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getUserByUsername($username)
    {
        $sql =
            "SELECT * 
            FROM {$this->tableUser} 
            WHERE username=:username";

        $this->db->query($sql);
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getUserByEmail($email)
    {
        $sql =
            "SELECT * 
            FROM {$this->tableUser} 
            WHERE email=:email";

        $this->db->query($sql);
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    public function createTokenReset($username)
    {
        $token = bin2hex(random_bytes(10));
        $sql =
            "INSERT INTO {$this->tableToken}
            VALUES (NULL, :username, :token, CURRENT_TIMESTAMP)";
        $this->db->query($sql);
        $this->db->bind('username', $username);
        $this->db->bind('token', $token);
        $this->db->execute();
        return $token;
    }

    public function checkExistToken($token)
    {
        $sql =
            "SELECT *
            FROM  {$this->tableToken}
            WHERE token=:token";

        $this->db->query($sql);
        $this->db->bind("token", $token);
        $this->db->execute();
        return $this->db->single();
    }

    public function getTokenTimestamp($token)
    {
        $sql =
            "SELECT * 
            FROM {$this->tableToken} 
            WHERE token=:token";

        $this->db->query($sql);
        $this->db->bind('token', $token);
        $data = $this->db->single();
        return $data['created_at'];
    }

    public function updateEmailUser($username, $email)
    {
        $sql =
            "UPDATE {$this->tableUser}
            SET email=:email
            WHERE username=:username";

        $this->db->query($sql);
        $this->db->bind("username", $username);
        $this->db->bind("email", $email);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePasswordUser($username, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql =
            "UPDATE {$this->tableUser}
            SET password=:passwordHash
            WHERE username=:username";

        $this->db->query($sql);
        $this->db->bind("username", $username);
        $this->db->bind("passwordHash", $passwordHash);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteToken($token)
    {
        $sql =
            "DELETE FROM {$this->tableToken}
            WHERE token=:token";

        $this->db->query($sql);
        $this->db->bind("token", $token);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
