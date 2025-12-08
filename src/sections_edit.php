<?php
require_once __DIR__ . "/assets/includes/config.php";

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

    if (!$isValid) {
        header("Location: sections_by_course.php?course_id=$courseId&success=0");
        exit;
    }

    if ($sectionId) {
        $sql = "UPDATE sections SET course_id = ?, title = ?, content = ?, position = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issii", $courseId, $SectionTitle, $sectionContent, $position, $sectionId);
    } else {
        header("Location: sections_by_course.php?course_id=$courseId&success=0");
        exit;
    }

    if ($stmt->execute()) {
        header("Location: sections_by_course.php?course_id=$courseId&success=2");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
