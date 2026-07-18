<?php
session_start();
include('../includes/config.php');
?>
<?php
	if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM courses WHERE id = $id");
	$_SESSION['success'] = "Course deleted successfully!";
    header("location: courses.php");
    exit();
	}
	?>
	<?php
include('header.php');
?>
<style>
.card{
    width:100%;
    height:100%;
    transition:.3s;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

.card-img-top{
    height:250px;
    width:100%;
    object-fit:contain;
    padding:20px;
    background:#fff;
}

.card-body{
    display:flex;
    flex-direction:column;
}

.btn{
    margin-top:auto;
}
</style>
<?php
include('sidebar.php');
?>

<main class="app-main">
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Courses</h3>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Courses
                    </li>
                </ol>
            </div>
        </div>

        <!-- Add New Button -->
        <div class="d-flex justify-content-end mb-0">
            <a href="add_course.php" class="btn btn-danger btn-xs">
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
            <!-- Teacher Page Content -->
            <div class="card">
                <div class="card-body">
				 <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo htmlspecialchars($_SESSION['success']); ?>
                        </div>
                    <?php unset($_SESSION['success']); endif; ?>
                    <table class="table table-bordered table-striped">
					<h4> Courses </h4>
                        <thead>
                            <tr>
                                <th style="width: 60px;">S.No.</th>
                                <th style="width: 30px;">Image</th>
                                <th style="width: 190px;">Name</th>
                                <th style="width: 10px;">Category</th>
                                <th style="width: 80px;">Duration</th>
                                <th style="width: 60px;">Date</th>
                                <th style="width: 60px;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
                            $count = 1;
							$courses_query = mysqli_query($conn ,'SELECT * FROM courses');
							while($course = mysqli_fetch_object($courses_query)){ ?> 
							<tr>
								<td><?= $count++?></td>
								<td> <img src="/project/dist/uploads/<?= urlencode($course->image) ?>" height="100" class="border"></td>
								<td><?=$course->name?></td>
								<td><?=$course->category?></</td>
								<td><?=$course->duration?></</td>
								<td><?=$course->date?></</td>
								<td>
								<a href="courses.php?delete=<?= $course->id ?>"
									name="delete"
								   class="btn btn-danger btn-sm"
								   onclick="return confirm('Are you sure you want to delete this course?')">
								   Delete
								</a>
							</tr>	
							<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>