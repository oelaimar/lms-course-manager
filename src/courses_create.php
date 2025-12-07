<?php
require_once __DIR__ . "/assets/includes/config.php";

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

    $title = $_POST["title"];
    $description = $_POST["description"];
    $level = $_POST["level"];

    $sql = "INSERT INTO courses (title, descriptions, levels) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $level);

    if ($stmt->execute()) {
        header("Location: /?success=1");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
