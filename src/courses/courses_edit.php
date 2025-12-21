<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/includes/config.php";

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
        $_SESSION['success'] = "0_course";
        header("Location: /");
        exit;
    }

    session_start();

    $title = $_POST["title"];
    $description = $_POST["description"];
    $level = $_POST["level"];
    if ($coursId) {
        $sql = "UPDATE courses SET title = ?, description = ?, level = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $description, $level, $coursId);
    } else {
        $_SESSION['success'] = "0_course";
        header("Location: /");
        exit;
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "2_course";
        header("Location: /");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
