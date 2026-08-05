<?php
session_start();
include('../includes/config.php');
$std_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

 $std_id = $_SESSION['user_id'] ?? 0;
 if ($std_id <= 0) {
    header("Location: " . "../fee_details.php?student_id=" . $std_id);
    exit();
 }
$stmt = mysqli_prepare($conn, "SELECT id, name, email FROM school_management_system WHERE id = ? AND type = 'student' LIMIT 1");
mysqli_stmt_bind_param($stmt, "i", $std_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $student_name, $student_email);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

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
                                    <th>Status</th>
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
                                        <td>Paid</td>
                                        <td>
                                            <button
                                            type="button"
                                            class="btn btn-sm btn-success paybtn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#paymentModal"
                                            data-student="<?= $std_id ?>"
                                            data-month="<?= $month ?>">
                                            Pay Now
                                        </button>
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
<!-- Payment Modal -->
<?php

?>
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">
                        Fee Payment
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="student_id" id="student_id">
                    <input type="hidden" name="month" id="month_hidden">

                    <div class="mb-3">
                        <label class="form-label">Student</label>
                        <input type="text"
                               class="form-control"
                               value="<?= htmlspecialchars($student_name) ?>"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Month</label>
                        <input type="text"
                               class="form-control"
                               value=""
                               id="month_display"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <h2 class="text-danger">₹ 5000</h2>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select" name="payment_method" required>
                            <option value="">Select Method</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-success">
                        Proceed to Pay
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
<?php include('footer.php'); ?>
<script>
    jQuery(document).on('click','.paybtn',function(){
        var month = jQuery(this).data('month');
         jQuery('#month_hidden').val(month);
         jQuery('#month_display').val(month);
    });
    </script>