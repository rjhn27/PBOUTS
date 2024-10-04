<?php
// app/models/User.php

namespace App\Models; // Pastikan untuk mendeklarasikan namespace di bagian atas
require_once '../app/core/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();  // Inisialisasi koneksi database
    }

    // Fungsi untuk menambahkan user baru ke database
    public function addUser($id, $name, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Menggunakan hash untuk password
        $this->db->query("INSERT INTO users (id, name, password) VALUES (:id, :name, :password)", [
            'id' => $id,
            'name' => $name,
            'password' => $hashedPassword
        ]);
    }
    
    // Fungsi untuk mendapatkan semua user (dari sebelumnya)
    public function getAllUsers() {
        $this->db->query("SELECT * FROM users");
        return $this->db->fetchAll();
    }
}
