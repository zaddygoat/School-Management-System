<?php
include('../includes/config.php'); 
if (isset($_GET['delete']) && isset($_GET['id'])) {
	$id = $_GET['id'];
    $type = "student";
    
    $stmt = $conn->prepare("DELETE FROM school_management_system WHERE id = ? AND type = ?");
    $stmt->bind_param("is", $id, $type);
    $stmt->execute();
    header("location: students.php");
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
                    <h3 class="d-inline-block mb-0"">Manage Accounts</h3>
				<a href="add_students.php" class="btn btn-primary btn ms-2"> Add New</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Students
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
                    <form method="GET" class="row mb-3">
                    <div class="col-md-4">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by name or email"
                            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>

                        <a href="students.php" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>
                </form>
                    <table class="table table-bordered table-striped" id="users-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Action</th>
                                <th>View Fee Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $type = "student";
                            $search = trim($_GET['search'] ?? '');
                            if ($search != "") {
                            $searchLike = "%" . $search . "%";

                            $stmt = mysqli_prepare($conn, "SELECT id, email, name FROM school_management_system WHERE type = ? AND (name LIKE ? OR email LIKE ?)");
                            mysqli_stmt_bind_param($stmt, "sss", $type, $search, $searchLike);
                            } else {
                            $stmt = mysqli_prepare($conn, "SELECT id, email, name FROM school_management_system WHERE type = ?");
                            mysqli_stmt_bind_param($stmt, "s", $type);
                            }
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id, $email, $name);
                            $sno = 1;
                            while (mysqli_stmt_fetch($stmt)) { ?>
                                <tr>
                                <td> <?=$sno++?> </td>
                                <td><?= htmlspecialchars($email)?></td>
                                <td><?= htmlspecialchars($name)?></td>
								<td>
                                  <a href="students.php?delete=1&id=<?=$id?>"
								   name="delete"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Delete this student?');">
                                   Delete
                                  </a>
                                  </td>
                                  <td>
                                  <a href="student_fees.php?id=<?= $id; ?>"
                                  class="btn btn-sm btn-info">
                                    View Fee
                                 </a>
                                </td>
                                </tr>
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