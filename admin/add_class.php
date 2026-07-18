<?php
include('../includes/config.php'); 

	if(isset($_POST['submit'])){
	$title = $_POST['title'];
	$sections = implode(',' , $_POST['sections']);
	$add_date = date('Y-m-d');
	mysqli_query($conn , "INSERT INTO classes(title, section, add_date) VALUES ('$title','$sections','$add_date')");
	header("location: add_class.php");
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
                <h3 class="mb-0">Manage Classes</h3>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                       Add Classes
                    </li>
                </ol>
            </div>
        </div>
    <div class="app-content">
        <div class="container-fluid">
            <!-- Teacher Page Content -->
           <div class="card">
			<div class="card-body">

        <h5>Add New Class</h5>

        <form action="" method="POST">

            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
            <br>
            <label class="form-label">Section</label>
            <?php
            $stmt = mysqli_prepare($conn, "SELECT id, title FROM sections");
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id, $title);

            while (mysqli_stmt_fetch($stmt)) {
            ?>
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="sections[]"
                           value="<?php echo $id; ?>"
                           id="section<?php echo $id; ?>">

                    <label class="form-check-label" for="section<?php echo $id; ?>">
                        <?php echo htmlspecialchars($title); ?>
                    </label>
                </div>
            <?php
            }
            mysqli_stmt_close($stmt);
            ?>
            <button type="submit" name="submit"class="btn btn-danger mt-3">
                Submit
            </button>
        </form>
    </div>
</div>
</main>
<?php include('footer.php'); ?>