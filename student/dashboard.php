<?php 
include('../includes/config.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Dashboard</h3>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

                            
    <?php
    $std_id = (int)$_SESSION['user_id'];
    $current_month = strtolower(date('F'));
    $current_year = date('Y');
    $current_date = date('d');
    $stmt = mysqli_prepare($conn, "SELECT attendance_value FROM attendance WHERE std_id = ? AND attendance_month = ? AND year(current_session) = ?");
    mysqli_stmt_bind_param($stmt, "iss", $std_id, $current_month, $current_year);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) == 0) {
    $empty = serialize([]);

    $insert = mysqli_prepare($conn, "INSERT INTO attendance (std_id, attendance_month, attendance_value, current_session) VALUES (?, ?, ?, NOW())");
    mysqli_stmt_bind_param($insert, "iss", $std_id, $current_month, $empty);
    mysqli_stmt_execute($insert);
    mysqli_stmt_close($insert);
    $chk = mysqli_prepare($conn, "SELECT attendance_value FROM attendance WHERE std_id = ? AND attendance_month = ? AND YEAR(current_session) = ?");
    mysqli_stmt_bind_param($chk, "isi", $std_id, $current_month, $current_year);
    mysqli_stmt_execute($chk);
    $result = mysqli_stmt_get_result($chk);
    mysqli_stmt_close($chk);
    }
    $row = mysqli_fetch_assoc($result);
    $attendance = ($row && !empty($row['attendance_value']))  ? unserialize($row['attendance_value']) : [];
      if(isset($_POST['sign-in'])){
        
    //   $data = [];
    //   for($i = 1; $i<=31; $i++){
    //    $data[$i] = [
    //     'signin_at' => (date('d') == $i)? time():'',
    //     'signout_at' => (date('d') == $i)? time():'',
    //     'date' => $i
    //    ];
    //   }
      $attendance[$current_date] = [
        'signin_at' => time(),
        'signout_at' => '',
        'date' => $current_date

      ];
      $data = serialize($attendance);
      $current_month = strtolower(date('F'));
      $stmt = mysqli_prepare($conn ,"UPDATE attendance SET attendance_value = ?  WHERE attendance_month = ? and  std_id = ?");
      mysqli_stmt_bind_param($stmt, "ssi", $data, $current_month, $std_id);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      }
      if(isset($_POST['sign-out'])){
      $attendance[$current_date]['signout_at'] = time();
      $data = serialize($attendance);
      $current_month = strtolower(date('F'));
      $stmt = mysqli_prepare($conn ,"UPDATE attendance SET attendance_value = ?  WHERE attendance_month = ? and  std_id = ?");
      mysqli_stmt_bind_param($stmt, "ssi", $data, $current_month, $std_id);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      }
?>
         <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Sign In Information
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <?php
                            if(empty($attendance[$current_date]['signin_at']) || $attendance[$current_date]['signout_at']){
                            echo '<button name="sign-in" class="btn btn-primary">Mark Present</button>';
                            }
                            else{
                            echo '<button name="sign-out" class="btn btn-primary">Done</button>';
                            }
                            ?>
                            
                        </form>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

<?php include('footer.php'); ?>