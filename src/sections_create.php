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

    if (!$isValid) {
        header("Location: /?success=0");
        exit;
    }

    $SectionTitle = $_POST["SectionTitle"];
    $sectionContent = $_POST["sectionContent"];
    $position = $_POST["position"];
    $courseId = $_POST["course_id"];

    $sql = "INSERT INTO sections (course_id, title, content, position) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi",$courseId, $SectionTitle, $sectionContent, $position);

    if ($stmt->execute()) {
        header("Location: sections_by_course.php?course_id=$courseId&success=1");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
