<?php 
include 'inc/session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Arabic Teachers Dashboard | Fidelity Schools</title>
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

<div class="clearfix"></div>
</div>
<hr class="bg-success mt-0">

<h5 class="text-center">﷽</h5>
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
<div class="col-md-3 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="a_students" class="text-dark">
<div class="p-2"><span class="fas fa-users fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(0,200,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM register WHERE level =0";
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
<a href="arabic_class" class="text-dark">
<div class="p-2"><span class="fas fa-layer-group fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(255,0,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM arabic_class";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>الفصل</b>
</div>
</a>
</div>
</div>

<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="term" class="text-dark ">
<div class="p-2"><span class="fas fa-th fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(0,200,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM arabic_subjects";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>الموا د</b>
</div>
</a>
</div>
</div>

<div class=" col-md-2 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="arabic_result" class="text-dark ">
<div class="p-2"><span class="fas fa-truck fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(255,0,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM arabic_result";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b> Reports</b>
</div>
</a>
</div>
</div>
<div class=" col-md-3 p-2 mt-2 mb-2">
<div class="position-relative">
<a href="" class="text-dark ">
<div class="p-2"><span class="fas fa-mosque fa-3x float-right"></span></div>
<div class="clearfix"></div>
<div class="p-2 position-absolute col-md-12 text-light rounded" style="top: 0; background-color: rgba(0,200,0,0.5);">

<h3 class=""><?php  
	$sql = "SELECT * FROM register WHERE level = 2";
	$query = mysqli_query($connect, $sql);
	echo number_format(mysqli_num_rows($query));
	?></h3>
<b>Uztazh</b>
</div>
</a>
</div>
</div>







<div class="col-md-8 mt-3">
<b class="mt-3 text-center">Students</b>
<table class="table rounded table-striped text-center table-bordered table-responsive-xl p-0 mr-0 rounded">
<thead class="bg-success text-light">
<tr>
	<th>Name</th>
	<th>Arabic Class</th>
	<th>Regular Class</th>
	<th>Date of Registration</th>
	
</tr>
</thead>
<tbody>
	<?php  
	$sql = "SELECT * FROM students ORDER BY id DESC LIMIT 10";
	$query=  mysqli_query($connect, $sql);
	while ($tab = mysqli_fetch_array($query)) {
	
	
	?>
<tr>
	<td class="text-capitalize p-0">
	<?php
	$selecter = mysqli_query($connect, "SELECT * FROM register  WHERE id = '{$tab['user_id']}'");
	foreach($selecter as $call){
		echo $call['name'];
	}
	
	?>
	
	</td>
	<td class="p-1">
	<?php
	$selecter = mysqli_query($connect, "SELECT * FROM arabic_class  WHERE id = '{$tab['arabic_class']}'");
	foreach($selecter as $call){
		echo $call['class'];
	}
	?>
	
	</td>
	<td class="p-1">
	<?php
	$selecter = mysqli_query($connect, "SELECT * FROM class  WHERE id = '{$tab['class']}'");
	foreach($selecter as $call){
		echo $call['class'];
	}
	?>
	</td>
	<td class="p-1">
	<?php
	$selecter = mysqli_query($connect, "SELECT * FROM register  WHERE id = '{$tab['user_id']}'");
	foreach($selecter as $call){
		echo $call['date'];
	}
	
	?>
	</td>
</tr>

<?php } ?>
</tbody>
</table>
</div>


<div class="col-md-4 mt-3 p-0">
<b class="mt-3 text-center">Co-staffs</b>
<table class="table rounded table-striped text-center table-bordered table-responsive-xl p-0 mr-0 rounded">
<thead class="bg-danger text-light">
<tr>
	<th>Name</th>
	
	
	<th>Date of Registration</th>
	
</tr>
</thead>
<tbody>
	<?php  
	$sql = "SELECT * FROM register WHERE level = 3 ORDER BY id DESC LIMIT 10";
	$query=  mysqli_query($connect, $sql);
	while ($tab = mysqli_fetch_array($query)) {
	
	
	?>
<tr>
	<td class="text-capitalize p-0">
	<?php
	echo $tab['name'];
	?>
	
	</td>
	<td class="p-1">
	<?php
	echo $tab['date'];
	?>
	
	</td>
	
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