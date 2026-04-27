<?php include __DIR__ . '/../includess/header.php'; ?>

<?php
// Ndërroje për testim: admin ose teacher
$role = "teacher";
// $role = "admin";

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
                <p>Mesatarja e klasës</p>
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
                    <?php $inputId = $className . $index; ?>

                    <tr>
                        <td><?= $student["student"] ?></td>
                        <td><?= $student["subject"] ?></td>
                        <td>
                            <input
                                type="number"
                                min="5"
                                max="10"
                                value="<?= $student["grade"] ?>"
                                id="grade<?= $inputId ?>"
                                class="grade-input"
                                disabled
                            >
                        </td>
                        <td>
                            <button class="edit-btn" onclick="editGrade('<?= $inputId ?>')">
                                Edit
                            </button>

                            <button class="save-btn" onclick="saveGrade('<?= $inputId ?>')">
                                Save
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endforeach; ?>

<?php endif; ?>

</div>

<script>
function hideAllTables() {
    let all = document.querySelectorAll(".details-card");
    all.forEach(card => card.style.display = "none");
}

function showAdminClass(className) {
    hideAllTables();
    document.getElementById("admin" + className).style.display = "block";
}

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
        alert("Nota duhet me qenë prej 5 deri 10!");
        return;
    }

    input.disabled = true;
    alert("Nota u ruajt me sukses!");
}
</script>

<?php include __DIR__ . '/../includess/footer.php'; ?>