<?php
	// use Twilio\Rest\Client;
	require 'class/class.phpmailer.php';

include 'inc/session.php';
$message = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print Assignments | Fidelity Schools</title>
	
	<?php include 'inc/link.php'; ?>
	

</head>
<body>
<?php
	if (isset($_GET['print_id'])) {
	 	$id = (int)$_GET['print_id'];
	 	
	
	 	
	 $n = 1; 
	$sel = mysqli_query($connect, "SELECT * FROM fees_reminder WHERE id = '{$id}'");
	// echo mysqli_num_rows($sel);
	?>
	<div class="col-md-11 m-auto p-3" style="">
		<img src="../images/fidelity heading.jpg" style="width: 100%">

	<div class=" rounded mt-2 mx-0">
		<div class=" p-2 text-center">
		  <p class="mx-0 row">
	 		<span class="font-weight-bold" style="width: 10%">Date :</span>
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%; font-size: 18px;">
				<?php 
				echo $date;
				?>
			</span>
		  </p>
				
		</div>
	</div>
		
		<h4 class="text-center">Reminder</h4>
	<?php
	foreach ($sel as $key) {
		
	
 ?>
 	<div class="p-2 border rounded border-success mb-2" style="min-height: 400px; position: relative;">
 		
         <p>
         <?php echo $key['description']; ?>
         </p>
         <span style="position: absolute; bottom: 20px;">Kindly ignore if you have balanced up</span>
 	</div>
 <?php }} ?>
 	</div>

 	<div style="position: absolute; bottom: 0" class="p-2 position-fixed w-100">
 	<div class="text-center">
     <?php echo $message; ?>
     </div>
     <center>
   
    <button type="button" class="btn btn-success p-2" onclick="print(this)">Print</button>
    <a href="school_fees" class="btn btn-danger p-2">Go Back</a>
	</center>
 </div>

 	
</body>
</html>