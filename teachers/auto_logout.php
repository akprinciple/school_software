<?php 
		include 'inc/config.php';
		
		
		$sql = "UPDATE users_visit SET status = 0";
		$query = mysqli_query($connect, $sql);
		header('location: index');
		// switch ($query) {
		// 	case '$query':
		// 		echo "Done";
		// 		break;
			
		// 	default:
		// 		echo "Error";
		// 		break;
		// }
 ?>