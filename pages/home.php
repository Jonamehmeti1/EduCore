<?php
include __DIR__ . '/../includess/header.php';

$_SESSION['role'] = 'student';

$role = $_SESSION['role'] ?? 'student';
?>

<?php if ($role === 'admin'): ?>

<div class="dashboard-page">

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
        ["name" => "Drita Berisha", "subject" => "Anglisht", "status" => "Active"]
    ];

    $classes = [
        ["class" => "10A", "students" => 28, "teacher" => "Arta Gashi"],
        ["class" => "10B", "students" => 25, "teacher" => "Besnik Krasniqi"],
        ["class" => "11A", "students" => 30, "teacher" => "Drita Berisha"]
    ];
    ?>

    <div class="dashboard-admin-grid">

        <div class="admin-card teacher-month-card-admin">
            <div class="teacher-avatar">
                <?= htmlspecialchars($teacherOfMonth["initials"]) ?>
            </div>

            <div class="teacher-month-content">
                <h2>Teacher of the Month</h2>
                <h3><?= htmlspecialchars($teacherOfMonth["name"]) ?></h3>
                <p><?= htmlspecialchars($teacherOfMonth["subject"]) ?></p>

                <div class="teacher-stats">
                    <span>Lessons: <?= htmlspecialchars($teacherOfMonth["lessons"]) ?></span>
                    <span>Rating: <?= htmlspecialchars($teacherOfMonth["rating"]) ?> ⭐</span>
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
                    <?php foreach ($activeTeachers as $index => $teacher): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($teacher["name"]) ?></td>
                            <td><?= htmlspecialchars($teacher["subject"]) ?></td>
                            <td><span class="status present"><?= htmlspecialchars($teacher["status"]) ?></span></td>
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
                        <h3><?= htmlspecialchars($class["class"]) ?></h3>
                        <p><?= htmlspecialchars($class["students"]) ?> Students</p>
                        <span><?= htmlspecialchars($class["teacher"]) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<?php elseif ($role === 'teacher'): ?>

<div class="dashboard-page">

    <h1 class="page-title">Teacher Dashboard</h1>

    <?php
    $myClasses = [
        ["class" => "10A", "students" => 28],
        ["class" => "10B", "students" => 25],
        ["class" => "11A", "students" => 30]
    ];

    $todaySchedule = [
        ["time" => "09:00", "class" => "10A", "subject" => "Matematikë"],
        ["time" => "10:30", "class" => "10B", "subject" => "Matematikë"],
        ["time" => "12:00", "class" => "11A", "subject" => "Matematikë"]
    ];

    $attendanceToday = [
        "present" => 72,
        "absent" => 11
    ];

    $recentLessons = [
        ["title" => "Functions & Graphs", "class" => "10A", "date" => "Today"],
        ["title" => "Linear Equations", "class" => "10B", "date" => "Yesterday"],
        ["title" => "Quadratic Equations", "class" => "11A", "date" => "2 days ago"]
    ];
    ?>

    <div class="teacher-dashboard-grid">

        <div class="admin-card">
            <h2>My Classes</h2>

            <div class="class-summary-grid">
                <?php foreach ($myClasses as $class): ?>
                    <div class="class-summary-card">
                        <h3><?= htmlspecialchars($class["class"]) ?></h3>
                        <p><?= htmlspecialchars($class["students"]) ?> Students</p>
                        <span>Assigned class</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="admin-card attendance-summary-card">
            <h2>Attendance Today</h2>

            <div class="attendance-summary">
                <div>
                    <h3><?= $attendanceToday["present"] ?></h3>
                    <span>Present</span>
                </div>

                <div>
                    <h3><?= $attendanceToday["absent"] ?></h3>
                    <span>Absent</span>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <h2>Today’s Schedule</h2>

            <table class="students-table">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Class</th>
                        <th>Subject</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($todaySchedule as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item["time"]) ?></td>
                            <td><?= htmlspecialchars($item["class"]) ?></td>
                            <td><?= htmlspecialchars($item["subject"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="admin-card">
            <h2>Recent Lessons</h2>

            <div class="recent-lessons-list">
                <?php foreach ($recentLessons as $lesson): ?>
                    <div class="recent-lesson-item">
                        <div>
                            <h3><?= htmlspecialchars($lesson["title"]) ?></h3>
                            <p><?= htmlspecialchars($lesson["class"]) ?> • <?= htmlspecialchars($lesson["date"]) ?></p>
                        </div>

                        <a href="lessons.php">View</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

</div>

<?php elseif ($role === 'student'): ?>

<div class="dashboard-page">

    <h1 class="page-title">Student Dashboard</h1>

    <?php
    $studentInfo = [
        "name" => "Jona Mehmeti",
        "class" => "10A",
        "average" => 4.7,
        "attendance" => 91
    ];

    $recentGrades = [
        ["subject" => "Matematikë", "grade" => 5, "date" => "Today"],
        ["subject" => "TIK", "grade" => 5, "date" => "Yesterday"],
        ["subject" => "Fizikë", "grade" => 4, "date" => "2 days ago"]
    ];

    $todaySchedule = [
        ["time" => "09:00", "subject" => "Matematikë", "room" => "Room 201"],
        ["time" => "10:30", "subject" => "TIK", "room" => "Lab 2"],
        ["time" => "12:00", "subject" => "Anglisht", "room" => "Room 105"]
    ];

    $notifications = [
        "New lesson uploaded in Matematikë",
        "Homework deadline tomorrow",
        "Grade updated in TIK"
    ];
    ?>

    <div class="student-dashboard-grid">

        <div class="admin-card student-profile-card">
            <div class="student-avatar-big">
                <?= strtoupper(substr($studentInfo["name"], 0, 1)) ?>
            </div>

            <div>
                <h2><?= htmlspecialchars($studentInfo["name"]) ?></h2>
                <p>Class <?= htmlspecialchars($studentInfo["class"]) ?></p>

                <div class="student-summary-row">
                    <span>Average: <?= $studentInfo["average"] ?></span>
                    <span>Attendance: <?= $studentInfo["attendance"] ?>%</span>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <h2>Recent Grades</h2>

            <table class="students-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Grade</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($recentGrades as $grade): ?>
                        <tr>
                            <td><?= htmlspecialchars($grade["subject"]) ?></td>
                            <td><?= htmlspecialchars($grade["grade"]) ?></td>
                            <td><?= htmlspecialchars($grade["date"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="admin-card">
            <h2>Today’s Schedule</h2>

            <table class="students-table">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Subject</th>
                        <th>Room</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($todaySchedule as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item["time"]) ?></td>
                            <td><?= htmlspecialchars($item["subject"]) ?></td>
                            <td><?= htmlspecialchars($item["room"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="admin-card">
            <h2>Notifications</h2>

            <div class="notifications-list">
                <?php foreach ($notifications as $note): ?>
                    <div class="notification-item">
                        <?= htmlspecialchars($note) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

</div>
<?php else: ?>

<h1 class="page-title">No Access</h1>

<?php endif; ?>

<?php include __DIR__ . '/../includess/footer.php'; ?>