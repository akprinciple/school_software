<?php
		include 'inc/config.php';
		 session_start();

		$msg = $username = $password = "";

		if (isset($_POST['submit'])) {
			$username = mysqli_real_escape_string($connect, $_POST['username']);
			$password = mysqli_real_escape_string($connect, $_POST['password']);

			$sql = "SELECT * FROM register WHERE username = '{$username}' && password = '{$password}' && level = 4 ||  username = '{$username}' && password = '{$password}' && level = 2";
			$query = mysqli_query($connect, $sql);
			$count = mysqli_num_rows($query);
			$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

				if ($count > 0) {
					$_SESSION['id'] = $row['id'];
				// header('location:results.php');
					header('location: index');
				}
				else{
					$msg = "<div class='alert-danger text-center p-2 rounded'>Incorrect Username or Password</div>";
				}
		}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>
</head>
<body style="background: url('../images/fidelity logo.jpg'); background-size: 50%">
								

<div style="">
<div class="col-md-6 p-3 shadow" style="background-color: ghostwhite; min-height: 100%;">
<div class="mt-5">
<h2 class="text-center font-weight-bold">Uztazh LOGIN</h2>
<div class="text-center mt-5"></div>
<div class="col-md-6 m-auto text-center ">
<i class="w-25 ml-3 p-2 fab fa-facebook border fa-2x text-primary"></i>
<i class="w-25 ml-3 p-2 fab fa-google border fa-2x text-info"></i>
<i class="w-25 ml-3 p-2 fab fa-linkedin border fa-2x text-info"></i>
</div>
<p class="text-center">
__________________Or Continue with_______________
</p>
<form method="post" enctype="multipart/form-data" class="col-md-8 pl-5 pr-5 pt-2 m-auto">
<?php echo $msg; ?>
<label class="font-weight-bold">Username</label>
<div class="form-group">
<input type="text" name="username" class="form-control" placeholder="Enter Your Username">
</div>
<label class="font-weight-bold">Password</label>
<div class="form-group">
<input type="password" name="password" class="form-control" placeholder="Enter Your Password">
</div>
<input type="checkbox" name="check">
<span>Keep me Logged in</span> 
<a href="" class="float-right text-success">Forgot Password?</a>
<button type="submit" name="submit" class="btn mt-2 w-100 font-weight-bold btn-success">LOG IN</button>
</form>
</div>
</div>
</div>

								

</body>
</html>