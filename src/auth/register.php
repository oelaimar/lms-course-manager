<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/includes/config.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['signupName'];
    $email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    $confirmPassword = $_POST['signupConfirmPassword'];
    $role = 'admin';

    $isValid = true;

    if (empty($name)) {
        $isValid = false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
    }
    $passwordRegex = "/^.{6,}$/";
    if ($password !== $confirmPassword) {
        $isValid = false;
    }

    if (!preg_match($passwordRegex, $password)) {
        $isValid = false;
    }
    
    if (!$isValid) {
        
        $_SESSION['login'] = '0';
        header('location: /');
    }

    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $name, $email, $passwordHashed, $role);

    if($stmt->execute()){
        $_SESSION['login'] = '1';
    }else{
        $_SESSION['login'] = '0';
    }

    header('location: /');
}
