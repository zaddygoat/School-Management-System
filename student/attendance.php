<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include('../includes/config.php'); 
$std_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$std_id = $_SESSION['user_id'] ?? 0;
 if ($std_id <= 0) {
    header("Location: " . "../fee_details.php?student_id=" . $std_id);
    exit();
    }

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
                    <p><strong>Name:</strong> <?= htmlspecialchars($student_name) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($student_email) ?></p>
                </div>
            </div>

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

                                $data = ($row && !empty($row['attendance_value'])) 
                                    ? unserialize($row['attendance_value']) 
                                    : [];

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
                                ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php include('footer.php');?>