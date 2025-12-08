<?php
require_once __DIR__ . "/assets/includes/config.php";

$coursId = $_GET['id'] ?? null;

session_start();

if ($coursId) {
    $sql = "DELETE FROM courses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $coursId);
} else {
    $_SESSION['success'] = "0";
    header("Location: /");
    exit;
}

if ($stmt->execute()) {
    $_SESSION['success'] = "3";
    header("Location: /");
    exit;
} else {
    echo "Error: " . $conn->error;
}