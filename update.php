<?php  
include('inc/config.php');
session_start();
date_default_timezone_set('Africa/Lagos');
$user_check = $_SESSION['id'];

$ses_sql = mysqli_query($connect, "SELECT * FROM register WHERE id = '$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$login_session = $row['id'];

$username = "";
$_SESSION['name'] = $row['name'];
$msg = "";
if(!isset($_SESSION['id'])){
	header('location: login');
}
if (isset($_POST['submit'])) {
$username = mysqli_real_escape_string($connect, $_POST['username']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$c_password = mysqli_real_escape_string($connect, $_POST['c_password']);

$asql = "SELECT * FROM register WHERE username = '{$username}'";
$aquery = mysqli_query($connect, $asql);
$a_count = mysqli_num_rows($aquery);
if ($a_count > 0) {
$msg = "<div class='text-center text-danger p-2'>Username has been chosen. Try  Again!</span>	</div>";
 }
 elseif ($password != $c_password) {
 	$msg = "<div class='text-center text-danger p-2'>Password and Confirm password must match	</div>";
 }
 
 else { 
 $sql =  "UPDATE register SET username = '{$username}', password = '{$password}', status = 1 WHERE id = '{$row["id"]}'";
$query = mysqli_query($connect, $sql);
if ($query) {
	header('location: index.php');
}
else{
	echo "<script>alert('Error')</script>";
}
 
}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Details | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>
</head>
<body style="background: linear-gradient(to left, rgba(0,0,0,0.5), rgba(0,0,0,0.8)), url('images/element.jpg'); background-size: 100% 100%; background-attachment: fixed;">
<div class=" p-3 ">
<a href="logout.php" class="btn btn-danger float-right">Logout</a>
<div class="clearfix"></div>
<h3 class="text-light mt-5 mb-3 text-center">
Welcome	
<?php echo $row['name']; ?>
</h3>


	<div class="col-md-6 m-auto p-3" style="background-color: ghostwhite;">
	<h4>Update Details</h4>
	<hr class="bg-success">
	<?php echo $msg; ?>
	<form method="post" enctype="multipart/form-data">
<label class="font-weight-bold">Username</label>
<div class="form-group">
<input type="text" name="username" value="<?php echo $username; ?>" class="form-control" required="required" placeholder="Choose a Username">
</div>



<label class="font-weight-bold">Password</label>
<div class="form-group">
<input type="password" required="required" minlength="4" name="password" class="form-control" placeholder="Enter Your Password">
</div>
<label class="font-weight-bold">Confirm Password</label>
<div class="form-group">
<input type="password" required="required" name="c_password" class="form-control" placeholder="Enter Your Password Again">
</div>
<button type="submit" name="submit" class="btn btn-success w-100 mt-2">Update</button>

	</form>
	</div>
	</div>
</body>
</html>