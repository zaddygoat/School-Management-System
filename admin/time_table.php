<?php
session_start();
include('../includes/config.php'); 
include('../includes/functions.php'); 

if (isset($_POST['submit'])) {
    $class_id   = intval($_POST['class_id']);
    $section_id = intval($_POST['section_id']);
    $grid = $_POST['timetable'];// Name Of The Timetable (timetable = [$day] [$slot]) => subject

    $stmt = $conn->prepare(
        "INSERT INTO timetable (class_id, section_id, day, time_slot, subject)
         VALUES (?, ?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE subject = VALUES(subject)"
    );

    foreach ($grid as $day => $slots) {
        foreach ($slots as $time_slot => $subject) {
            $subject = trim($subject);
            $stmt->bind_param("iisss", $class_id, $section_id, $day, $time_slot, $subject);
            $stmt->execute();
        }
    }

    header("location: time_table.php");
    exit();
}

include('header.php');
include('sidebar.php');

$days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
$slots = ["9:00 - 10:00","10:00 - 11:00","11:00 - 12:00","1:00 - 2:00","2:00 - 3:00"];
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Manage Time-Table</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Time-Table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Create Time-Table</h3></div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Select Class</label>
                                <select name="class_id" class="form-select" required>
                                    <option value="">-- Select Class --</option>
                                    <?php
                                    $classes = get_the_classes($conn);
                                    foreach ($classes as $value) { ?>
                                        <option value="<?=$value->id?>"><?=$value->title?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Select Section</label>
                                <select name="section_id" class="form-select" required>
                                    <option value="">-- Select Section --</option>
                                    <?php
                                    $sections = get_the_sections($conn);
                                    foreach ($sections as $value) { ?>
                                        <option value="<?=$value->id?>"><?=$value->title?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Day</th>
                                        <?php foreach ($slots as $slot) { ?>
                                            <th><?=$slot?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($days as $day) { ?>
                                    <tr>
                                        <td><?=$day?></td>
                                        <?php foreach ($slots as $slot) { ?>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="timetable[<?=$day?>][<?=$slot?>]">
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary mt-3">
                            Save Time-Table
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>