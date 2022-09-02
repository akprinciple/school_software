<?php  
$msg = "";
	include 'inc/session.php';
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>All Arabic Results | Fidelity Schools</title>
    <?php include 'inc/link.php'; ?>
    <style>
           td, tr{
            border: 1px solid blue;

            }
    </style>
</head>
<body onafterprint="alerts()">




<script>
function alerts(){
	alert('This page is being printed');
}
</script>
 <?php 
 if (isset($_GET['class']) && isset($_GET['term']) && isset($_GET['session'])) {
		$session = $_GET['session'];
		$class = $_GET['class'];
		
		$term = $_GET['term'];

 $u_sql = "SELECT DISTINCT student_id FROM arabic_result WHERE class ='{$class}'  && session = '{$session}'  && term = '{$term}' ORDER BY id DESC";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>

<div id="update<?php echo $user['student_id']; ?>" class="w-100 bg-white" style="background-color: rgba(0,0,0,0.1); min-height: 100%;  overflow: auto;">

	<div class="col-md-11 mx-auto mt-5 p-3" style="border: 5px dashed blue;">
		<div class="col-md-11 m-auto">
		<img src="../images/arabic head.png" style="width: 100%" class="mb-3">
		
        </div>
        <div style="border: 1px solid blue;" class=" my-2">
        <table class="table table-striped table-bordered mb-0"  >
            <tr >
                <td col-span="" class="w-25 text-center p-0">
                    <b>الإسم(NAME):</b>
                   
                </td>
                <td colspan="3"  class="p-0"> 
                    <span class="d-block text-center font-weight-bold " style=""><?php 
	$c_sql = "SELECT * FROM register WHERE id = '{$user["student_id"]}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($name = mysqli_fetch_array($c_query)) {
	 	echo $name['name'];
	 } 
	
    ?>
    </span>
    </td>
                
            </tr>
            <tr class="text-center">
                <td class="font-weight-bold p-0">الفصل(Class):</td>
                <td class="p-0">
                <?php 
	$c_sql = "SELECT * FROM arabic_class WHERE id = '{$class}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['class'];
	 } 
	?>
                </td>
                <td class="font-weight-bold p-0">الفصل(Class):</td>
                <td class="p-0">
                <?php 
	$c_sql = "SELECT * FROM students WHERE user_id = '{$user['student_id']}' && arabic_class ='{$class}'  && session = '{$session}'";

	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
         $selt = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$clas['class']}'");
         $rows = mysqli_fetch_array($selt);
            echo $rows['class'];
	 } 
	?>
                </td>
                
    </tr>
    <tr class="text-center font-weight-bold p-0">
    <td class="font-weight-bold p-0">الفترة (Term)</td>
                <td class="text-center p-0">
                <?php

$c_sql = "SELECT * FROM term WHERE id = '{$term}'";
$c_query = mysqli_query($connect, $c_sql);
while ($ter = mysqli_fetch_array($c_query)) {
     echo $ter['term'];
 } 
?>
                </td>
        <td class="text-center font-weight-bold p-0">عدد الطالب في الفصل (NUMBER OF STUDENTS): </td>
        <td  class="p-0">
            <?php
                $every = mysqli_query($connect, "SELECT * FROM students WHERE arabic_class = '{$_GET['class']}' && session = '{$_GET['session']}'");
                echo mysqli_num_rows($every);

            ?>
        </td>
</tr>

    <tr class="text-center font-weight-bold">
        <td class="p-0"> العام الدراسي ( Academic Session):</td>
        <td class="p-0">
        <?php 
	$c_sql = "SELECT * FROM session WHERE id = '{$session}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['session'];
	 } 
	?>
        </td>
        <td class="text-center font-weight-bold p-0">التّقدير(Total Grade) </td>
        <td>
            
        </td>
</tr>
<!-- -->
        </table>
</div>
	

	


		<div class="mt-5">
			<b class="pl-3">PERFORMANCE IN SUBJECTS (COGNITIVE)</b>
			<table  class="text-center table-responsive-xl w-100" border="1" style="border: 2px solid blue">
				<thead>
					<tr style=" padding: 15px;">
						<th>Signature</th>
                        <th class=""> <p style="direction: ltr;">Grade</p></th>
						
						
						<th>Total</th>
						<th>Exam Score</th>
						<th>Second CA (20)</th>
						<th>First CA (20)</th>
						<th style="width: 30%;">SUBJECT</th>
						<!-- <th></th> -->
					</tr>
				</thead>
				<tbody>
					<?php 

			$sql = "SELECT * FROM arabic_result WHERE student_id = '{$user["student_id"]}' && class ='{$class}' && session = '{$session}'  && term = '{$term}' ORDER BY subject ASC";
$query = mysqli_query($connect, $sql);
$count = mysqli_num_rows($query);
		while ($rw = mysqli_fetch_array($query)) {
			
		
         ?>	
         
		 <tr class="py-3" style=" font-size: 20px; font-family: timesnewroman;">
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
         <td><?php 

$total = $rw['first'] + $rw['second'] + $rw['exam'];
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
    echo "E8";
}else{ echo "F9";}
 ?></td>
		 	<!-- <td><?php echo $rw['test']; ?></td> -->
		 	<td><?php echo $rw['first'] + $rw['second'] + $rw['exam']; ?></td>
		 	
		 	<td><?php echo $rw['exam']; ?></td>
		 	
		 	
             <!-- <td></td> -->
             <td><?php echo $rw['second']; ?></td>
             <td><?php echo $rw['first']; ?></td>
             <td class="font-weight-bold"><?php 
		 	

	$c_sql = "SELECT * FROM arabic_subjects WHERE id = '{$rw['subject']}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($ter = mysqli_fetch_array($c_query)) {
	 	echo $ter['subject'];
	 } 
		 	 $rw['subject']; ?></td>
		 </tr>
		 	<?php } ?>
		 	<tr>
		 		<td class="p-3"></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 	</tr>
		 	<tr>
		 		<td class="p-3"></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 	</tr>
		 	<tr>
		 		<td class="p-3"></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 	</tr>
		 	
				</tbody>
			</table>

            <p class="mx-0 row mt-5 mb-4">
     <b class="row mx-0" style="width: 33.33%;">
     <span class="col-md-7">TOTAL OBTAINABLE: </span>
     <span class="col-md-5 d-block text-center" style="border-bottom: 1px solid blue;">
        <?php
            $num_obt = mysqli_query($connect, "SELECT * FROM arabic_result WHERE  student_id = '{$user["student_id"]}' && class ='{$class}' && session = '{$session}'  && term = '{$term}'");
           echo mysqli_num_rows($num_obt) * 100;
        ?>
    </span>
    </b>
    <b class="row mx-0" style="width: 33.33%;">
     <span class="col-md-6">TOTAL OBTAINED: </span>
     <span class="col-md-6 d-block text-center" style="border-bottom: 1px solid blue;">
     <?php 
            $num_obt = mysqli_query($connect, "SELECT SUM(first + second + exam) AS total FROM arabic_result WHERE  student_id = '{$user["student_id"]}' && class ='{$class}' && session = '{$session}'  && term = '{$term}'");
           while($tot = mysqli_fetch_array($num_obt)){
               echo $tot['total'];
           }
        ?>
    </span>
    </b>
    <b class="row mx-0" style="width: 33.33%;">
     <span class="col-md-5">PERCENTAGE: </span>
     <span class="col-md-7 d-block text-center" style="border-bottom: 1px solid blue;">
           <?php
                  $num_obts = mysqli_query($connect, "SELECT * FROM arabic_result WHERE  student_id = '{$user["student_id"]}' && class ='{$class}' && session = '{$session}'  && term = '{$term}'");
                  $number = mysqli_num_rows($num_obts);
                  $num_obt = mysqli_query($connect, "SELECT SUM(first + second + exam) AS total FROM arabic_result WHERE  student_id = '{$user["student_id"]}' && class ='{$class}' && session = '{$session}'  && term = '{$term}'");
                  while($tot = mysqli_fetch_array($num_obt)){
                      echo number_format($tot['total']/$number,2)."%";
                  }
                    
           ?>
    </span>
    </b>
	 
	</p>

			<p class="mx-0 row mt-5">
	 <b class="" style="width: 20%">Teacher's Comment :</b>
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid blue; width: 80%">
			</span>
	</p>
	<p class="mx-0 mb-5 float-right mt-n4">
	 
	
			<span class=" text-center font-weight-bold d-block" style="width: 130px">
			<?php  
		 			$sig = mysqli_query($connect, "SELECT * FROM register WHERE level =4");
		 			while ($s = mysqli_fetch_array($sig)) {
		 				# code...
		 			
		 		?>

		 		<img alt="<?php echo substr($s['name'], 0, 3) ?>" src="../signatures/<?php echo $s['signature'] ?>" width="100%">
		 		
				
		 	<?php echo date('d/m/Y');} ?>
			</span>
	</p>
	<div class="clearfix"></div>

	

		


	
</div>
</div>

<div class=" bg-dark w-100 text-light text-center position-fixed p-2" style="bottom: 0; z-index: 2 ">
	<!-- <button class="btn-success btn">Yes</button> -->
	<button type="button" class="btn btn-success" onclick="print(this)">Print <span class="fas fa-print"></span></button>
	

<a href="arabic_result_view?class=<?php echo $class; ?>&term=<?php echo $term; ?>&session=<?php echo $session; ?>">
	<button id="" class="btn-danger btn">Cancel</button>
</a>
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
