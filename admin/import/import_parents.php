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
                
                $code  = $line[3];
                $username  = $line[4];
                $password  = $line[5];
                $phone  = $line[6];
                $email  = $line[7];
                $job  = $line[8];
                $level  = $line[9];
                $status  = $line[10];
                $date  = $line[11];
               
                
               
                
                
                // Check whether member already exists in the register database with the same id
                $prevQuery = "SELECT id FROM register WHERE id = '".$line[1]."'";
                $prevResult = $connect->query($prevQuery);
                
                // If Member is present in the register table:
                // Update user Details
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $connect->query("UPDATE register SET name = '".$name."', code = '".$code."', username = '".$username."', password = '".$password."', level = '".$level."', status = '".$status."', phone = '".$phone."', email = '".$email."', job = '".$job."', date = '".$date."' WHERE id = '".$id."'");
                }
                
                // If Member is not present in register table:
                 // Insert user details in register table 
                 elseif ($prevResult->num_rows < 1) {
                     
                     $connect->query("INSERT INTO register(id, name, code, username, password, level, status, email, job, phone, date) VALUES('$id', '$name', '$code', '$username', '$password', '$level', '$status', '$email', '$job', '$phone', '$date' )");
                    
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