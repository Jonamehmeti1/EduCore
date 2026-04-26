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
        ["name" => "Arta Gashi", "grade" => "10A", "average" => 4.9],
        ["name" => "Besnik Krasniqi", "grade" => "10B", "average" => 4.8],
        ["name" => "Drita Berisha", "grade" => "10A", "average" => 4.7],
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