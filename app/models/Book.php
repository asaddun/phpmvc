<?php

class Book
{
    private $tableBook = 'bookstore_books';
    private $tableAuthor = 'bookstore_authors';
    private $tableCategory = 'bookstore_categories';
    private $tableCart = 'bookstore_carts';
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
            INNER JOIN {$this->tableAuthor} ON {$this->tableBook}.author_id = {$this->tableAuthor}.author_id
            WHERE {$this->tableBook}.stock > 0";

        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getCartTotal($userId)
    {
        $sql =
            "SELECT COUNT(*) as total
            FROM {$this->tableCart}
            WHERE user_id = :user_id";

        $this->db->query($sql);
        $this->db->bind('user_id', $userId);
        $this->db->execute();
        return $this->db->single()['total'];
    }

    public function checkCart($bookId, $userId)
    {
        $sql =
            "SELECT quantity
            FROM {$this->tableCart}
            WHERE book_id = :book_id AND user_id = :user_id";

        $this->db->query($sql);
        $this->db->bind('book_id', $bookId);
        $this->db->bind('user_id', $userId);
        $this->db->execute();
        return $this->db->single();
    }

    public function addToCart($bookId, $userId)
    {
        $sql =
            "INSERT INTO {$this->tableCart} (book_id, user_id)
            VALUES (:book_id, :user_id)";
        $this->db->query($sql);
        $this->db->bind('book_id', $bookId);
        $this->db->bind('user_id', $userId);
        $this->db->execute();
    }

    public function updateQuantity($bookId, $userId)
    {
        $sql =
            "UPDATE {$this->tableCart}
            SET quantity = quantity + 1
            WHERE book_id = :book_id AND user_id = :user_id";
        $this->db->query($sql);
        $this->db->bind('book_id', $bookId);
        $this->db->bind('user_id', $userId);
        $this->db->execute();
    }
}
