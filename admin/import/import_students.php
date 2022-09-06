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
                $arabic_class  = $line[5];
                $gender  = $line[6];
                $code  = $line[7];
                $dob  = $line[8];
                $parent  = $line[9];
                $username  = $line[10];
                $password  = $line[11];
                $level  = $line[12];
                $status  = $line[13];
                $image  = $line[14];
                $date  = $line[15];
                
                
                // Check whether member already exists in the register database with the same id
                $prevQuery = "SELECT id FROM register WHERE id = '".$line[1]."'";
                $prevResult = $connect->query($prevQuery);
                // Check whether member already exists in the student database with the same id, class and session

                $select = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '{$id}' && class = '{$class}' && session = '{$session}'");
                // If Member is present in both student and register table:
                // Update user Details
                if($prevResult->num_rows > 0 && $select ->num_rows >0){
                    // Update member data in the database
                    $connect->query("UPDATE register SET name = '".$name."', gender = '".$gender."', code = '".$code."', dob = '".$dob."', parent = '".$parent."', username = '".$username."', password = '".$password."', level = '".$level."', status = '".$status."', image = '".$image."', date = '".$date."' WHERE id = '".$id."'");
                }
                // If Member is present in register table but not in student:
                 // Update user details in register table and insert into student table 
                elseif ($prevResult->num_rows > 0 && $select ->num_rows < 1) {
                     $connect->query("UPDATE register SET name = '".$name."', gender = '".$gender."', code = '".$code."', dob = '".$dob."', parent = '".$parent."', username = '".$username."', password = '".$password."', level = '".$level."', status = '".$status."', image = '".$image."', date = '".$date."' WHERE id = '".$id."'");
                     $connect->query("INSERT INTO students(user_id, class, session, arabic_class) VALUES('$id', '$class', '$session', '$arabic_class')");
                    
                }
                // If Member is not present in register table but present in student table:
                 // Insert user details in register table 
                 elseif ($prevResult->num_rows < 1 && $select ->num_rows > 0) {
                     
                     $connect->query("INSERT INTO register(id, name, class, session, arabic_class, gender, code, dob, parent, username, password, level, status, image, date) VALUES('$id', '$name', '$class', '$session', '$arabic_class', '$gender', '$code', '$dob', '$parent', '$username', '$password', '$level', '$status', '$image', '$date' )");
                    
                }// If Member is not present in both register table and student table:
                 // Insert user details in register table and student table 
                 elseif ($prevResult->num_rows < 1 && $select ->num_rows < 1) {
                     
                     $connect->query("INSERT INTO register(id, name, class, session, arabic_class, gender, code, dob, parent, username, password, level, status, image, date) VALUES('$id', '$name', '$class', '$session', '$arabic_class', '$gender', '$code', '$dob', '$parent', '$username', '$password', '$level', '$status', '$image', '$date' )");
                      $connect->query("INSERT INTO students(user_id, class, session, arabic_class) VALUES('$id', '$class', '$session', '$arabic_class')");
                    
                }
                // else{
                //     // Insert member data in the database
                //     $connect->query("INSERT INTO members (id, name, code, username, password) VALUES ('".$id."', '".$name."', '".$code."', '".$username."', '".$password."')");
                // }
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
header("Location: ../users.php".$qstring);

?>