<?php
include 'inc/session.php';
if (isset($_GET['user'])&&isset($_GET['class'])&&isset($_GET['session'])&&isset($_GET['term'])) {
	$user = $_GET['user'];
	$class = $_GET['class'];
	$session = $_GET['session'];
    $term = $_GET['term'];
    $s_parent = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user}'");
    $row = mysqli_fetch_array($s_parent);
    $parent = $row['parent'];
	$sel = "SELECT * FROM parents WHERE user_id = '{$user}' && class='{$class}'&& session ='{$session}'&& term='{$term}'";
    $s_query = mysqli_query($connect, $sel);
    $count = mysqli_num_rows($s_query);
    if($count < 1){
        $insert = mysqli_query($connect, "INSERT INTO parents (user_id, class, session, term, parent) VALUES ('$user', '$class', '$session', '$term', '$parent')");
        if($insert){
		echo "fas fa-check btn p-1 btn btn-primary | click to unapprove";
        }
       
    }elseif($count > 0){
        $ins = "DELETE FROM parents WHERE user_id = '{$user}' && class='{$class}'&& session ='{$session}'&& term='{$term}'";
       $query = mysqli_query($connect, $ins);
        if($query){                       
            echo "fas fa-check btn p-1 btn btn-warning | click to Approve";
            }
        
    }
	

	}




?>