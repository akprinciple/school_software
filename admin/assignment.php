<?php
include 'inc/session.php';
ob_start();
$msg = "";
if (isset($_POST['submit'])) {
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $subject = mysqli_real_escape_string($connect, $_POST['subject']);
    $submission_date = mysqli_real_escape_string($connect, $_POST['submission_date']);
    $date = $_GET['date'];
    $class = $_GET['class'];

    $ins = "INSERT INTO assignment (date, class, submission_date, description, subject) VALUES ('$date', '$class', '$submission_date', '$description', '$subject')";
 	$ins_query = mysqli_query($connect, $ins);
 	if ($ins_query) {
 		$msg = "<div class='text-center text-success p-2'>Assignment Successfully Added.</div>";
 	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Assignments | Fidelity Schools</title>
	
	<?php include 'inc/link.php'; ?>
	

</head>
<body>
<div class="">
<div class="row ml-0 mr-0">
<!---------------- Sidebar  --------------->
<?php include 'inc/sidebar.php'; ?>
<div class="col-md-10 ">
<h4 class="ml-3 mt-3">Assignments</h4>
<?php 
include 'inc/hr.php';
?>
<div class="mt-3 row">
<!---------------- Search by class and term  --------------->

<form class="col-md-12 row border-right mx-0">

	<div class="form-group col-md-5 p-2">
	<label class="font-weight-bold">Date</label>
	<br>
	<input type="date" name="date" class="form-control" required="required" id="" <?php if(isset($_GET['date'])){
		echo "value=".'"'.$_GET["date"].'"';} ?>>
	</div>


	<div class="form-group col-md-5 p-2">
	<label class="font-weight-bold">Class</label>
	<br>
	<select class="form-control" name="class">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['date'])) {
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



	
<div class="col-md-2">
	<div class="p-2"></div>
	<button type="search" name="submit" class="btn btn-success rounded w-100 mt-3">Search</button>
</div>
</form>
<div class="col-md-12">
<?php echo $msg; ?>
</div>
<?php
	if (isset($_GET['class']) && isset($_GET['date'])) {
	 	$class = (int)$_GET['class'];
	 	$date = $_GET['date'];
	
	 	
	 $n = 1; 
	$sel = mysqli_query($connect, "SELECT * FROM assignment WHERE class ='{$class}' && date = '{$date}' ORDER BY id DESC");
	$count = mysqli_num_rows($sel);
	?>
<div class="col-md-12"  style="display: <?php if($count < 1){echo "none";} ?>">
<!-- PRINT pREVIEW -->
<a href="print_assignment?class=<?php echo $_GET['class']; ?>&&date=<?php echo $_GET['date']; ?>" class="float-right mx-1" title="print preview">
<button class="btn-danger btn fas fa-print"></button></a>
   <!-- Add Button -->
<button type="button" class="btn btn-primary float-right fas fa-plus" title="Add Assignment" id="click"></button>
<div class="clearfix"> </div>
</div>
<!---------------- To insert Assignment  --------------->
<div class="col-md-10 m-auto " style="display: <?php if($count > 0){echo "none";} ?>" id="reg">
	<form action="" method="post" enctype="multipart/form-data">
    <h4 class="text-center mb-0">Add Assigment</h4>
    <hr class="bg-success">
    <div class="row mx-0">
    <div class="form-group col-md-6 p-2">
	<label class="font-weight-bold">Subject</label>
	<br>
	<select class="form-control" name="subject">
	<option value="1">Select Subject</option>
	<?php 
	$sql = "SELECT * FROM subjects ORDER BY subject ASC";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
	
	 ?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['subjectcode']; ?></option>
	<?php } ?>
	</select>
	</div>
    <!-- Submission Date -->
    <div class="form-group col-md-6 p-2">
	<label class="font-weight-bold">Submission Date</label>
	<br>
	<input type="date" name="submission_date" class="form-control" required="required" id="">
	</div>
    </div>
    <!-- Description -->
    <label for="area" class="font-weight-bold">Description</label>
    <textarea name="description" id="area"  rows="10" class="form-control"></textarea>

    <button type="submit" name="submit" class="btn btn-success float-right my-2 btn-lg">Add</button>
    <div class="clearfix"></div>
    </form>
</div>
	
</div>


<!-- Assignment Display -->
<?php
	if ($count > 0) {
        # code...
    
	?>
		<div class="row rounded mx-0">
			<div class="w-50 p-2 bg-success text-center text-light shadow">
				<?php echo $date; ?>
			</div>
			<div class="w-50 p-2 bg-light text-center text-dark shadow">
				<?php 
	$sql = "SELECT * FROM class WHERE id = '{$_GET['class']}'";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		echo $row['class'];	
	 
	 }
	 ?>
			</div>

		</div>

	<?php
	foreach ($sel as $key) {
		
	
 ?>
 	<div class="p-2 border rounded border-success mb-2">
 		<span class="rounded-circle bg-success text-light p-2 my-2"><?php  echo $n++; ?></span>
         <b> <?php 
         $sel_subject = mysqli_query($connect, "SELECT subject FROM subjects WHERE id = '{$key['subject']}'");
         foreach ($sel_subject as $sub)
         echo $sub['subject']; 
         
         ?></b>
         <!-- Delete button -->
         <span class="btn btn-danger fas fa-trash-alt float-right" title="Delete Assignment" id="del<?php echo $key['id']; ?>"></span>
         <!-- Edit button -->
         <span class="btn btn-primary fas fa-pen float-right mx-1" title="Edit Assignment" id="update<?php echo $key['id']; ?>"></span>
         <p>
         <?php echo $key['description']; ?>
         </p>
         <span>To be submitted on or before <b><?php echo $key['submission_date']; ?></b></span>
 	</div>
 	
 <?php }} ?>
</div>
</div>
</div>
<?php 
	if (isset($_GET['class']) && isset($_GET['date'])) {
	 	$class = (int)$_GET['class'];
	 	$date = $_GET['date'];
	 $n = 1; 
	$sel = mysqli_query($connect, "SELECT * FROM assignment WHERE class ='{$class}' && date = '{$date}'");
	foreach ($sel as $key) {
		$id = $key['id'];
		?>
<div id="fetcher<?php echo $key['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
	<div class="col-md-8 m-auto p-5 shadow">
		<span id="clearer<?php echo $key['id']; ?>" class="fas fa-times text-light p-2 rounded-circle mb-2 float-right bg-danger"></span>
		<div class="clearfix"></div>
		<h5 class="text-light mb-0">Assignment of <?php echo $_GET['date']; ?></h5>
		<hr class="mt-0 bg-light">
		<form method="post" enctype="multipart/form-data">
        <div class="row form-group mx-0">
        <div class="col-md-6">
        <label class="font-weight-bold text-light mb-0">Subject</label>
		<input type="text" readonly name="" id="" class="form-control text-center mb-2" value="<?php echo $key['subject']; ?>" >
		</div>
        <div class="col-md-6">
        <label class="font-weight-bold text-light mb-0">Submission Date</label>
		<input type="date" name="s_date<?php echo $key['id']; ?>" id="" class="form-control text-center mb-2" value="<?php echo $key['submission_date']; ?>">
		</div>
        </div>
        <div class="col-md-12">
        <label class="font-weight-bold text-light mb-0">Description</label>
        
        <textarea class="form-control" rows="7" id="" name="description<?php echo $key['id']; ?>">
		<?php echo $key['description']; ?>
		</textarea>
	<button type="submit" name="update<?php echo $key['id']; ?>" class="btn btn-success float-right my-2">Update</button>
	<div class="clearfix"></div>
	</div>
	</form>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $("#update<?php echo $key['id']; ?>").click(function(){
  $("#fetcher<?php echo $key['id']; ?>").toggle("slow");
  })
  $("#clearer<?php echo $key['id']; ?>").click(function(){
  $("#fetcher<?php echo $key['id']; ?>").hide("slow"); 
})
})                     
</script>
		<?php
        $id = $key['id'];
        if (isset($_POST['update'.$id])) {

            $s_date = $_POST['s_date'.$id];
            $description = $_POST['description'.$id];
            
            $ind_sql = "UPDATE assignment SET submission_date = '{$s_date}', description = '{$description}' WHERE id = '{$key["id"]}'";
			$ind_query = mysqli_query($connect, $ind_sql);
			if ($ind_query) {
				header('location: assignment?date='.$date.'&&class='.$class.'');

			}

        }
    }
}



 ?>


  <!---------------- Modal Deleting Assignment ------------->

<?php 
if (isset($_GET['class']) && isset($_GET['date'])) {
    $class = (int)$_GET['class'];
    $date = $_GET['date'];
$n = 1; 
$sel = mysqli_query($connect, "SELECT * FROM assignment WHERE class ='{$class}' && date = '{$date}'");
foreach ($sel as $use) {
   $id = $use['id'];
   ?>
<div id="fetch<?php echo $use['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">Are you sure you want to <b class="text-danger"> DELETE</b> 
	<b>
	<?php 
	$c_sql = "SELECT * FROM class WHERE id = '{$use["class"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['class'];
	 }  
	?>  	
	</b>
	<b>
	<?php 
	$c_sql = "SELECT * FROM subjects WHERE id = '{$use["subject"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['subject'];
	 }  
	?>  	
	</b>
	asssignment 
    for the 
	<b>
	<?php 
	echo $date; 
	?> 
	</b>
	
	permanently?
	
		<!-- Delete Button  -->
<a href="delete?del_assignment=<?php echo $use['id']; ?>&class=<?php echo $_GET['class']; ?>&date=<?php echo $_GET['date']; ?>"><button class="btn-success btn">Yes</button></a>
	
<span id="clear<?php echo $use['id']; ?>"><button class="btn-danger btn">No</button></span>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $("#del<?php echo $use['id']; ?>").click(function(){
  $("#fetch<?php echo $use['id']; ?>").toggle("slow");
  })
  $("#clear<?php echo $use['id']; ?>").click(function(){
  $("#fetch<?php echo $use['id']; ?>").hide("slow"); 
})
})                     
</script>
<?php }}} ?>
</body>
</html>

<script src='../tinymce/js/tinymce/tinymce.min.js'></script>
<script type="text/javascript">
	
tinymce.init({
    selector: '#area',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
    link_list: [
        { title: 'My page 1', value: 'https://www.codexworld.com' },
        { title: 'My page 2', value: 'https://www.xwebtools.com' }
    ],
    image_list: [
        { title: 'My page 1', value: 'https://www.codexworld.com' },
        { title: 'My page 2', value: 'https://www.xwebtools.com' }
    ],
    image_class_list: [
        { title: 'None', value: '' },
        { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,
    file_picker_callback: function (callback, value, meta) {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
        }
    
        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
        }
    
        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
            callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
        }
    },
    templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 250,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: 'sliding',
    contextmenu: "link image imagetools table",
});
</script>