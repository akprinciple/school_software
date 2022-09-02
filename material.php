	<?php include 'inc/session.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'inc/link.php'; ?>
	<title>Course Materials | Fidelity Portal</title>
</head>
	<?php include 'inc/sidebar.php'; ?>

<div class=" m-auto p-2 text-justify">
<h4>Course Materials</h4>
<hr class="">
<p class=" p-3 pb-0" style="">
-- The page contains some materials which are needed by you.<br> 
--  Some files are zipped while some are docx file, pdf, images or videos. <br>
-- To make use of the zipped files, you need to extract them to your computer system.  <br>
-- Click on the download icon once and wait patiently for the download to start. <br>
-- Multiple clicks will lead to multiple download <br>
-- Always make sure the download is completed for the file to work properly.
</p>

<!-- <hr class="bg-light"> -->
</div>
<div class="">
<table class="table table-bordered table-striped text-center table-responsive-lg mt-2">
	<thead class="">
	<tr>
	<th>S/N</th>
	<th>Material Name</th>
	<th>Date</th>
	<th>Actions</th>
	</tr>
	</thead>
	<tbody>
		<?php 
$sel = "SELECT * FROM materials WHERE class = '{$_SESSION['class']}'&& status = 1 || class = 'all' && status = 1 ORDER BY id DESC";
$selt = mysqli_query($connect, $sel);
$n = 1;
while ($rw = mysqli_fetch_array($selt)) {
										
									
?>
<tr>
<td class=""><?php echo $n++; ?></td>
<td class="">
<a title="Download" href="materials/<?php echo $rw['file']; ?>" class="" download="<?php echo $rw['file']; ?>">
		<?php echo $rw['name']; ?>
</a>
</td>
<td class=""><?php echo $rw['date']; ?></td>
<td class="">
	<a title="Download" href="materials/<?php echo $rw['file']; ?>"  download="<?php echo $rw['file']; ?>" class=" pointer">
		<p class="fas fa-download mb-0 w-100"></p>
	</a>
</td>
</tr>

<?php } ?>	
</tbody>
</table>
</div>
	<?php include 'inc/footer.php'; ?>

