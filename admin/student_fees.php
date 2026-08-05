<?php
session_start();
include('../includes/config.php');
$std_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($std_id <= 0) {
    $_SESSION['error'] = "Please select a student first.";
    header("Location: students.php");
    exit();
}
$stmt = mysqli_prepare($conn, "SELECT id, name, email FROM school_management_system WHERE id = ? AND type = 'student' LIMIT 1");
mysqli_stmt_bind_param($stmt, "i", $std_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $student_name, $student_email);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if (!$id) {
    $_SESSION['error'] = "Student not found!";
    header("Location: students.php");
    exit();
}

$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$currentMonth = date("F");
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Fee Payment - <?= htmlspecialchars($student_name) ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="students.php">Students</a></li>
                        <li class="breadcrumb-item active">Fee Payment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <!-- Student Info -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Student Details</h5>
                    <p><strong>Name:</strong> <?= htmlspecialchars($student_name) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($student_email) ?></p>
                </div>
            </div>

            <!-- Fees Table -->
            <div class="card">
                <div class="card-header">
                    <h5>Monthly Tuition Fee</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Month</th>
                                    <th>Fee Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sno = 1;
                                foreach ($months as $month): 
                                ?>
                                    <tr>
                                        <td><?= $sno++ ?></td>
                                        <td><?= $month ?></td>
                                        <td>Paid In Cash</td>
                                        <td>
                                            <a href="process_fee_payment.php?student_id=<?= $std_id ?>&month=<?= urlencode($month) ?>" 
                                               class="btn btn-sm btn-success">
                                                Pay Now
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include('footer.php'); ?>