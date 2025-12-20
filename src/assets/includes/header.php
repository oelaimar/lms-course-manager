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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i> LMS
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/">Courses</a></li>
                    <button class="btn btn-primary" onclick="openModal('loginModal')">login</button>
                    <img src="" alt="">
                </ul>
            </nav>
        </div>
    </header>
    
    <div id="loginModal" class="modal-overlay" onclick="closeModal('loginModal')">
        <div class="modal" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 id="modalTitleLogin" class="modal-title">Welcome Back</h2>
                <button class="close-modal" onclick="closeModal('loginModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Tab Switcher -->
                <div class="tab-switcher">
                    <button id="loginBtn" class="tab-btn active" onclick="switchTab('loginTab')">Login</button>
                    <button id="signupBtn" class="tab-btn " onclick="switchTab('signupTab')">Sign Up</button>
                </div>

                <!-- Login Tab -->
                <div id="loginTab" class="tab-content active">
                    <form id="login_form" action="/auth/login.php" method="POST">
                        <div class="form-group">
                            <label class="form-label" for="loginEmail">Email Address *</label>
                            <input type="email" id="loginEmail" class="form-input" placeholder="you@example.com" name="loginEmail">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="loginPassword">Password *</label>
                            <input type="password" id="loginPassword" class="form-input" placeholder="••••••••" name="loginPassword">
                        </div>

                        <button type="submit" style="width:100%;" class="btn btn-primary">Login</button>

                        <div class="text-center">
                            Don't have an account? 
                            <a class="link" onclick="switchTab('signupTab');">Sign up</a>
                        </div>
                    </form>
                </div>

                <!-- Signup Tab -->
                <div id="signupTab" class="tab-content ">
                    <form id="ingup_form" action="/auth/register.php" method="POST">
                        <div class="form-group">
                            <label class="form-label" for="signupName">Full Name *</label>
                            <input type="text" id="signupName" class="form-input" placeholder="John Doe" name="signupName">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="signupEmail">Email Address *</label>
                            <input type="email" id="signupEmail" class="form-input" placeholder="you@example.com" name="signupEmail">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="signupPassword">Password *</label>
                            <input type="password" id="signupPassword" class="form-input" placeholder="••••••••" minlength="6" name="signupPassword">
                            <p class="form-hint">Must be at least 6 characters</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="signupConfirmPassword">Confirm Password *</label>
                            <input type="password" id="signupConfirmPassword" class="form-input" placeholder="••••••••" name="signupConfirmPassword">
                        </div>

                        <button type="submit" style="width:100%;" class="btn btn-primary">Create Account</button>

                        <div class="text-center">
                            Already have an account? 
                            <a class="link" onclick="switchTab('loginTab')">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>