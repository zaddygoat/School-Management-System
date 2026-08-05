<?php
session_start();
include('../includes/config.php'); 
$action = isset($_GET['action']) ? $_GET['action'] : 'add-new';
	if(isset($_POST['submit'])&& $action == 'add-new'){
		$name = $_POST['name'];
		$email = $_POST['email'];
        $dob = $_POST['dob'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        $father_name = $_POST['father_name'];
        $father_mobile = $_POST['father_mobile'];
        $mother_name = $_POST['mother_name'];
        $mother_mobile = $_POST['mother_mobile'];

        $qualification = $_POST['qualification'];
        $college_name = $_POST['college_name'];
        $school_college = $_POST['school_college'];
        $status = $_POST['status'];
        $total_marks = $_POST['total_marks'];
        $obtain_marks = $_POST['obtain_marks'];
        $percentage = ($total_marks > 0) ? ($obtain_marks / $total_marks) * 100 : 0;
        $admission_in = $_POST['admission_in'];
        $stream = $_POST['stream'];
        $date_of_join = $_POST['date_of_join'];

		$password = md5($dob);
		$type = $_POST['type'];
        $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
		
		$checkStmt = mysqli_prepare($conn, "SELECT id FROM school_management_system WHERE email = ?");
		mysqli_stmt_bind_param($checkStmt, "s", $email);
		mysqli_stmt_execute($checkStmt);
		mysqli_stmt_store_result($checkStmt);

		if (mysqli_stmt_num_rows($checkStmt) > 0) {
			$_SESSION['error'] = "This email is already registered.";
			mysqli_stmt_close($checkStmt);
			header("Location: add_students.php");
			exit();
		}
		mysqli_stmt_close($checkStmt);
		
		$stmt = mysqli_prepare($conn, "INSERT INTO school_management_system(`name`, `email`, `password`, `type`) VALUES(?, ?, ?, ?) ");
		mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $type);
		mysqli_stmt_execute($stmt);
        $student_id = mysqli_insert_id($conn);
		mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conn, "INSERT INTO student_details(student_id,dob,mobile,address,father_name,father_mobile,mother_name,mother_mobile,qualification,college_name,school_college,status,total_marks,obtain_marks,percentage,admission_in,stream,date_of_join,payment_method)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt2, "isssssssssssddsssss", $student_id, $dob, $mobile, $address, $father_name, $father_mobile, $mother_name, $mother_mobile, $qualification, $college_name, $school_college, $status, $total_marks, $obtain_marks, $percentage, $admission_in, $stream, $date_of_join, $payment_method);
		mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        
        //Parent
		$checkParentStmt = mysqli_prepare($conn, "SELECT id FROM school_management_system WHERE email = ? AND type = 'parent'");
		mysqli_stmt_bind_param($checkParentStmt, "s", $father_mobile);
		mysqli_stmt_execute($checkParentStmt);
		mysqli_stmt_store_result($checkParentStmt);
 
		if (mysqli_stmt_num_rows($checkParentStmt) == 0) {
			$parent_password = $father_mobile; // plain text, not hashed
			$parent_type = 'parent';
			$parent_name = $father_name . " & " . $mother_name;
 
			$stmtP = mysqli_prepare($conn, "INSERT INTO school_management_system(`name`, `email`, `password`, `type`) VALUES(?, ?, ?, ?)");
			mysqli_stmt_bind_param($stmtP, "ssss", $parent_name, $father_mobile, $parent_password, $parent_type);
			mysqli_stmt_execute($stmtP);
			mysqli_stmt_close($stmtP);
		}
		mysqli_stmt_close($checkParentStmt);
        $_SESSION['success'] = "Student added successfully!";
		header("Location: add_students.php?action=fee-payment&std_id=" . $student_id);
		exit();
		}
        
        

        //Fees Submission Part
        if(isset($_POST['submit']) && $action == 'fee-payment'){
            $std_id = $_POST['std_id'];
            $receipt_number = $_POST['receipt_number'];
            $registration_fee= $_POST['registration_fee'];

            $stmt3 = mysqli_prepare($conn , "INSERT INTO fees(std_id,receipt_number,registration_fee) VALUES(?,?,?)");
            mysqli_stmt_bind_param($stmt3, "isd", $std_id, $receipt_number, $registration_fee);
            mysqli_stmt_execute($stmt3);
            mysqli_stmt_close($stmt3);
        $_SESSION['success'] = "Fee payment recorded successfully!";
        header("Location: students.php");
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
				<div class="d-flex">
                    <h3 class="mb-0">
                    <?php echo ($action == 'fee-payment') ? 'Fee Payment' : 'Manage Accounts'; ?>
                    </h3>
					</div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?php echo ($action == 'fee-payment') ? 'Fee Payment' : 'Students'; ?>
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
                <?php if ($action == 'add-new'): ?>
				<form method="POST" action="add_students.php?action=add-new">
                        <h5 class="mb-3 text-primary">Personal Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mobile</label>
                                <input type="text" name="mobile" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2" required></textarea>
                            </div>
                        </div>

                        <hr>
                        <h5 class="mb-3 text-primary">Parent / Guardian Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Father's Name</label>
                                <input type="text" name="father_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Father's Mobile Number</label>
                                <input type="text" name="father_mobile" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mother's Name</label>
                                <input type="text" name="mother_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mother's Mobile Number</label>
                                <input type="text" name="mother_mobile" class="form-control" required>
                            </div>
                        </div>

                        <hr>
                        <h5 class="mb-3 text-primary">Academic Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Qualification</label>
                                <input type="text" name="qualification" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">School / College Name</label>
                                <input type="text" name="college_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">School / College</label>
                                <select name="school_college" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    <option value="School">School</option>
                                    <option value="College">College</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    <option value="Pass">Pass</option>
                                    <option value="Fail">Fail</option>
                                    <option value="Appearing">Appearing</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Total Marks</label>
                                <input type="number" name="total_marks" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Obtained Marks</label>
                                <input type="number" name="obtain_marks" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Percentage</label>
                                <input type="text" class="form-control" placeholder="Auto-calculated on save" disabled>
                            </div>
                        </div>

                        <hr>
                        <h5 class="mb-3 text-primary">Admission Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Admission In</label>
                                <input type="text" name="admission_in" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stream</label>
                                <select name="stream" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    <option value="Science">Science</option>
                                    <option value="Commerce">Commerce</option>
                                    <option value="Arts">Arts</option>
                                    <option value="Degree">Degree</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date Of Join</label>
                                <input type="date" name="date_of_join" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <h5 class="mb-3 text-primary">Payment Method</h5>
                                <label for="cash" class="form-label"><input type="radio" name="payment_method" value="cash" id="cash"> Cash</label>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['error'])): ?>
						<small class="text-danger">
						<?php echo htmlspecialchars($_SESSION['error']); ?>
						</small>
						<?php unset($_SESSION['error']); endif; ?>
						<input type="hidden" name="type" value="student">
                        <button type="submit" name="submit" class="btn btn-primary">Add Student</button>
                        <a href="manage_students.php" class="btn btn-secondary">Cancel</a>
                    </form>
                    <?php elseif ($action == 'fee-payment'): ?>

                    <form method="POST" action="add_students.php?action=fee-payment">
                        <h5 class="mb-3 text-primary">Fee Payment</h5>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Receipt Number</label>
                                    <input type="text" name="receipt_number" placeholder="Receipt Number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Registration Fee</label>
                                    <input type="number" name="registration_fee" placeholder="Registration Fee" class="form-control" required>
                                </div>
                    </div>
                        <input type="hidden" name="std_id" value="<?php echo isset($_GET['std_id']) ? htmlspecialchars($_GET['std_id']) : ''; ?>">
                        <button type="submit" name="submit" class="btn btn-primary">Submit Payment</button>
                    </form>

                    <?php endif; ?>
                           
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>