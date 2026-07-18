<?php
include('../includes/config.php'); 

function get_the_classes($conn){
	$input = array();
	$query = mysqli_query($conn , 'SELECT * FROM classes');
	while($row = mysqli_fetch_object($query)){
			$input[] = $row;
	}
	return $input;
}	

function get_the_sections($conn){
	$output = array();
	$query1 = mysqli_query($conn , 'SELECT * FROM sections');
	while($result = mysqli_fetch_object($query1)){
		$output[] = $result;
	}
	return $output;
}
function get_the_periods($conn){
	$output = array();
	$query1 = mysqli_query($conn , 'SELECT * FROM periods');
	while($result = mysqli_fetch_object($query1)){
		$output[] = $result;
	}
	return $output;
}





?>