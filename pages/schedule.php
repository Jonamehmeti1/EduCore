<?php include __DIR__ . '/../includess/header.php'; ?>

<div class="schedule-container">
    <h1 class="schedule-title">Schedule - Admin</h1>

    <?php
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
            "08:00 - 08:45" => [
                "subject" => "Matematike",
                "teacher" => "Prof. Blerim",
                "class" => "10A"
            ],
            "08:50 - 09:35" => [
                "subject" => "Programim",
                "teacher" => "Prof. Arben",
                "class" => "11B"
            ],
        ],
        "Tuesday" => [
            "09:40 - 10:25" => [
                "subject" => "Anglisht",
                "teacher" => "Prof. Elira",
                "class" => "10A"
            ],
        ],
        "Wednesday" => [
            "10:30 - 11:15" => [
                "subject" => "Fizike",
                "teacher" => "Prof. Drita",
                "class" => "12C"
            ],
        ],
        "Thursday" => [
            "11:20 - 12:05" => [
                "subject" => "Kimi",
                "teacher" => "Prof. Besnik",
                "class" => "11B"
            ],
        ],
        "Friday" => [
            "13:00 - 13:45" => [
                "subject" => "Biologji",
                "teacher" => "Prof. Nora",
                "class" => "10A"
            ],
        ],
    ];
    ?>

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
                                <input 
                                    type="text" 
                                    class="schedule-input"
                                    id="subject<?= $cellId ?>"
                                    placeholder="Subject"
                                    value="<?= $subject ?>"
                                >

                                <input 
                                    type="text" 
                                    class="schedule-input"
                                    id="teacher<?= $cellId ?>"
                                    placeholder="Teacher"
                                    value="<?= $teacher ?>"
                                >

                                <input 
                                    type="text" 
                                    class="schedule-input"
                                    id="class<?= $cellId ?>"
                                    placeholder="Class"
                                    value="<?= $class ?>"
                                >

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