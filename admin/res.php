<?php 
ob_start();
include 'inc/session.php';
$msg = "";
// Code to insert New User
if (isset($_POST['add'])) {
$name = mysqli_real_escape_string($connect, $_POST['a_name']);
$test = mysqli_real_escape_string($connect, $_POST['test']);
// $exam = mysqli_real_escape_string($connect, $_POST['exam']);
$class = $_GET['class'];
$term = $_GET['term'];
$week = $_GET['week'];
$subject = $_GET['subject'];
$session = $_GET['session'];
$teacher = $_SESSION['id'];

// $a_term = mysqli_real_escape_string($connect, $_POST['a_term']);
if ($name == "--Select Name--") {
 	$msg = "<div class='text-center alert-danger p-2'>Selection Error</div>";
 }
 else{
 	$asql = "SELECT * FROM scores WHERE student_id = '{$name}' && class = '{$class}' && term = '{$term}' && session ='{$session}' && week = '{$week}' && subject = '{$subject}'";
 	$aquery = mysqli_query($connect, $asql);
 	$a_count = mysqli_num_rows($aquery);
 	if ($a_count > 0) {
 	$msg = "<div class='text-center alert-danger p-2'>The Score for the Subject of this User has already been Added <span id='clicks' class='pointer text-success'> Click here to try Again!</span>	</div>";
 	}
 	else{
 	$ins = "INSERT INTO scores (student_id, class, term, session, week, subject, test, teacher) VALUES ('$name', '$class', '$term', '$session', '$week', '$subject', '$test', '$teacher')";
 	$ins_query = mysqli_query($connect, $ins);
 	if ($ins_query) {
 		$msg = "<div class='text-center alert-success p-2'>User Successfully Added.</div>";
 	}
 	else{
 		echo "<script>alert('Error');</script>";
 	}

 	}
 }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Weekly Test Results | Fidelity Schools</title>
	
	<?php include 'inc/link.php'; ?>
	<script type="text/javascript">
     function finds(val) {
    $.ajax({
    type: "GET",
    url: "finder.php",
    data: 'sees='+val,
    success: function (data) {
    $('#sea').html(data);
    }
    })
    }
    
function view(val) {
    $.ajax({
    type: "GET",
    url: "search.php",
    data:
    	'a_see='+val,
    	// 'sees='+val,

    success: function (data) {
    $('#set').html(data);
    }
    })
    }
    </script>
    
<?php #include 'search.php'; ?>
<?php #include 'finder.php'; ?>

</head>
<body>
<div class="">
<div class="row ml-0 mr-0">
<!---------------- Sidebar  --------------->
<?php include 'inc/sidebar.php'; ?>
<div class="col-md-10 ">
<h4 class="ml-3 mt-3">Manage Weekly Results</h4>
<?php 
include 'inc/hr.php';
?>
<div class="mt-3 row">
<!---------------- Search by class and term  --------------->

<form class="col-md-8 row border-right mx-0">

	<div class="form-group col-md-4 p-2">
	<label class="font-weight-bold">Subject</label>
	<br>
	<select class="form-control" name="subject">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['subject']) && !isset($_GET['week']) && !isset($_GET['session'])) {
	 	echo "<option value='1'>Select Subject</option>";
	}
	
	else {
	$t = $_GET['subject'];
	$sq = "SELECT * FROM subjects WHERE id = '{$t}'";
	$quer = mysqli_query($connect, $sq);
	while ($rw = mysqli_fetch_array($quer)) {
		$tm = $rw['subject'];
		echo "<option value='$t'>$tm</option>";
	 }} 
	?>
	?>
	<?php 
	$sql = "SELECT * FROM subjects ORDER BY subject ASC";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
	
	 ?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['subject']; ?></option>
	<?php } ?>
	</select>
	</div>


	<div class="form-group col-md-4 p-2">
	<label class="font-weight-bold">Class</label>
	<br>
	<select class="form-control" name="class">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['subject']) && !isset($_GET['week']) && !isset($_GET['session'])) {
	 	echo "<option value='1'>Select Class</option>";
	}
	
	else {
	$t = $_GET['class'];
	$sq = "SELECT * FROM class WHERE id = '{$t}'";
	$quer = mysqli_query($connect, $sq);
	while ($rw = mysqli_fetch_array($quer)) {
		$tm = $rw['class'];
		echo "<option value='$t'>$tm</option>";
	 }} 
	?>
	?>
	<?php 
	$sql = "SELECT * FROM class";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
	
	 ?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
	<?php } ?>
	</select>
	</div>

<div class="form-group col-md-4 p-2">
	<label class="font-weight-bold">week</label>
	<br>
	<select class="form-control" name="week">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['subject']) && !isset($_GET['week']) && !isset($_GET['session'])) {
	 	echo "<option value='1'>Select week</option>";
	}
	
	else {
	$t = $_GET['week'];
	$sq = "SELECT * FROM weeks WHERE id = '{$t}'";
	$quer = mysqli_query($connect, $sq);
	while ($rw = mysqli_fetch_array($quer)) {
		$tm = $rw['week'];
		echo "<option value='$t'>$tm</option>";
	 }} 
	?>
	?>
	<?php 
	$sql = "SELECT * FROM weeks";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
	
	 ?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['week']; ?></option>
	<?php } ?>
	</select>
	</div>

	<div class="form-group col-md-4 p-2">
	<label class="font-weight-bold">Session</label>
	<br>
	<select class="form-control" name="session">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['subject']) && !isset($_GET['week']) && !isset($_GET['session'])) {
	 	echo "<option value='1'>Select Session</option>";
	}
	
	else {
	$t = $_GET['session'];
	$sq = "SELECT * FROM session WHERE id = '{$t}'";
	$quer = mysqli_query($connect, $sq);
	while ($rw = mysqli_fetch_array($quer)) {
		$tm = $rw['session'];
		echo "<option value='$t'>$tm</option>";
	 }} 
	?>
	?>
	<?php 
	$sql = "SELECT * FROM session";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
	
	 ?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['session']; ?></option>
	<?php } ?>
	</select>
	</div>

	<div class="form-group col-md-4 p-2">
	<label class="font-weight-bold">Term</label>
	<br>
	<select class="form-control" name="term">
	
	<?php
	// Code to show that the search inputs that are showing in the input box
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['subject']) && !isset($_GET['week']) && !isset($_GET['session'])) {
	 	echo "<option value='1'>Select Term</option>";
	}
	
	else {
	$t = $_GET['term'];
	$sq = "SELECT * FROM term WHERE id = '{$t}'";
	$quer = mysqli_query($connect, $sq);
	while ($rw = mysqli_fetch_array($quer)) {
		$tm = $rw['term'];
		echo "<option value='$t'>$tm</option>";
	 }} 
	?>
	

	<?php 
	// Code to fetch the terms
	$sql = "SELECT * FROM term";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
	
	 ?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['term']; ?></option>
	<?php } ?>
	</select>
</div>
<div class="col-md-4">
	<div class="p-3"></div>
	<button type="search" name="submit" class="btn btn-success rounded w-100 mt-3">Search</button>
</div>
</form>
	

<!---------------- Search by Keyword  --------------->

	<div class="col-md-4 form-group p-2">
	<form>
	<label class="font-weight-bold">Search by keyword</label>
	<br>
	<input type="search" required="required" name="search" placeholder="Search By keyword" class="form-control" value="<?php if (isset($_GET['search'])) {
	echo $_GET['search']; } ?>" 
	>
	<button class="btn btn-success rounded mt-1 float-right">Search</button>		
	</form>
	</div>
</div>






<span class="float-right mb-3 bot-left p-2 bg-white">
<?php 
	if (isset($_GET['class']) && isset($_GET['term']) && isset($_GET['subject']) && isset($_GET['week']) && isset($_GET['session'])) {
		$session = $_GET['session'];
		$class = $_GET['class'];
		$subject = $_GET['subject'];
		$week = $_GET['week'];
		$term = $_GET['term'];
 ?>
<a id="click" class="pointer text-success fas fa-plus mr-2" title="Add score for new Student"></a> 
<?php } ?>
<a href="results.php" class="text-success fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span>	
<div class="clearfix"></div>






















<!-- </div> -->

<!-- Search by class, term , subject,  week and Session -->
<?php 
if (isset($_GET['class']) && isset($_GET['term']) && isset($_GET['subject']) && isset($_GET['week']) && isset($_GET['session'])) {
		$session = $_GET['session'];
		$class = $_GET['class'];
		$subject = $_GET['subject'];
		$week = $_GET['week'];
		$term = $_GET['term'];

	$select = "SELECT * FROM scores WHERE class ='{$class}' && week = '{$week}'  && session = '{$session}' && subject ='{$subject}' && term = '{$term}' ORDER BY student_id ASC";
	$show = mysqli_query($connect, $select);

	$count = mysqli_num_rows($show);
	
	if ($count < 1) {
		?>

 <!-- Display of insert form for Scores When Result is Zero -->
 <h3 class="display-4 text-center mt-3"> 
 	<?php 
	$c_sql = "SELECT * FROM subjects WHERE id = '{$subject}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['subject'];
	 } 
	?>
 </h3>
<div class="row  text-center mx-0 mb-n3">
 <div class="col-md-6 my-0 p-0">
 <div class="float-left w-50 shadow bg-success text-light p-2 font-weight-bold mb-3">
	
	<?php 
	$c_sql = "SELECT * FROM session WHERE id = '{$session}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['session'];
	 } 
	?>
</div>
<!---------------- Term Display  --------------->
<div class="float-right w-50 bg-white text-dark p-2 font-weight-bold shadow mb-3">
	<?php

	$c_sql = "SELECT * FROM term WHERE id = '{$term}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($ter = mysqli_fetch_array($c_query)) {
	 	echo $ter['term'];
	 } 
	?> Term
</div>
</div>
<div class="col-md-6 my-0 p-0">
	<div class="float-left w-50 shadow bg-white txt-light p-2 font-weight-bold mb-3">
	<!-- Class: -->
	<?php 
	$c_sql = "SELECT * FROM class WHERE id = '{$class}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['class'];
	 } 
	?>
</div>
<div class="float-left w-50 shadow bg-success text-light p-2 font-weight-bold mb-3">
	
	<?php 
	$c_sql = "SELECT * FROM weeks WHERE id = '{$week}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['week'];
	 } 
	?>
</div>
</div>
</div>
<div class="mt-3">
<!---------------- Add New Student and Refresh Section  --------------->

<div class="mb-3">
<!---------------- Alert Message  --------------->	
	<?php echo $msg; ?>
	

 <form method="post" enctype="multipart/form-data">
 <table class="table table-striped table-bordered text-center text-capitalize">
 	<thead class="">
	<th>S/N</th>
	<th>Name</th>
	<th>Test(20)</th>
	
	<!-- <th>Actions</th> -->
</thead>

		<?php

	$n = 1;	
	$r_sql = "SELECT * FROM students WHERE class ='{$class}'  && session = '{$session}'  ORDER BY user_id ASC";
	$r_query = mysqli_query($connect, $r_sql);
		
	while ($r_name = mysqli_fetch_array($r_query)) {
 ?>
  <tr>
 	<td><?php echo $n++; ?></td>
 	<td><?php 
 	$name = $r_name['user_id'];
 	$r_id = $r_name['id'];

 	$s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
 	while ($pro = mysqli_fetch_array($s_name)) {
 		echo $pro['name'];
 	}
 	

 	?></td>
 	
 	
 	<td><input type="number" required="required" name="test<?php echo $name; ?>" value="0" class="border-0 text-center outline w-100"  max="20" min="0"></td>
 	<!-- <td><input type="number" required="required" name="exam<?php echo $name; ?>" value="0" class="border-0 text-center outline w-100" max="70" min="0"></td>
 	<td>0</td> -->
 	<!-- <td><a href="results.php" class="fas fa-arrow-left text-danger"></a></td> -->
 </tr>
<?php
 // Code to Insert New Results for a new term
if (isset($_POST['updated'])) {
	
$i_name = $name;
$test = $_POST['test'.$name];	
// $exam = $_POST['exam'.$name];	
$insert = "INSERT INTO scores (student_id, subject, term, class, week, session, test) VALUES ('$name', '$subject', '$term', '$class', '$week', '$session', '$test')";
$i_query = mysqli_query($connect, $insert);
if ($i_query) {
	// $msg = "<div class='text-center'>Results Added Successfully</div>";
	header('location: results.php?class='.$class.'&term='.$term.'&&week='.$week.'&&subject='.$subject.'&&session='.$session.'');

}
}
?>
 <?php } ?>

</table>
<button name="updated" type="submit" class="btn btn-success float-right mt-3 <?php if ($count > 0) {
	echo "d-none";
} ?>">Submit</button>
<div class="clearfix"></div>
</form>


<?php }
// What will be displayed When the results is greater than 0
else{ ?>
	<h3 class="display-4 text-center mt-3"> 
 	<?php 
	$c_sql = "SELECT * FROM subjects WHERE id = '{$subject}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['subject'];
	 } 
	?>
 </h3>
<div class="row  text-center mx-0 mb-n3">
 <div class="col-md-6 my-0 p-0">
 <div class="float-left w-50 shadow bg-success text-light p-2 font-weight-bold mb-3">
	
	<?php 
	$c_sql = "SELECT * FROM session WHERE id = '{$session}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['session'];
	 } 
	?>
</div>
<!---------------- Term Display  --------------->
<div class="float-right w-50 bg-white text-dark p-2 font-weight-bold shadow mb-3">
	<?php

	$c_sql = "SELECT * FROM term WHERE id = '{$term}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($ter = mysqli_fetch_array($c_query)) {
	 	echo $ter['term'];
	 } 
	?> Term
</div>
</div>
<div class="col-md-6 my-0 p-0">
	<div class="float-left w-50 shadow bg-white txt-light p-2 font-weight-bold mb-3">
	<!-- Class: -->
	<?php 
	$c_sql = "SELECT * FROM class WHERE id = '{$class}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['class'];
	 } 
	?>
</div>
<div class="float-left w-50 shadow bg-success text-light p-2 font-weight-bold mb-3">
	
	<?php 
	$c_sql = "SELECT * FROM weeks WHERE id = '{$week}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['week'];
	 } 
	?>
</div>
</div>
</div>

<div id="reg" class="col-md-11 m-auto shadow p-2 bg-white rounded bot-left border-success" style="display: none;">
<!---------------- Dropdown Form To Add Score for New Students  --------------->
	<form method="post" enctype="multipart/form-data">
	<h4 class="text-center">Add Score for New Student</h4>
	



<div class="row mx-0">
<div class="col-md-6 mt-2">
	<label class="font-weight-bold">Name</label>
<div class="form-group">
	<select class="form-control" name="a_name">
	<option>--Select Name--</option>
	<?php 
		
		$sel = mysqli_query($connect, "SELECT * FROM students WHERE class = '{$class}' && session = '{$session}' ");
		while ($rel = mysqli_fetch_array($sel)) {
			# code...
		
	?>
	<option value="<?php echo $rel['user_id']; ?>"
		style="
			<?php  
				$lect = mysqli_query($connect, "SELECT * FROM scores WHERE class = '{$class}' && session = '{$session}' && subject = '{$subject}' && term = '{$term}'  && student_id = '{$rel['user_id']}'");
				
		while($ive = mysqli_fetch_array($lect)){
			$user_id = $ive['student_id'];
			echo "display: none"; }
			?>
		"
		>
		<?php  
			$a_sql = "SELECT * FROM register WHERE id = '{$rel["user_id"]}'";
	$a_query = mysqli_query($connect, $a_sql);
	while ($a_row = mysqli_fetch_array($a_query)) {
		echo $a_row['name'];
		}
	?>
		
	</option>
	<?php } ?>
	</select>
</div>
</div>


<div class="col-md-6 mt-2">
	<label class="font-weight-bold">Test(20)</label>
	<input type="number" name="test" min="0" max="20" class="form-control" placeholder="Input Test Score">
</div>

<!-- <div class="col-md-6 mt-2">
	<label class="font-weight-bold">Exam(70)</label>
	<input type="number" name="exam" min="0" max="70" class="form-control" placeholder="Input Exam Score">
</div> -->


<div class="col-md-6 mt-2">
<button type="submit" name="add" class="btn btn-success w-100 mt-4 mx-auto d-block">Add</button>
</div>
</div>
</form>
</div>
<form method="post" enctype="multipart/form-data">
<table class="table-bordered table-hover table col-md-12 text-center m-auto" style="overflow-x: auto; min-width: 100%;">
<thead class="">
	<th>S/N</th>
	<th>Name</th>
	<th>Test(20)</th>
	<!-- <th>Exam</th>
	<th>Total</th> -->
	<th>Actions</th>
</thead>
<tbody>
<?php 

	$n =1;
// Row to Update found results for search by class and term
while($report = mysqli_fetch_array($show)) { 
	$id = $report['id'];
?>
<tr>
	<td><?php echo $n++; ?></td>
	<td>
	<?php 
	$c_sql = "SELECT * FROM register WHERE id = '{$report["student_id"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($name = mysqli_fetch_array($c_query)) {
	 	echo $name['name'];
	 } 
	
	?>
	</td>
	
	
	<td>
		<?php echo $report['test']; ?>
		
	</td>
	<!-- <td>
		<?php #if($report['exam'] < 1){echo "ABS";}else{echo $report['exam'];} ?>
		
	</td>
	<td>
		<?php #echo $report['test'] + $report['exam']; ?>
	</td> -->
	<td>
		<span id="update<?php echo $report['id']; ?>" title="Edit Scores" class="fas fa-pen pointer text-success"></span>
		<span id="del<?php echo $report['id']; ?>" title="Delete" class="fas fa-times text-danger"></span>
	</td>
</tr>
<?php }}} ?>












<div>


<?php 
// Code for to display Search results by Keyword
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$s_sql = "SELECT * FROM register WHERE name LIKE '%%".$search."%%' ORDER BY id DESC";
	$s_query = mysqli_query($connect, $s_sql);
	$n = 1;
	
	
?>
 <!---------------- Table to Display Search Results by Keyword ------------->
<form method="post" enctype="multipart/form-data">
<table class="table-bordered table-striped table col-md-12 text-center m-auto bg-white shadow rounded">
<thead class="bg-success text-light">
	<th>S/N</th>
	<th>Name</th>
	<th>Class</th>
	<th>Week</th>
	<th>Term</th>
	<th>Session</th>
	<th>Subject</th>
	<th>Test</th>
	<!-- <th>Exam</th> -->
	<th>Actions</th>
</thead>
<tbody>
<?php 
while ($s_row = mysqli_fetch_array($s_query)) {
$id = $s_row['id'];
$z_sql = "SELECT * FROM scores WHERE student_id = '{$id}'";
$z_query = mysqli_query($connect, $z_sql);
$counts = mysqli_num_rows($z_query);
#echo $counts;

while ($z_row = mysqli_fetch_array($z_query)) {
	$zname = $z_row['student_id'];
?>
<tr>
 	<td><?php echo $n++; ?></td>
 	<td><?php echo $s_row['name']; ?></td>
 	<td>
 	<?php
 	$zclass = $z_row['class'];
 	$sql = "SELECT * FROM class WHERE id = '$zclass'";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
 	echo $row['class'];
 }
?>
</td>
<td>
<?php

 	$zter = $z_row['week'];
 	$sql = "SELECT * FROM weeks WHERE id = '$zter'";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
 	echo $row['week'];
 }
?>
</td>
	
	<td>
	<?php
 	$zterm = $z_row['term'];
 	$sql = "SELECT * FROM term WHERE id = '$zterm'";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
 	echo $row['term'];
 }
 ?>
 
</td>
 	<td>
 		<?php
 	$zterm = $z_row['session'];
 	$sql = "SELECT * FROM session WHERE id = '$zterm'";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
 	echo $row['session'];
 }
?>
 	
 	
 	<td>
 	<?php

 	$zter = $z_row['subject'];
 	$sql = "SELECT * FROM subjects WHERE id = '$zter'";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
 	echo $row['subject'];
 }
?>
 	<td>
 	<?php echo $z_row['test'] ?>
 	
 	</td>
 	<!-- <td>
 	<?php #echo $z_row['exam'] ?>
 	
 	</td> -->
 	<!-- <td>
 	<?php #echo $z_row['test'] + $z_row['exam']; ?>
 	</td> -->
 	<td>
 	<span title="Edit Scores" id="update<?php echo $z_row['id']; ?>" class="fas fa-pen text-success"></span>
 	<span title="Delete" id="del<?php echo $z_row['id']; ?>" class="fas fa-times text-danger"></span>
 	</td>
 </tr>
 <?php }}
} ?>
</tbody>
</table>
	
</form>
</div>
</div>
</div>

</div>
 <!---------------- Modal Deleting Reports ------------->

<?php 
 $u_sql = "SELECT * FROM scores";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">Are you sure you want to <b class="text-danger"> DELETE</b> the report for  
	<b class="text-capitalize"> <?php 
	$c_sql = "SELECT * FROM register WHERE id = '{$user["student_id"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($name = mysqli_fetch_array($c_query)) {
	 	echo $name['name'];
	 }  ?>  
	</b> in 
	<b>
	<?php 
	$c_sql = "SELECT * FROM class WHERE id = '{$user["class"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['class'];
	 }  
	?>  	
	</b>
	class 
	<b>
	<?php 
	$c_sql = "SELECT * FROM subjects WHERE id = '{$user["subject"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['subject'];
	 }  
	?> 
	</b>
	score for 	
	<b>
	<?php 
	$sq = "SELECT * FROM term WHERE id = '{$user["term"]}'";
	$quer = mysqli_query($connect, $sq);
	while ($rw = mysqli_fetch_array($quer)) {
		$tm = $rw['term'];
		echo $tm;
	 }
	 ?> 
	</b> Term of 
	<b>
	<?php 
	$c_sql = "SELECT * FROM session WHERE id = '{$user["session"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['session'];
	 }  
	?>  	
	</b>
	session
	permanently?
	<?php if(isset($_GET['class']) && isset($_GET['term']) && isset($_GET['subject']) && isset($_GET['week']) && isset($_GET['session'])){

		?>
		<!-- Delete Button for Search results by subject, class, term ... -->
<a href="delete.php?del_report=<?php echo $user['id']; ?>&class=<?php echo $_GET['class']; ?>&term=<?php echo $_GET['term']; ?>&week=<?php echo $_GET['week']; ?>&subject=<?php echo $_GET['subject']; ?>&session=<?php echo $_GET['session']; ?>"><button class="btn-success btn">Yes</button></a>
	<?php }elseif(isset($_GET['search'])){ ?>
		<!-- Delete Button for Search Results By Keyword -->
		<!-- The essence of the two delete Buttons is to make the redirection back to the same page possible
		from the delete page
	-->
<a href="delete.php?del_report_keyword=<?php echo $user['id']; ?>&search=<?php echo $_GET['search']; ?>"><button class="btn-success btn">Yes</button></a>
<?php } ?>
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
<!---------------- Modal Editing Results ------------->
<?php 
$u_sql = "SELECT * FROM scores";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
$id = $user['id'];

?>

<div id="fetcher<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
	<div class="col-md-8 m-auto p-5 shadow">
		<span id="clearer<?php echo $user['id']; ?>" class="fas fa-times text-danger float-right fa-2x"></span>

	<div class="mt-5 shadow p-3" style="background-color: ghostwhite;">
	<h4 class="text-center font-weight-bold">Edit Result</h4>
	<hr>
	<h5 class="row ml-0 mr-0 text-center mb-3">
	<div class="w-25" style="">
	<?php 
	$c_sql = "SELECT * FROM register WHERE id = '{$user["student_id"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($name = mysqli_fetch_array($c_query)) {
	 	echo $name['name'];
	} 
	?>
	</div>
	<div class="text-center w-25" style="">
	<?php 
	$c_sql = "SELECT * FROM class WHERE id = '{$user["class"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	echo $clas['class'];
	}  
	?> 
	</div>
	<div style="width: 25%">
	<?php 
	$sq = "SELECT * FROM term WHERE id = '{$user["term"]}'";
	$quer = mysqli_query($connect, $sq);
	while ($rw = mysqli_fetch_array($quer)) {
		$tm = $rw['term'];
		echo $tm;
	 }
	 ?> Term	
	</div>
	<div style="width: 25%">
	<?php 
	$sq = "SELECT * FROM weeks WHERE id = '{$user["week"]}'";
	$quer = mysqli_query($connect, $sq);
	while ($rw = mysqli_fetch_array($quer)) {
		$tm = $rw['week'];
		echo $tm;
	 }
	 ?> 	
	</div>
	</h5>
	<hr>
	<form method="post" enctype="multipart/form-data">
	<div class="row">
	

	

	<div class="w-100 px-3">
	<label>Test Score (20)</label>
	<div class="form-group">
 	<input type="number" max="20" min="0" required="required" name="test<?php echo $id; ?>" value="<?php echo $user['test'] ?>" class="text-center form-control">
	</div>
	</div>
	<div class="col-md-6">
	<!-- <label>Exam(70)</label>
	<div class="form-group">
 	<input type="number" max="70" min="0" required="required" name="exam<?php echo $id; ?>" value="<?php echo $user['exam'] ?>" class="text-center form-control">
	</div> -->
	</div>
	</div>
	<div class="pl-3 ">
	<button type="submit" name="ind_update<?php echo $id; ?>" class="btn btn-success float-right w-50">update</button>
	<div class="clearfix"></div>
	</div>
	</form>

	</div>
	</div>
<?php 

// Code to update Scores on Modal
if (isset($_POST['ind_update'.$id])) {

$test = mysqli_real_escape_string($connect, $_POST['test'.$id]);
// $exam = mysqli_real_escape_string($connect, $_POST['exam'.$id]);
$ind_sql = "UPDATE scores SET test = '{$test}' WHERE id = '{$user["id"]}'";
$ind_query = mysqli_query($connect, $ind_sql);
if ($ind_query && isset($_GET['search'])) {
	$search = $_GET['search'];
	header('location: results.php?search='.$search.'');
	
}
elseif ($ind_query && isset($_GET['class']) && isset($_GET['term']) && isset($_GET['subject']) && isset($_GET['week']) && isset($_GET['session'])) {
	header('location: results.php?class='.$class.'&&term='.$term.'&&week='.$week.'&&subject='.$subject.'&&session='.$session.'');
	
}
else{
	echo "<script>alert('Error');</script>";
}
}
?>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $("#update<?php echo $user['id']; ?>").click(function(){
  $("#fetcher<?php echo $user['id']; ?>").toggle("slow");
  })
  $("#clearer<?php echo $user['id']; ?>").click(function(){
  $("#fetcher<?php echo $user['id']; ?>").hide("slow"); 
})
})                     
</script>
<?php } ?>
</body>
</html>
<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="js/java.js"></script> -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>