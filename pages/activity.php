<?php include __DIR__ . '/../includess/header.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h1 class="page-title">Student Activity</h1>

<!-- TOP CARDS -->
<div class="activity-row">

    <div class="activity-mini-card">
        <h3>Attendance</h3>
        <div class="chart-box">
            <canvas id="attendanceChart"></canvas>
        </div>
        <p class="percent">86%</p>
        <span>Excellent</span>
    </div>

    <div class="activity-mini-card">
        <h3>Homework</h3>
        <div class="chart-box">
            <canvas id="homeworkChart"></canvas>
        </div>
        <p class="percent">72%</p>
        <span>Good</span>
    </div>

    <div class="activity-mini-card">
        <h3>Activity Level</h3>
        <div class="chart-box">
            <canvas id="activityChart"></canvas>
        </div>
        <p class="percent">64%</p>
        <span>Moderate</span>
    </div>

</div>
<!-- 🔥 TOP STUDENTS TABLE -->
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
            <?php foreach ($students as $index => $student): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $student['name'] ?></td>
                    <td><?= $student['grade'] ?></td>
                    <td><?= $student['average'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<?php
$teachers = [
    [
        "id" => 1,
        "name" => "Arta Gashi",
        "subject" => "Matematikë",
        "lessons" => 18,
        "rating" => 4.9,
        "initials" => "AG"
    ],
    [
        "id" => 2,
        "name" => "Besnik Krasniqi",
        "subject" => "TIK",
        "lessons" => 14,
        "rating" => 4.7,
        "initials" => "BK"
    ],
    [
        "id" => 3,
        "name" => "Drita Berisha",
        "subject" => "Anglisht",
        "lessons" => 16,
        "rating" => 4.8,
        "initials" => "DB"
    ]
];

if (!isset($_SESSION['teacher_of_month'])) {
    $_SESSION['teacher_of_month'] = 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_SESSION['role'] ?? '') === 'admin') {
    $_SESSION['teacher_of_month'] = (int) $_POST['teacher_id'];
}

$teacherOfMonth = $teachers[0];

foreach ($teachers as $teacher) {
    if ($teacher['id'] === $_SESSION['teacher_of_month']) {
        $teacherOfMonth = $teacher;
        break;
    }
}
?>

<div class="teacher-month-wrapper">

    <div class="teacher-month-card">
        <div class="teacher-avatar">
            <?= $teacherOfMonth['initials'] ?>
        </div>

        <div class="teacher-info">
            <h2>Teacher of the Month</h2>
            <h3><?= $teacherOfMonth['name'] ?></h3>
            <p><?= $teacherOfMonth['subject'] ?></p>

            <div class="teacher-stats">
                <span>Lessons: <?= $teacherOfMonth['lessons'] ?></span>
                <span>Rating: <?= $teacherOfMonth['rating'] ?> ⭐</span>
            </div>
        </div>
    </div>

    <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
        <button class="change-teacher-btn" onclick="toggleTeacherForm()">
            Change Teacher
        </button>

        <form method="POST" class="teacher-select-form" id="teacherSelectForm">
            <label>Select teacher:</label>

            <select name="teacher_id" required>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?= $teacher['id'] ?>">
                        <?= $teacher['name'] ?> - <?= $teacher['subject'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Update</button>
        </form>
    <?php endif; ?>

</div>

<script>
function toggleTeacherForm() {
    const form = document.getElementById("teacherSelectForm");
    form.classList.toggle("show");
}
</script>
<script>
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

<?php include __DIR__ . '/../includess/footer.php'; ?>