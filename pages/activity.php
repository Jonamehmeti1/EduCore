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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php if ($role === 'admin'): ?>

<h1 class="page-title">Student Activity</h1>

<div class="activity-row">
    <div class="activity-mini-card">
        <h3>Attendance</h3>
        <div class="chart-box"><canvas id="attendanceChart"></canvas></div>
        <p class="percent">86%</p>
        <span>Excellent</span>
    </div>

    <div class="activity-mini-card">
        <h3>Homework</h3>
        <div class="chart-box"><canvas id="homeworkChart"></canvas></div>
        <p class="percent">72%</p>
        <span>Good</span>
    </div>

    <div class="activity-mini-card">
        <h3>Activity Level</h3>
        <div class="chart-box"><canvas id="activityChart"></canvas></div>
        <p class="percent">64%</p>
        <span>Moderate</span>
    </div>
</div>

<div class="top-students-card">
    <h2>Top 3 Students</h2>

    <?php
    $students = [
        ["name" => "Jona Mehmeti", "grade" => "10A", "average" => 4.9],
        ["name" => "Jona Elezi", "grade" => "10B", "average" => 4.8],
        ["name" => "Kron Pajaziti", "grade" => "10A", "average" => 4.7],
    ];
    ?>

    <table class="students-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Class</th>
                <th>Average</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $i => $s): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($s['name']) ?></td>
                    <td><?= htmlspecialchars($s['grade']) ?></td>
                    <td><?= htmlspecialchars($s['average']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$teachers = [
    ["id" => 1, "name" => "Arta Gashi", "subject" => "Matematikë", "lessons" => 18, "rating" => 4.9, "initials" => "AG"],
    ["id" => 2, "name" => "Besnik Krasniqi", "subject" => "TIK", "lessons" => 14, "rating" => 4.7, "initials" => "BK"],
    ["id" => 3, "name" => "Drita Berisha", "subject" => "Anglisht", "lessons" => 16, "rating" => 4.8, "initials" => "DB"]
];

if (!isset($_SESSION['teacher_of_month'])) {
    $_SESSION['teacher_of_month'] = 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teacher_id'])) {
    $_SESSION['teacher_of_month'] = (int) $_POST['teacher_id'];
}

$teacherOfMonth = $teachers[0];

foreach ($teachers as $t) {
    if ($t['id'] === $_SESSION['teacher_of_month']) {
        $teacherOfMonth = $t;
        break;
    }
}
?>

<div class="teacher-month-wrapper">
    <div class="teacher-month-card">
        <div class="teacher-avatar"><?= htmlspecialchars($teacherOfMonth['initials']) ?></div>

        <div class="teacher-info">
            <h2>Teacher of the Month</h2>
            <h3><?= htmlspecialchars($teacherOfMonth['name']) ?></h3>
            <p><?= htmlspecialchars($teacherOfMonth['subject']) ?></p>

            <div class="teacher-stats">
                <span>Lessons: <?= htmlspecialchars($teacherOfMonth['lessons']) ?></span>
                <span>Rating: <?= htmlspecialchars($teacherOfMonth['rating']) ?> ⭐</span>
            </div>
        </div>
    </div>

    <button class="change-teacher-btn" onclick="toggleTeacherForm()">Change Teacher</button>

    <form method="POST" class="teacher-select-form" id="teacherSelectForm">
        <select name="teacher_id">
            <?php foreach ($teachers as $t): ?>
                <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Update</button>
    </form>
</div>

<script>
function toggleTeacherForm() {
    document.getElementById("teacherSelectForm").classList.toggle("show");
}

function createMiniDonut(id, percent, color) {
    new Chart(document.getElementById(id), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [percent, 100 - percent],
                backgroundColor: [color, '#3a3a3c'],
                borderWidth: 0,
                cutout: '72%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });
}

createMiniDonut('attendanceChart', 86, '#d4945a');
createMiniDonut('homeworkChart', 72, '#6b8e6b');
createMiniDonut('activityChart', 64, '#c9845a');
</script>

<?php elseif ($role === 'teacher'): ?>

<h1 class="page-title">Class Attendance</h1>

<?php
$classes = [
    "10A" => [
        "best_student" => "Jona Mehmeti",
        "students" => [
            ["name" => "Jona Mehmeti", "status" => "present"],
            ["name" => "Kron Pajaziti", "status" => "present"],
            ["name" => "Elira Gashi", "status" => "absent"]
        ]
    ],
    "10B" => [
        "best_student" => "Jona Elezi",
        "students" => [
            ["name" => "Jona Elezi", "status" => "present"],
            ["name" => "Ardi Krasniqi", "status" => "absent"],
            ["name" => "Lina Berisha", "status" => "present"]
        ]
    ],
    "11A" => [
        "best_student" => "Dion Morina",
        "students" => [
            ["name" => "Dion Morina", "status" => "present"],
            ["name" => "Era Hoxha", "status" => "present"],
            ["name" => "Blendi Shala", "status" => "absent"]
        ]
    ]
];

$selectedClass = $_GET['class'] ?? '10A';

if (!array_key_exists($selectedClass, $classes)) {
    $selectedClass = '10A';
}

$classData = $classes[$selectedClass];
?>

<div class="teacher-class-card">
    <h2>My Classes</h2>

    <div class="class-buttons">
        <?php foreach ($classes as $className => $classInfo): ?>
            <a href="activity.php?class=<?= urlencode($className) ?>"
               class="class-btn <?= $className === $selectedClass ? 'active' : '' ?>">
                <?= htmlspecialchars($className) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="best-student-wrapper">

    <div class="best-student-card">

        <div class="best-left">
            <div class="best-icon">🏆</div>
        </div>

        <div class="best-info">
            <h2>Best Student</h2>

            <h3><?= htmlspecialchars($classData['best_student']) ?></h3>

            <p>Class <?= htmlspecialchars($selectedClass) ?></p>

            <span class="best-badge">Top Performer</span>
        </div>

    </div>

</div>

<div class="class-students-card">
    <h2>Students</h2>

    <table class="students-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($classData['students'] as $i => $student): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td>
                        <span class="status <?= htmlspecialchars($student['status']) ?>">
                            <?= $student['status'] === 'present' ? 'Në shkollë' : 'Mungon' ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php elseif ($role === 'student'): ?>

<h1 class="page-title">My Attendance</h1>

<?php
$subjects = [
    ["subject"=>"Matematikë","absences"=>2,"total"=>24],
    ["subject"=>"Gjuhë","absences"=>1,"total"=>22],
    ["subject"=>"TIK","absences"=>0,"total"=>18],
    ["subject"=>"Fizikë","absences"=>3,"total"=>20],
    ["subject"=>"Anglisht","absences"=>1,"total"=>21]
];
?>

<div class="student-table-card">

    <table class="students-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Lënda</th>
                <th>Mungesat</th>
                <th>Total Orë</th>
                <th>Prezenca</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($subjects as $i => $s): 
                $present = $s["total"] - $s["absences"];
                $percent = round(($present / $s["total"]) * 100);
            ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($s["subject"]) ?></td>
                    <td><?= $s["absences"] ?></td>
                    <td><?= $s["total"] ?></td>
                    <td>
                        <span class="status <?= $percent >= 80 ? 'present' : 'absent' ?>">
                            <?= $percent ?>%
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>


<h1 class="page-title">My Subjects</h1>

<?php
$subjects = [
    [
        "subject" => "Matematikë",
        "absences" => 2,
        "last_lesson" => "Functions & Graphs"
    ],
    [
        "subject" => "Gjuhë",
        "absences" => 1,
        "last_lesson" => "Analiza e poezisë"
    ],
    [
        "subject" => "TIK",
        "absences" => 0,
        "last_lesson" => "HTML Basics"
    ],
    [
        "subject" => "Fizikë",
        "absences" => 3,
        "last_lesson" => "Forca dhe Lëvizja"
    ],
    [
        "subject" => "Anglisht",
        "absences" => 1,
        "last_lesson" => "Past Tense"
    ]
];
?>

<div class="subjects-carousel">

    <?php foreach ($subjects as $subject): ?>
        <div class="student-subject-card">

            <h3><?= htmlspecialchars($subject["subject"]) ?></h3>

            <p class="subject-absence">
                Mungesa: <span><?= $subject["absences"] ?></span>
            </p>

            <div class="subject-lesson">
                <small>Last Lesson</small>
                <p><?= htmlspecialchars($subject["last_lesson"]) ?></p>
            </div>

            <button class="learn-more-btn">
                <a href="lesson.php?subject=<?= urlencode($subject["subject"]) ?>" style="text-decoration: none; color: inherit;">Learn More</a>
            </button>

        </div>
    <?php endforeach; ?>

</div>

<?php else: ?>

<h1>No Access</h1>

<?php endif; ?>

<?php include __DIR__ . '/../includess/footer.php'; ?>