<?php 
include 'inc/config.php';
session_start();

;
$user_check = $_SESSION['id'];

$ses_sql = mysqli_query($connect, "SELECT * FROM users WHERE id = '$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$user = $row['username'];
$sql = "UPDATE users_visit SET status = 0 WHERE username = '{$user}'";
$query = mysqli_query($connect, $sql);



if (session_destroy()) {
header("location: login");
}

 ?>