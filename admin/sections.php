<?php
include('../includes/config.php'); 

	if(isset($_POST['submit'])){
	$title = $_POST['title'];
	mysqli_query($conn , "INSERT INTO sections(title) VALUES ('$title')");
	header("location: sections.php");
	exit();
	}
?>
	<?php
	if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM sections WHERE id = $id");
    header("location: sections.php");
    exit();
	}
	?>
	<?php

include('header.php');
include('sidebar.php');
?>
<main class="app-main">
    <div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Sections</h3>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Sections
                    </li>
                </ol>
            </div>
        </div>
    </div>
	
</div>
    <div class="app-content">
        <div class="container-fluid">
        <div class="row">
            <!-- Teacher Page Content -->
           <div class="col-lg-8">
			<div class="card">
				<div class="card-header">
				<h5>Sections</h5>
				</div>
				<div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:70px;">S.No.</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$count = 1;
							$query = mysqli_query($conn ,'SELECT * FROM sections');
							while($sections = mysqli_fetch_object($query)){ ?> 
							<tr>
								<td><?= $count++?></td>
								<td><?= htmlspecialchars($sections->title)?></td>
								<td>
								<a href="sections.php?delete=<?= $sections->id ?>"
									name="delete"
								   class="btn btn-danger btn-sm"
								   onclick="return confirm('Are you sure you want to delete this section?')">
								   Delete
								</a>
								</td>
								</td>
							</tr>	
							<?php } ?>
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
		<!-- Right Side -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add New Section</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        placeholder="Enter Title"
                                        required>
                                </div>
                                <button type="submit "name="submit" class="btn btn-success float-right">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row Ends -->
        </div>
    </div>
</main>
<?php include('footer.php'); ?>