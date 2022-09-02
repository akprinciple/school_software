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
	<title>View User | Queens Schools</title>
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
  <div>
 	
<div class="">

            <div class="row ml-0 mr-0">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
           	<h4 class="mt-3">
             View User's Results
            </h4>
           	<?php include 'inc/hr.php'; ?>


            <div class="">
<div class="">
  <p class="display-4 text-center">
     <?php 
                $sql = mysqli_query($connect, "SELECT * FROM register WHERE md5(id) = '{$id}'");
                // echo $id;
                while ($r = mysqli_fetch_array($sql)) {
                  echo $r['name'];
                }
               ?>
  </p>
  <table class="table table-bordered text-center">
    <thead class="bg-success text-light">
      <tr>
        <th>S/N</th>
        <th>Session</th>
        <th>Class</th>
        <th>Term</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php  
    $select = mysqli_query($connect, "SELECT DISTINCT term,class,session FROM mid_term_results WHERE md5(student_id) = '{$id}'");
    $n= 1;
    while ($row = mysqli_fetch_array($select)) {
      $class =  $row['class'];
      $term = $row['term'];
      $session = $row['session'];
      
  ?>
  <tr>
    <td><?php echo $n++; ?></td>
    <td><?php 
         $c_sql = "SELECT * FROM session WHERE id = '{$session}'";
  $c_query = mysqli_query($connect, $c_sql);
  while ($clas = mysqli_fetch_array($c_query)) {
    echo $clas['session'];
   }

     ?></td>
    <td> <?php 
  $c_sql = "SELECT * FROM class WHERE id = '{$class}'";
  $c_query = mysqli_query($connect, $c_sql);
  while ($clas = mysqli_fetch_array($c_query)) {
    echo $clas['class'];
   } 
  ?></td>
    <td>
     <?php 
  $c_sql = "SELECT * FROM term WHERE id = '{$term}'";
  $c_query = mysqli_query($connect, $c_sql);
  while ($clas = mysqli_fetch_array($c_query)) {
    echo $clas['term'];
   }
   ?>
     
   </td>
    <td>
     <a href="view_user.php?id=<?php echo $id; ?>&class=<?php echo $class; ?>&term=<?php echo $term; ?>&session=<?php echo $session; ?>">
      <span class="fas fa-eye text-success" title="View"></span>
    </a>
    </td>
  </tr>
      
  <?php } ?>
    </tbody>
  </table>
  
  
  </div>


  
  


 

   </div>


</div>
<!-- Print Preview -->
<?php 
 if (isset($_GET['id']) && isset($_GET['class']) && isset($_GET['term']) && isset($_GET['session'])) {
    $session = $_GET['session'];
    $class = $_GET['class'];
    $term = $_GET['term'];
    $id = $_GET['id'];

 $u_sql = "SELECT * FROM mid_term_results WHERE md5(student_id) = '{$id}' &&class ='{$class}' && session = '{$session}'  && term = '{$term}' ORDER BY id DESC";
$u_query = mysqli_query($connect, $u_sql);
echo $id;
echo mysqli_num_rows($u_query);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="update<?php echo $user['student_id']; ?>" class="w-100 position-absolute position-fixe bg-white" style="background-color: rgba(0,0,0,0.1); min-height: 100%; top: 0; z-index: 2; overflow: auto;">

<div class="col-md-11 m-auto p-3" style=" border: 5px dashed green;">
    <div class="row mx-0 col-md-11 m-auto">
    <img src="../images/fidelity heading.jpg" style="width: 100%">
    
    <div style="width: 84%">
    
    </div>
    </div>
    <p class="w-75 mx-auto my-3  row text-uppercase"><b> Name:</b> 
        <span class="w-75 text-center font-weight-bold " style="border-bottom: 1px solid green"><?php 
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
        <h4 class="mb-0 text-center">MID-TERM REPORT CARD</h4>
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

        $sql = "SELECT * FROM mid_term_results WHERE student_id = '{$user["student_id"]}' && class ='{$class}'  && session = '{$session}'  && term = '{$term}' ORDER BY subject ASC";
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
        <span class=" text-center font-weight-bold " style="border-bottom: 1px solid black; width: 80%">
        </span>
</p>
<p class="mx-0 row">
 <b class="" style="width: 70%; border-bottom: 1px solid black;"></b>
 <span style="width: 8%" class="font-weight-bold pl-2">Signature:</span>
        <span class=" text-center font-weight-bold " style="border-bottom: 1px solid black; width: 15%">
        </span>
</p>

<p class="mx-0 row">
 <b class="" style="width: 16%">Principal's Comment :</b>
        <span class=" text-center font-weight-bold " style="border-bottom: 1px solid black; width: 81%">
        </span>
</p>

    


<p class="mx-0 row mt-1">
 <b class="" style="width: 70%; border-bottom: 1px solid black;"></b>
 <span style="width: 8%" class="font-weight-bold pl-2">Signature:</span>
        <span class=" text-center font-weight-bold " style="border-bottom: 1px solid black; width: 15%">
        </span>
</p>

    

</div>
</div>

<div class=" bg-dark w-100 text-light text-center position-fixed p-2" style="bottom: 0; z-index: 2 ">
<!-- <button class="btn-success btn">Yes</button> -->
<button type="button" class="btn btn-success" onclick="print(this)">Print <span class="fas fa-print"></span></button>


<span>
<a href="view_user.php?id=<?php echo md5($user['student_id']); ?>">
  <button id="clear<?php echo $user['student_id']; ?>" class="btn-danger btn">Cancel</button>
</a>
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

