<?php include __DIR__ . '/../includess/header.php'; ?>

<?php
// Ndryshoje për testim
$role = "teacher";
// $role = "admin";
// $role = "student";

$teacherName = "Prof. Blerim";
$studentClass = "10A";

$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

$times = [
    "08:00 - 08:45",
    "08:50 - 09:35",
    "09:40 - 10:25",
    "10:30 - 11:15",
    "11:20 - 12:05",
    "12:10 - 12:55",
    "13:00 - 13:45",
    "13:50 - 14:30"
];

$schedule = [
    "Monday" => [
        "08:00 - 08:45" => ["subject" => "Matematike", "teacher" => "Prof. Blerim", "class" => "10A"],
        "08:50 - 09:35" => ["subject" => "Programim", "teacher" => "Prof. Arben", "class" => "11B"],
        "09:40 - 10:25" => ["subject" => "Programim", "teacher" => "Prof. Arben", "class" => "10A"],
    ],
    "Tuesday" => [
        "08:50 - 09:35" => ["subject" => "Anglisht", "teacher" => "Prof. Elira", "class" => "10A"],
        "09:40 - 10:25" => ["subject" => "Matematike", "teacher" => "Prof. Blerim", "class" => "11B"],
        "11:20 - 12:05" => ["subject" => "Fizike", "teacher" => "Prof. Drita", "class" => "10A"],
    ],
    "Wednesday" => [
        "10:30 - 11:15" => ["subject" => "Fizike", "teacher" => "Prof. Drita", "class" => "12C"],
        "10:30 - 11:15" => ["subject" => "Kimi", "teacher" => "Prof. Besnik", "class" => "10A"],
        "13:00 - 13:45" => ["subject" => "Biologji", "teacher" => "Prof. Nora", "class" => "10A"],
    ],
    "Thursday" => [
        "08:00 - 08:45" => ["subject" => "Histori", "teacher" => "Prof. Valon", "class" => "10A"],
        "11:20 - 12:05" => ["subject" => "Matematike", "teacher" => "Prof. Blerim", "class" => "12C"],
        "12:10 - 12:55" => ["subject" => "Gjeografi", "teacher" => "Prof. Linda", "class" => "10A"],
    ],
    "Friday" => [
        "09:40 - 10:25" => ["subject" => "Edukatë Fizike", "teacher" => "Prof. Ilir", "class" => "10A"],
        "13:00 - 13:45" => ["subject" => "Biologji", "teacher" => "Prof. Nora", "class" => "10A"],
        "13:50 - 14:30" => ["subject" => "Art", "teacher" => "Prof. Hana", "class" => "10A"],
    ],
];
?>

<div class="schedule-container">

<?php if ($role == "admin"): ?>

    <h1 class="schedule-title">Schedule - Admin</h1>

    <div class="admin-info-card">
        <h2>Weekly Schedule</h2>
        <p>Admin can write or edit the subject, teacher and class for each hour.</p>
    </div>

    <div class="schedule-table-card">
        <table class="schedule-table">
            <tr>
                <th>Time</th>
                <?php foreach ($days as $day): ?>
                    <th><?= $day ?></th>
                <?php endforeach; ?>
            </tr>

            <?php foreach ($times as $time): ?>
                <tr>
                    <td class="time-cell"><?= $time ?></td>

                    <?php foreach ($days as $day): ?>
                        <?php
                        $subject = $schedule[$day][$time]["subject"] ?? "";
                        $teacher = $schedule[$day][$time]["teacher"] ?? "";
                        $class = $schedule[$day][$time]["class"] ?? "";
                        $cellId = str_replace([" ", ":", "-"], "", $day . $time);
                        ?>

                        <td>
                            <div class="schedule-cell">
                                <input type="text" class="schedule-input" id="subject<?= $cellId ?>" placeholder="Subject" value="<?= $subject ?>">
                                <input type="text" class="schedule-input" id="teacher<?= $cellId ?>" placeholder="Teacher" value="<?= $teacher ?>">
                                <input type="text" class="schedule-input" id="class<?= $cellId ?>" placeholder="Class" value="<?= $class ?>">

                                <button class="save-schedule-btn" onclick="saveSchedule('<?= $cellId ?>')">
                                    Save
                                </button>

                                <p class="saved-message" id="msg<?= $cellId ?>"></p>
                            </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php elseif ($role == "teacher"): ?>

    <h1 class="schedule-title">Schedule - Teacher</h1>

    <div class="teacher-info-card">
        <h2><?= $teacherName ?></h2>
        <p>Your weekly lectures schedule</p>
    </div>

    <div class="schedule-table-card teacher-schedule-card">
        <table class="schedule-table teacher-schedule-table">
            <tr>
                <th>Day</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Class</th>
            </tr>

            <?php foreach ($schedule as $day => $daySchedule): ?>
                <?php foreach ($daySchedule as $time => $item): ?>
                    <?php if ($item["teacher"] == $teacherName): ?>
                        <tr>
                            <td><?= $day ?></td>
                            <td class="time-cell"><?= $time ?></td>
                            <td><?= $item["subject"] ?></td>
                            <td><?= $item["class"] ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
    </div>

<?php elseif ($role == "student"): ?>

    <h1 class="schedule-title">Schedule - Student</h1>

    <div class="teacher-info-card">
        <h2>Class <?= $studentClass ?></h2>
        <p>Your lectures for each day</p>
    </div>

    <div class="schedule-table-card">
        <table class="schedule-table">
            <tr>
                <th>Day</th>
                <th>Lectures</th>
            </tr>

            <?php foreach ($schedule as $day => $daySchedule): ?>
                <tr>
                    <td class="time-cell"><?= $day ?></td>
                    <td>
                        <?php
                        $hasLecture = false;

                        foreach ($daySchedule as $time => $item):
                            if ($item["class"] == $studentClass):
                                $hasLecture = true;
                        ?>
                            <div class="student-lecture">
                                <strong><?= $time ?></strong><br>
                                <?= $item["subject"] ?><br>
                                <span><?= $item["teacher"] ?></span>
                            </div>
                        <?php
                            endif;
                        endforeach;

                        if (!$hasLecture) {
                            echo "<span class='no-lecture'>No lectures</span>";
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php endif; ?>

</div>

<script>
function saveSchedule(id) {
    let subject = document.getElementById("subject" + id);
    let teacher = document.getElementById("teacher" + id);
    let className = document.getElementById("class" + id);
    let msg = document.getElementById("msg" + id);

    if (
        subject.value.trim() === "" ||
        teacher.value.trim() === "" ||
        className.value.trim() === ""
    ) {
        msg.innerText = "Fill all fields";
        msg.style.color = "#ef4444";
        return;
    }

    msg.innerText = "Saved!";
    msg.style.color = "#22c55e";

    setTimeout(function () {
        msg.innerText = "";
    }, 2000);
}
</script>

<?php include __DIR__ . '/../includess/footer.php'; ?>