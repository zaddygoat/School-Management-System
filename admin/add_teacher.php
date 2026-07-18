<?php
session_start();
include('../includes/config.php'); 
?>
 <?php
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = md5(123456789);
		$type = $_POST['type'];
		
		$checkStmt = mysqli_prepare($conn, "SELECT id FROM school_management_system WHERE email = ?");
		mysqli_stmt_bind_param($checkStmt, "s", $email);
		mysqli_stmt_execute($checkStmt);
		mysqli_stmt_store_result($checkStmt);

		if (mysqli_stmt_num_rows($checkStmt) > 0) {
			$_SESSION['error'] = "This email is already registered.";
			mysqli_stmt_close($checkStmt);
			header("Location: add_teacher.php");
			exit();
		}
		mysqli_stmt_close($checkStmt);
		
		$stmt = mysqli_prepare($conn, "INSERT INTO school_management_system(`name`, `email`, `password`, `type`) VALUES(?, ?, ?, ?) ");
		mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $type);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		$_SESSION['success'] = "Teacher added successfully!";
		header("Location: teachers.php");
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
                    <h3 class="mb-0">Manage Accounts </h3> 
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
				<form method="POST" action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <?php if (isset($_SESSION['error'])): ?>
						<small class="text-danger">
						<?php echo htmlspecialchars($_SESSION['error']); ?>
						</small>
						<?php unset($_SESSION['error']); endif; ?>
						<input type="hidden" name="type" value="teacher">
                        <button type="submit" name="submit" class="btn btn-primary">Add Teacher</button>
                        <a href="manage_teachers.php" class="btn btn-secondary">Cancel</a>
                    </form>
                           
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>