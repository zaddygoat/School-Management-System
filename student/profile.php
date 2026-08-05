<?php
include('../includes/config.php');
 include('header.php'); 
 include('sidebar.php'); 
 $std_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$std_id = $_SESSION['user_id'] ?? 0;
 if ($std_id <= 0) {
    header("Location: " . "../fee_details.php?student_id=" . $std_id);
    exit();
    }

$stmt = mysqli_prepare($conn, "SELECT id, name, email FROM school_management_system WHERE id = ? AND type = 'student'");
mysqli_stmt_bind_param($stmt, "i", $std_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $student_name, $student_email);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);


?>
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">User Profile</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">User</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-3">
              <!-- Profile sidebar -->
              <div class="col-md-3">
                <!-- About card -->
                <div class="card">
                  <div class="card-body text-center">
                    <div
                      class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center mb-3"
                      style="width: 96px; height: 96px; font-size: 2rem"
                      aria-hidden="true">
                    </div>
                    <h3 class="h5 mb-0"><?= htmlspecialchars($student_name)?></h3>
                    <p class="text-secondary mb-3"><?= htmlspecialchars($student_email)?></p>
                    <ul class="list-group list-group-flush text-start small">
                      <li class="list-group-item d-flex justify-content-between px-0">
                  </div>
                </div>
                  </div>
                    </div>
</div>
</div>


<?php
 include('footer.php'); 
?>