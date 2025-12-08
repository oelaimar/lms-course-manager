<?php
require_once __DIR__ . "/assets/includes/config.php";

$sectionId = $_GET['id'] ?? null;
$courseId = $_POST["course_id"];

if ($sectionId) {
    $sql = "DELETE FROM sections WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sectionId);
} else {
    header("Location: sections_by_course.php?course_id=$courseId&success=0");
    exit;
}

if ($stmt->execute()) {
    header("Location: sections_by_course.php?course_id=$courseId&success=3");
    exit;
} else {
    echo "Error: " . $conn->error;
}