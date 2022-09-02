<?php 
		include 'inc/session.php';
		$msg = "";
		if (isset($_POST['submit'])) {
			$term = $_POST['term'];

			$sel = "SELECT * FROM term WHERE term = '{$term}'";
			$selt = mysqli_query($connect, $sel);
			$count = mysqli_num_rows($selt);
			if ($count > 0) {
				$msg = "<div class='p-2 rounded alert-danger text-center mb-2'>Term is already existing</div>";
			}
			else{
			$sql = "INSERT INTO term (term) VALUES ('$term')";
			$query = mysqli_query($connect, $sql);
			if ($query) {
				$msg = "<div class='p-2 rounded alert-success text-center mb-2'>Term Added Successfully</div>";
			}
			else{
				$msg = "<div class='p-2 rounded alert-danger text-center mb-2'>Error</div>";
			}
		}
		}
		 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Terms | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>

</head>
<body>
	<div class="h-100 pl-3 pr-3">
            <div class="row">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
           		<h4 class="font-weight-bold ml-3 mt-3">Manage Terms</h4>
           	<?php 
           		include 'inc/hr.php';
           	 ?>

           		<div class="col-md-10 m-auto">
           			<div class="">
           				<form method="post" enctype="multipart/form-data">
           					<h5 class="">Add Terms</h5>
           					<?php echo $msg; ?>
           					<div class="form-group mt-2 row p-3">
           						<input type="text" name="term" class="form-control w-75" placeholder="Add Term" required="required">
           						<button type="submit" name="submit" class="btn btn-success" style="border-radius: 0px 20px 20px 0px; width: 20%">Add</button>
                    </div>
           				</form>
           			</div>




           			<div class="">

           				<table class="table table-striped text-center col-md-12">
           					<thead class="bg-success text-light">
           						<tr>
           							<th>S/N</th>
           							<th>Term</th>
           							<th>Action</th>
           						</tr>
           					</thead>
           					<tbody>
           						<?php 
           							$sel = "SELECT * FROM term";
									$selt = mysqli_query($connect, $sel);
									$n = 1;
									while ($rw = mysqli_fetch_array($selt)) {
										
									
           						 ?>
           						<tr>
           							<td><?php echo $n++; ?></td>
           							<td><?php echo $rw['term']; ?></td>
           							<td><span id="del<?php echo $rw['id']; ?>" class="fas fa-times text-danger pointer"></span></td>
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
 $u_sql = "SELECT * FROM term";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">Are you sure you want to delete <b> <?php echo $user['term']; ?> Term </b>permanently?
<a href="delete?del_term=<?php echo $user['id']; ?>"><button class="btn-success btn">Yes</button></a>
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
