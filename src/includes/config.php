<?php
$host = "mysql";
$user = "user";
$password = "password";
$database = "lms_courses";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>