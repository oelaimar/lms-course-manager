<?php
require_once __DIR__ . "/assets/includes/config.php";

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

    $sql = "INSERT INTO sections (course_id, title, content, position) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $courseId, $SectionTitle, $sectionContent, $position);

    if ($stmt->execute()) {
        $_SESSION['success'] = "1";
        header("Location: sections_by_course.php?course_id=$courseId");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
