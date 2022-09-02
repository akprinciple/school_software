<?php 
include 'inc/session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard | Fidelity Schools</title>
	<style type="text/css">
		*{
			box-sizing: border-box;
		}
	</style>
	<?php include 'inc/link.php'; ?>
</head>
<body>
<div class="row ml-0 mr-0">
<?php include 'inc/sidebar.php'; ?>
<div class="col-md-10 border">
<span class="fas fa-bars fa-2x p-2" id="small_screen_bar"></span>
<div class="clearfix"></div>
<div class=" mt-2 p-2">
<span class="float-left"><?php echo date('D d/M/Y'); ?></span>
<a href="auto_logout">
<span class="btn btn-danger float-right">Logout All User</span>
</a>
<div class="clearfix"></div>
</div>
<hr class="bg-success mt-0">


<div class="row mt-2 mr-0 ml-0">
<div class="col-md-6 mt-3">
		<span class="font-weight-bold"><i class="fas fa-male fa-2x text-success border border-success mb-1 p-2 rounded-circle"></i> Male - <?php  
	$sql = "SELECT * FROM register WHERE gender = 'male'";
	$query = mysqli_query($connect, $sql);
	$male = mysqli_num_rows($query);
	 
	$m_sql = "SELECT * FROM register ";
	$m_query = mysqli_query($connect, $m_sql);
	$total = mysqli_num_rows($m_query);
	echo number_format($male * 100/$total,0);
	?>%
	 </span>
		<div class="p-1 
		bg-success " 
		style="width: <?php  
	$sql = "SELECT * FROM register WHERE gender = 'male'";
	$query = mysqli_query($connect, $sql);
	$male = mysqli_num_rows($query);
	 
	$m_sql = "SELECT * FROM register ";
	$m_query = mysqli_query($connect, $m_sql);
	$total = mysqli_num_rows($m_query);
	echo number_format($male * 100/$total,2);
	?>%">
		</div>
		
		</div><div class="col-md-6 mt-3">
		<span class="font-weight-bold"><i class="fas fa-female fa-2x text-danger mb-1 border border-danger p-2 rounded-circle"></i> Female - 
		<?php  
	$sql = "SELECT * FROM register WHERE gender = 'female'";
	$query = mysqli_query($connect, $sql);
	$male = mysqli_num_rows($query);
	 
	$m_sql = "SELECT * FROM register ";
	$m_query = mysqli_query($connect, $m_sql);
	$total = mysqli_num_rows($m_query);
	echo number_format($male * 100/$total,0);
	?>%
		 </span>
		<div class="p-1 
		bg-danger " style="width: <?php  
	$sql = "SELECT * FROM register WHERE gender = 'female'";
	$query = mysqli_query($connect, $sql);
	$male = mysqli_num_rows($query);
	 
	$m_sql = "SELECT * FROM register ";
	$m_query = mysqli_query($connect, $m_sql);
	$total = mysqli_num_rows($m_query);
	echo number_format($male * 100/$total,2);
	?>%"></div>
		
		</div>
<div class="col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="users" class="text-dark">
<div class="p-2"><span class="fas fa-users fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(0,200,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM register WHERE level=0 ";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Students</b>
</div>
</a>
</div>
</div>

<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="teachers" class="text-dark ">
<div class="p-2"><span class="fas fa-user-graduate fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(255,0,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM register WHERE level = 1";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Regular Teachers</b>
</div>
</a>
</div>
</div>

<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="teachers" class="text-dark ">
<div class="p-2"><span class="fas fa-mosque fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(0,200,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM register WHERE level =2";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Arabic Teachers</b>
</div>
</a>
</div>
</div>

<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="parents" class="text-dark ">
<div class="p-2"><span class="fas fa-cloud-sun-rain fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(255,0,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM register WHERE level = 3";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Parents</b>
</div>
</a>
</div>
</div>


<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="class" class="text-dark">
<div class="p-2"><span class="fas fa-layer-group fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(0,200,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM class";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Classes</b>
</div>
</a>
</div>
</div>


<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="arabic_class" class="text-dark">
<div class="p-2"><span class="fas fa-moon fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(255,0,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM arabic_class";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Arabic Classes</b>
</div>
</a>
</div>
</div>



<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="subjects" class="text-dark ">
<div class="p-2"><span class="fas fa-tasks fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(255,0,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM subjects";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Subjects</b>
</div>
</a>
</div>
</div>

<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="arabic_subjects" class="text-dark ">
<div class="p-2"><span class="fas fa-cloud-moon fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(0,200,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM arabic_subjects";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Arabic Subjects</b>
</div>
</a>
</div>
</div>

	<div class=" col-md-2 p-2 mt-2 mb-2">
	<div class="position-relative">
	<a href="session" class="text-dark ">
	<div class="p-2"><span class="fas fa-th fa-3x float-right"></span></div>
	<div class="clearfix"></div>
	<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(255,0,0,0.5);">
	
	<h3 class=""><?php  
		$sql = "SELECT * FROM session";
		$query = mysqli_query($connect, $sql);
		echo number_format(mysqli_num_rows($query));
		?></h3>
	<b>Session</b>
	</div>
	</a>
	</div>
	</div>

<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="midterm_results" class="text-dark ">
<div class="p-2"><span class="fas fa-truck fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(0,200,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM mid_term_results";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Midterm Reports</b>
</div>
</a>
</div>
</div>

<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="materials" class="text-dark ">
<div class="p-2"><span class="fas fa-dice-d6 fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(255,0,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM materials";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Materials</b>
</div>
</a>
</div>
</div>


<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="submissions" class="text-dark ">
<div class="p-2"><span class="fas fa-file-archive fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(0,200,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM submissions";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Submitted Projects</b>
</div>
</a>
</div>
</div>




<div class="col-md-6 mt-3">
<b class="mt-3 text-center">New Students</b>
<table class="table rounded table-striped text-center table-bordered table-responsive-xl p-0 mr-0">
<thead class="bg-success text-light">
<tr>
	<th>Name</th>
	<th>Class</th>
	<th>Date</th>
	
</tr>
</thead>
<tbody>
	<?php  
	$sql = "SELECT * FROM register WHERE level =0  ORDER BY id DESC LIMIT 5";
	$query=  mysqli_query($connect, $sql);
	while ($tab = mysqli_fetch_array($query)) {
	
	
	?>
<tr>
	<td class="text-capitalize"><?php echo $tab['name']; ?></td>
	<td>
		<?php
		$select = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$tab['class']}'");
		while ($ro = mysqli_fetch_array($select)){
			echo $ro['class'];
		}
		
		
		?></td>
	<td><?php echo $tab['date']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>


<div class="col-md-6 mt-3">
<b class="mt-3 text-center">New Teachers</b>
<table class="table rounded table-striped text-center table-bordered table-responsive-xl p-0 mr-0">
<thead class="bg-danger text-light">
<tr>
	<th>Name</th>
	<th>Class</th>
	<th>Date</th>
	
</tr>
</thead>
<tbody>
	<?php  
	$sql = "SELECT * FROM register WHERE level = 2 || level =1  ORDER BY id DESC LIMIT 5";
	$query=  mysqli_query($connect, $sql);
	while ($tab = mysqli_fetch_array($query)) {
	
	
	?>
<tr>
	<td class="text-capitalize"><?php echo $tab['name']; ?></td>
	<td>
		<?php
		if($tab['level'] == 1){
		$select = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$tab['class']}'");
		while ($ro = mysqli_fetch_array($select)){
			echo $ro['class'];
		}}else{
			echo "Arabic";
		}
		
		
		?></td>
	<td><?php echo $tab['date']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>


<div class="col-md-6 mt-3">
<b class="mt-3 text-center">New Parents/Sponsors</b>
<table class="table rounded table-striped text-center table-bordered table-responsive-xl p-0 mr-0">
<thead class="bg-danger text-light">
<tr>
	<th>Name</th>
	<th>No of Wards</th>
	<th>Date</th>
	
</tr>
</thead>
<tbody>
	<?php  
	$sql = "SELECT * FROM register WHERE level = 3 ORDER BY id DESC LIMIT 5";
	$query=  mysqli_query($connect, $sql);
	while ($tab = mysqli_fetch_array($query)) {
	
	
	?>
<tr>
	<td class="text-capitalize"><?php 
	
		echo $tab['name'];
	
	 ?></td>
	<td>
		<?php
		$select = mysqli_query($connect, "SELECT COUNT(name) AS total FROM register WHERE parent = '{$tab['id']}'");
		while ($ro = mysqli_fetch_array($select)){
			echo $ro['total'];
		}
				
		?></td>
	<td><?php
		echo $tab['date'];
				
		?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<div class="col-md-6 mt-3">
<b class="mt-3 text-center">New Reports</b>
<table class="table rounded table-striped text-center table-bordered table-responsive-xl p-0 mr-0">
<thead class="bg-success text-light">
<tr>
	<th>Name</th>
	<th>Subject</th>
	<th>Score</th>
	
</tr>
</thead>
<tbody>
	<?php  
	$sql = "SELECT * FROM mid_term_results ORDER BY id DESC LIMIT 5";
	$query=  mysqli_query($connect, $sql);
	while ($tab = mysqli_fetch_array($query)) {
	
	
	?>
<tr>
	<td class="text-capitalize"><?php 
	$select = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$tab['student_id']}'");
	while ($ro = mysqli_fetch_array($select)){
		echo $ro['name'];
	}
	 ?></td>
	<td>
		<?php
		$select = mysqli_query($connect, "SELECT * FROM subjects WHERE id = '{$tab['subject']}'");
		while ($ro = mysqli_fetch_array($select)){
			echo $ro['subject'];
		}
				
		?></td>
	<td><?php
		echo $tab['test']+ $tab['test2'];
				
		?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>



<div class="col-md-6 mt-3 p-0">
<b class="mt-3 text-center">Most Frequent Users</b>
<table class="table rounded table-striped text-center table-bordered table-responsive-xl p-0 mr-0">
<thead class="bg-success text-light">
<tr>
	<th>Username</th>
	<th>Times</th>
	<th>Last Visit</th>
	
</tr>
</thead>
<tbody>
	<?php  
	$sql = "SELECT * FROM users_visit WHERE username != '' ORDER BY times DESC LIMIT 5";
	$query=  mysqli_query($connect, $sql);
	while ($tab = mysqli_fetch_array($query)) {
	
	
	?>
<tr>
	<td class="text-capitalize"><?php echo $tab['username']; ?></td>
	<td>
		<?php echo $tab['times']; ?></td>
	<td><?php echo $tab['date']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<div class="col-md-6 mt-3 ">
<b class="mt-3 text-center">Latest Submissions</b>
<table class="table rounded table-striped text-center table-bordered table-responsive-xl p-0 mr-0">
<thead class="text-light bg-danger">
<tr>
	<th>Name</th>
	<th>Project</th>
	<th>Date</th>
	
</tr>
</thead>
<tbody>
	<?php  
	$sql = "SELECT * FROM submissions ORDER BY id DESC LIMIT 5";
	$query=  mysqli_query($connect, $sql);
	while ($tab = mysqli_fetch_array($query)) {
	
	
	?>
<tr>
	<td class="text-capitalize">
	<?php 
		$select = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$tab['name']}'");
		while ($ro = mysqli_fetch_array($select)){
			echo $ro['username'];
		}
 ?>
	
	<!-- <?php echo $tab['name']; ?></td> -->
	<td style="font-size: 0.8em">
		<?php 
		$s_sql = mysqli_query($connect, "SELECT * FROM projects WHERE id ='{$tab["project"]}'");
		while ($r = mysqli_fetch_array($s_sql)) {
			# code...
		echo $r['code']; 
		}
		?></td>
	<td><?php echo $tab['date']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>


<div class="row ml-0 mr-0 mb-5"> 
<div class="col-md-10 p-0 border">
<?php include 'inc/graph.php'; ?>
	
</div>
<div class="col-md-2">
<div class="shadow text-success" style="height: 500px;">
<?php 
	$date = date('h:i d/M/Y'); 
	$sql = "SELECT * FROM users_visit WHERE username != '' && status = 1";
	$query=  mysqli_query($connect, $sql);
	$c = mysqli_num_rows($query);
	
	

	?>
	
<p class="font-weight-bold pt-2 pl-2 pr-2 pb-0 border-bottom border-success"><?php print " $c"; ?> Online User(s)</p>
<marquee direction="up" class="h-75">

	<?php 	
while ($tab = mysqli_fetch_array($query)) {
	 ?>
<div class="border-bottom border-success p-2">
	<span class="float-left"><?php echo $tab['username']; ?></span>
	<span class="float-right fas fa-check text-success"></span>
	<div class="clearfix"></div>
</div>
	<?php } ?>
</marquee>
</div>
</div>
</div>
</div>

</div>
</body>
</html>
<script type="text/javascript" src="../js/chart.min.js"></script>