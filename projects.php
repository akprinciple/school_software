<?php include 'inc/session.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'inc/link.php'; ?>
	<title>Course Materials | Fidelity Portal</title>
</head>
	<?php include 'inc/sidebar.php'; ?>

	<div class=" m-auto p-2 text-justify">
<h4 class="mt-3">Submitted Projects</h4>
<table class="table table-bordered text-center bg-light table-striped">
<thead class="">
	<tr>
		<th>S/N</th>
		<th>Project Type</th>
		<th>File</th>
		<th>Comments</th>
		<th>Date</th>
		<th>Download</th>
	</tr>
</thead>
<tbody class="text-dark">
	<?php  
	$l_sql = "SELECT * FROM submissions WHERE name = '{$_SESSION["id"]}' ORDER BY id DESC";
	$l_query = mysqli_query($connect, $l_sql);
	$n = 1;
	while ($link = mysqli_fetch_array($l_query)) {
		
	
	?>
	<tr>
	<td><?php echo $n++; ?></td>
	<td><?php
$sql = "SELECT * FROM projects WHERE id = {$link['project']}";
	$query = mysqli_query($connect, $sql);
	
	while ($links = mysqli_fetch_array($query)) {
	 echo $links['project']; } ?></td>
	<td><a href="submission_folder/<?php echo $link['file']; ?>" download="<?php echo $link['file']; ?>" class="text-dark"><?php echo $link['file']; ?></a></td>
	<td><?php echo $link['comments']; ?></td>
	<td><?php echo $link['date']; ?></td>
	<td><a href="submission_folder/<?php echo $link['file']; ?>" download="<?php echo $link['file']; ?>" class="text-dark " title="Download"><p class="fas fa-download w-100 m-0"></p></a></td>
	
	</tr>
	<?php } ?>
</tbody>
</table>
</div>
	<?php include 'inc/footer.php'; ?>