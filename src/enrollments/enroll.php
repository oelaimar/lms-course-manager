<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/config.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['login'] = '0';
    header('Location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = $_POST['course_id'] ?? null;
    $userId = $_SESSION['user']['id'];

    if (!$courseId) {
        $_SESSION['success'] = '0_enroll';
        header('Location: /');
        exit;
    }

    // Check if user is already enrolled
    $checkSql = "SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $userId, $courseId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Already enrolled
        $_SESSION['success'] = '2_enroll';
        header('Location: /');
        exit;
    }

    // Enroll the user
    $sql = "INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $courseId);

    if ($stmt->execute()) {
        $_SESSION['success'] = '1_enroll';
    } else {
        $_SESSION['success'] = '0_enroll';
    }

    $stmt->close();
    $conn->close();

    header('Location: /');
    exit;
}

// If not POST request, redirect to home
header('Location: /');
exit;
