<?php
include('../includes/config.php'); 

function get_the_classes(){
	$input = array();
	$query = mysqli_query($conn , SELECT * FROM classes);
	while($row = mysqli_fetch_object($query)){
			$input[] = $row;
	}
	return $input;
}	

<?php
/**
 * functions.php
 * -----------------------------------------------------------------
 * Shared, reusable database helpers for the Student / Fees module.
 * Include this AFTER config.php on any page that needs them:
 *
 *   include('../includes/config.php');
 *   include('functions.php');
 *
 * Every function takes $conn (the mysqli connection from config.php)
 * as its first argument so nothing here depends on global state.
 * -----------------------------------------------------------------
 */

/**
 * Look up ONE student's core account row (id, email, name) by id.
 * Used by student_detail.php to know which student we're viewing.
 * Returns an associative array, or false if no match.
 */
function getStudentById($conn, $id)
{
    $type = "student";
    $stmt = mysqli_prepare($conn, "SELECT id, email, name FROM school_management_system WHERE id = ? AND type = ?");
    mysqli_stmt_bind_param($stmt, "is", $id, $type);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $student;
}

/**
 * Get EVERY student account row. Used by students.php to build the list table.
 * Returns a plain array of associative arrays.
 */
function getAllStudents($conn)
{
    $type = "student";
    $stmt = mysqli_prepare($conn, "SELECT id, email, name FROM school_management_system WHERE type = ?");
    mysqli_stmt_bind_param($stmt, "s", $type);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $students = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $students;
}

/**
 * Get the extended profile row (dob, address, parents, academics, etc.)
 * for one student from student_details. Returns false if none exists yet.
 */
function getStudentDetails($conn, $student_id)
{
    $stmt = mysqli_prepare($conn, "SELECT * FROM student_details WHERE student_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $details = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $details;
}

/**
 * Get every fee row paid by one student, indexed by "Month-Year"
 * (e.g. "July-2026") so student_detail.php can check a month with
 * a single isset() instead of looping the DB result per row.
 */
function getFeesByStudent($conn, $student_id)
{
    $stmt = mysqli_prepare($conn, "SELECT * FROM fees WHERE std_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $fees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $key = $row['month'] . '-' . $row['year'];
        $fees[$key] = $row;
    }
    mysqli_stmt_close($stmt);
    return $fees;
}

/**
 * Insert one fee payment record. Returns true/false.
 * NOTE: requires the `month`, `year`, `payment_method` columns added
 * in fees_migration.sql — see that file.
 */
function insertFeePayment($conn, $std_id, $receipt_number, $registration_fee, $payment_method, $month, $year)
{
    $stmt = mysqli_prepare($conn, "INSERT INTO fees (std_id, receipt_number, registration_fee, payment_method, month, year) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isdssi", $std_id, $receipt_number, $registration_fee, $payment_method, $month, $year);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

/**
 * Delete a student's login/account row.
 * Pairs with ON DELETE CASCADE on student_details.student_id and
 * fees.std_id (see fees_migration.sql) so their profile and fee
 * history are cleaned up automatically instead of being orphaned.
 */
function deleteStudent($conn, $id)
{
    $type = "student";
    $stmt = mysqli_prepare($conn, "DELETE FROM school_management_system WHERE id = ? AND type = ?");
    mysqli_stmt_bind_param($stmt, "is", $id, $type);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}


?>