<?php
session_start();
include('../includes/config.php'); 
if (isset($_GET['delete']) && isset($_GET['id'])) {
	$id = $_GET['id'];
    $type = "teacher";
    $stmt = $conn->prepare("DELETE FROM school_management_system WHERE id = ? AND type = ?");
    $stmt->bind_param("is", $id, $type);
    $stmt->execute();
	$_SESSION['success'] = "Teacher deleted successfully!";
    header("location: teachers.php");
    exit();
}
include('header.php');
include('sidebar.php');
?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
				<div class="d-flex">
                    <h3 class="d-inline-block mb-0">Manage Accounts </h3> 
					<a href="add_teacher.php" class="btn btn-primary btn ms-2"> Add New</a>
					</div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Teachers
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
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo htmlspecialchars($_SESSION['success']); ?>
                        </div>
                    <?php unset($_SESSION['success']); endif; ?>

                    <table class="table table-bordered table-striped">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 60px;">S.No.</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $type = "teacher";
                            $stmt = mysqli_prepare($conn, "SELECT id, email, password, name FROM school_management_system WHERE type = ?");
                            mysqli_stmt_bind_param($stmt, "s", $type);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id, $email, $password, $name);

                            $sno = 1;
                            while (mysqli_stmt_fetch($stmt)){ ?> 
                                <tr>
                                <td><?=$sno?></td>
                                <td><?= htmlspecialchars($email)?></td>
								<td><?= htmlspecialchars($password)?></td>
                                <td><?= htmlspecialchars($name)?></td>
								<td>
                                  <a href="teachers.php?delete=1&id=<?=$id?>"
								   name="delete"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Delete this teacher?');">
                                   Delete
                                  </a>
                                  </td>
                                </tr>
                                <?$sno++;?>
                            <?php }
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