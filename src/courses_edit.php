<?php
require_once __DIR__ . "/assets/includes/config.php";

$coursId = $_GET['id'] ?? null;

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

    if (!$isValid) {
        header("Location: /?success=0");
        exit;
    }

    session_start();

    $title = $_POST["title"];
    $description = $_POST["description"];
    $level = $_POST["level"];
    if ($coursId) {
        $sql = "UPDATE courses SET title = ?, descriptions = ?, levels = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $description, $level, $coursId);
    } else {
        $_SESSION['success'] = "0";
        header("Location: /");
        exit;
    }
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "2";
        header("Location: /");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
