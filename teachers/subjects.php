<?php 
		include 'inc/session.php';
    ob_start();
		$msg = $session_msg = "";
    if (isset($_GET['success'])) {
      $msg = "<script>alert('Update Successful');</script>";
      
    }

   
		 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Subjects | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>

</head>
<body>
	<div class="h-100 pl-3 pr-3">
            <div class="row">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
           		<h4 class="font-weight-bold ml-3 mt-3"> Subjects</h4>
           	<?php 
           		include 'inc/hr.php';
           	 ?>
             <div class="">
           		<div class="col-md-9 m-auto">
           		
           				
           			




           			<div class="">
								<h5 class="text-center mt-4">Your Teaching Subjects</h5>
           				<table class="table table-striped text-center border-bottom col-md-12">
           					<thead class="bg-success text-light">
           						<tr>
           							<th>S/N</th>
           							<th>Subjects</th>
           							<th>Subject Code</th>
           						</tr>
           					</thead>
           					<tbody>
           						<?php 
           							$sel = "SELECT * FROM teachers WHERE name = '{$_SESSION['id']}'";
									$selt = mysqli_query($connect, $sel);
									$n = 1;
									while ($rw = mysqli_fetch_array($selt)) {
										
									
           						 ?>
           						<tr>
           							<td><?php echo $n++; ?></td>
									   <td><?php
										$sels = "SELECT * FROM subjects WHERE id = '{$rw['subject']}' ";
									$selts = mysqli_query($connect, $sels);
									   foreach($selts as $s){
										   echo $s['subject'];
									   }
									   ?></td>
           							<td>
                        <?php
                    $sels = "SELECT * FROM subjects WHERE id = '{$rw['subject']}' ";
                  $selts = mysqli_query($connect, $sels);
                     foreach($selts as $s){
                       echo $s['subjectcode'];
                     }
                     ?>      
                        </td>
           						</tr>

           					<?php } ?>	
</tbody>
</table>
</div>
</div>
    
</div>
</div>
</div>
</div>
      
</body>
</html>
    <?php #include '../inc/footer.php'; ?>
