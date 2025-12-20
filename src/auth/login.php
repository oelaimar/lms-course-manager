<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/includes/config.php";

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    
    if ($user && password_verify($password , $user['password'])) {
        $_SESSION['login'] = '1';
        $_SESSION['user'] = $user;

    } else {
        $_SESSION['login'] = '0';
    }

    header('location: /');
}
