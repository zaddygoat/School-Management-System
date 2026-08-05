    <?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    include('../includes/config.php'); 
    $std_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $stmt = mysqli_prepare($conn, "SELECT id, name, email FROM school_management_system WHERE id = ? AND type = 'student'");
    mysqli_stmt_bind_param($stmt, "i", $std_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $student_name, $student_email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);


    ?>
    <?php
    include('header.php');
    include('sidebar.php');
    ?>
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                    <div class="d-flex">
                        <h3 class="d-inline-block mb-0">Manage Attendance </h3> 	
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Student Attendance
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="card mb-4">
                    <div class="card-body">
                        <h5>Student Details</h5>
                        <form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <select name="id" class="form-select" required>
                <option value="">-- Select Student --</option>
                <?php
                $result = mysqli_query($conn, "SELECT id, name FROM school_management_system WHERE type='student' ORDER BY name");

                while ($student = mysqli_fetch_assoc($result)) {
                    $selected = (isset($_GET['id']) && $_GET['id'] == $student['id']) ? "selected" : "";
                    ?>
                    <option value="<?= $student['id'] ?>" <?= $selected ?>>
                        <?= $student['id'] ?> - <?= htmlspecialchars($student['name']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>
            <div class="col-md-2">
            <button type="submit" class="btn btn-primary">
                View Attendance
            </button>
             <a href="attendance.php" class="btn btn-secondary">
                            Reset
                        </a>
                        </div>
                    </div>
                    </form>
                    <?php if ($std_id > 0 && !empty($student_name)) { ?>
                        <p><strong>Name:</strong> <?= htmlspecialchars($student_name) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($student_email) ?></p>
                        <?php } ?>
                    </div>
                </div>
        <?php if ($std_id > 0) { ?>
        <div class="card">
                    <div class="card-header">
                        <h5>Student</h5>
                    </div>
                    <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">S.No.</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Sign In Time</th>
                                        <th>Sign Out Time</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $current_month = strtolower(date('F'));
                                    $current_year = date('Y');
                                    $stmt = mysqli_prepare($conn, "SELECT attendance_value FROM attendance WHERE std_id = ? AND attendance_month = ? AND year(current_session) = ?");
                                    mysqli_stmt_bind_param($stmt, "iss", $std_id, $current_month, $current_year);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    $row = mysqli_fetch_assoc($result);
                                    if (!$row || empty($row['attendance_value'])) {
                                    echo "<tr>
                                            <td colspan='5' class='text-center text-danger'>
                                                No attendance records found for this student.
                                            </td>
                                        </tr>";
                                        mysqli_stmt_close($stmt);
                                    } else {
                                    $data = unserialize($row['attendance_value']);

                                    for($i = 1; $i <= 31; $i++){
                                    $day = str_pad($i, 2, '0', STR_PAD_LEFT);
                                    $attendance = $data[$day] ?? null;
                                    $signin  = $attendance['signin_at']  ?? null;
                                    $signout = $attendance['signout_at'] ?? null;
                                    ?>
                                    <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $day ?></td>
                                    <td><?= !empty($signin) ? 'Present' : 'Absent' ?></td>
                                    <td><?= !empty($signin)  ? date('d-m-Y h:i:s', $signin)  : '-' ?></td>
                                    <td><?= !empty($signout) ? date('d-m-Y h:i:s', $signout) : '-' ?></td>
                                    </tr>
                                    <?php }
                                    mysqli_stmt_close($stmt); 
                                    }
                                    ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>


























    <?php include('footer.php');?>