<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EduCare</title>
    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../interactivity/css/style.css">
    <link rel="stylesheet" href="../interactivity/css/dashboard.css">
</head>
<body>
    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </button>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="dashboard">
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <div class="logo-icon">EC</div>
                <span class="logo-text">EduCare</span>
            </div>
            <nav class="nav-section">
                <div class="nav-label">Main Menu</div>
                <a href="home.php" class="nav-item active">
                    <i class="fa-solid fa-chart-pie nav-icon"></i>
                    Dashboard
                </a>
                <a href="markets.php" class="nav-item">
                    <i class="fa-solid fa-chalkboard-user nav-icon"></i>
                    Teachers
                </a>
                <a href="wallet.php" class="nav-item">
                    <i class="fa-solid fa-user-graduate nav-icon"></i>
                    Students
                </a>
            </nav>
            <nav class="nav-section">
                <div class="nav-label">Account</div>
                <a href="settings.php" class="nav-item">
                    <i class="fa-solid fa-sliders nav-icon"></i>
                    Settings
                </a>
            </nav>
            <div class="sidebar-footer">
                <div class="theme-toggle">
                    <div class="theme-toggle-label">
                        <i class="fa-solid fa-circle-half-stroke"></i>
                        Theme Mode
                    </div>
                    <div class="theme-switch" id="themeSwitch"></div>
                </div>
                <button class="logout-btn" onclick="window.location.href='login.php'">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout
                </button>
            </div>
        </aside>
        <main class="main-content">