<?php
require_once '../app/models/User.php';

class UserController {
    public function index() {
        $userModel = new User();
        $users = $userModel->getAllUsers();

        // Kirim data pengguna ke view
        require_once '../app/views/user.php';
    }

    public function add() {
        $message = null;

        // Jika request adalah POST, proses form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $password = $_POST['password'];

            // Validasi input
            if (!empty($id) && !empty($name) && !empty($password)) {
                $userModel = new User();
                $userModel->add_User($id, $name, $password);
                $message = "User berhasil ditambahkan!";
            } else {
                $message = "Semua field harus diisi.";
            }
        }

        // Tampilkan form tambah user
        require_once '../app/views/add_user.php';
    }
     // Metode untuk menampilkan halaman beranda
     public function home() {
        require_once '../app/views/home.php';
    }
}
