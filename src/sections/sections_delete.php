<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/includes/config.php";

$sectionId = $_GET['id'] ?? null;
$courseId = $_POST["course_id"];

session_start();

if ($sectionId) {
    $sql = "DELETE FROM sections WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sectionId);
} else {
    $_SESSION['success'] = "0";
    header("Location: sections_by_course.php?course_id=$courseId");
    exit;
}

if ($stmt->execute()) {
    $_SESSION['success'] = "3";
    header("Location: sections_by_course.php?course_id=$courseId");
    exit;
} else {
    echo "Error: " . $conn->error;
}