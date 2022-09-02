<?php 
		include 'inc/session.php';
$msg = "";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>View User's Results | Fidelity Schools</title>
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
  
<!-- Print Preview -->
<?php 
 if (isset($_GET['id']) && isset($_GET['class']) && isset($_GET['term']) && isset($_GET['session'])) {
    $session = $_GET['session'];
    $class = $_GET['class'];
    $term = $_GET['term'];
    $id = $_GET['id'];

 $u_sql = "SELECT * FROM mid_term_results WHERE md5(student_id) = '{$id}' &&class ='{$class}' && session = '{$session}'  && term = '{$term}' ORDER BY id DESC";
$u_query = mysqli_query($connect, $u_sql);


$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="update<?php echo $user['student_id']; ?>" class="w-100 position-absolute position-fixe bg-white" style="background-color: #fff; min-height: 100%; top: 0; z-index: 2; overflow: auto;">

<div class="col-md-11 m-auto p-3" style=" border: 5px dashed green;">
  <div class="row mx-0 col-md-11 m-auto">
  <img src="../images/fidelity heading.jpg" style="width: 100%">
  
  <div style="width: 84%">
  
  </div>
  </div>
  <p class="w-75 mx-auto my-3  row text-uppercase"><span> Name:</span> 
    <span class="w-75 text-center font-weight-bold " style="border-bottom: 1px solid green;  font-size: 18px;"><?php 
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
 <span class="" style="width: 10%">Class :</span>
    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%;  font-size: 18px;">
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
 <span class="" style="width: 10%">Term :</span>
    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%;  font-size: 18px;">
      <?php

          $c_sql = "SELECT * FROM term WHERE id = '{$term}'";
          $c_query = mysqli_query($connect, $c_sql);
          while ($ter = mysqli_fetch_array($c_query)) {
          echo $ter['term'];
          } 
      ?>
    </span>
</p>
 
  
</div>

  <!-- right Heading Section -->

<div class="w-50">
<div class="m-0 row "></div>


<p class="mx-0 row">
 <span class="" style="width: 10%">Sex :</span>
    <span class=" text-center font-weight-bold text-capitalize" style="border-bottom: 1px solid green; width: 87%;  font-size: 18px;"><?php 
$c_sql = "SELECT * FROM register WHERE id = '{$user["student_id"]}'";
$c_query = mysqli_query($connect, $c_sql);
while ($name = mysqli_fetch_array($c_query)) {
   echo $name['gender'];
 } 

?>
    </span>
</p>
  <p class="mx-0 row">
 <span class="" style="width: 13%">Session :</span>
    <span class=" text-center font-weight-bold text-capitalize" style="border-bottom: 1px solid green; width: 87%;  font-size: 18px;">
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
 <span class="" style="width: 18%">No in Class :</span>
    <span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 82%;  font-size: 18px;">
      <?php 


 $no_of_std = mysqli_query($connect, "SELECT DISTINCT student_id FROM mid_term_results WHERE  class ='{$class}' && session = '{$session}'  && term = '{$term}'");
echo mysqli_num_rows($no_of_std);
?>


    </span>
</p>

</div>


</div>

<div class="">
			<h4 class="mb-0 text-center">TERMINAL REPORT CARD</h4>
			<table  class="w-100 text-center"  style="border: 2px solid green;  font-size: 18px; color: #000;">
				<thead>
					<tr class="">
						<th rowspan="2">S/N</th>
						<th rowspan="2" style="width: 22%;">SUBJECT</th>
						
						<th colspan="3">MARKS OBTAINED 
						
						</th>
						<th rowspan="2">Total(100)</th>
						<th rowspan="2">GRADE</th>
						
						
						<th rowspan="2">SIGNATURE</th>
						<!-- <th></th> -->
					</tr>
					
					<tr>	
	 				<th>Weekly Tests(20)</th>
					<th>Midterm Test(20)</th>
	 				<th>Exam (60)</th>
	 				</tr>
				</thead>
				<tbody>
					<?php 

			$sql = "SELECT * FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && class ='{$class}'  && session = '{$session}'  && term = '{$term}' && test + exam + test2 > 0 ORDER BY subject ASC";
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
		 	//  $rw['subject']; ?>
              </td>
		 	
		 	<td><?php echo $rw['test2']; ?></td>
		 	<td><?php echo $rw['test']; ?></td>
		 	<td><?php echo $rw['exam']; ?></td>
		 	<td><?php echo $rw['test2'] + $rw['test'] + $rw['exam']; ?></td>
		 	
		 	
		 	<td><?php 

		 		$total = $rw['test'] + $rw['test2'] + $rw['exam'];
		 		if ($total > 74) {
		 			echo "A1- Excellent";
		 		}elseif ($total > 69 && $total < 75) {
		 			echo "B2 - V.Good";
		 		}elseif ($total > 64 && $total < 70) {
		 			echo "B3 - Good";
		 		}elseif ($total > 59 && $total < 65) {
		 			echo "C4 - Good";
		 		}elseif ($total > 54 && $total < 60) {
		 			echo "C5 - Average";
		 		}elseif ($total > 49 && $total < 55) {
		 			echo "C6  - Average";
		 		}elseif ($total > 44 && $total < 50) {
		 			echo "D7 - Fair";
				 }elseif ($total > 39 && $total < 45) {
					echo "E8 - Weak ";
				}else{ echo "F9 - Fail";}
		 		 ?></td>
		 	<td>
			 <?php  
							 $sig = mysqli_query($connect, "SELECT * FROM register WHERE id ='{$rw["teacher"]}'");
							 while ($s = mysqli_fetch_array($sig)) {
		 			if($s['signature'] != ""){
						# code...
							 
						 ?>
		
						 <img alt="<?php echo substr($s['name'], 0, 3) ?>" src="../signatures/<?php echo $s['signature'] ?>" width="50px">
						 
						
					 <?php }else{ ?>
								<s>
								<?php echo substr($s['name'], 0, 3) ?>
								</s>
					 <?php }} ?>
		 	</td>
		 	<!-- <td></td> -->
		 </tr>
		 	<?php } ?>
		 	
             
		 	
		 	
				</tbody>
			</table>

			<p class="mx-0 row mt-4">
	 <b class="" style="width: 17%"> Comments :</b>
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid black; width: 83%">
				<?php
					$overall = mysqli_query($connect, "SELECT SUM(test + test2+exam) AS total FROM mid_term_results WHERE class ='{$class}' && session = '{$session}'  && term = '{$term}' && student_id = '{$user['student_id']}' && test + exam + test2 > 0");
					$r = mysqli_fetch_array($overall);
					// ;
					$subject_select = mysqli_query($connect, "SELECT * FROM mid_term_results WHERE class ='{$class}' && session = '{$session}'  && term = '{$term}' && student_id = '{$user['student_id']}' && test + exam + test2 > 0");
					$percentage = $r['total']  / (mysqli_num_rows($subject_select));
						
					if($percentage > 74){
						echo "An excellent result. Keep it up!";
					}elseif($percentage >59 && $percentage < 75){
						echo "A good result. Do not relent.";
					}elseif($percentage > 49 && $percentage < 55){
						echo "An average result. You can do better.";
					}elseif($percentage > 39 && $percentage < 50){
							echo "A fair result. Please work harder.";
					}elseif($percentage < 40){
						echo "A weak result. Put in more effort. You can do it";
					}
				?>
			</span>
	</p>
<p class="mx-0 mb-5 float-right mt-n4">
 

<span class=" text-center font-weight-bold d-block" style="width: 130px">
			<?php  
		 			$sig = mysqli_query($connect, "SELECT * FROM register WHERE level =4");
		 			while ($s = mysqli_fetch_array($sig)) {
		 				# code...
		 			if($class < 4){
		 		?>
				 
		 		<img alt="<?php echo substr($s['name'], 0, 3) ?>" src="../signatures/fidelity heading.jpg" width="100%">

					 <?php }else{ ?>

		 		<img alt="<?php echo substr($s['name'], 0, 3) ?>" src="../signatures/<?php echo $s['signature'] ?>" width="100%">
		 		
				
					 <?php } echo "<span class='font-weight-light'>".date('d/m/Y')."</span>"; } ?>
			</span>
</p>
<div class="clearfix"></div>


    

</div>
</div>

<div class=" bg-dark w-100 text-light text-center position-fixed p-2" style="bottom: 0; z-index: 2 ">
<!-- <button class="btn-success btn">Yes</button> -->
<button type="button" class="btn btn-success" onclick="print(this)">Print <span class="fas fa-print"></span></button>


<span>
<a href="results">
  <button id="clear<?php echo $user['student_id']; ?>" class="btn-danger btn">Cancel</button>
</a>
</span>
</div>
</div>

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

