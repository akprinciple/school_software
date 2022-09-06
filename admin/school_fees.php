<?php
include 'inc/session.php';
ob_start();
$msg = "";
if (isset($_POST['submit'])) {
    $description = mysqli_real_escape_string($connect, $_POST['description']);
   	$date = date('Y-m-d');

    $ins = "INSERT INTO fees_reminder (date, description) VALUES ('$date', '$description')";
 	$ins_query = mysqli_query($connect, $ins);
 	if ($ins_query) {
 		$msg = "<div class='text-center text-success p-2'>Reminder Successfully Added.</div>";
 	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>School Fees Reminder | Fidelity Schools</title>
	
	<?php include 'inc/link.php'; ?>
	

</head>
<body>
<div class="">
<div class="row ml-0 mr-0">
<!---------------- Sidebar  --------------->
<?php include 'inc/sidebar.php'; ?>
<div class="col-md-10 ">
<h4 class="ml-3 mt-3">School Fees Reminder</h4>
<?php 
include 'inc/hr.php';
?>
<div class="mt-3 ">
<!---------------- Search by class and term  --------------->

<form>

	<div class="form-group col-md-9 border-right mx-auto rounded border p-2">
	<label class="font-weight-bold">Search by Date</label>
	<br>
	<input type="date" name="date" class="form-control" required="required" id="" <?php if(isset($_GET['date'])){
		echo "value=".'"'.$_GET["date"].'"';} ?>>
	
<div class="col-md-2">
	<button type="search" name="submit" class="btn btn-success rounded w-100 mt-3">Search</button>
</div>
</div>
</form>
<div class="col-md-12">
<?php echo $msg; ?>
</div>

<div class="col-md-12 mb-2"  style="">
<!-- Refresh Button -->
<a href="school_fees" class="btn btn-danger fas fa-expand-arrows-alt mx-1 float-right"></a>
   <!-- Add Button -->
<button type="button" class="btn btn-success float-right fas fa-plus" title="Add School Reminder" id="click"></button>
<div class="clearfix"> </div>

<!---------------- To insert Reminder  --------------->
<div class="col-md-10 m-auto " style="display: none" id="reg">
	<form action="" method="post" enctype="multipart/form-data">
    <h4 class="text-center mb-0">Add School fees reminder</h4>
    <hr class="bg-success">
    
    <!-- Description -->
    <label for="area" class="font-weight-bold">Description</label>
    <textarea name="description" id="area"  rows="10" class="form-control"></textarea>

    <button type="submit" name="submit" class="btn btn-success float-right my-2 btn-lg">Add</button>
    <div class="clearfix"></div>
    </form>
</div>
</div>
<?php
	if (isset($_GET['date'])) {
	 	$date = $_GET['date'];
		
		$sel = mysqli_query($connect, "SELECT * FROM fees_reminder WHERE date = '{$date}' ORDER BY id DESC");
		}else{

		$sel = mysqli_query($connect, "SELECT * FROM fees_reminder ORDER BY id DESC LIMIT 5");
		}
		$count = mysqli_num_rows($sel);
		$n = 1; 
	?>


	
</div>


<!-- Reminder Display -->
<?php
	if ($count > 0) {
	foreach ($sel as $key) {
		
	
 ?>
 	<div class="p-2 border rounded border-success mb-2">
 		<span class="rounded-circle bg-success text-light p-2 my-2"><?php  echo $n++; ?></span>
         <span>
         	<b>Date:</b> <?php  echo $key['date']; ?>
         </span>
         <!-- Delete button -->
         <span class="btn btn-danger fas fa-trash-alt float-right" title="Delete Reminder" id="del<?php echo $key['id']; ?>"></span>
         <!-- Print Button -->
         <a href="print_reminder?print_id=<?php echo $key['id']; ?>" class="float-right" title="print preview"> 
		 <button class="btn-warning text-light btn fas fa-print mx-1"></button></a>
         <!-- Edit button -->
         <span class="btn btn-primary fas fa-pen float-right" title="Edit Reminder" id="update<?php echo $key['id']; ?>"></span>
         <!-- Description -->
         <p>
         <?php echo $key['description']; ?>
         </p>
         <span>Kindly ignore if you have balanced up your payment.</b></span>
 	</div>
 	
 <?php }}else{
 	echo "<h1 class='text-center text-success'>Nothing to display</h1>";
 } ?>
</div>
</div>
</div>
<!-- Edit Section -->
<?php 
	
	 $p = 1; 
	// $sel = mysqli_query($connect, "SELECT * FROM fees_reminder WHERE class ='{$class}' && date = '{$date}'");
	foreach ($sel as $key) {
		$id = $key['id'];
		?>
<div id="fetcher<?php echo $key['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
	<div class="col-md-8 m-auto p-5 shadow">
		<span id="clearer<?php echo $key['id']; ?>" class="fas fa-times text-light p-2 rounded-circle mb-2 float-right bg-danger"></span>
		<div class="clearfix"></div>
		<h5 class="text-light mb-0">School fees reminder of <?php echo $_GET['date']; ?></h5>
		<hr class="mt-0 bg-light">
		<form method="post" enctype="multipart/form-data">
        
        <div class="col-md-12">
        <label class="font-weight-bold text-light mb-0">Description</label>
        
        <textarea class="form-control" rows="7" id="text" name="description<?php echo $key['id']; ?>">
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

           
            $description = $_POST['description'.$id];
            
            $ind_sql = "UPDATE fees_reminder SET description = '{$description}' WHERE id = '{$key["id"]}'";
			$ind_query = mysqli_query($connect, $ind_sql);
			if ($ind_query) {
				if (isset($_GET['date'])) {
					
				header('location: school_fees?date='.$date);
				}
				else{
					header('location: school_fees');
				}

			}

        }
    }




 ?>


  <!---------------- Modal Deleting Reminder ------------->

<?php 
 
foreach ($sel as $use) {
   $id = $use['id'];
   ?>
<div id="fetch<?php echo $use['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">Are you sure you want to this reminder permanently?
	
		<!-- Delete Button  -->
<a href="delete?del_reminder=<?php echo $use['id']; ?>"><button class="btn-success btn">Yes</button></a>
	
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
<?php } ?>
</body>
</html>

<script src='../tinymce/js/tinymce/tinymce.min.js'></script>
<script type="text/javascript">
	
tinymce.init({
    selector: '#area, #text',
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