<?php
// Load the database configuration file
include_once '../inc/config.php';

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
                $class  = $line[3];
                $session  = $line[4];
                $code  = $line[5];
                $dob  = $line[6];
                $username  = $line[7];
                $password  = $line[8];
                $level  = $line[9];
                $status  = $line[10];
                $signature  = $line[11];
                $date  = $line[12];
                
               
                
                
                // Check whether member already exists in the register database with the same id
                $prevQuery = "SELECT id FROM register WHERE id = '".$line[1]."'";
                $prevResult = $connect->query($prevQuery);
                
                // If Member is present in the register table:
                // Update user Details
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $connect->query("UPDATE register SET name = '".$name."', class = '".$class."', code = '".$code."', dob = '".$dob."', username = '".$username."', password = '".$password."', level = '".$level."', status = '".$status."', signature = '".$signature."', session = '".$session."', date = '".$date."' WHERE id = '".$id."'");
                }
                
                // If Member is not present in register table:
                 // Insert user details in register table 
                 elseif ($prevResult->num_rows < 1) {
                     
                     $connect->query("INSERT INTO register(id, name, class, session, code, dob, username, password, level, status, signature, date) VALUES('$id', '$name', '$class', '$session', '$code', '$dob', '$username', '$password', '$level', '$status', '$signature', '$date' )");
                    
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
header("Location: ../teachers.php".$qstring);

?>