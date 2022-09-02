<?php 

    session_start();
  include('inc/config.php');
    $user_check = $_SESSION['id'];

    $ses_sql = mysqli_query($connect, "SELECT * FROM register WHERE id = '$user_check' && level = 4 ");
    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
    // $login_session = $row['id'];

    if (!isset($row['id'])) {
      header("location: login");

    }
     

    $_SESSION['level'] = $row['level'];
		// $_SESSION['lastname'] = $row['lastname'];
		// $_SESSION['email'] = $row['email'];
		// $_SESSION['gender'] = $row['gender'];
		// $_SESSION['phone'] = $row['phone'];
		// $_SESSION['address'] = $row['address'];
		// $_SESSION['nationality'] = $row['nationality'];
		// $_SESSION['date'] = $row['date'];

        // $_SESSION['username'] = $row['username'];
?>