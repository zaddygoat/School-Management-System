<?php
session_start();
include('../includes/config.php');
$sql = "SELECT  sd.student_id, stu.name as student_name, sd.father_name, sd.mother_name, sd.father_mobile, sd.mother_mobile FROM student_details AS  sd JOIN school_management_system stu ON stu.id = sd.student_id AND stu.type = 'student'  JOIN school_management_system parent ON parent.email = sd.father_mobile AND parent.type = 'parent'  ORDER BY sd.student_id";

$result = mysqli_query($conn, $sql);

include('header.php');
include('sidebar.php');
?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Parents</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Parents</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Father's Name</th>
                                <th>Father's Mobile</th>
                                <th>Mother's Name</th>
                                <th>Mother's Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['father_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['father_mobile']); ?></td>
                                <td><?php echo htmlspecialchars($row['mother_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['mother_mobile']); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center">No parent records found.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>