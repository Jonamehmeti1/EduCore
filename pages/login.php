<?php
session_start();
$_SESSION['users_db'] = [
    [
        "email" => "admin@educare.com",
        "password" => "admin123",
        "role" => "admin",
        "name" => "Admin User"
    ],
    [
        "email" => "teacher@test.com",
        "password" => "123",
        "role" => "teacher",
        "name" => "Prof. Arta"
    ],
    [
        "email" => "student@test.com",
        "password" => "123",
        "role" => "student",
        "name" => "Student User"
    ]
];
$error = "";
$success = "";
if (isset($_POST['login_btn'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    foreach ($_SESSION['users_db'] as $user) {
        if (
            $user['email'] === $email &&
            $user['password'] === $password &&
            $user['role'] === $role
        ) {
            $_SESSION['logged_in'] = true;
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            header("Location: home.php");
            exit();
        }
    }

    $error = "Të dhënat e gabuara ose roli nuk përputhet!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduCare</title>

    <link rel="stylesheet" href="../interactivity/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
<div class="auth-wrapper">
    <div class="auth-container">

        <div class="auth-header">
            <h1>Edu<span>Care</span></h1>
            <p>Welcome to your learning platform</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="input-group">
                <label>Full Name</label>
                <input type="text" name="fullname" placeholder="Not required for login">
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="input-group">
                <label>Login as:</label>
                <select name="role" required>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="auth-actions">
                <button type="submit" name="login_btn" class="btn-primary">Login</button>
            </div>

        </form>

    </div>
</div>
</body>
</html>