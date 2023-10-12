<?php

class Library
{
  private $db;

  public function __construct()
  {
    // Modify these settings to match your database server configuration
    $db_host = 'localhost';
    $db_name = 'iudigital_libreria';
    $db_user = 'root';
    $db_pass = 'gaXKW^9,o$Y^p>b`';

    try {
      $this->db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Database connection failed: " . $e->getMessage());
    }
  }

  public function registerBook($title, $author, $pages, $code, $isbn, $publisher)
  {
    $stmt = $this->db->prepare("INSERT INTO books (title, author, pages, code, isbn, publisher) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $author, $pages, $code, $isbn, $publisher]);
  }

  public function registerUser($name, $code, $phone, $address)
  {
    $stmt = $this->db->prepare("INSERT INTO users (name, code, phone, address) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $code, $phone, $address]);
  }

  public function assignBook($userCode, $bookTitle, $loanDate, $returnDate)
  {
    $stmt = $this->db->prepare("INSERT INTO user_books (user_code, book_title, loan_date, return_date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userCode, $bookTitle, $loanDate, $returnDate]);
  }

  public function getAssignedBooks()
  {
    $stmt = $this->db->query("SELECT * FROM user_books");
    $assignedBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $assignedBooks;
  }

  public function getBookList()
  {
    $stmt = $this->db->query("SELECT * FROM books");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getUserList()
  {
    $stmt = $this->db->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
