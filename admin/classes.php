<?php
include('../includes/config.php'); 
?>
<?php
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM classes WHERE id = $id");
    header("location: classes.php");
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
                        Classes
                    </li>
                </ol>
            </div>
        </div>

        <!-- Add New Button -->
        <div class="d-flex justify-content-end mb-0">
            <a href="add_class.php" class="btn btn-danger btn-xs">
                <i class="fa-solid fa-plus me-1"></i> Add New
            </a>
        </div>

    </div>
</div>
    <div class="app-content">
        <div class="container-fluid">
            <!-- Teacher Page Content -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					<h4> Classes </h4>
                        <thead>
                            <tr>
                                <th style="width: 60px;">S.No.</th>
                                <th>Name</th>
                                <th>Sections</th>
								<th>Date</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
                            $count = 1;
							$class_query = mysqli_query($conn ,'SELECT * FROM classes');
							while($class = mysqli_fetch_object($class_query)){ ?> 
							<tr>
								<td><?= $count++?></td>
								<td><?= htmlspecialchars($class->title)?></td>
								<td>
									<?php
									$sections = explode(',', $class->section);
									
									foreach($sections as $section) {
										$sec_query = mysqli_query($conn ,"SELECT * FROM sections WHERE id = '$section'");
									
									if($sec = mysqli_fetch_object($sec_query)){
									echo htmlspecialchars($sec->title) . "  ";
									}
								}
									?>
								</td>
								<td><?= htmlspecialchars($class->add_date)?></td>
								<td>
								<a href="classes.php?delete=<?= $class->id ?>" 
								   class="btn btn-danger btn-sm"
								   onclick="return confirm('Are you sure you want to delete this section?')">
								   Delete
								</a>
								</td>
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