<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'] ?? 'student';
$username = $_SESSION['username'] ?? 'User';

include __DIR__ . '/../includess/header.php';
?>
<div class="dashboard-page">
    <h1 class="page-title">Lessons</h1>

    <?php
    $lessons = [
        ["title" => "Functions & Graphs", "subject" => "Matematikë", "class" => "10A", "teacher" => "Arta Gashi", "date" => "Today"],
        ["title" => "HTML Basics", "subject" => "TIK", "class" => "10B", "teacher" => "Besnik Krasniqi", "date" => "Yesterday"],
        ["title" => "Past Tense", "subject" => "Anglisht", "class" => "11A", "teacher" => "Drita Berisha", "date" => "2 days ago"]
    ];
    ?>

    <?php if ($role === 'teacher'): ?>
        <div class="admin-card lesson-form-card">
            <h2>Add New Lesson</h2>
            <form class="lesson-form">
                <input type="text" placeholder="Lesson title">
                <input type="text" placeholder="Subject">
                <input type="text" placeholder="Class">
                <button type="button">Add Lesson</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if ($role === 'admin'): ?>
        <div class="lessons-table-card">
            <h2>All Lessons (Admin View)</h2>
            <table class="lessons-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Lesson</th>
                        <th>Subject</th>
                        <th>Class</th>
                        <th>Teacher</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lessons as $index => $lesson): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($lesson["title"]) ?></td>
                            <td><?= htmlspecialchars($lesson["subject"]) ?></td>
                            <td><?= htmlspecialchars($lesson["class"]) ?></td>
                            <td><?= htmlspecialchars($lesson["teacher"]) ?></td>
                            <td><?= htmlspecialchars($lesson["date"]) ?></td>
                            <td><button class="small-action-btn">View</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>
        <div class="lessons-grid">
            <?php foreach ($lessons as $lesson): ?>
                <div class="lesson-card">
                    <h2><?= htmlspecialchars($lesson["title"]) ?></h2>
                    <p><?= htmlspecialchars($lesson["subject"]) ?></p>

                    <div class="lesson-meta">
                        <span>Class <?= htmlspecialchars($lesson["class"]) ?></span>
                        <span><?= htmlspecialchars($lesson["date"]) ?></span>
                    </div>

                    <small>Teacher: <?= htmlspecialchars($lesson["teacher"]) ?></small>

                    <button class="lesson-btn">
                        <?= $role === 'teacher' ? 'Manage Lesson' : 'Open Lesson' ?>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includess/footer.php'; ?>