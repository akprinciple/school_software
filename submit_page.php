
<?php
			include 'inc/session.php'; 
    //         if ($row['class'] != 1 && $row['class'] != 2) {
    // header('location: index.php');
// }
			$msg = $name = $class = $comments = "";
				
if (isset($_POST['submit'])) {
$id = $_SESSION['id'];
$class = $_SESSION['class'];
$project = mysqli_real_escape_string($connect, $_POST['project']);
$comments = mysqli_real_escape_string($connect, $_POST['comments']);
$time = date('h:i:sa d/M/Y');
$file = $_FILES['file']['name'];
$tmp = $_FILES['file']['tmp_name'];
$type = pathinfo("upload/$file", PATHINFO_EXTENSION);


$sel = "SELECT * FROM submissions WHERE name = '$id' && project ='$project'";
$ins = mysqli_query($connect, $sel);
$count = mysqli_num_rows($ins);
if ($count > 0) {
$msg = "<div class='text-danger text-center '>You have already Submitted. Contact Your Instructor for assistance</div>";
					
}
else{
  $selr = "SELECT * FROM submissions WHERE file = '$file'";
$insr = mysqli_query($connect, $selr);
$countr = mysqli_num_rows($insr);
if ($countr > 0) { 
$msg = "<div class='text-danger p-3 font-weight-bold rounded mb-3 text-center'>File name is already existing. Consider changing the file's name</div>";

} 
elseif ($type != "zip" && $type != "docx" && $type != "doc" && $type != "pdf" && $type != "pptx" && $type != ".xlsx") {
$msg = "<div class='text-danger p-3 font-weight-bold rounded mb-3 text-center'>File type must be either zip, pdf, microsoft word file, powerpoint file or excel file.</div>";
				 	
}
elseif ($_FILES["file"]["size"] > 2000000) {
								// 2mb
$msg = "<div class='text-danger p-3 font-weight-bold rounded mb-3 text-center'>File size is larger than 2mb</div>";
}
elseif ($project == "Select Project Type" ) {
$msg = "<div class='text-danger p-3 font-weight-bold rounded mb-3 text-center'>Select Your Project Type</div>";
}

else{

$sql = "INSERT INTO submissions(name, class, project, file, comments, date) VALUES('$id', '$class', '$project', '$file', '$comments', '$time')";
$query = mysqli_query($connect, $sql);
move_uploaded_file($tmp, "submission_folder/$file");

if ($query) {


 header('location: projects');
                        
}
else{
    $msg = "<div class='alert-primary p-2 font-weight-bold rounded mb-3 text-center'>Error</div>";
				 	}
				 }
			}
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'inc/link.php'; ?>
	<title>Submission Page | Fidelity Portal</title>
</head>
	<?php include 'inc/sidebar.php'; ?>
	
			
	<h6>
		<div class="text-center p-2 bg-white">
		 <div id="typed-strings">
	  <span>Asalam Alaekun</span>\
	  <p>Submit Your Projects Here</p>
		  <p style="font-size: 10px">File type must be either zip, pdf,  microsoft<br> word file, powerpoint file or excel file</p>
	 <p>It must be less than 2mb</p>
		 <p>Wishing You Success!</p>
	 <span>Asalam Alaekun</span>\
	  <p>Submit Your Projects Here</p>
	  <p style="font-size: 10px">File type must be either zip, pdf,  microsoft<br> word file, powerpoint file or excel file</p>
	 <p>It must be less than 2mb</p>
	 <p>Wishing You Success!</p>
	 <span>Asalam Alaekun</span>\
	  <p>Submit Your Projects Here</p>
	  <p style="font-size: 10px">File type must be either zip, pdf,  microsoft<br> word file, powerpoint file or excel file</p>
	 <p>It must be less than 2mb</p>
	 <p>Wishing You Success!</p>
	 <span>Asalam Alaekun</span>\
	  <p>Submit Your Projects Here</p>
	  <p style="font-size: 10px">File type must be either zip, pdf,   microsoft<br> word file, powerpoint file or excel file</p>
	 <p>It must be less than 2mb</p>
	 <p>Wishing You Success!</p>
	</div>
	<span id="typed" style="white-space:pre;"></span>
		</div>
	</h6>
	<div class=" ">

	<?php echo $msg; ?>
	<form method="post" enctype="multipart/form-data" class="p-2">


<label class="font-weight-bold mt-3">Project Type</label>
<div class="form-group">
<select name="project" class="form-control">
<option selected="selected">Select Project Type</option>
<?php  
$sql = "SELECT * FROM projects WHERE status = 1";
$query = mysqli_query($connect, $sql);
$counter = mysqli_num_rows($query);
if ($counter > 0) {
   

?>
<?php 
while ($rw = mysqli_fetch_array($query)) {
   

 ?>	
<option value="<?php echo $rw['id']; ?>"><?php echo $rw['project']; ?> <i class="small">(<?php echo $rw['code']; ?>)</i></option>
<?php }} 
else{


?>

<option>You have not been authorized to submit any project. Contact Your Instructor.</option>
<?php } ?>								
</select>
</div>

					<label class="font-weight-bold mt-3">File<i class="small">(Not larger than 2mb)</i></label>
						<div class="form-group">
							<input type="file" required="required" name="file" accept=".zip,.docx,.doc,.pdf,.xlsx,.pptx" class="form-control" >
				
					</div>

					<label class="font-weight-bold mt-3"> Comments</label>
						<div class="form-group">
							<textarea name="comments" class="form-control" placeholder="Make Your Comments"><?php echo $comments; ?></textarea>
						</div>


						 <button type="<?php if ($counter > 0) {echo "submit";}else{echo "button";} ?>" name="submit" class="btn btn-primary w-100 mt-2">Submit Now</button>

			</form>
		</div>
	

	<?php include 'inc/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
  <script src="lib/typed.js" type="text/javascript"></script>
  <script src="assets/demos.js"></script>