<?php
require_once __DIR__ . "/assets/includes/config.php";

$coursId = $_GET['id'] ?? null;

if ($coursId) {
    $sql = "DELETE FROM courses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $coursId);
} else {
    header("Location: /?success=0");
    exit;
}

if ($stmt->execute()) {
    header("Location: /?success=3");
    exit;
} else {
    echo "Error: " . $conn->error;
}