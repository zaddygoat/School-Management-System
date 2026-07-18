<?php
include('../includes/config.php'); 
include('header.php');
include('sidebar.php');
?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
				<div class="d-flex">
                    <h3 class="mb-0">Manage Accounts </h3> 
					<a href="add_teacher.php" class="btn btn-primary btn-sm"> Add New</a>
					</div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Counsellor
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <!-- Teacher Page Content -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $type = "counsellor";
                            $stmt = mysqli_prepare($conn, "SELECT email, password, name FROM school_management_system WHERE type = ?");
                            mysqli_stmt_bind_param($stmt, "s", $type);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $email, $password, $name);

                            $sno = 1;
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<tr>";
                                echo "<td>" . $sno . "</td>";
                                echo "<td>" . htmlspecialchars($email) . "</td>";
                                echo "<td>" . htmlspecialchars($password) . "</td>";
                                echo "<td>" . htmlspecialchars($name) . "</td>";
                                echo "</tr>";
                                $sno++;
                            }
                            mysqli_stmt_close($stmt);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>