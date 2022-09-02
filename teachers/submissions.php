<?php  
include 'inc/session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Submitted Projects | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>
</head>
<body>
<div class="row ml-0 mr-0">
<!---------------- Sidebar  --------------->
<?php include 'inc/sidebar.php'; ?>
<div class="col-md-10 ">
<h4 class="ml-3 mt-3">Submitted Projects</h4>

<!-- <hr class="bg-white"> -->
<?php include ('inc/hr.php'); ?>
<div class="row">
	<form class="col-md-8 row">
	<div class="col-md-6">
		<div class="form-group">
		<b>Project Name</b>
		<select name="project" class="form-control">
		<option value="<?php if (isset($_GET['project'])){echo $_GET['project'];} else{echo 5;} ?>">
		<?php  
		if (isset($_GET['project'])){
		$pro = $_GET['project'];
		$selt = "SELECT * FROM projects WHERE id = '{$pro}'";
		$sel_query = mysqli_query($connect, $selt);
		while ($sel = mysqli_fetch_array($sel_query)) {
		
		echo $sel['project'].'('.$sel["code"].')';
		}
		}
		else{
			echo "Select Project";
		}
		?>
		</option>
		<?php  
		$sql = "SELECT * FROM projects ORDER BY project ASC";
		$query = mysqli_query($connect, $sql);
		while ($rw = mysqli_fetch_array($query)) {
		
		
		?>
		<option value="<?php echo $rw['id']; ?>"><?php echo $rw['project'].'('.$rw["code"].')'; ?></option>
		<?php } ?>
		</select>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group">
		<b>Class</b>
		<select name="class" class="custom-select">
		<option value="<?php if (isset($_GET['class'])){echo $_GET['class'];} else{echo 1;} ?>">
		<?php  
		if (isset($_GET['class'])){
		$pro = $_GET['class'];
		$selt = "SELECT * FROM class WHERE id = '{$pro}'";
		$sel_query = mysqli_query($connect, $selt);
		while ($sel = mysqli_fetch_array($sel_query)) {
		
		echo $sel['class'];
		}
		}
		else{
			echo "Select Class";
		}
		?>
		</option>
		<!-- <option>Select Class</option> -->
		<?php  
		$sql = "SELECT * FROM class";
		$query = mysqli_query($connect, $sql);
		while ($rw = mysqli_fetch_array($query)) {
		
		
		?>
		<option value="<?php echo $rw['id']; ?>"><?php echo $rw['class']; ?></option>
		<?php } ?>
		</select>
		
		<button class="btn btn-success float-right mt-2">Search</button>
		<div class="clearfix"></div>
	</div>
	</div>
	</form>
	<div class="col-md-4">
		<form>
		<div class="form-group">
			<b>Search by keyword</b>
			<input type="search" disabled name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search by keyword">
			<button disabled class="btn btn-success float-right mt-2">Search</button>
		<div class="clearfix"></div>
		</div>
	</form>
	</div>
</div>
<hr class="bg-white">
<span class="float-right mb-3 bot-left p-2 bg-white">
<!-- <a id="click" class="pointer text-success fas fa-plus mr-2" title="Add Project"></a>  -->
<!-- <span class="">/</span> -->
<a href="submissions" class="text-success fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span>	
<div class="clearfix"></div>
<?php #echo $msg; ?>


<?php  
if (isset($_GET['project']) && isset($_GET['class'])) {
	$project = (int)$_GET['project'];
	$class = (int)$_GET['class'];
	$sql =  "SELECT * FROM submissions WHERE project = '$project' && class = '{$class}'";
	$query = mysqli_query($connect, $sql);
	$n = 1;

?>
<div class="row  mr-0 ml-0 p-0 shadow font-weight-bold">
	<div class="p-2 col-md-6 bg-success pointer text-center text-light">
	<?php 
	$l_sql = "SELECT * FROM projects WHERE id = '{$_GET['project']}'";
	$l_query = mysqli_query($connect, $l_sql);
	while ($proj = mysqli_fetch_array($l_query)) {
		echo $proj['project'];
	}
	?>
	
	</div>
	<div class="p-2 col-md-6 bg-white text-center text pointer">
	<?php 
	$l_sql = "SELECT * FROM class WHERE id = '{$_GET['class']}'";
	$l_query = mysqli_query($connect, $l_sql);
	while ($proj = mysqli_fetch_array($l_query)) {
		echo $proj['class'];
	}
	?>
	
	</div>
</div>
<table class="table table-bordered text-center bg-light table-striped">
<thead>
	<tr>
		<th>S/N</th>
		<th>Name</th>
		<!-- <th>Project Type</th> -->
		<th>File</th>
		<th style="width: 25%">Comments</th>
		<th>Date</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody class="text-dark">
<?php  
while ($user = mysqli_fetch_array($query)) {
	

?>
<tr>
<td><?php echo $n++; ?></td>
<td><?php 
		$select = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['name']}'");
		while ($ro = mysqli_fetch_array($select)){
			echo $ro['name'];
		}
 ?></td>
<td>
	<a href="../submission_folder/<?php echo $user['file']; ?>" class="text-dark " title="Download" download="<?php echo $user['file']; ?>">
		<p class="w-100 m-0"><?php echo $user['file']; ?></p>
	</a>
</td>
<td><?php echo substr($user['comments'], 0, 50); ?></td>
<td><?php echo $user['date']; ?></td>
<td>
<a href="../submission_folder/<?php echo $user['file']; ?>" class="text-dark " title="Download" download="<?php echo $user['file']; ?>">
		 <i class="fas fa-download"></i>
	</a>
	&nbsp;
<i id="del<?php echo $user['id']; ?>" class="fas fa-trash-alt text-danger"></i></td>
	
</tr>
<?php }
 ?>
</tbody>
</table>
<?php } ?>


<?php  
if (isset($_GET['search'])) {
	$searchs = $_GET['search'];
	$search_sql = "SELECT * FROM submissions WHERE name LIKE '%%".$searchs."%%'";
	$search_query= mysqli_query($connect, $search_sql);
	$n = 1;
	
?>
<table class="table table-bordered text-center bg-light table-striped">
<thead class="bg-success text-light">
	<tr>
	<th>S/N</th>
	<th>Name</th>
	<th>Project Type</th>
	<th>File</th>
	<!-- <th style="width: 25%">Comments</th> -->
	<th>Date</th>
	<th><i class="fas fa-times"></i></th>
	</tr>
</thead>
<tbody class="text-dark">
<?php
while ($sear = mysqli_fetch_array($search_query)) {
	


?>
<tr>
<td><?php echo $n++; ?></td>	
<td><?php echo $sear['name']; ?></td>	
<td>
<?php 
$pro = $sear['project'];
$selt = "SELECT * FROM projects WHERE id = '{$pro}'";
$sel_query = mysqli_query($connect, $selt);
while ($sel = mysqli_fetch_array($sel_query)) {
		
echo $sel['project'];
}
 ?></td>	
<td><a href="../submission_folder/<?php echo $sear['file']; ?>" class="text-dark " title="Download"><p class="w-100 m-0"><?php echo $sear['file']; ?></p></a></td>	
<td><?php echo $sear['date']; ?></td>	
<td><i id="del<?php echo $sear['id']; ?>" class="fas fa-times text-danger"></i></td>
	
</tr>
<?php } ?>
</tbody>

</table>
<?php } ?>

</div>
</div>



<!--------------- Modal To Delete Users  --------------------->
   <?php 
   if (isset($_GET['project']) && isset($_GET['class'])) {
	$project = (int)$_GET['project'];
	$class = (int)$_GET['class'];
	$u_sql =  "SELECT * FROM submissions WHERE project = '$project' && class = '{$class}'";
	
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">Are you sure you want to delete 
<b> <?php echo $user['name']; ?> </b> Project permanently?
<a href="delete?del_submission=<?php echo $user['id']; ?>"><button class="btn-success btn">Yes</button></a>
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
<?php }} ?>

</body>
</html>


