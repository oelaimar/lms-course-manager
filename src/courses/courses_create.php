<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $isValid = true;

    if (empty($_POST['title'])) {
        $isValid = false;
    }
    if (empty($_POST['level'])) {
        $isValid = false;
    }
    if (!in_array($_POST['level'], ["Beginner", "Intermediate", "Advanced"])) {
        $isValid = false;
    }

    if (empty($_POST['description'])) {
        $isValid = false;
    }
    session_start();

    if (!$isValid) {
        $_SESSION['success'] = "0_course";
        header("Location: /");
        exit;
    }


    $title = $_POST["title"];
    $description = $_POST["description"];
    $level = $_POST["level"];

    $sql = "INSERT INTO courses (title, description, level) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $level);

    if ($stmt->execute()) {
        $_SESSION['success'] = "1_course";
        header("Location: /");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
