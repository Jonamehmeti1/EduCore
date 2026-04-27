<?php
session_start();

// "Databaza" e përkohshme në Session
if (!isset($_SESSION['users_db'])) {
    $_SESSION['users_db'] = [
        ["email" => "admin@educare.com", "password" => "admin123", "role" => "admin", "name" => "Admin User"],
        ["email" => "teacher@test.com", "password" => "123", "role" => "teacher", "name" => "Prof. Arta"]
    ];
}

$error = "";
$success = "";

// Logjika për Login
if (isset($_POST['login_btn'])) {
    $found = false;
    foreach ($_SESSION['users_db'] as $user) {
        if ($user['email'] === $_POST['email'] && $user['password'] === $_POST['password'] && $user['role'] === $_POST['role']) {
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['name'];
            header("Location: lessons.php");
            exit();
        }
    }
    $error = "Të dhënat e gabuara ose roli nuk përputhet!";
}

// Logjika për Signup
if (isset($_POST['signup_btn'])) {
    if(!empty($_POST['fullname']) && !empty($_POST['email'])) {
        $_SESSION['users_db'][] = [
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "role" => $_POST['role'],
            "name" => $_POST['fullname']
        ];
        $success = "Llogaria u krijua! Mund të kyçeni tani.";
    } else {
        $error = "Ju lutem plotësoni të gjitha fushat!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduCore</title>
    <link rel="stylesheet" href="../interactivity/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="auth-header">
                <h1>Edu<span>Care</span></h1>
                <p>Mirësevini në platformën tuaj mësimore</p>
            </div>

            <?php if($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="input-group">
                    <label>Emri i Plotë</label>
                    <input type="text" name="fullname" placeholder="Psh. Filan Fisteku">
                </div>

                <div class="input-group">
                    <label>Email Adresa</label>
                    <input type="email" name="email" placeholder="email@shembull.com" required>
                </div>

                <div class="input-group">
                    <label>Fjalëkalimi</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                
                <div class="input-group">
                    <label>Kyçuni si:</label>
                    <select name="role" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="auth-actions">
                    <button type="submit" name="login_btn" class="btn-primary">Login</button>
                    <button type="submit" name="signup_btn" class="btn-secondary">Krijo Llogari</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>