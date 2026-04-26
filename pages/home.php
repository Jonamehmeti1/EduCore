<?php
include __DIR__ . '/../includess/header.php';

/* TEST ROLE - hiqe ma vonë */
$_SESSION['role'] = 'admin';

$role = $_SESSION['role'] ?? 'student';
?>

<?php if ($role === 'admin'): ?>

<h1 class="page-title">Admin Dashboard</h1>

<?php
$teacherOfMonth = [
    "name" => "Arta Gashi",
    "subject" => "Matematikë",
    "lessons" => 18,
    "rating" => 4.9,
    "initials" => "AG"
];

$activeTeachers = [
    ["name" => "Arta Gashi", "subject" => "Matematikë", "status" => "Active"],
    ["name" => "Besnik Krasniqi", "subject" => "TIK", "status" => "Active"],
    ["name" => "Drita Berisha", "subject" => "Anglisht", "status" => "Active"],
];

$classes = [
    ["class" => "10A", "students" => 28, "teacher" => "Arta Gashi"],
    ["class" => "10B", "students" => 25, "teacher" => "Besnik Krasniqi"],
    ["class" => "11A", "students" => 30, "teacher" => "Drita Berisha"],
];
?>

<div class="dashboard-admin-grid">

    <div class="admin-card teacher-month-card-admin">
        <div class="teacher-avatar">
            <?= $teacherOfMonth["initials"] ?>
        </div>

        <div>
            <h2>Teacher of the Month</h2>
            <h3><?= $teacherOfMonth["name"] ?></h3>
            <p><?= $teacherOfMonth["subject"] ?></p>

            <div class="teacher-stats">
                <span>Lessons: <?= $teacherOfMonth["lessons"] ?></span>
                <span>Rating: <?= $teacherOfMonth["rating"] ?> ⭐</span>
            </div>
        </div>
    </div>

    <div class="admin-card">
        <h2>Active Teachers</h2>

        <table class="students-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Teacher</th>
                    <th>Subject</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($activeTeachers as $i => $teacher): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $teacher["name"] ?></td>
                        <td><?= $teacher["subject"] ?></td>
                        <td>
                            <span class="status present"><?= $teacher["status"] ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="admin-card">
        <h2>Classes & Students</h2>

        <div class="class-summary-grid">
            <?php foreach ($classes as $class): ?>
                <div class="class-summary-card">
                    <h3><?= $class["class"] ?></h3>
                    <p><?= $class["students"] ?> Students</p>
                    <span><?= $class["teacher"] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php else: ?>

<h1 class="page-title">No Access</h1>

<?php endif; ?>

<?php include __DIR__ . '/../includess/footer.php'; ?>