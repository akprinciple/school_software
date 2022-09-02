<?php  
$msg = "";
include 'inc/session.php';
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Results | Fidelity Schools</title>
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

<!-- The Print Preview -->
<?php 
 if (isset($_GET['class']) && isset($_GET['term'])  && isset($_GET['session'])) {
	 $session = $_GET['session'];
	 $class = $_GET['class'];
	 $term = $_GET['term'];
	 
	 
	 $u_sql = "SELECT DISTINCT student_id FROM mid_term_results WHERE class ='{$class}'   && session = '{$session}'  && term = '{$term}'  && test+ test2+exam >0 ORDER BY id DESC";
	 $u_query = mysqli_query($connect, $u_sql);
	 $n = 1;
	 $counter = mysqli_num_rows($u_query);
	 while ($user = mysqli_fetch_array($u_query)) {
		 ?>
		 <div id="update<?php echo $user['student_id']; ?>" class="w-100 position-fixe bg-white" style="background-color: rgba(0,0,0,0.1); min-height: 40cm; top: 0;;">
<!-- <div id="update<?php echo $user['student_id']; ?>" class="w-100 position-absolute position-fixe bg-white" style="background-color: rgba(0,0,0,0.1); min-height: 100%; top: 0; z-index: 2; overflow: auto; display : none;"> -->

	<div class="col-md-11 m-auto p-3" style=" border: 5px dashed green;">
		<div class="row mx-0 col-md-11 m-auto">
		<img src="../images/fidelity heading.jpg" style="width: 100%">
		
		<div style="width: 84%">
		
		</div>
		</div>
		<p class="w-75 mx-auto my-3  row text-uppercase" style=""> Name: 
			<span class="w-75 text-center font-weight-bold " style="border-bottom: 1px solid green; font-size: 20px;"><?php 
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
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%; font-size: 18px;">
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
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%; font-size: 18px;">
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
			<span class=" text-center font-weight-bold text-capitalize" style="border-bottom: 1px solid green; width: 87%; font-size: 18px;"><?php 
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
			<span class=" text-center font-weight-bold text-capitalize" style="border-bottom: 1px solid green; width: 87%; font-size: 18px;">
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
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 82%; font-size: 18px;">
				<?php 
	
    echo $counter;

?>
	
	
			</span>
	</p>
	
</div>

	
</div>

		<div class="">
			<h4 class="mb-0 text-center">TERMINAL REPORT CARD</h4>
			<?php if($term == 3){ ?>
				<table  class="w-100 text-center"  style="border: 2px solid green;  font-size: 18px; color: #000;">
				<thead>
					<tr class="" style="font-size: 13px;">
						<th rowspan="2">S/N</th>
						<th rowspan="2" style="width: 22%;">SUBJECT</th>
						
						<th colspan="3">MARKS OBTAINED 
						
						</th>
						<th rowspan="2">3rd term Total(100)</th>
						<th rowspan="2">2nd term Total(100)</th>
						<th rowspan="2">1st term Total(100)</th>
						<th rowspan="2">Annual Total(100)</th>
						<th rowspan="2">Highest Score</th>
						<th rowspan="2">Lowest Score</th>
						<th rowspan="2" style="width: 12%">GRADE</th>
						
						
						<th rowspan="2">SIGNATURE</th>
						<!-- <th></th> -->
					</tr>
					
					<tr style="font-size: 13px;">	
	 				<th>Weekly Tests(20)</th>
					<th>Midterm Test(20)</th>
	 				<th>Exam (60)</th>
	 				</tr>
				</thead>
				<tbody>
					<?php 

			$sql = "SELECT DISTINCT subject FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && class ='{$class}'  && session = '{$session}' && test + exam + test2 > 0 ORDER BY subject ASC";
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
		 	<td class="font-weight-bold" style="font-size: 13px;"><?php 
		 	

	$c_sql = "SELECT * FROM subjects WHERE id = '{$rw['subject']}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($ter = mysqli_fetch_array($c_query)) {
	 	echo $ter['subject'];
	 } 
		 	//  $rw['subject']; ?>
              </td>
		 	
		 	<td>
			 <?php
			 $third_result = mysqli_query($connect, "SELECT * FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && subject = '{$rw['subject']}' && class ='{$class}' && term =3  && session = '{$session}' && test + exam + test2 > 0 "); 
			$w = mysqli_fetch_array($third_result);
			if(isset($w['test2'])){
			echo $w['test2'];
					}
			  ?>
			 </td>
		 	<td>
			 <?php
			 $third_result = mysqli_query($connect, "SELECT * FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && subject = '{$rw['subject']}' && class ='{$class}' && term =3  && session = '{$session}' && test + exam + test2 > 0 "); 
			$w = mysqli_fetch_array($third_result);
			if(isset($w['test'])){
				echo $w['test'];
						}
			  ?>
			 </td>
		 	<td>
			 <?php
			 $third_result = mysqli_query($connect, "SELECT * FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && subject = '{$rw['subject']}' && class ='{$class}' && term =3  && session = '{$session}' && test + exam + test2 > 0 "); 
			$w = mysqli_fetch_array($third_result);
			if(isset($w['exam'])){
				echo $w['exam'];
						}
			  ?>
			 </td>

		 	<!--Third Term -->
		 	<td> 
			 <?php
			 $third_result = mysqli_query($connect, "SELECT SUM(test+test2+exam) AS addition FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && subject = '{$rw['subject']}' && class ='{$class}' && term =3  && session = '{$session}' && test + exam + test2 > 0 "); 
			$w = mysqli_fetch_array($third_result);
			
			echo $w['addition'];
			  ?>
			</td>
		 	<!--2nd Term -->
		 	
		 	<td> <?php
				$term_score = mysqli_query($connect, "SELECT SUM(test + test2 + exam) AS total FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && class ='{$class}'  && session = '{$session}'  && term = 2 && subject = '{$rw['subject']}'");
	 				foreach ($term_score as $key) {
						 echo $key['total'];
					 }
			 ?></td>
		 	<!--1st Term -->
		 	
		 	<td>
			 <?php
				$term_score = mysqli_query($connect, "SELECT SUM(test + test2 + exam) AS total FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && class ='{$class}'  && session = '{$session}'  && term = 1 && subject = '{$rw['subject']}' && test + exam + test2 > 0");
	 				foreach ($term_score as $key) {
						 echo $key['total'];
					 }
			 ?>
			 </td>
			 <!-- Annual Average -->
		 	<td>
			 <?php
				$term_score = mysqli_query($connect, "SELECT AVG(test + test2 + exam) AS total FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && class ='{$class}'  && session = '{$session}' && subject = '{$rw['subject']}' && test + exam + test2 > 0");
	 				foreach ($term_score as $key) {
						 echo number_format($key['total'], 0);
					 }
			 ?>
			 </td>
			 <!-- Highest Score -->
			 <td>
			 <?php
				$try = "SELECT AVG(test + test2 + exam) AS score, student_id FROM mid_term_results  WHERE student_id = ANY (SELECT DISTINCT student_id FROM mid_term_results WHERE term =3 && class ='{$class}'  && session = '{$session}' && subject = '{$rw['subject']}'&& test + exam + test2 > 0) && class ='{$class}'  && session = '{$session}' && subject = '{$rw['subject']}' && test + exam + test2 > 0 GROUP BY student_id ORDER BY score DESC LIMIT 1";
				$highest_score = mysqli_query($connect, $try);
				foreach ($highest_score as $key) {
					print number_format($key['score'], 0);
						 
				}
			 ?>
			 </td>
			 <!-- Lowest Score  -->
			 <td>
			 	 <?php
				$try = "SELECT AVG(test + test2 + exam) AS score FROM mid_term_results  WHERE student_id = ANY (SELECT student_id FROM mid_term_results WHERE term =3 && class ='{$class}'  && session = '{$session}' && subject = '{$rw['subject']}'&& test + exam + test2 > 0) && class ='{$class}'  && session = '{$session}' && subject = '{$rw['subject']}' && test + exam + test2 > 0 GROUP BY student_id ORDER BY score ASC LIMIT 1";
				$lowest_score = mysqli_query($connect, $try);
				foreach ($lowest_score as $key) {
					print number_format($key['score'], 0);
				}
			 
			 ?>
			 </td>
		 	<!-- Grade -->
		 	<td style="font-size: 13px;" class="font-weight-bold">
			 
			 <?php 

$term_score = mysqli_query($connect, "SELECT AVG(test + test2 + exam) AS total FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && class ='{$class}'  && session = '{$session}' && subject = '{$rw['subject']}' && test + test2+exam>0");
foreach ($term_score as $key) {
	$total = number_format($key['total'], 0);
	if($class > 8 && $class <15){
		 		if ($total > 74) {
		 			echo "A1";
		 		}elseif ($total > 69 && $total < 75) {
		 			echo "B2";
		 		}elseif ($total > 64 && $total < 70) {
		 			echo "B3";
		 		}elseif ($total > 59 && $total < 65) {
		 			echo "C4";
		 		}elseif ($total > 54 && $total < 60) {
		 			echo "C5";
		 		}elseif ($total > 49 && $total < 55) {
		 			echo "C6";
		 		}elseif ($total > 44 && $total < 50) {
		 			echo "D7";
				 }elseif ($total > 39 && $total < 45) {
					echo "E8 ";
				}else{ echo "F9";}
			}else{
				if ($total > 74) {
					echo "Excellent";
				}elseif ($total > 69 && $total < 75) {
					echo "V.Good";
				}elseif ($total > 64 && $total < 70) {
					echo "Good";
				}elseif ($total > 59 && $total < 65) {
					echo "Good";
				}elseif ($total > 54 && $total < 60) {
					echo "Average";
				}elseif ($total > 49 && $total < 55) {
					echo "Average";
				}elseif ($total > 44 && $total < 50) {
					echo "Fair";
				}elseif ($total > 39 && $total < 45) {
				   echo "Weak ";
			   }else{ echo "Fail";}
		   }
			}
		 		 ?></td>
		 	<td>
			 <?php  
					$third_result = mysqli_query($connect, "SELECT * FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && subject = '{$rw['subject']}' && class ='{$class}' && term =3  && session = '{$session}' && test + exam + test2 > 0 "); 
					$w = mysqli_fetch_array($third_result);
						if(!empty($w['teacher'])){
					$sig = mysqli_query($connect, "SELECT * FROM register WHERE id ='{$w["teacher"]}'");
							 while ($s = mysqli_fetch_array($sig)) {
		 			if($s['signature'] != ""){
						# code...
							 
						 ?>
		
						 <img alt="<?php echo substr($s['name'], 0, 3) ?>" src="../signatures/<?php echo $s['signature'] ?>" width="50px">
						 
						
					 <?php }else{ ?>
								<s>
								<?php echo substr($s['name'], 0, 3) ?>
								</s>
					 <?php }}} ?>
		 	</td>
		 	<!-- <td></td> -->
		 </tr>
		 	<?php } ?>
		 	
             
		 	
		 	
				</tbody>
			</table>

			<p class="mx-0 row mt-4 w-50 float-right">
	 <b class="" style="width: 27%"> Overall Percentage :</b>
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 66%">
				<?php
					
					
					$overall = mysqli_query($connect, "SELECT AVG(test + test2 +exam) AS total FROM mid_term_results WHERE class ='{$class}' && session = '{$session}' && student_id = '{$user['student_id']}' && test + exam + test2 > 0");
					while($r = mysqli_fetch_array($overall)){
					echo number_format($r['total'],1);
					
				}
				// $overall_sql = "SELECT (SELECT AVG(test + test2 +exam) AS total FROM mid_term_results WHERE class ='{$class}' && session = '{$session}' && student_id = '{$user['student_id']}'  && test + exam + test2 > 0 GROUP BY subject) SUM(total) AS average FROM mid_term_results WHERE class ='{$class}' && session = '{$session}' && student_id = '{$user['student_id']}'  && test + exam + test2 > 0";
				// $overall = mysqli_query($connect, $overall_sql);
				// 	while($r = mysqli_fetch_array($overall)){
				// 	echo number_format($r['average'],1);
					
				// }
				?>%
			</span>
	</p>
	<div class="clearfix"></div>
			<p class="mx-0 row mt-4">
	 <b class="" style="width: 17%"> Comment :</b>
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 83%">
				<?php
					$overall = mysqli_query($connect, "SELECT AVG(test + test2 +exam) AS total FROM mid_term_results WHERE class ='{$class}' && session = '{$session}' && student_id = '{$user['student_id']}' && test + exam + test2 > 0");
					while($r = mysqli_fetch_array($overall)){
						$percentage = number_format($r['total'],1);
					
						$c_sql = "SELECT * FROM register WHERE id = '{$user["student_id"]}'";
					$c_query = mysqli_query($connect, $c_sql);
					$name = mysqli_fetch_array($c_query);
					if($percentage > 39){
					
						echo "This is to inform {$name['name']} that you are promoted to the next class.";
					
					}else{
						echo "This is to inform {$name['name']} that you are to repeat the present class.";
							
					}
					}
				?>
			</span>
	</p>
	<p class="mx-0 mb-5 float-right mt-n5">
	 
	
			<span class=" text-center font-weight-bold d-block" style="width: 200px">
			<?php  
		 			$sig = mysqli_query($connect, "SELECT * FROM register WHERE level =4");
		 			while ($s = mysqli_fetch_array($sig)) {
		 				if($s['signature'] != ""){
						 if($class > 8 && $class < 15){
							 
							?>
   
						   <img alt="<?php echo substr($s['name'], 0, 3) ?>" src="../signatures/<?php echo "School Stamp Sec.png" ?>" width="100%">
					   <?php	}  else{ ?>
							<img alt="<?php echo substr($s['name'], 0, 3) ?>" src="../signatures/<?php echo $s['signature'] ?>" width="100%">
							
						   
						<?php } ?>
				 
		 		
					 <?php }else{ ?>

									<h1><s>FID</s></h1>
				
					 <?php } echo "<span class='font-weight-light'>".date('d/m/Y')."</span>"; } ?>
			</span>
	</p>
	<div class="clearfix"></div>
			

			<?php }else{ ?>
			<table  class="w-100 text-center"  style="border: 2px solid green;  font-size: 18px; color: #000;">
				<thead>
					<tr class="">
						<th rowspan="2">S/N</th>
						<th rowspan="2" style="width: 22%;">SUBJECT</th>
						
						<th colspan="3">MARKS OBTAINED 
						
						</th>
						<th rowspan="2">Total(100)</th>
						<th rowspan="2">Highest Score</th>
						<th rowspan="2">Lowest Score</th>
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
		 	<td>
			 <?php
				$highest_score = mysqli_query($connect, "SELECT MAX(test + test2 + exam) AS score FROM mid_term_results WHERE class ='{$class}'  && session = '{$session}'  && term = '{$term}' && subject = '{$rw['subject']}' && test + exam + test2 > 0");
				foreach ($highest_score as $key) {
					print($key['score']);
				}
			 ?>
			 </td>
		 	<td>
			 <?php
				$lowest_score = mysqli_query($connect, "SELECT MIN(test + test2 + exam) AS score FROM mid_term_results WHERE class ='{$class}'  && session = '{$session}'  && term = '{$term}' && subject = '{$rw['subject']}' && test + exam + test2 > 0");
				foreach ($lowest_score as $key) {
					print($key['score']);
				}
			 ?>
			 </td>
		 	<td style="width: 12%;"><?php 

		 		$total = $rw['test'] + $rw['test2'] + $rw['exam'];
		 		if($class > 8 && $class <15){
					if ($total > 74) {
						echo "A1";
					}elseif ($total > 69 && $total < 75) {
						echo "B2";
					}elseif ($total > 64 && $total < 70) {
						echo "B3";
					}elseif ($total > 59 && $total < 65) {
						echo "C4";
					}elseif ($total > 54 && $total < 60) {
						echo "C5";
					}elseif ($total > 49 && $total < 55) {
						echo "C6";
					}elseif ($total > 44 && $total < 50) {
						echo "D7";
					}elseif ($total > 39 && $total < 45) {
					   echo "E8 ";
				   }else{ echo "F9";}
			   }else{
				   if ($total > 74) {
					   echo "Excellent";
				   }elseif ($total > 69 && $total < 75) {
					   echo "V.Good";
				   }elseif ($total > 64 && $total < 70) {
					   echo "Good";
				   }elseif ($total > 59 && $total < 65) {
					   echo "Good";
				   }elseif ($total > 54 && $total < 60) {
					   echo "Average";
				   }elseif ($total > 49 && $total < 55) {
					   echo "Average";
				   }elseif ($total > 44 && $total < 50) {
					   echo "Fair";
				   }elseif ($total > 39 && $total < 45) {
					  echo "Weak ";
				  }else{ echo "Fail";}
			  }
			   
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
	 <b class="" style="width: 17%"> Comment :</b>
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 83%">
				<?php
					$overall = mysqli_query($connect, "SELECT SUM(test + test2 +exam) AS total FROM mid_term_results WHERE class ='{$class}' && session = '{$session}'  && term = '{$term}' && student_id = '{$user['student_id']}' && test + exam + test2 > 0");
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
	<p class="mx-0 mb-5 float-right mt-n5">
	 
	
			<span class=" text-center font-weight-bold d-block" style="width: 200px">
			<?php  
		 			$sig = mysqli_query($connect, "SELECT * FROM register WHERE level =4");
		 			while ($s = mysqli_fetch_array($sig)) {
		 				if($s['signature'] != ""){
						 if($class > 8 && $class < 15){
							 
							?>
   
						   <img alt="<?php echo substr($s['name'], 0, 3) ?>" src="../signatures/<?php echo "School Stamp Sec.png" ?>" width="100%">
					   <?php	}  else{ ?>
							<img alt="<?php echo substr($s['name'], 0, 3) ?>" src="../signatures/<?php echo $s['signature'] ?>" width="100%">
							
						   
						<?php } ?>
				 
		 		
					 <?php }else{ ?>

									<h1><s>FID</s></h1>
				
					 <?php } echo "<span class='font-weight-light'>".date('d/m/Y')."</span>"; } ?>
			</span>
	</p>
	<div class="clearfix"></div>
			
	
	<?php } ?>
		


	

		
	
</div>
</div>
<div class=" bg-dark w-100 text-light text-center position-fixed p-2" style="bottom: 0; z-index: 2 ">
	<!-- <button class="btn-success btn">Yes</button> -->
	<button type="button" class="btn btn-success" onclick="print(this)">Print <span class="fas fa-print"></span></button>
	

<a href="terminalresults?class=<?php echo $class; ?>&term=<?php echo $term; ?>&session=<?php echo $session;?>">
	<button id="clear<?php echo $user['student_id']; ?>" class="btn-danger btn">Cancel</button>
</a>
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
