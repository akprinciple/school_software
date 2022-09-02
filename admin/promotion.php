<?php  
$msg = "";
    include 'inc/session.php';
    
    $msg = "";
	if (isset($_POST['submit'])) {
$key = mysqli_real_escape_string($connect, $_POST['key']);
        if($key =="Fidelity@LAS2468"){
            header('location: promotion_page.php');
            $_SESSION['key'] = $key;
        }
        else{
            $msg = "<div class='text-danger text-center'>Wrong Access Key</div>";
        }

		}
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Weekly Test Results | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>
    <style>
        tr, td, th{
            border: 1px solid green;
        }
        td, th{
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="row ml-0 mr-0">
<!---------------- Sidebar  --------------->
<?php include 'inc/sidebar.php'; ?>
<div class="col-md-10 ">
<h4 class="ml-3 mt-3">Enter Your Access Key</h4>
<?php 
include 'inc/hr.php';




?>

            <form method="post" enctype="multipart/form-data" class="mt-5 pt-5">
                <div class="col-md-6 mx-auto form-group mt-5">
                <h4>Enter Your Access Key</h4>
                <?php echo $msg; ?>
                <input type="password" autofocus name="key" class="form-control" placeholder="Enter your Access Key">
                <button type="submit" name="submit" class="btn btn-success mt-2 w-100">Submit</button>
                </div>
            </form>
</div>
</div>




</body>
</html>

