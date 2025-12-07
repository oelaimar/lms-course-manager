<?php
require_once __DIR__ . '/config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - Course Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i> LMS
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="#">Courses</a></li>
                    <li><a href="#">Students</a></li>
                    <li><a href="#">Reports</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </nav>
        </div>
    </header>