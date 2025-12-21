<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/includes/config.php";

$coursId = $_GET['id'] ?? null;

session_start();

if ($coursId) {
    $sql = "DELETE FROM courses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $coursId);
} else {
    $_SESSION['success'] = "0_course";
    header("Location: /");
    exit;
}

if ($stmt->execute()) {
    $_SESSION['success'] = "3_course";
    header("Location: /");
    exit;
} else {
    echo "Error: " . $conn->error;
}