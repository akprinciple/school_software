<?php 
 
// Load the database configuration file 
include '../inc/config.php'; 
ob_start();

if (isset($_GET['all'])) {
   
    // To fetch all students
 	
	

 $query = mysqli_query($connect, "SELECT * FROM register WHERE level = 1 || level = 2 ORDER BY name ASC");

// Fetch records from database 

 
if($query->num_rows > 0){ 
  
$date = date('M Y');
$delimiter = ",";
$filename = "All Teachers ".$date.".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Set column headers
$fields = array('S/N', 'ID','NAME', 'CLASS', 'SESSION', 'REGISTRATION CODE', 'DOB',  'USERNAME', 'PASSWORD', 'LEVEL', 'STATUS', 'SIGNATURE', 'DATE');
fputcsv($f, $fields, $delimiter);
$n = 1;
// Output each row of the data, format line as csv and write to file pointer
while($row = $query->fetch_assoc()){

	
	 	
	 
	
	

    
$lineData = array($n++, $row['id'], $row['name'], $row['class'], $row['session'], $row['code'], $row['dob'], $row['username'], $row['password'], $row['level'], $row['status'], $row['signature'], $row['date']);
fputcsv($f, $lineData, $delimiter);
}

// Move back to beginning of file
fseek($f, 0);

// Set headers to download file rather than displayed
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

//output all remaining data on a file pointer
fpassthru($f);
} }
exit;

?>