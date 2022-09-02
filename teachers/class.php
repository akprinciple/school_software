<?php 
		include 'inc/session.php';
		$msg = "";
		if (isset($_POST['submit'])) {
			$class = $_POST['class'];

			$sel = "SELECT * FROM class WHERE class = '{$class}'";
			$selt = mysqli_query($connect, $sel);
			$count = mysqli_num_rows($selt);
			if ($count > 0) {
				$msg = "<div class='p-2 rounded alert-danger'>Class is already existing</div>";
			}
			else{
			$sql = "INSERT INTO class (class) VALUES ('$class')";
			$query = mysqli_query($connect, $sql);
			if ($query) {
				$msg = "<div class='p-2 rounded alert-success'>Class Added Successfully</div>";
			}
			else{
				$msg = "<div class='p-2 rounded alert-danger'>Error</div>";
			}
		}
		}
		 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Classes | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>

</head>
<body>
	         <div class=" pl-3 pr-3">
            <div class="row border">

           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10 p-4">
           		<h4 class="ml-3 mt-3">Manage Classes</h4>
           	<?php 
           		include 'inc/hr.php';
           	 ?>

           		<div class="mt-5 bg-white shadow p-3">
           			




           			<div class="col-md-12 m-auto">
                  <form method="post" enctype="multipart/form-data">
                    <h5 class="font-weight-bold">Add Classes</h5>
                    <?php echo $msg; ?>
                    <div class="form-group mt-2 row pl-3 pr-3">
                      <input type="text" required="required" name="class" class="form-control w-75" placeholder="Add Class">
                      <input type="submit" name="submit" class="bg-success border-0 text-light outline" style="border-radius: 0px 20px 20px 0px; width: 20%" value="Add"><!-- Add</button> -->
                    </div>
                  </form>
           				<table class="table table-striped table-bordered text-center">
           					<thead class="bg-success text-light">
           						<tr>
           							<td class="">S/N</td>
           							<td class="">Class</td>
           							<td class="">Action</td>
           						</tr>
           					</thead>
           					<tbody>
           						<?php 
           							$sel = "SELECT * FROM class";
									$selt = mysqli_query($connect, $sel);
									$n = 1;
									while ($rw = mysqli_fetch_array($selt)) {
										
									
           						 ?>
           						<tr>
           							<td class=""><?php echo $n++; ?></td>
           							<td class=""><?php echo $rw['class']; ?></td>
           							<td class=""><span title="Delete" id="del<?php echo $rw['id']; ?>" class="fas fa-trash-alt text-danger pointer"></span></td>
           						</tr>

           					<?php } ?>	
           					</tbody>
           				</table>



           			</div>
           		</div>
           </div>
      </div>

   </div>
  <?php 
 $u_sql = "SELECT * FROM class";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">Are you sure you want to Delete <b> <?php echo $user['class']; ?></b> permanently?  
<a href="delete?del_class=<?php echo $user['id']; ?>"><button class="btn-success btn">Yes</button></a>
<span id="clear<?php echo $user['id']; ?>"><button class="btn-danger btn">No</button></span>
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
<?php } ?>
</body>
</html>
    <?php include '../inc/footer.php'; ?>
