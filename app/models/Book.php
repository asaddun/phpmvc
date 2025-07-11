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

    public function pushBooks($data)
    {
        $sql =
            "INSERT INTO {$this->tableBook} (title, author_id, category_id, publisher, year, isbn, price, stock, description, cover)
            VALUES (:title, :author_id, :category_id, :publisher, :year, :isbn, :price, :stock, :description, :cover)";
        $this->db->query($sql);
        $this->db->bind('title', $data['title']);
        $this->db->bind('author_id', $data['author_id']);
        $this->db->bind('category_id', $data['category_id']);
        $this->db->bind('publisher', $data['publisher']);
        $this->db->bind('year', $data['year']);
        $this->db->bind('isbn', $data['isbn']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('stock', $data['stock']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('cover', $data['cover']);
        $this->db->execute();
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

    public function getBookByISBN($isbn)
    {
        $sql =
            "SELECT *
            FROM {$this->tableBook}
            INNER JOIN {$this->tableAuthor} ON {$this->tableBook}.author_id = {$this->tableAuthor}.author_id
            WHERE isbn = :isbn";
        $this->db->query($sql);
        $this->db->bind('isbn', $isbn);
        $this->db->execute();
        return $this->db->single();
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
