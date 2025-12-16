<?php
require_once __DIR__ . "../assets/includes/config.php";

$sectionId = $_GET['id'] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $isValid = true;

    if (empty($_POST['SectionTitle'])) {
        $isValid = false;
    }
    if (empty($_POST['sectionContent'])) {
        $isValid = false;
    }

    if (empty($_POST['position'])) {
        $isValid = false;
    }

    $SectionTitle = $_POST["SectionTitle"];
    $sectionContent = $_POST["sectionContent"];
    $position = $_POST["position"];
    $courseId = $_POST["course_id"];

    session_start();

    if (!$isValid) {
        $_SESSION['success'] = "0";
        header("Location: sections_by_course.php?course_id=$courseId");
        exit;
    }

    if ($sectionId) {
        $sql = "UPDATE sections SET course_id = ?, title = ?, content = ?, position = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issii", $courseId, $SectionTitle, $sectionContent, $position, $sectionId);
    } else {
        $_SESSION['success'] = "0";
        header("Location: sections_by_course.php?course_id=$courseId");
        exit;
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "2";
        header("Location: sections_by_course.php?course_id=$courseId");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
