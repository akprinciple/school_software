<?php 

    session_start();
  include('inc/config.php');
    $user_check = $_SESSION['id'];

    $ses_sql = mysqli_query($connect, "SELECT * FROM register WHERE id = '$user_check' && level = 1 || id = '$user_check' && level = 4");
    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
    // $login_session = $row['id'];

    $cant = mysqli_num_rows($ses_sql);
    $_SESSION['level'] = $row['level'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['class'] = $row['class'];
    $_SESSION['status'] = $row['status'];
    if (!isset($row['id'])) {
      header("location: login");

    }
    elseif($cant < 1){
      header("location: login");

    }elseif($_SESSION['level'] != 1 && $_SESSION['level'] != 4){
      header("location: login");
    }elseif($_SESSION['status'] != 1){
      header("location: update");
    }
		// $_SESSION['email'] = $row['email'];
		// $_SESSION['gender'] = $row['gender'];
		// $_SESSION['phone'] = $row['phone'];
		// $_SESSION['address'] = $row['address'];
		// $_SESSION['nationality'] = $row['nationality'];
		// $_SESSION['date'] = $row['date'];

        // $_SESSION['username'] = $row['username'];
               ?>