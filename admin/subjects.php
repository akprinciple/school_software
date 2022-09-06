<?php 
		include 'inc/session.php';
    ob_start();
		$msg = $session_msg = "";
    if (isset($_GET['success'])) {
      $msg = "<script>alert('Update Successful');</script>";
      
    }
		if (isset($_POST['submit'])) {
			$subject = $_POST['subject'];
			$subjectcode = $_POST['subjectcode'];
            
			$sel = "SELECT * FROM subjects WHERE subject = '{$subject}' && subjectcode = '{$subjectcode}'";
			$selt = mysqli_query($connect, $sel);
			$count = mysqli_num_rows($selt);
			if ($count > 0) {
				$msg = "<div class='p-2 rounded alert-danger text-center mb-2'>Subject is already existing</div>";
			}
			else{
			$sql = "INSERT INTO subjects (subject, subjectcode) VALUES ('$subject', '$subjectcode')";
			$query = mysqli_query($connect, $sql);
			if ($query) {
				$msg = "<div class='p-2 rounded alert-success text-center mb-2'>subject Added Successfully</div>";
			}
			else{
				$msg = "<div class='p-2 rounded alert-danger text-center mb-2'>Error</div>";
			}
		}
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
           		<h4 class="font-weight-bold ml-3 mt-3">Manage Subjects</h4>
           	<?php 
           		include 'inc/hr.php';
           	 ?>
             <div class="">
           		<div class="col-md-11 m-auto">
           		
           				<form method="post" enctype="multipart/form-data">
           					<h5 class="">Add Subjects</h5>
           					<?php echo $msg; ?>
           					<div class="form-group mt-2 row p-3">
							   <div class="w-75 row px-2">
							   <div class="w-50 px-2">
           						<input type="text" name="subject" class="form-control" placeholder="Add Subject" required="required">
           						</div>
								   <div class="w-50">
								   <input type="text" name="subjectcode" class="form-control " placeholder="Input Subject Code" required="required">
           						</div>
								   </div>
								<button type="submit" name="submit" class="btn btn-success" style="border-radius: 0px 20px 20px 0px; width: 20%">Add</button>
                    </div>
           				</form>
           			


                  <?php
            if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Alotted Subjects csv file has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        case 'empty':
            $statusType = 'alert-danger';
            $statusMsg = 'There is nothing here to export';
          break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
  <div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

 <!-- Import Section -->
   
              <div class=" mt-3 border-bottom" id="importer"  style="display: none">
                <h5 class="text-center font-weight-bold border-bottom">Import Teachers' Alotted Subjects</h5>
               
                <form method="post" action="import/import_alotted_subject.php" enctype="multipart/form-data">
                  
                  
                  
                  <div class="form-group col-md-6 mx-auto">
                  <b>Choose CSV file</b>
                 <input type="file" accept=".csv" required="required" name="file" class="form-control" >
                
                  </div>

                 
                 
                  
                  <div class="w-100 text-center">
                  <button class="btn btn-success my-2 " name="submit" type="submit">Import</button>
                  <button class="btn btn-danger my-2 " type="reset" onclick="import_csv()">Close</button>
                  </div>
                  
                </form>
                <script type="text/javascript">
                    function import_csv() {
                    var element = document.getElementById('importer');
                    if(element.style.display === "none"){
                    element.style.display = "block";
                    }else{
                    element.style.display = "none";
                    }
                    }
                </script>
              </div>

                     <span class="float-right">
                 <!-- Export Button -->

                <a href="export/export_alotted_subjects?all" class="pointer btn btn-primary fas fa-file-csv " title="Export alotted Subjects as CSV"></a> 
              <!-- Import Button -->
               <a href="javascript:void(0)" onclick="import_csv()" class="pointer btn btn-warning text-light fas fa-file-import " title="Import CSV file for alotted Subjects"></a>
               </span>
               <div class="clearfix"></div>





           			<div class="">

           				<table class="table table-striped text-center col-md-12">
           					<thead class="bg-success text-light">
           						<tr>
           							<th>S/N</th>
           							<th>Subjects</th>
           							<th>Subject Codes</th>
           							<th>Action</th>
           						</tr>
           					</thead>
           					<tbody>
           						<?php 
           							$sel = "SELECT * FROM subjects";
									$selt = mysqli_query($connect, $sel);
									$n = 1;
									while ($rw = mysqli_fetch_array($selt)) {
										
									
           						 ?>
           						<tr>
           							<td><?php echo $n++; ?></td>
           							<td><?php echo $rw['subject']; ?></td>
           							<td><?php echo $rw['subjectcode']; ?></td>
           							<td><span id="del<?php echo $rw['id']; ?>" class="fas fa-pen text-success pointer"></span></td>
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
        <?php 
 $u_sql = "SELECT * FROM subjects";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
  $id = $user['id'];
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">

  <form method="post" enctype="multipart/form-data" class="pt-5">
    <div class="form-group col-md-4 border mx-auto mt-5 py-5">
      <h4 class="text-center text-light">Edit Subject</h4>
      <hr class="bg-white">
	  <label class=" font-weight-bold text-light">Subject Name </label>
      <input type="text" name="subj<?php echo $user['id']; ?>" class="form-control text-center" value="<?php echo $user['subject']; ?>">
	  <label class="mt-2 font-weight-bold text-light">Subject Code </label>
      <input type="text" name="subjcode<?php echo $user['id']; ?>" class="form-control text-center" value="<?php echo $user['subjectcode']; ?>">
      <button type="submit" name="edit<?php echo $user['id']; ?>" class="btn btn-success col-md-12 float-right mt-3">Edit</button>
      <div class="clearfix"></div>
    </div>
  </form>
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; "><!-- Are you sure you want to delete <b> <?php echo $user['term']; ?> Term </b>permanently? -->
<!-- <a href="delete.php?del_term=<?php echo $user['id']; ?>"><button class="btn-success btn">Yes</button></a> -->
<span id="clear<?php echo $user['id']; ?>"><button class="btn-danger btn">Cancel</button></span>
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
<?php 
  if (isset($_POST['edit'.$id])) {
      // echo "<script>alert('ERROR')</script>";

    $subj = $_POST['subj'.$id];
    $subjcode = $_POST['subjcode'.$id];
    $update = mysqli_query($connect, "UPDATE subjects SET subject = '{$subj}', subjectcode = '{$subjcode}' WHERE id = '{$id}'");
    if ($update) {
      header('location: subjects?success');
      // echo "Successful";
    }
  }

 ?>
<?php } ?>
</body>
</html>
    <?php #include '../inc/footer.php'; ?>
