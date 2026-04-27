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
<?php
$classes = [
    "10A" => [
        ["student" => "Arta Krasniqi", "subject" => "Matematike", "grade" => 9],
        ["student" => "Beni Gashi", "subject" => "Programim", "grade" => 8],
        ["student" => "Lira Berisha", "subject" => "Anglisht", "grade" => 10],
    ],
    "11B" => [
        ["student" => "Dion Hoxha", "subject" => "Matematike", "grade" => 7],
        ["student" => "Era Shala", "subject" => "Programim", "grade" => 9],
        ["student" => "Nita Morina", "subject" => "Anglisht", "grade" => 8],
    ],
    "12C" => [
        ["student" => "Jon Gashi", "subject" => "Matematike", "grade" => 10],
        ["student" => "Lea Hoti", "subject" => "Programim", "grade" => 9],
        ["student" => "Albi Berisha", "subject" => "Anglisht", "grade" => 7],
    ],
];

function calculateAverage($students) {
    $total = 0;
    foreach ($students as $student) {
        $total += $student["grade"];
    }
    return round($total / count($students), 2);
}
?>

<div class="grades-container">

<?php if ($role == "admin"): ?>

    <h1 class="grades-title">Grades - Admin</h1>

    <div class="cards">
        <?php foreach ($classes as $className => $students): ?>
            <div class="class-card">
                <h2>Class <?= $className ?></h2>
                <p>Mesatarja</p>
                <div class="average"><?= calculateAverage($students) ?></div>

                <button class="learn-btn" onclick="showAdminClass('<?= $className ?>')">
                    Learn more
                </button>
            </div>
        <?php endforeach; ?>
    </div>

    <?php foreach ($classes as $className => $students): ?>
        <div class="details-card" id="admin<?= $className ?>">
            <h2>Class <?= $className ?> - Notat</h2>

            <table>
                <tr>
                    <th>Student</th>
                    <th>Lënda</th>
                    <th>Nota</th>
                </tr>

                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= $student["student"] ?></td>
                        <td><?= $student["subject"] ?></td>
                        <td><?= $student["grade"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endforeach; ?>

<?php elseif ($role == "teacher"): ?>

    <h1 class="grades-title">Grades - Teacher</h1>

    <div class="cards">
        <?php foreach ($classes as $className => $students): ?>
            <div class="class-card">
                <h2>Class <?= $className ?></h2>
                <p>Manage student grades</p>

                <button class="learn-btn" onclick="showTeacherClass('<?= $className ?>')">
                    Grade Students
                </button>
            </div>
        <?php endforeach; ?>
    </div>

    <?php foreach ($classes as $className => $students): ?>
        <div class="details-card" id="teacher<?= $className ?>">
            <h2>Class <?= $className ?> - Grade Students</h2>

            <table>
                <tr>
                    <th>Student</th>
                    <th>Lënda</th>
                    <th>Nota</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($students as $index => $student): ?>
                    <?php $id = $className . $index; ?>
                    <tr>
                        <td><?= $student["student"] ?></td>
                        <td><?= $student["subject"] ?></td>
                        <td>
                            <input
                                type="number"
                                min="5"
                                max="10"
                                value="<?= $student["grade"] ?>"
                                id="grade<?= $id ?>"
                                class="grade-input"
                                disabled
                            >
                        </td>
                        <td>
                            <button class="edit-btn" onclick="editGrade('<?= $id ?>')">Edit</button>
                            <button class="save-btn" onclick="saveGrade('<?= $id ?>')">Save</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endforeach; ?>

<?php elseif ($role == "student"): ?>

    <h1 class="grades-title">Grades - Student</h1>

    <?php
    $studentName = "Arta Krasniqi";

    $studentGrades = [
        ["subject" => "Matematike", "teacher" => "Prof. Blerim", "grade" => 9, "status" => "Accepted"],
        ["subject" => "Programim", "teacher" => "Prof. Arben", "grade" => 8, "status" => "Accepted"],
        ["subject" => "Anglisht", "teacher" => "Prof. Elira", "grade" => 10, "status" => "Accepted"],
    ];
    ?>

    <div class="details-card student-card" style="display:block;">
        <h2><?= $studentName ?> - My Grades</h2>

        <table>
            <tr>
                <th>Lënda</th>
                <th>Profesori</th>
                <th>Nota</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php foreach ($studentGrades as $index => $g): ?>
                <tr>
                    <td><?= $g["subject"] ?></td>
                    <td><?= $g["teacher"] ?></td>
                    <td><?= $g["grade"] ?></td>

                    <td id="status<?= $index ?>">
                        <?= $g["status"] ?>
                    </td>

                    <td>
                        <button class="reject-btn" onclick="rejectGrade(<?= $index ?>)">
                            Reject
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php endif; ?>

</div>

<script>
function hideAllTables() {
    document.querySelectorAll(".details-card").forEach(c => c.style.display = "none");
}

/* ADMIN */
function showAdminClass(className) {
    hideAllTables();
    document.getElementById("admin" + className).style.display = "block";
}

/* TEACHER */
function showTeacherClass(className) {
    hideAllTables();
    document.getElementById("teacher" + className).style.display = "block";
}

function editGrade(id) {
    let input = document.getElementById("grade" + id);
    input.disabled = false;
    input.focus();
}

function saveGrade(id) {
    let input = document.getElementById("grade" + id);

    if (input.value === "" || input.value < 5 || input.value > 10) {
        alert("Nota duhet 5-10!");
        return;
    }

    input.disabled = true;
    alert("Saved!");
}

/* STUDENT */
function rejectGrade(index) {
    let status = document.getElementById("status" + index);
    status.innerText = "Rejected";
    status.style.color = "#ef4444";
    status.style.fontWeight = "bold";
}
</script>

<?php include __DIR__ . '/../includess/footer.php'; ?>