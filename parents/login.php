<?php  
include 'inc/config.php';
     session_start();

        $msg = $username = $password = $code = "";

        if (isset($_POST['submit'])) {
            $code = mysqli_real_escape_string($connect, $_POST['code']);

            $sql = "SELECT * FROM register WHERE code = '{$code}'";
            $query = mysqli_query($connect, $sql);
            $counts = mysqli_num_rows($query);
            $row = mysqli_fetch_array($query);
            if ($counts > 0) {
            
            

                
                    $_SESSION['id'] = $row['id'];
                header('location:index');
                
                
            }else{
                     
                     
                    $msg = "<div class='text-danger text-center p-2 mt-1'>Authorization Code Not Found</div>";
                }
            }
        elseif (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($connect, $_POST['username']);
            $password = mysqli_real_escape_string($connect, $_POST['password']);
            
            $sql = "SELECT * FROM register WHERE username = '{$username}' && password = '{$password}'";
            $query = mysqli_query($connect, $sql);
            $count = mysqli_num_rows($query);
            $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
            // while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            if($count < 1){
            $msg = "<div class='text-center p-2  text-danger mb-2'>Incorrect Username or Password</div>";
                }
                else {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['level'] = $row['level'];
                     header('location: index');
                
                }
            }
        // }

?> 

<!DOCTYPE html>
<html>
<head>
    <title>Sign In | Fidelity Portal</title>
<link rel="stylesheet" href="../bootstrap/bootstrap-4.6/css/bootstrap.min.css">

    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="../bootstrap/bootstrap-4.6/css/bootstrap.min.css">

<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->

<link rel="shortcut icon" type="image/jpg" href="../images/fidelity logo.jpg">
     <link rel="stylesheet" type="text/css" href="../font/css/all.min.css">
     <style type="text/css">
        ::placeholder{
            color: White;
        }
        input{
            background-color: transparent;
            -webkit-background-color: transparent;
            -moz-background-color: transparent;
            -o-background-color: transparent;
            
        }
        input:focus{
            background-color: transparent;
            -webkit-background-color: transparent;
            -moz-background-color: transparent;
            -o-background-color: transparent;
        }
     .cont:hover{
            color: #495057;
  background-color: #fff;
  /*border-color: #80bdff;*/
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);

        }

     </style>
</head>
<body style="font-family: open sans; font-weight: 400; background: radial-gradient(circle, rgba(0,0,0,0.7) 40%, rgba(0,0,0,.35) 30%), url('../images/rainha.jpg'); background-size: 100% 100%; background-attachment: fixed; background-repeat: repeat-y;">

<div class="py-5 col-md-3 m-auto">
    <center>
        <img src="../images/fidelity logo.jpg" width="150px" class="mt-2"></center>
    <?php echo $msg; ?>
    <h3 class="mt-3 text-center text-light" style="cursor: pointer;">Fidelity Montessori School & College Portal</h3>
    <ul class="nav nav-tabs text-center bg-white mb-3">
  <li class="active col-md-6 p-0"><a data-toggle="tab" href="#menu1" class="text-success"><p class="mb-0 p-2">Default Login</p></a></li>
  <li class=" col-md-6 bg-success p-0"><a data-toggle="tab" href="#home" class="text-light"><p class="mb-0 p-2"> No username</p></a></li>
  <!-- <li><a data-toggle="tab" href="#menu2">Menu 2</a></li> -->
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade-in">
    <h6 class="font-weight-bold mt-3 text-light text-center">Input Your Authorization Code</h6>
    <!-- <hr class="bg-success mt-0"> -->
    <?php echo $msg; ?>
    <form method="post" enctype="multipart/form-data">
    <input type="text" name="code" value="<?php echo $code; ?>" placeholder="Input Your Authorization Code" class="w-100 py-2 pl-1 text-light" style="outline: none; border: 1px solid white; background-color: rgba(0,0,0,0);">
<input type="checkbox" name="check">
<span>Keep me Logged in</span> 
<a href="" class="float-right text-success">Forgot Password?</a>
<button type="submit" name="submit" class="btn btn-success w-100">Log In</button>
</form>
  </div>



  <div id="menu1" class="tab-pane fade-in active">
    <form method="post" enctype="multipart/form-data">

    <div class="border px-2 cont" style="background-color: rgba(255,255,255,0.3); border-radius: 20px;">
        <input type="text" required="required" name="username" id="username" placeholder="Username" class="border-0 py-2 pl-1 text-light" value="<?php echo $username; ?>" style="outline: none; background-color: rgba(0,0,0,0);">
        <label for="username" class="fas fa-user text-light float-right pt-2 pr-2"></label>
    </div>

    <div class="border mt-3 px-2 cont" style="background-color: rgba(255,255,255,0.3); border-radius: 20px;">
        <input type="password" name="password" required="required" id="password" placeholder="Password" class="border-0 py-2 pl-1 text-light" style="outline: none; background-color: rgba(0,0,0,0);">
        <label for="password" class="fas fa-lock text-light float-right pt-2 pr-2"></label>
    </div>
    <!-- <span class="text-light text-center">I dont have a username <span class="text-primary" style="cursor: pointer;">Click here!</span></span> -->
    <button class="btn btn-light w-100 mt-3" style="border-radius: 20px" type="submit" name="login">Sign In</button>
    </form>
</div>
</div>
</body>
</html>

 <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="js/java.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>