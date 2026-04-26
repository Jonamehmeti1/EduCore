<?php
include __DIR__ . '/../includess/header.php';

require_once __DIR__ . '/../classes/Student.php';
require_once __DIR__ . '/../classes/Teacher.php';

$student1 = new Student(1, "Arian Krasniqi", "arian@email.com", "10A", 4.7);
$teacher1 = new Teacher(1, "Arta Gashi", "arta@email.com", "Matematikë", true);
?>

<h1>Activity</h1>

<div class="dashboard-card">
    <h3>Student Info</h3>
    <p><?= $student1->getStudentInfo(); ?></p>
</div>

<div class="dashboard-card">
    <h3>Teacher Info</h3>
    <p><?= $teacher1->getTeacherInfo(); ?></p>
</div>

<?php include __DIR__ . '/../includess/footer.php'; ?>