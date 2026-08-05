<?php
session_start();
include('../includes/config.php');
?>
<?php
$class_id = intval($_GET['class_id'] ?? 0);
$subject_id = intval($_GET['subject_id'] ?? 0);
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
                <h3 class="mb-0">Manage Study Material</h3>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Materials
                    </li>
                </ol>
            </div>
        </div>

        <!-- Add New Button -->
        <div class="d-flex justify-content-end mb-0">
            <a href="add_study_material.php" class="btn btn-danger btn-xs">
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
                                <th style="width: 190px;">Title</th>
                                <th style="width: 10px;">File</th>
                                <th style="width: 60px;">Class</th>
                                <th style="width: 60px;">Subject</th>
                                <th style="width: 80px;">Created</th>
                            </tr>
                        </thead>
                        <tbody>
						    <?php
                            $count = 1;
                            $materials_query = mysqli_query($conn, "SELECT study_materials.*, classes.title AS class_name, subjects.name AS subject_name FROM study_materials LEFT JOIN classes ON study_materials.class_id = classes.id LEFT JOIN subjects ON study_materials.subject_id = subjects.id");  
							while($material = mysqli_fetch_object($materials_query)){ ?> 
							<tr>
								<td><?= $count++?></td>
								<td> <a href ="/project/teacher/uploads/<?=($material->file)?>">Download</a></td>
								<td><?=$material->title?></td>
								<td><?=$material->file?></</td>
								<td><?=htmlspecialchars($material->class_name)  ?></</td>
								<td><?=htmlspecialchars($material->subject_name)?></</td>
                                <td><?=$material->created_at?></</td>
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