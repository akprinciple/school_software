<?php  
$msg = "";
	include 'inc/session.php';
	if (isset($_POST['submit'])) {
$project = mysqli_real_escape_string($connect, $_POST['project']);
$code = mysqli_real_escape_string($connect, $_POST['code']);
$date = date('d/M/Y');
$sel = "SELECT * FROM projects WHERE code = '{$code}'";
			$selt = mysqli_query($connect, $sel);
			$count = mysqli_num_rows($selt);
			if ($count > 0) {
				$msg = "<div class='p-2 rounded text-center'>Project Code is already existing</div>";
			}
			else{
			$sql = "INSERT INTO projects (project, code, date) VALUES ('$project', '$code', '$date')";
			$query = mysqli_query($connect, $sql);
			if ($query) {
				$msg = "<div class='p-2 rounded text-center'>Project Added Successfully</div>";
			}
			else{
				$msg = "<div class='p-2 rounded text-center'>Error!</div>";
			}
		}
		}
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Weekly Test Results | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>
    <style>
        tr, td, th{
            border: 1px solid green;
        }
        td, th{
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="row ml-0 mr-0">
<!---------------- Sidebar  --------------->
<?php include 'inc/sidebar.php'; ?>
<div class="col-md-10 ">
<h4 class="ml-3 mt-3">View Weekly Test Results</h4>
<?php 
include 'inc/hr.php';

?>
<!-- <span class="float-right mb-3 bot-left p-2 bg-white"> -->
<!-- <a id="click" class="pointer text-success fas fa-plus mr-2" title="Add Project"></a>  -->
<!-- <span class="">/</span> -->
<!-- <a href="projects.php" class="text-success fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span>	
<div class="clearfix"></div> -->
<?php echo $msg; ?>
<div class="row mx-0">
<form class="col-md-8 row border-right mx-0">

	
	


	<div class="form-group col-md-6 p-1">
	<label class="font-weight-bold">Class</label>
	<br>
	<select class="form-control" name="class">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['week']) && !isset($_GET['session'])) {
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

<div class="form-group col-md-6 p-1">
	<label class="font-weight-bold">week</label>
	<br>
	<select class="form-control" name="week">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['term'])  && !isset($_GET['week']) && !isset($_GET['session'])) {
	 	echo "<option value='1'>Select week</option>";
	}
	
	else {
	$t = $_GET['week'];
	$sq = "SELECT * FROM weeks WHERE id = '{$t}'";
	$quer = mysqli_query($connect, $sq);
	while ($rw = mysqli_fetch_array($quer)) {
		$tm = $rw['week'];
		echo "<option value='$t'>$tm</option>";
	 }} 
	?>
	?>
	<?php 
	$sql = "SELECT * FROM weeks";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
	
	 ?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['week']; ?></option>
	<?php } ?>
	</select>
	</div>

	<div class="form-group col-md-6 p-1">
	<label class="font-weight-bold">Session</label>
	<br>
	<select class="form-control" name="session">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['week']) && !isset($_GET['session'])) {
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

	<div class="form-group col-md-6 p-1">
	<label class="font-weight-bold">Term</label>
	<br>
	<select class="form-control" name="term">
	
	<?php
	// Code to show that the search inputs are showing in the input box
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['week']) && !isset($_GET['session'])) {
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
<div class="col-md-6"></div>
<div class="col-md-6">
	
	<button type="search" name="submit" class="btn btn-success d-block rounded w-100">Search</button>
</div>
</form>


	<div class="col-md-4 form-group p-2">
	<form>
	<label class="font-weight-bold">Search by keyword</label>
	<br>
	<input type="search" required="required" name="search" placeholder="Search By keyword" class="form-control" value="<?php if (isset($_GET['search'])) {
	echo $_GET['search']; } ?>" 
	>
	<button class="btn btn-success rounded mt-1 float-right">Search</button>		
	</form>
	</div>
</div>



<?php 
if (isset($_GET['class']) && isset($_GET['term']) && isset($_GET['week']) && isset($_GET['session'])) {
		$session = $_GET['session'];
		$class = $_GET['class'];
		$week = $_GET['week'];
		$term = $_GET['term'];

	$select = "SELECT DISTINCT student_id FROM scores WHERE class ='{$class}' && week = '{$week}'  && session = '{$session}'  && term = '{$term}'";
	$show = mysqli_query($connect, $select);

	$count = mysqli_num_rows($show);


?>

<a href="all_results?class=<?php echo $class; ?>&week=<?php echo $week; ?>&session=<?php echo $session; ?>&term=<?php echo $term; ?>"><button class="btn btn-danger float-right">Print All</button></a>
<div class="clearfix"></div>
<div class="row  text-center mx-0 mt-3 mb-n3">
 <div class="col-md-6 my-0 p-0">
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
<div class="col-md-6 my-0 p-0">
	<div class="float-left w-50 shadow bg-white txt-light p-2 font-weight-bold mb-3">
	<!-- Class: -->
	<?php 
	$c_sql = "SELECT * FROM class WHERE id = '{$class}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['class'];
	 } 
	?>
</div>
<div class="float-left w-50 shadow bg-success text-light p-2 font-weight-bold mb-3">
	
	<?php 
	$c_sql = "SELECT * FROM weeks WHERE id = '{$week}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['week'];
	 } 
	?>
</div>
</div>
</div>
<table class="table-bordered table-hover table col-md-12 text-center m-auto" style="overflow-x: auto; min-width: 100%;">
<thead class="">
	<th>S/N</th>
	<th>Name</th>
	
	
	<th>Actions</th>
</thead>
<tbody>
<?php 

	$n =1;
// Row to Update found results for search by class and term
while($report = mysqli_fetch_array($show)) { 
	#$id = $report['id'];
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
    <span id="up<?php echo $report['student_id']; ?>" title="View results" class="pointer text-success">
	 		<button class="btn btn-danger fas fa-eye "></button>
		</span>
	</td>
</tr>
<?php }} ?>


</tbody>
</table>
</div>

</div>




<!-- Print Preview -->
 <?php 
 if (isset($_GET['class']) && isset($_GET['term']) && isset($_GET['week']) && isset($_GET['session'])) {
		$session = $_GET['session'];
		$class = $_GET['class'];
		$week = $_GET['week'];
		$term = $_GET['term'];

        $u_sql = "SELECT DISTINCT student_id FROM scores WHERE class ='{$class}'   && session = '{$session}'  && term = '{$term}' && week = '{$week}' ORDER BY id DESC";
        $u_query = mysqli_query($connect, $u_sql);
        $n = 1;
        while ($user = mysqli_fetch_array($u_query)) {
        ?>
        <div id="update<?php echo $user['student_id']; ?>" class="w-100 position-absolute position-fixe bg-white" style="background-color: rgba(0,0,0,0.1); min-height: 100%; top: 0; z-index: 2; overflow: auto; display : none;">
        
            <div class="col-md-11 m-auto p-3" style=" border: 5px dashed green;">
                <div class="row mx-0 col-md-11 m-auto">
                <img src="../images/fidelity heading.jpg" style="width: 100%">
                
                <div style="width: 84%">
                
                </div>
                </div>
                <p class="w-75 mx-auto my-3  row text-uppercase">
                <b class="d-block" style="width: 5%"> Name:</b> 
                    <span class=" text-center font-weight-bold d-block" style="border-bottom: 1px solid green; width:89%;">
                    <?php 
            $c_sql = "SELECT * FROM register WHERE id = '{$user["student_id"]}'";
            $c_query = mysqli_query($connect, $c_sql);
            while ($name = mysqli_fetch_array($c_query)) {
                 echo $name['name'];
             } 
            
            ?>
                
            </span>
        </p>
            <div class="row mx-0 mt-3">
            <!-- Left Heading Section -->
            <div class="w-50">
            <p class="mx-0 row">
             <b class="" style="width: 10%">Class :</b>
                    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%">
                        <?php 
            $c_sql = "SELECT * FROM class WHERE id = '{$class}'";
            $c_query = mysqli_query($connect, $c_sql);
            while ($clas = mysqli_fetch_array($c_query)) {
                 echo $clas['class'];
             } 
            ?>
            
                    </span>
            </p>
            <p class="mx-0 row">
             <b class="" style="width: 10%">Term :</b>
                    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%">
                <?php
        
                    $c_sql = "SELECT * FROM term WHERE id = '{$term}'";
                    $c_query = mysqli_query($connect, $c_sql);
                    while ($ter = mysqli_fetch_array($c_query)) {
                    echo $ter['term'];
                    } 
                ?>
                    </span>
            </p>
           
            <p class="mx-0 row">
             <b class="" style="width: 10%">Week :</b>
                    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%">
                <?php
        
                    $c_sql = "SELECT * FROM weeks WHERE id = '{$week}'";
                    $c_query = mysqli_query($connect, $c_sql);
                    while ($ter = mysqli_fetch_array($c_query)) {
                    echo $ter['week'];
                    } 
                ?>
                    </span>
            </p>
                
            </div>
        
            <!-- right Heading Section -->
        
            <div class="w-50">
            <div class="m-0 row "></div>
            
            
            <p class="mx-0 row">
             <b class="" style="width: 10%">Sex :</b>
                    <span class=" text-center font-weight-bold text-capitalize" style="border-bottom: 1px solid green; width: 87%"><?php 
            $c_sql = "SELECT * FROM register WHERE id = '{$user["student_id"]}'";
            $c_query = mysqli_query($connect, $c_sql);
            while ($name = mysqli_fetch_array($c_query)) {
                 echo $name['gender'];
             } 
            
            ?>
                    </span>
            </p>
            <p class="mx-0 row">
             <b class="" style="width: 13%">Session :</b>
                    <span class=" text-center font-weight-bold text-capitalize" style="border-bottom: 1px solid green; width: 87%">
                    <?php 
            $c_sql = "SELECT * FROM session WHERE id = '{$session}'";
            $c_query = mysqli_query($connect, $c_sql);
            while ($clas = mysqli_fetch_array($c_query)) {
                 echo $clas['session'];
             } 
            ?>
                    </span>
            </p>
        
            <p class="mx-0 row">
             <b class="" style="width: 18%">No in Class :</b>
                    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 82%">
                        <?php 
            
            $every = mysqli_query($connect, "SELECT * FROM students WHERE class = '{$_GET['class']}' && session = '{$_GET['session']}'");
            echo mysqli_num_rows($every);
        
        ?>
            
            
                    </span>
            </p>
            
        </div>
        
            
        </div>
        
                <div class="">
                    <h4 class="mb-0 text-center">WEEKLY TEST RESULTS</h4>
                    <table  class="w-100 text-center"  style="border: 2px solid green;  font-size: 18px; color: #000;">
                        <thead>
                            <tr class="">
                                <th>S/N</th>
                                <th style="width: 22%;">SUBJECT</th>
                                
                                <th>MARK OBTAINED (40)</th>
                                <th>GRADE</th>
                                
                                
                                <th>SIGNATURE</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
        
                    $sql = "SELECT * FROM scores WHERE student_id = '{$user["student_id"]}' && week = '{$week}' && class ='{$class}'  && session = '{$session}'  && term = '{$term}' ORDER BY subject ASC";
        $query = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($query);
        $n = 1;
                while ($rw = mysqli_fetch_array($query)) {
                    
                
                 ?>	
                 <tr>
                 <td>
                 <?php
                    
                    echo $n++;
                 ?>
                 </td>
                     <td class="font-weight-bold"><?php 
                     
        
            $c_sql = "SELECT * FROM subjects WHERE id = '{$rw['subject']}'";
            $c_query = mysqli_query($connect, $c_sql);
            while ($ter = mysqli_fetch_array($c_query)) {
                 echo $ter['subject'];
             } 
                      $rw['subject']; ?>
                      </td>
                     
                     <td><?php echo $rw['test']; ?></td>
                     
                     
                     <td><?php 
        
                         $total = $rw['test'];
                         if ($total > 34) {
                             echo "A1- Excellent";
                         }elseif ($total > 29 && $total < 35) {
                             echo "B2 - V.Good";
                         }elseif ($total > 24 && $total < 30) {
                             echo "B3 - Good";
                         }elseif ($total > 19 && $total < 25) {
                             echo "C - Average";
                         }elseif ($total > 14 && $total < 20) {
                             echo "C5";
                         }elseif ($total > 9 && $total < 15) {
                             echo "D - Fair";
                         }elseif ($total > 4 && $total < 10) {
                             echo "E - Weak";
                         }else{ echo "F - Fail";}
                          ?></td>
                     <td>
                         <?php  
                             $sig = mysqli_query($connect, "SELECT * FROM subjects WHERE id ='{$rw["subject"]}'");
                             while ($s = mysqli_fetch_array($sig)) {
                                 # code...
                             
                         ?>
                         <!-- <img alt="<?php #echo substr($s['name'], 0, 3) ?>" src="../upload/<?php echo $s['signature'] ?>" width="50px"> -->
                         <s>
                         <?php 
                             $c_sql = "SELECT * FROM subjects WHERE id = '{$rw['subject']}'";
                            $c_query = mysqli_query($connect, $c_sql);
                        while ($ter = mysqli_fetch_array($c_query)) {
                             echo substr($ter['subject'], 1, 3);
                             } 
                          ?>
                         </s>
                     <?php } ?>
                     </td>
                     <!-- <td></td> -->
                 </tr>
                     <?php } ?>
                     
                     
                     
                     
                        </tbody>
                    </table>
        
                    <p class="mx-0 row mt-4">
             <b class="" style="width: 20%">Teacher's Comment :</b>
                    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 80%">
                    </span>
            </p>
            <p class="mx-0 row">
             <b class="" style="width: 70%; border-bottom: 1px solid green;"></b>
             <span style="width: 8%" class="font-weight-bold pl-2">Signature:</span>
                    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 15%">
                    </span>
            </p>
        
            <p class="mx-0 row">
             <b class="" style="width: 16%">Principal's Comment :</b>
                    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 81%">
                    </span>
            </p>
        
                
        
        
            <p class="mx-0 row mt-1">
             <b class="" style="width: 70%; border-bottom: 1px solid green;"></b>
             <span style="width: 8%" class="font-weight-bold pl-2">Signature:</span>
                    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 15%">
                    </span>
            </p>
        
                
            
        </div>
        </div>
        
        <div class=" bg-dark w-100 text-light text-center position-fixed p-2" style="bottom: 0; z-index: 2 ">
            <!-- <button class="btn-success btn">Yes</button> -->
            <button type="button" class="btn btn-success" onclick="print(this)">Print <span class="fas fa-print"></span></button>
            
        
        <span>
            <button id="clear<?php echo $user['student_id']; ?>" class="btn-danger btn">Cancel</button>
        </span>
        </div>
        </div>
<script type="text/javascript">
$(document).ready(function() {
  $("#up<?php echo $user['student_id']; ?>").click(function(){
  $("#update<?php echo $user['student_id']; ?>").toggle("slow");
  })
  $("#clear<?php echo $user['student_id']; ?>").click(function(){
  $("#update<?php echo $user['student_id']; ?>").toggle("slow"); 
})
})                     
</script>
<?php }} ?>
</body>
</html>


	<script type="text/javascript">
     	var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}
     </script>
