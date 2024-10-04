<?php
require_once '../app/controllers/UserController.php';
require_once '../app/models/User.php';
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();

// Routing sederhana
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $controller = new UserController();
    
    if ($page == 'users') {
        $controller->index();
    } elseif ($page == 'add_user') {
        $controller->add();
    } else {
        $controller->home(); // Tampilkan beranda jika page tidak dikenali
    }
} else {
    $controller = new UserController();
    $controller->home(); // Tampilkan beranda sebagai default
}
