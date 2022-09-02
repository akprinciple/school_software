<?php  
$msg = "";
	include 'inc/session.php';
	if (isset($_POST['submit'])) {
$project = mysqli_real_escape_string($connect, $_POST['project']);
$code = mysqli_real_escape_string($connect, $_POST['code']);
$date = date('d/M/Y');
$sel = "SELECT * FROM projects WHERE code = '{$code}'";
			$selt = mysqli_query($connect, $sel);
			$count = mysqli_num_rows($selt);
			if ($count > 0) {
				$msg = "<div class='p-2 rounded text-center'>Project Code is already existing</div>";
			}
			else{
			$sql = "INSERT INTO projects (project, code, date) VALUES ('$project', '$code', '$date')";
			$query = mysqli_query($connect, $sql);
			if ($query) {
				$msg = "<div class='p-2 rounded text-center'>Project Added Successfully</div>";
			}
			else{
				$msg = "<div class='p-2 rounded text-center'>Error!</div>";
			}
		}
		}
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Project Type | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>
</head>
<body>
<div class="row ml-0 mr-0">
<!---------------- Sidebar  --------------->
<?php include 'inc/sidebar.php'; ?>
<div class="col-md-10 ">
<h4 class="ml-3 mt-3">Manage Projects</h4>
<?php 
include 'inc/hr.php';

?>
<span class="float-right mb-3 bot-left p-2 bg-white">
<a id="click" class="pointer text-success fas fa-plus mr-2" title="Add Project"></a> 
<!-- <span class="">/</span> -->
<a href="submissiontype" class="text-success fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span>	
<div class="clearfix"></div>
<?php echo $msg; ?>
<div class="col-md-8 m-auto p-0 bg-white shadow" id="reg" style="display: none;">
<h4 class="text-center  p-2">Add New Project </h4>
<div class="border border-success"></div>
<form method="post" enctype="multipart/form-data" class="mt-3 p-3">

<div class=" form-group">
<label class="font-weight-bold">Project Name</label>
<input type="text" name="project" class="form-control" placeholder="input Project Type" required="">

<label class="font-weight-bold mt-3">Project Code</label>
<input type="text" name="code" class="form-control" placeholder="e.g test001" required="">

<button type="submit" name="submit" class="btn btn-success w-50 mt-2 float-right">Create</button>
<div class="clearfix"></div>
</div>
</div>

<table class="table table-striped table-bordered text-center">
<thead class="bg-success text-light">
<tr>
<td class="">S/N</td>
<td class="">Project</td>
<td class="">Code</td>
<td class="">Date</td>
<td class="">Action</td>
</tr>
</thead>
<tbody>
<?php 
$sel = "SELECT * FROM projects";
$selt = mysqli_query($connect, $sel);
$n = 1;
while ($rw = mysqli_fetch_array($selt)) {
										
									
 ?>
<tr>
<td class=""><?php echo $n++; ?></td>
<td class=""><?php echo $rw['project']; ?></td>
<td class=""><?php echo $rw['code']; ?></td>
<td class=""><?php echo $rw['date']; ?></td>
<td class=""><span title="Delete" id="del<?php echo $rw['id']; ?>" class="fas fa-times text-danger pointer"></span></td>
</tr>
<?php } ?>	
</tbody>
</table>

</div>
</div>

 <?php 
 $u_sql = "SELECT * FROM projects";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">Are you sure you want to Delete <b> <?php echo $user['project']; ?></b> permanently?  
<a href="delete?del_project=<?php echo $user['id']; ?>"><button class="btn-success btn">Yes</button></a>
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