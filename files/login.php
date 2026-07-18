<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/config.php');
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$md5 = md5($password);
		
		$stmt = $conn->prepare("SELECT * FROM school_management_system WHERE email = ? and password = ?");
		$stmt->bind_param("ss", $email, $password);
		$stmt->execute();
		$result = $stmt->get_result();
		echo "Rows found: " . $result->num_rows . "<br>";
		
		if($result->num_rows > 0){
			$user = $result->fetch_object();
			$_SESSION['login'] = true;
			$_SESSION['session_id'] = uniqid();
			$user_type = $user->type;
			$_SESSION['user_type'] = $user_type;
			$_SESSION['user_id'] = $user->id;
			header("location: ../".$user->type."/dashboard.php");
			exit;
		} 
	else {
		echo "Invalid Credentials";
		header("location: ../schoolmanagementproject.php");
		exit;
		
	}
}
?>