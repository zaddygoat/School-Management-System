<?php
include('../includes/config.php'); 

function get_the_classes(){
	$input = array();
	$query = mysqli_query($conn , "SELECT * FROM classes");
	while($row = mysqli_fetch_object($query)){
			$input[] = $row;
	}
	return $input;
}	
function get_the_subjects($conn, $class_id){
    $input = array();

    $stmt = $conn->prepare("SELECT * FROM subjects WHERE class_id = ?");
    $stmt->bind_param("i", $class_id);
    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_object()){
        $input[] = $row;
    }

    return $input;
}

?>