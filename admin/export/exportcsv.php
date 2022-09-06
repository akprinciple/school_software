<?php 
 
// Load the database configuration file 
include '../inc/config.php'; 
if (isset($_GET['class']) && isset($_GET['term']) && isset($_GET['subject']) && isset($_GET['session'])) {
    $session = $_GET['session'];
    $class = $_GET['class'];
    $subject = $_GET['subject'];
    $term = $_GET['term'];

 $query = mysqli_query($connect, "SELECT * FROM mid_term_results WHERE class ='{$class}' && subject = '{$subject}'  && session = '{$session}' && term = '{$term}' ORDER BY student_id ASC");

// Fetch records from database 

 
if($query->num_rows > 0){ 
   
	$session_sql = "SELECT * FROM session WHERE id = '{$session}'";
	$session_query = mysqli_query($connect, $session_sql);
	$session_row = mysqli_fetch_array($session_query);
	
    $class_sql = "SELECT * FROM class WHERE id = '{$class}'";
	$class_query = mysqli_query($connect, $class_sql);
	$class_row = mysqli_fetch_array($class_query);
    
	$term_sql = "SELECT * FROM term WHERE id = '{$term}'";
	$term_query = mysqli_query($connect, $term_sql);
	$term_row = mysqli_fetch_array($term_query); 

	$subject_sql = "SELECT * FROM subjects WHERE id = '{$subject}'";
	$subject_query = mysqli_query($connect, $subject_sql);
	$subject_row = mysqli_fetch_array($subject_query); 
	

$delimiter = ",";
$filename = $subject_row['subject']." results ".$class_row['class']." ".$term_row['term']." term ".$session_row['session'].".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Set column headers
$fields = array('S/N', 'STUDENT ID','NAME', 'SUBJECT', 'TERM', 'CLASS', 'SESSION', 'WEEKLY TEST', 'MIDTERM TEST', 'EXAM SCORE', 'TEACHER');
fputcsv($f, $fields, $delimiter);
$n = 1;
// Output each row of the data, format line as csv and write to file pointer
while($row = $query->fetch_assoc()){

	$c_sql = "SELECT * FROM register WHERE id = '{$row["student_id"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	$name = mysqli_fetch_array($c_query);
	 	
	 
	
	

    
$lineData = array($n++, $row['student_id'], $name['name'], $row['subject'], $row['term'], $row['class'], $row['session'], $row['test2'], $row['test'], $row['exam'], $row['teacher']);
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