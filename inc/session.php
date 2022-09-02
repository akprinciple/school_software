<?php 

include('inc/config.php');
session_start();
date_default_timezone_set('Africa/Lagos');
$user_check = $_SESSION['id'];

$ses_sql = mysqli_query($connect, "SELECT * FROM register WHERE id = '$user_check' && level = 0 || id = '$user_check' && level = 2");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$login_session = $row['id'];
$ses_count = mysqli_num_rows($ses_sql);


$_SESSION['name'] = $row['name'];
		// $_SESSION['lastname'] = $row['lastname'];
$_SESSION['username'] = $row['username'];
		// $_SESSION['email'] = $row['email'];
$_SESSION['gender'] = $row['gender'];
$_SESSION['status'] = $row['status'];
$login_sql = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '{$_SESSION['id']}' ORDER BY id DESC LIMIT 1");
$counts = mysqli_num_rows($login_sql);
if($counts > 0){
$login_row = mysqli_fetch_array($login_sql);
$_SESSION['class'] = $login_row['class'];
$_SESSION['session'] = $login_row['session'];
}else{
        $_SESSION['class'] = 1;
        $_SESSION['session'] = 1;    
}
		// $_SESSION['address'] = $row['address'];
		// $_SESSION['nationality'] = $row['nationality'];
  //       $_SESSION['level'] = $row['level'];
		// $_SESSION['date'] = $row['date'];
if ($ses_count < 1) {
header("location:login");

}elseif($_SESSION['status'] == 0){
header ('location: update');
}


 
        
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
$ip = $_SERVER['HTTP_CLIENT_IP'];
}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
$ip = $_SERVER['REMOTE_ADDR'];
}
            
if (isset($ip)) {
$date = date('d/M/Y');
$sql  = "SELECT * FROM visitors WHERE date = '{$date}'";
$query = mysqli_query($connect, $sql);
$count = mysqli_num_rows($query);
if ($count == 0) {
$ins = "INSERT INTO visitors (times, date) VALUES ('1', '$date')";
$i_query = mysqli_query($connect, $ins);
}
else{
$s_sql = "SELECT * FROM visitors WHERE date = '{$date}'";
$s_query = mysqli_query($connect, $s_sql);
while ($p = mysqli_fetch_array($s_query)) {
$plus = $p['times'] + 1;
$ins = "UPDATE visitors SET times = '{$plus}' WHERE date = '{$date}'";
$i_query = mysqli_query($connect, $ins);
}
              
}

} 
if (isset($ip)) {
$username = $_SESSION['username'];
$select = "SELECT * FROM users_visit WHERE username = '{$username}'";
$sel_query = mysqli_query($connect, $select);
$counter = mysqli_num_rows($sel_query);
$dat = date('h:i d/M/Y');

if ($counter < 1 && $username != '') {
$a_sql = "INSERT INTO users_visit(username, address, times, date) VALUES ('$username', '$ip', '1', '$dat')";
$a_query = mysqli_query($connect, $a_sql);
}
else{
$a_sql = "SELECT * FROM users_visit WHERE username = '{$username}'";
$a_query = mysqli_query($connect, $a_sql);
while ($r = mysqli_fetch_array($a_query)) {
$add = $r['times'] + 1;
$update = "UPDATE users_visit SET times = '{$add}', date = '{$dat}' WHERE username = '{$username}'";
$up_query = mysqli_query($connect, $update);

}
}
}
if (isset($ip)) {
$username = $_SESSION['username'];       
$status_update = "UPDATE users_visit SET status = 1 WHERE username ='{$username}'";
$update_query = mysqli_query($connect, $status_update);
}
#$c_ins = "INSERT INTO visitors (address, page, time, date) VALUES ('$ip', '$script', '$time', '$date')";
           # $set = mysqli_query($connect, $c_ins);
     ?>