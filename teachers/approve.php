<?php 
include 'inc/session.php';
if (isset($_GET['approve'])) {
	$approve = $_GET['approve'];
	$sel = "SELECT * FROM materials WHERE id = '{$approve}'";
	$s_query = mysqli_query($connect, $sel);
	while ($row = mysqli_fetch_array($s_query)) {
		if ($row['status'] ==1) {
			$sql = "UPDATE materials SET status = 0 WHERE id = '{$approve}'";
			$query = mysqli_query($connect, $sql);
			echo "fas fa-check btn p-1 btn-warning | click to approve";
		}else{
		$sql = "UPDATE materials SET status = 1 WHERE id = '{$approve}'";
		$query = mysqli_query($connect, $sql);
		echo "fas fa-check btn p-1 btn btn-success | click to unapprove";
		}

	}
	// header('location: materials.php');
	// echo "Yes";
}
if (isset($_GET['approve_proj'])) {
	$approve = $_GET['approve_proj'];
	$sel = "SELECT * FROM projects WHERE id = '{$approve}'";
	$s_query = mysqli_query($connect, $sel);
	while ($row = mysqli_fetch_array($s_query)) {
		if ($row['status'] ==1) {
			$sql = "UPDATE projects SET status = 0 WHERE id = '{$approve}'";
			$query = mysqli_query($connect, $sql);
		}else{
		$sql = "UPDATE projects SET status = 1 WHERE id = '{$approve}'";
		$query = mysqli_query($connect, $sql);
		}

	}
	header('location: projects');
}

if (isset($_GET['approve_session'])) {
	$approve = (int)$_GET['approve_session'];
	$sel = "SELECT * FROM session WHERE id = '{$approve}'";
	$s_query = mysqli_query($connect, $sel);
	while ($row = mysqli_fetch_array($s_query)) {
		if ($row['status'] ==1) {
			$sql = "UPDATE session SET status = 0 WHERE id = '{$approve}'";
			$query = mysqli_query($connect, $sql);
		}else{
		$sql = "UPDATE session SET status = 1 WHERE id = '{$approve}'";
		$query = mysqli_query($connect, $sql);
		}

	}
	header('location: session');
}
 ?>