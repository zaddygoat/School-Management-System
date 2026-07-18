<?php
session_start();
include('../includes/config.php'); 
include('../includes/functions.php'); 

$class_id   = intval($_GET['class_id'] ?? 0);
$section_id = intval($_GET['section_id'] ?? 0);

$timetable = []; // will hold day => [time_slot => subject]

if ($class_id && $section_id) {
    $stmt = $conn->prepare("SELECT day, time_slot, subject FROM timetable WHERE class_id = ? AND section_id = ?");
    $stmt->bind_param("ii", $class_id, $section_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $timetable[$row['day']][$row['time_slot']] = $row['subject'];
    }
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
                <div class="col-sm-6"><h3 class="mb-0">View Time-Table</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">View Time-Table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Select Class & Section</h3></div>
                <div class="card-body">
                    <form method="GET" class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Select Class</label>
                            <select name="class_id" class="form-select" required>
                                <option value="">-- Select Class --</option>
                                <?php
                                $classes = get_the_classes($conn);
                                foreach ($classes as $value) { ?>
                                    <option value="<?=$value->id?>" <?= $value->id == $class_id ? 'selected' : '' ?>>
                                        <?=htmlspecialchars($value->title)?>
                                    </option>
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
                                    <option value="<?=$value->id?>" <?= $value->id == $section_id ? 'selected' : '' ?>>
                                        <?=htmlspecialchars($value->title)?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">View Time-Table</button>
                        </div>
                    </form>

                    <?php if ($class_id && $section_id) { ?>
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
                                        <?php foreach ($slots as $slot) { 
                                            $subject = $timetable[$day][$slot] ?? '-';
                                        ?>
                                            <td><?=htmlspecialchars($subject)?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p class="text-muted">Please select a class and section to view the timetable.</p>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>