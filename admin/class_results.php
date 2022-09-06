<?php 
ob_start();
include 'inc/session.php';
$msg = "";

?>

<!DOCTYPE html>
<html>

<head>
    <title>View Class Results | Fidelity Schools</title>

    <?php include 'inc/link.php'; ?>
   

</head>

<body>
    <div class="">
        <div class="row ml-0 mr-0">
            <!---------------- Sidebar  --------------->
            <?php include 'inc/sidebar.php'; ?>
            <div class="col-md-10">
                <h4 class="ml-3 mt-3">Class Results</h4>
                <?php 
include 'inc/hr.php';
?>
                <div class="mt-3 ">
                    <!---------------- Search by class and term  --------------->

                    <form class=" row mx-0">

                        


<div class="form-group col-md-6 py-0">
    <label class="font-weight-bold">Class</label>
    <br>
    <select class="form-control" name="class">
    <?php 
    if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['subject']) && !isset($_GET['session'])) {
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



<div class="form-group col-md-6 py-0">
    <label class="font-weight-bold">Session</label>
    <br>
    <select class="form-control" name="session">
    <?php 
    if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['subject']) && !isset($_GET['session'])) {
    echo "<option value='1'>Select Session</option>";
    }

    else {
    $t = $_GET['session'];
    $sq = "SELECT * FROM session WHERE id = '{$t}'";
    $quer = mysqli_query($connect, $sq);
    while ($rw = mysqli_fetch_array($quer)) {
    $tm = $rw['session'];
    echo "<option value='$t'>$tm</option>";
    }} 
    ?>
    ?>
    <?php 
    $sql = "SELECT * FROM session";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {


    ?>
    <option value="<?php echo $row['id']; ?>"><?php echo $row['session']; ?></option>
    <?php } ?>
    </select>
</div>

<div class="form-group col-md-6 py-0">
    <label class="font-weight-bold">Term</label>
    <br>
    <select class="form-control" name="term">

    <?php
    // Code to show that the search inputs that are showing in the input box
    if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['subject']) && !isset($_GET['session'])) {
    echo "<option value='1'>Select Term</option>";
    }

    else {
    $t = $_GET['term'];
    $sq = "SELECT * FROM term WHERE id = '{$t}'";
    $quer = mysqli_query($connect, $sq);
    while ($rw = mysqli_fetch_array($quer)) {
    $tm = $rw['term'];
    echo "<option value='$t'>$tm</option>";
    }} 
    ?>


    <?php 
    // Code to fetch the terms
    $sql = "SELECT * FROM term";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {


    ?>
    <option value="<?php echo $row['id']; ?>"><?php echo $row['term']; ?></option>
    <?php } ?>
    </select>
</div>
<div class="col-md-6 py-0">
   <div class="p-2"></div>
    <button type="search" name="submit" class="btn btn-success rounded w-100 mt-3">Search</button>
</div>
 </form>

  <?php 
if (!isset($_GET['class']) && !isset($_GET['term'])  && !isset($_GET['session'])) {

    ?>
<span class=" float-right">                
<!-- Import Button -->
  <a href="javascript:void(0)" onclick="import_csv()" class="pointer btn btn-warning text-light fas fa-file-import " title="Import CSV file"></a>
  <!-- Refresh Button -->
<a href="class_results" class="btn btn-danger mb-1 fas fa-expand-arrows-alt"
                    title="Refresh Page"></a>
</span> 
<div class="clearfix"></div>
<?php } ?>

<?php
            if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Scores has been imported successfully.';
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
                <h5 class="text-center font-weight-bold border-bottom">Import Scores</h5>
               
                <form method="post" action="import/import_scores.php" enctype="multipart/form-data">
                  
                  
                  
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


                <!-- Search by class, term and Session -->
                <?php 
if (isset($_GET['class']) && isset($_GET['term'])  && isset($_GET['session'])) {
		$session = $_GET['session'];
		$class = $_GET['class'];
		
		$term = $_GET['term'];

	$select = "SELECT * FROM mid_term_results WHERE class ='{$class}'  && session = '{$session}' && term = '{$term}' ORDER BY (SELECT name FROM register WHERE id = student_id) ASC";
	$show = mysqli_query($connect, $select);

	$count = mysqli_num_rows($show);
	
	?>

                <!-- Display of insert form for Scores When Result is Zero -->
                <h3 class="display-4 text-center mt-3">
                    <?php 
	$c_sql = "SELECT * FROM class WHERE id = '{$class}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['class'];
	 } 
	?>
                </h3>
                <span class="float-right">
                 <!-- Button Export as CSV -->
                <a href="export/export_results?class=<?php echo $class; ?>&session=<?php echo $session; ?>&term=<?php echo $term; ?>"
                            class="btn btn-primary text-light  mb-1 fas fa-file-excel"
                            title="Export as Csv"></a>
                <!-- Import Button -->
                <a href="javascript:void(0)" onclick="import_csv()" class="pointer btn btn-warning text-light fas fa-file-import " title="Import CSV file"></a>
                <!-- Refresh Button -->
                <a href="class_results" class="btn btn-danger  mb-1 fas fa-expand-arrows-alt"
                    title="Refresh Page"></a>
                    
                </span>
                <div class="clearfix"></div>

                <div class="text-center mx-0">
                   
                        <div class="float-left w-50 shadow bg-success text-light p-2 font-weight-bold mb-3">

<?php 
    $c_sql = "SELECT * FROM session WHERE id = '{$session}'";
    $c_query = mysqli_query($connect, $c_sql);
    while ($clas = mysqli_fetch_array($c_query)) {
    echo $clas['session'];
    } 
?>
                    </div>
                        <!---------------- Term Display  --------------->
                        <div class="float-right w-50 bg-white text-dark p-2 font-weight-bold shadow mb-3">
                            <?php

	$c_sql = "SELECT * FROM term WHERE id = '{$term}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($ter = mysqli_fetch_array($c_query)) {
	 	echo $ter['term'];
	 } 
	?> Term
                       
                    </div>
                    
                </div>
              
                    <!---------------- Add New Student and Refresh Section  ---------------> 
                        <form method="post" enctype="multipart/form-data">
                            <table class="table-bordered table-hover table col-md-12 text-center mx-auto mb-3"
                                style="overflow-x: auto; min-width: 100%;">
                                <thead class="">
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Weekly Tests(20)</th>
                                    <th>Midterm Test(20)</th>
                                    <th>Total CA (40)</th>
                                    <th>Exam(60)</th>
                                    <th>Total (100)</th>
                                </thead>
                                <tbody>
                                    <?php 

	$n =1;
// Row to Update found results for search by class and term
while($report = mysqli_fetch_array($show)) { 
	$id = $report['id'];
?>
        <tr>
            <td><?php echo $n++; ?></td>
            <td>
 <?php 
	$c_sql = "SELECT * FROM register WHERE id = '{$report["student_id"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($name = mysqli_fetch_array($c_query)) {
        echo $name['name'];
     } 
    
    ?>
        </td>

        <td>
            <?php 
    $c_sql = "SELECT * FROM subjects WHERE id = '{$report["subject"]}'";
    $c_query = mysqli_query($connect, $c_sql);
    while ($name = mysqli_fetch_array($c_query)) {
        echo $name['subjectcode'];
     } 
    
    ?>
        </td>

        <td>
            <!-- Weekly Test -->
            <?php echo $report['test2']; ?>

        </td>
        <td>
            <!-- Midterm Test -->
            <?php echo $report['test']; ?>

        </td>
        <td>
            <?php echo $report['test'] + $report['test2']; ?>
        </td>
        <td>
            <?php echo $report['exam']; ?>

        </td>
        <td>
            <?php echo $report['test'] + $report['test2'] + $report['exam']; ?>

        </td>

    </tr>
                                    <?php }}?>
    </tbody>
</table>
</form>
</body>

</html>
<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="js/java.js"></script> -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>