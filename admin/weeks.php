<?php 
		include 'inc/session.php';
    ob_start();
		$msg = $session_msg = "";
    if (isset($_GET['success'])) {
      $msg = "<script>alert('Update Successful');</script>";
      
    }
		if (isset($_POST['submit'])) {
			$week = $_POST['week'];
            
			$sel = "SELECT * FROM weeks WHERE week = '{$week}'";
			$selt = mysqli_query($connect, $sel);
			$count = mysqli_num_rows($selt);
			if ($count > 0) {
				$msg = "<div class='p-2 rounded text-danger text-center mb-2'>Week is already existing</div>";
			}
			else{
			$sql = "INSERT INTO weeks (week) VALUES ('$week')";
			$query = mysqli_query($connect, $sql);
			if ($query) {
				$msg = "<div class='p-2 rounded text-success text-center mb-2'>Week Added Successfully</div>";
			}
			else{
				$msg = "<div class='p-2 rounded text-danger text-center mb-2'>Error</div>";
			}
		}
		}

   
		 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Weeks | Queens School</title>
	<?php include 'inc/link.php'; ?>

</head>
<body>
	<div class="h-100 pl-3 pr-3">
            <div class="row">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
           		<h4 class="font-weight-bold ml-3 mt-3">Manage Subjects</h4>
           	<?php 
           		include 'inc/hr.php';
           	 ?>
             <div class="">
           		<div class="col-md-9 m-auto">
           		
           				<form method="post" enctype="multipart/form-data">
           					<h5 class="">Add Weeks</h5>
           					<?php echo $msg; ?>
           					<div class="form-group mt-2 row p-3">
           						<input type="text" name="week" class="form-control w-75" placeholder="Add Week" required="required">
           						<button type="submit" name="submit" class="btn btn-success" style="border-radius: 0px 20px 20px 0px; width: 20%">Add</button>
                    </div>
           				</form>
           			




           			<div class="">

           				<table class="table table-striped text-center col-md-12 border">
           					<thead class="bg-success text-light">
           						<tr>
           							<th>S/N</th>
           							<th>Weeks</th>
           							<th>Action</th>
           						</tr>
           					</thead>
           					<tbody>
           						<?php 
           							$sel = "SELECT * FROM weeks";
									$selt = mysqli_query($connect, $sel);
									$n = 1;
									while ($rw = mysqli_fetch_array($selt)) {
										
									
           						 ?>
           						<tr>
           							<td><?php echo $n++; ?></td>
           							<td><?php echo $rw['week']; ?></td>
           							<td><span id="del<?php echo $rw['id']; ?>" class="fas fa-pen text-success pointer"></span></td>
           						</tr>

           					<?php } ?>	
</tbody>
</table>
</div>
</div>
    
</div>
</div>
</div>
</div>
        <?php 
 $u_sql = "SELECT * FROM weeks";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
  $id = $user['id'];
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">

  <form method="post" enctype="multipart/form-data" class="pt-5">
    <div class="form-group col-md-4 border mx-auto mt-5 py-5">
      <h4 class="text-center text-light">Edit Subject</h4>
      <hr class="bg-white">
      <input type="text" name="subj<?php echo $user['id']; ?>" class="form-control text-center" value="<?php echo $user['subject']; ?>">
      <button type="submit" name="edit<?php echo $user['id']; ?>" class="btn btn-success col-md-12 float-right mt-3">Edit</button>
      <div class="clearfix"></div>
    </div>
  </form>
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; "><!-- Are you sure you want to delete <b> <?php echo $user['term']; ?> Term </b>permanently? -->
<!-- <a href="delete.php?del_term=<?php echo $user['id']; ?>"><button class="btn-success btn">Yes</button></a> -->
<span id="clear<?php echo $user['id']; ?>"><button class="btn-danger btn">Cancel</button></span>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $("#del<?php echo $user['id']; ?>").click(function(){
  $("#fetch<?php echo $user['id']; ?>").toggle("slow");
  })
  $("#clear<?php echo $user['id']; ?>").click(function(){
  $("#fetch<?php echo $user['id']; ?>").hide("slow"); 
})
})                     
</script>
<?php 
  if (isset($_POST['edit'.$id])) {
      // echo "<script>alert('ERROR')</script>";

    $subj = $_POST['subj'.$id];
    $update = mysqli_query($connect, "UPDATE subjects SET subject = '{$subj}' WHERE id = '{$id}'");
    if ($update) {
      header('location: subjects?success');
      // echo "Successful";
    }
  }

 ?>
<?php } ?>
</body>
</html>
    <?php #include '../inc/footer.php'; ?>
