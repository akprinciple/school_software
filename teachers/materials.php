<?php  
include 'inc/session.php';
$msg = "";
if (isset($_POST['submit'])) {
$name = mysqli_real_escape_string($connect, $_POST['name']);
$class = mysqli_real_escape_string($connect, $_POST['class']);
$file = $_FILES['file']['name'];
$date = date('h:i:sa d/M/Y');
$tmp = $_FILES['file']['tmp_name'];

$sel = "SELECT * FROM materials WHERE name = '{$name}' && class = '{$class}' && file = '{$file}'";
$selt = mysqli_query($connect, $sel);
$count = mysqli_num_rows($selt);
if ($count > 0) {
$msg = "<div class='p-2 rounded text-danger text-center'>Material is already existing for  this class</div>";
}
else{
$sql = "INSERT INTO materials (name, class, file, date) VALUES ('$name', '$class', '$file', '$date')";
$query = mysqli_query($connect, $sql);
if ($query) {
move_uploaded_file($tmp, "../materials/$file");
$msg = "<div class='p-2 rounded text-success text-center'>Material Added Successfully</div>";	
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Course Materials | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>
	<?php 
		include 'material_search.php';
 ?>	
  <script type="text/javascript">
          function finder(val) {
               $.ajax({
                  type: "GET",
                  url: "material_search.php",
                  data: 'mat='+val,
                  success: function (data) {
                        $('#material').html(data);
                  }
               })
          }
		  function typer(val) {
               $.ajax({
                  type: "GET",
                  url: "mat_keyword.php",
                  data: 'mater='+val,
                  success: function (data) {
                        $('#material').html(data);
                  }
               })
          }
         
    </script>
</head>
<body>
<div class="row ml-0 mr-0">
<?php include 'inc/sidebar.php'; ?>

<div class="col-md-10">
<h4 class="mt-3">Course Materials</h4>
<?php include 'inc/hr.php'; ?>
<div class='row mx-0 mb-3'>
<!--Search Box By Ajax   -->
<form method="post" enctype="multipart/form-data" class="col-md-6 d-block">
<b>Search by Class</b>
<!-- <h4 class="text-center">SELECT CLASS </h4> -->
<select name="material" class="custom-select text-center" onchange="finder(this.value)">
	<option class="text-center">Select Class</option>
	<option value="all">General</option>
	<?php
		$sql = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$_SESSION['class']}' ORDER BY class ASC");
		while($mat_row = mysqli_fetch_array($sql)){
	?>
	<option value="<?php echo $mat_row['id']; ?>" class="text-center"><?php echo $mat_row['class']; ?></option>
	<?php } ?>
</select>

</form>
<!-- Search By Keyword -->
<form class="col-md-6 d-block">
	<b>Search by Keyword</b>
		<input type="text" onkeyup="typer(this.value)" class="form-control" placeholder="Keyword...">
</form>
</div>

<span class="float-right mb-3 bot-left p-2 bg-white">
<a id="click" class="pointer text-success fas fa-plus mr-2" title="Add Course Material"></a> 
<!-- <span class="">/</span> -->
<a href="materials" class="text-success fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span>	
<div class="clearfix"></div>
<?php echo $msg; ?>



<!-- Addding Material Section -->
<!-- The teachers are only allowed to select the class given to them -->
<div id="reg" class="col-md-9 m-auto p-0 bg-white shadow" style="display: <?php if(!isset($_POST['submit'])){ echo "none"; } ?>;">
<h4 class="p-2">Add Course Material</h4>
<div class="border border-success"></div>
<form method="post" enctype="multipart/form-data">
<div class="form-group mt-2 p-3">
<label class="font-weight-bold">Material Name</label>
<input type="text" name="name" required="" class="form-control" placeholder="Input Material Name">

<label class="font-weight-bold mt-2">Class</label>
<select class="custom-select" name="class">
	<option value="all">--Select Class--</option>
<?php  
$sel = "SELECT * FROM class WHERE id = '{$_SESSION['class']}' ORDER BY id ASC";
$selt = mysqli_query($connect, $sel);
$n = 1;
while ($rw = mysqli_fetch_array($selt)){
		
?>	
<option value="<?php echo $rw['id']; ?>"><?php echo $rw['class']; ?></option>
<?php } ?>
</select>


<label class="font-weight-bold mt-2">Upload File</label>
<input type="file" name="file" required="" class="form-control">

<button type="submit" name="submit"  class="btn btn-success mt-2 col-md-6 float-right">Add Material</button>
<div class="clearfix"></div>
</div>
</form>
</div>

<div id="material"></div>

</div>
</div>
 <?php 
 $u_sql = "SELECT * FROM materials";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">Are you sure you want to Delete <b> <?php echo $user['name']; ?></b> permanently?  
<a href="delete?del_material=<?php echo md5($user['id']); ?>"><button class="btn-success btn">Yes</button></a>
<span id="clear<?php echo $user['id']; ?>"><button class="btn-danger btn">No</button></span>
</div>
</div>


<?php } ?>
</body>
</html>

