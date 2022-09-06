<?php
// Load the database configuration file
include_once '../inc/config.php';
ob_start();
if(isset($_POST['submit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    echo $_FILES['file']['name'];
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $id   = $line[1];
                $name   = $line[2];
                
                $subject  = $line[3];
                $term  = $line[4];
                $class  = $line[5];
                $session  = $line[6];
                $test2  = $line[7];
                $test = $line[8];
                $exam  = $line[9];
                $teacher  = $line[10];
              
               
                
               
                
                
                // Check whether member already exists in the register database with the same id
                $prevQuery = "SELECT * FROM mid_term_results WHERE student_id = '".$line[1]."' && subject = '{$subject}' && term = '{$term}' && class = '{$class}' && session = '{$session}'";
                $prevResult = $connect->query($prevQuery);
                
                // If Member is present in the register table:
                // Update user Details
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $connect->query("UPDATE mid_term_results SET test = '".$test."', test2 = '".$test2."', exam = '".$exam."' WHERE student_id = '".$line[1]."' && subject = '{$subject}' && term = '{$term}' && class = '{$class}' && session = '{$session}'");
                }
                
                // If Member is not present in register table:
                 // Insert user details in register table 
                 elseif ($prevResult->num_rows < 1) {
                     
                     $connect->query("INSERT INTO mid_term_results(student_id, subject, term, class, session, test, test2, exam, teacher) VALUES('$id', '$subject', '$term', '$class', '$session', '$test', '$test2', '$exam', '$teacher')");
                    
                }
               
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: ../class_results.php".$qstring);

?>