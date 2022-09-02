<?php 

header('Content-Type: application/json');
		include '../inc/config.php';

			$sqlquery = "SELECT date,times FROM visitors ORDER BY id DESC LIMIT 20";
			$result = mysqli_query($connect, $sqlquery);

			$data = array();
foreach ($result as $rw) {
	$data[] = $rw;

}

mysqli_close($connect);

echo json_encode($data);
 ?>