<?php
session_start();
include('../includes/config.php'); 
include('../includes/functions.php'); 
?>
<?php
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		mysqli_query($conn , "INSERT INTO subjects(name) VALUES('$name')");
		header("location: subjects.php");
		exit();
		
	}
	include('header.php');
?>
<?php
include('sidebar.php');
?>

<main class="app-main">
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Routine</h3>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Routine
                    </li>
                </ol>
            </div>
        </div>

        <!-- Add New Button -->
        <div class="d-flex justify-content-end mb-0">
            <a href="add_subjects.php" class="btn btn-danger btn-xs">
                <i class="fa-solid fa-plus me-1"></i> Add New
            </a>
        </div>
		<?php
		if(isset($_SESSION['success_msg'])){
		?>
		<div class="col-12">
		<small class="text-success" style="font-size:14px"><?= $_SESSION['success_msg']?></small>
		</div>
		<?php
		unset($_SESSION['success_msg']);
		}
		?>
    </div>
</div>
    <div class="app-content">
    <div class="container-fluid">
	<div class="row">
            <!-- Right Card -->
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="mb-3">Subjects</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:60px;">S.No.</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $subject_query = mysqli_query($conn, "SELECT * FROM subjects");
                                while($subject = mysqli_fetch_object($subject_query)){
                                ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $subject->name ?></td>
                                    <td><?= $subject->date ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<?php include('footer.php'); ?>