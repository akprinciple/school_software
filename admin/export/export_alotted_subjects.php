<?php 
 
// Load the database configuration file 
include '../inc/config.php'; 
ob_start();

if (isset($_GET['all'])) {
   
    // To fetch all parents
 	
	

 $query = mysqli_query($connect, "SELECT * FROM teachers WHERE name = ANY(SELECT id FROM register WHERE level =1)");

// Fetch records from database 

 
if($query->num_rows > 0){ 
  
$date = date('M Y');
$delimiter = ",";
$filename = "Alotted Subjects ".$date.".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Set column headers
$fields = array('S/N', 'TEACHERs ID', 'TEACHERs NAME', 'SUBJECT ID', 'SUBJECT');
fputcsv($f, $fields, $delimiter);
$n = 1;
// Output each row of the data, format line as csv and write to file pointer
while($row = $query->fetch_assoc()){

	$subject_sql = "SELECT * FROM subjects WHERE id = '{$row['subject']}'";
	$subject_query = mysqli_query($connect, $subject_sql);
	$subject_row = mysqli_fetch_array($subject_query); 
	$subject = $subject_row['subject']; 
	
	$c_sql = "SELECT * FROM register WHERE id = '{$row["name"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	$name = mysqli_fetch_array($c_query);
	$teacher = $name['name'];
	 
	
	

    
$lineData = array($n++, $row['name'], $teacher, $row['subject'], $subject);
fputcsv($f, $lineData, $delimiter);
}

// Move back to beginning of file
fseek($f, 0);

// Set headers to download file rather than displayed
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

//output all remaining data on a file pointer
fpassthru($f);
}else{ 
header('location: ../subjects?status=empty');
}
}
exit;

?>