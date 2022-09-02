<?php 
		include 'inc/session.php';
    ob_start();
		$msg = $session_msg = "";
    if (isset($_GET['success'])) {
      $msg = "<script>alert('Update Successful');</script>";
      
    }
    if (isset($_POST['submit'])) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
             $type = pathinfo("upload/$image", PATHINFO_EXTENSION);
         if ($_FILES["image"]["size"] > 100000) {
                $msg = "<div class='text-center text-danger p-2  font-weight-bold'>Sorry, your file should be less than 100kb.</div>";
                }
                elseif ($type != "JPG" && $type != "jpg"  && $type != "PNG" && $type != "png") {
                      $msg = "<div class='alert alert-danger p-2 font-weight-bold'>Only jpg and png files are allowed</div>";
                    }
                    else{
                            $id = $_SESSION['id'];
                        $update = mysqli_query($connect, "UPDATE register SET signature = '{$image}' WHERE id ='{$_SESSION['id']}'");
                        if ($update) {
                      $msg = "<div class='alert text-success text-center p-2 font-weight-bold'>Upload Successful</div>";
                        move_uploaded_file($tmp, "../signatures/$image");
    
                          
                        }
    
                        else{
                      $msg = "<div class='alert alert-danger p-2 font-weight-bold'>Error</div>";
    
                        }
    
                    }     
      }
   
		 ?>
<!DOCTYPE html>
<html>
<head>
	<title>signature | Fidelity School</title>
	<?php include 'inc/link.php'; ?>

</head>
<body>
	<div class="h-100 pl-3 pr-3">
            <div class="row">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
           		<h4 class="font-weight-bold ml-3 mt-3">Manage signature</h4>
           	<?php 
           		include 'inc/hr.php';
           	 ?>
             
           		<div class="">
                   <div class="col-md-6 m-auto">
                   <h3>Signature</h3>
        <div class="border w-100">
          <?php 
          $sel = mysqli_query($connect, "SELECT * FROM register WHERE id ='{$_SESSION['id']}'");
          $rw = mysqli_fetch_array($sel);
          $_SESSION['signature'] = $rw['signature'];
            if (!empty($_SESSION['signature'])) {
              # code...
            }
           ?>
           <img src="../signatures/<?php echo $_SESSION['signature']; ?>" class="card-img">
        </div>
         <form method="post" enctype="multipart/form-data">
          <div class="form-group mt-3">
           <input type="file" required="required" accept=".jpg,.png" name="image" class="form-control">
         </div>
           <input type="submit" name="submit" class="btn btn-success w-100" value="Upload">
         </form>
       </div>
                   </div>
           		
           				
</body>
</html>
    <?php #include '../inc/footer.php'; ?>
