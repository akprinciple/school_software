<?php 
	function update(){
		while($report = mysqli_fetch_array($show)) { 
	$id = $report['id'];
?>
<tr>
	<td><?php echo $n++; ?></td>
	<td>
	<?php 
	$c_sql = "SELECT * FROM users WHERE id = '{$report["name"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($name = mysqli_fetch_array($c_query)) {
	 	echo $name['name'];
	 } 
	
	?>
	</td>
	<td>
	<input type="number" name="first<?php echo $id; ?>" value="<?php echo $report['first']; ?>" class="border-0 text-center outline">
	</td>
	<td>
	<input type="number" name="second<?php echo $id; ?>" value="<?php echo $report['second']; ?>" class="border-0 text-center outline">
	
	</td>
	<td>
		<input type="number" name="test<?php echo $id; ?>" value="<?php echo $report['test']; ?>" class="border-0 text-center outline">
	</td>
	<td>
		<input type="number" name="exam<?php echo $id; ?>" value="<?php echo $report['exam']; ?>" class="border-0 text-center outline">
	</td>
</tr>
<?php

if (isset($_POST['up'])) {
	// $test =  $_POST['test'.$id];
	// $first = $_POST['first'.$id];
	// $exam = $_POST['exam'.$id];
	// $second = $_POST['second'.$id];
$first = mysqli_real_escape_string($connect, $_POST['first'.$id]);
$second = mysqli_real_escape_string($connect, $_POST['second'.$id]);
$test = mysqli_real_escape_string($connect, $_POST['test'.$id]);
$exam = mysqli_real_escape_string($connect, $_POST['exam'.$id]);
$update = "UPDATE report SET test= '{$test}', first = '{$first}', second = '{$second}', exam = '{$exam}' WHERE id = '{$id}'";
$u_query = mysqli_query($connect, $update);
if ($u_query) {
	$msg = "<div class='text-center'>Results updated Successfully</div>";
	// $msg = header('location: users.php');
}
else{
	echo "<script>alert('Error')</script>";
	// header('location: users.php');

}
}
?>
<?php }
echo $msg;
} 

 ?>