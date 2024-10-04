<?php
class Database {
    private $pdo;
    private $stmt;

    public function __construct() {
        $config = require_once '../config/database.php'; // Muat konfigurasi dari file database.php
        
        // Membuat koneksi menggunakan PDO
        $dsn = "mysql:host={$config['host']};dbname=pbo;charset={$config['charset']}";
        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Koneksi ke database gagal: " . $e->getMessage());
        }
    }

    // Contoh metode untuk menjalankan query
    public function query($sql, $params = []) {
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($params);
        return $this->stmt;
    }

    // Mengambil semua hasil
    public function fetchAll() {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil satu hasil
    public function fetch() {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Contoh penggunaan untuk mengambil data
class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllUsers() {
        $this->db->query("SELECT id, nama, password FROM users"); // Ganti 'users' dengan nama tabel yang sesuai
        return $this->db->fetchAll();
    }

    public function getUserById($id) {
        $this->db->query("SELECT id, nama, password FROM users WHERE id = :id");
        $this->db->stmt->bindParam(':id', $id);
        return $this->db->fetch();
    }
}

