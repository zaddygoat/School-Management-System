<?php
session_start();
include('../includes/config.php'); 


	if(isset($_POST['submit'])){
		
	$name = $_POST['name'];
	$category = $_POST['category'];
	$duration = $_POST['duration'];	
	$image = $_FILES["image"]["name"];	
	$date = date('Y-m-d');
	
	$target_dir = "../dist/uploads/";
	$target_file = $target_dir . basename ($_FILES["image"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$uploadOk = 1;
	
	//Check If THe File Exist
	if(file_exists($target_file)){
		echo "File Already Exists.";
		$uploadOk = 0;
	}
	//Checking File Size And Limiting it
	if($_FILES["image"]["size"] > 500000){
	echo "Sorry File Size Should Be Under 500KB";
		$uploadOk = 0;
	}	
	//Check If the File Format is jpg png jpeg and gif 
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
		echo "Only JPG, PNG, JPEG, GIF Files Are Allowed.";
		$uploadOk = 0;
	}
	//Check If The File Is Uploaded
	if($uploadOk == 0){
		echo "Sorry , THe File Was Not Uploaded.";
		
	}else{
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
		mysqli_query($conn, "INSERT INTO courses(`name`, `category`, `duration`, `image`, `date`)
		VALUES('$name','$category','$duration','$image','$date')");
		$_SESSION['success_msg'] = 'Course Has been Uploaded Succesfully';
		header("location: courses.php");
		exit();
		}
	}	

	
}
include('header.php');
include('sidebar.php');
?>
<main class="app-main">
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Courses <br> </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                       Add Courses
                    </li>
                </ol>
            </div>
		</div>
    <div class="app-content">
        <div class="container-fluid">
            <!-- Teacher Page Content -->
<div class="card">
    <div class="card-header">
        <h5>Add New Course</h5>
    </div>

    <div class="card-body">

        <form action="" method="POST" enctype="multipart/form-data">

            <!-- Course Name -->
            <div class="mb-3">
                <label class="form-label">Course Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Course Name"
                       required>
            </div>

            <!-- Course Category -->
            <div class="mb-3">
                <label class="form-label">Course Category</label>
                <select name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="Programming">Programming</option>
                    <option value="Developer">Developer</option>
                    <option value="Design">Design</option>
                </select>
            </div>

            <!-- Course Duration -->
            <div class="mb-3">
                <label class="form-label">Course Duration</label>
                <input type="text"
                       name="duration"
                       class="form-control"
                       placeholder="Course Duration"
                       required>
            </div>

            <!-- Thumbnail -->
            <div class="mb-3">
                <label class="form-label">Course Thumbnail</label>
                <input type="file"
                       name="image"
                       class="form-control"
                       accept="image/*">
            </div>

            <!-- Submit -->
            <button type="submit"
                    name="submit"
                    class="btn btn-success">
                Submit
            </button>

        </form>

    </div>
</div>
</main>
<?php include('footer.php'); ?>