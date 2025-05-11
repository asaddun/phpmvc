<?php

class Book
{
    private $tableBook = 'bookstore_books';
    private $tableAuthor = 'bookstore_authors';
    private $tableCategory = 'bookstore_categories';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBooks()
    {
        $sql =
            "SELECT *
            FROM {$this->tableBook}
            INNER JOIN {$this->tableAuthor} ON {$this->tableBook}.author_id = {$this->tableAuthor}.id
            WHERE {$this->tableBook}.stock > 0
            ";

        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
