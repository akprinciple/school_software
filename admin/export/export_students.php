<?php 
 
// Load the database configuration file 
include '../inc/config.php'; 
ob_start();
if (isset($_GET['class']) && isset($_GET['session'])) {
    $session = $_GET['session'];
    $class = $_GET['class'];
    
 

 $query = mysqli_query($connect, "SELECT * FROM students WHERE user_id = ANY(SELECT id FROM register WHERE level = 0) && class ='{$class}' && session = '{$session}' ORDER BY (SELECT name FROM register WHERE id = user_id) ASC");

// Fetch records from database 

 
if($query->num_rows > 0){ 
   
	$session_sql = "SELECT * FROM session WHERE id = '{$session}'";
	$session_query = mysqli_query($connect, $session_sql);
	$session_row = mysqli_fetch_array($session_query);
	
    $class_sql = "SELECT * FROM class WHERE id = '{$class}'";
	$class_query = mysqli_query($connect, $class_sql);
	$class_row = mysqli_fetch_array($class_query);
    
	
	

$delimiter = ",";
$filename = "All Students ".$class_row['class']." ".$session_row['session'].".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Set column headers
$fields = array('S/N', 'STUDENT ID','NAME', 'CLASS', 'SESSION', 'ARABIC CLASS', 'GENDER', 'REGISTRATION CODE', 'DOB', 'PARENT', 'USERNAME', 'PASSWORD', 'LEVEL', 'STATUS', 'IMAGE', 'DATE');
fputcsv($f, $fields, $delimiter);
$n = 1;
// Output each row of the data, format line as csv and write to file pointer
while($row = $query->fetch_assoc()){

	$c_sql = "SELECT * FROM register WHERE id = '{$row["user_id"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	$name = mysqli_fetch_array($c_query);
	 	
	 
	
	

    
$lineData = array($n++, $row['user_id'], $name['name'], $row['class'], $row['session'], $row['arabic_class'], $name['gender'], $name['code'], $name['dob'], $name['parent'], $name['username'], $name['password'], $name['level'], $name['status'], $name['image'], $name['date']);
fputcsv($f, $lineData, $delimiter);
}

// Move back to beginning of file
fseek($f, 0);

// Set headers to download file rather than displayed
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

//output all remaining data on a file pointer
fpassthru($f);
} 
else{ 
	header('location: ../users?status=empty');
	}

}elseif (isset($_GET['all'])) {
   
    // To fetch all students
 	$session_sql = "SELECT * FROM session WHERE status = 1 ORDER BY id DESC LIMIT 1";
	$session_query = mysqli_query($connect, $session_sql);
	$session_row = mysqli_fetch_array($session_query);
	$session = $session_row['id'];
	

 $query = mysqli_query($connect, "SELECT * FROM students WHERE user_id = ANY(SELECT id FROM register WHERE level = 0) && session = '{$session}' ORDER BY (SELECT name FROM register WHERE id = user_id) ASC");

// Fetch records from database 

 
if($query->num_rows > 0){ 
  

$delimiter = ",";
$filename = "All Students ".$session_row['session'].".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Set column headers
$fields = array('S/N', 'STUDENT ID','NAME', 'CLASS', 'SESSION', 'ARABIC CLASS', 'GENDER', 'REGISTRATION CODE', 'DOB', 'PARENT', 'USERNAME', 'PASSWORD', 'LEVEL', 'STATUS', 'IMAGE', 'DATE');
fputcsv($f, $fields, $delimiter);
$n = 1;
// Output each row of the data, format line as csv and write to file pointer
while($row = $query->fetch_assoc()){

	$c_sql = "SELECT * FROM register WHERE id = '{$row["user_id"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	$name = mysqli_fetch_array($c_query);
	 	
	 
	
	

    
$lineData = array($n++, $row['user_id'], $name['name'], $row['class'], $row['session'], $row['arabic_class'], $name['gender'], $name['code'], $name['dob'], $name['parent'], $name['username'], $name['password'], $name['level'], $name['status'], $name['image'], $name['date']);
fputcsv($f, $lineData, $delimiter);
}

// Move back to beginning of file
fseek($f, 0);

// Set headers to download file rather than displayed
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

//output all remaining data on a file pointer
fpassthru($f);
}
else{ 
	header('location: ../users?status=empty');
}
}
exit;

?>