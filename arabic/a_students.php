<?php
ob_start(); 
    include 'inc/session.php';
$msg = "";

 if (isset($_GET['success'])) {
      $msg = "<script>alert('Update Successful');</script>";
      
    }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Students | Fidelity Schools</title>
  <?php include 'inc/link.php'; ?>
</head>
<body>
  <div>
  <?php echo $msg; ?>
<div class="">

            <div class="row ml-0 mr-0">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
            <h4 class="mt-3 text-center">بسم الله الرحمن الرحيم</h4>
            <h5>All Students</h5>
            <?php include 'inc/hr.php'; ?>

<!-- <img src="../images/arabic head.png" class="card-img"> -->
            <div class="row mx-0">
<form class="col-md-8 row border-right mx-0">

  
  


  <div class="form-group col-md-6 p-1">
  <label class="font-weight-bold">الفصل(Class)</label>
  <br>
  <select class="form-control" name="class">
  <?php 
  if (!isset($_GET['class']) && !isset($_GET['session'])) {
    echo "<option>--Select Arabic Class--</option>";
  }
  
  else {
  $t = $_GET['class'];
  $sq = "SELECT * FROM arabic_class WHERE id = '{$t}'";
  $quer = mysqli_query($connect, $sq);
  while ($rw = mysqli_fetch_array($quer)) {
    $tm = $rw['class'];
    echo "<option value='$t'>$tm</option>";
   }} 
  ?>
 <option value="0">No Class</option>
  <?php 
  $sql = "SELECT * FROM arabic_class";
  $query = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
  <?php } ?>
  </select>
  </div>



  <div class="form-group col-md-6 p-1">
  <label class="font-weight-bold">العام الدراسي(Session)</label>
  <br>
  <select class="form-control" name="session">
  <?php 
  if (!isset($_GET['class']) && !isset($_GET['session'])) {
    echo "<option>Select Session</option>";
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
  
  <?php 
  // $sql = "";
  $query = mysqli_query($connect, "SELECT * FROM session");
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['session']; ?></option>
  <?php } ?>
  </select>
  </div>

<div class="col-md-6"></div>
<div class="col-md-6">
  
  <button type="search" class="btn btn-success  rounded w-100 float-right">Search</button>
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

















<span class="float-right mb-3 bot-left p-2 bg-white">
 
<!-- <span class="">/</span> -->
<a href="a_students.php" class="text-success fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span> 
<div class="clearfix"></div>
            

              <!-- Search by Student by class and Session -->
<?php 
if (isset($_GET['class'])  && isset($_GET['session'])) {
    $session = $_GET['session'];
    $class = $_GET['class'];
    // $arm = $_GET['arm'];

  $select = "SELECT * FROM students WHERE arabic_class ='{$class}'  && session = '{$session}'";
  $show = mysqli_query($connect, $select);

  $count = mysqli_num_rows($show);
  ?>   

<div class="text-center"><?php echo $count; ?> Result(s) Found</div>
  <h5 class=" row mx-0 "> 
      <div class="w-50 bg-success text-light text-center p-1">
          <?php
          if (isset($_GET['class'])  && isset($_GET['session'])) {
                $t = $_GET['class'];
                $sq = "SELECT * FROM arabic_class WHERE id = '{$t}'";
                $quer = mysqli_query($connect, $sq);
                while ($rw = mysqli_fetch_array($quer)) {
                  $tm = $rw['class'];
                  echo $rw['class'];
                }}
          ?>
      </div>
  <div class="w-50 text-center p-1 border">
  <?php
          if (isset($_GET['class'])  && isset($_GET['session'])) {
                $t = $_GET['session'];
                $sq = "SELECT * FROM session WHERE id = '{$t}'";
                $quer = mysqli_query($connect, $sq);
                while ($rw = mysqli_fetch_array($quer)) {
                  $tm = $rw['session'];
                  echo $rw['session'];
                }}
          ?>
  </div> 
  </h5>  
    
      <table class="table table-striped table-bordered text-center text-capitalize mt-n2 table-responsive-xl">
  <thead class="">
  <th>S/N</th>
  <th>Name</th>
  <th>Class</th>
  <th>Gender</th>
  <th>Action</th>
</thead>
<tbody>
  <?php

  $n = 1; 
  $r_sql = "SELECT * FROM students WHERE arabic_class ='{$class}'  && session = '{$session}' ORDER BY id ASC";
  $r_query = mysqli_query($connect, $r_sql);
    
  while ($r_name = mysqli_fetch_array($r_query)) {
 ?>
  <tr>
  <td><?php echo $n++; ?></td>
  <td><?php 
  $name = $r_name['user_id'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['name'];
  }
  

  ?></td>
  <td>
    <?php 
    $name = $r_name['class'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['class'];
  } ?>
  </td>
  <td>
  <?php 
  $name = $r_name['user_id'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['gender'];
  }
  

  ?>
  </td>
  <td>
  
  <span class="btn-danger btn fas fa-pen" id="del<?php echo $name; ?>" title="Edit And View Users' Details"></span>
  
</td>
<?php } ?>
</tbody>
</table>

    <?php } ?> 
<!-- Search by keyword -->
    <?php
          if(isset($_GET['search'])){
            $q = $_GET['search'];
            $see = mysqli_query($connect, "SELECT * FROM students WHERE EXISTS (SELECT * FROM register WHERE name LIKE '%".$q."%' && students.user_id = register.id ORDER BY name ASC)");
            $counts = mysqli_num_rows($see);
            $n = 1;        
    ?>

<h5 class="text-center"><?php echo $counts; ?> Results Found</h5>    
      <table class="table table-striped table-bordered text-center text-capitalize">
  <thead class="bg-success text-light">
  <th>S/N</th>
  <th>Name</th>
  <th>Arabic Class</th>
  <th>Regular Class</th>
  <!-- <th>Actions</th> -->
</thead>
<tbody>
<?php
 while ($search_row = mysqli_fetch_array($see)){

?>
<tr>
  <td><?php echo $n++; ?></td>
  <td><?php
  $sel = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$search_row['user_id']}'");
  foreach($sel as $c){
  echo $c['name'];
  
}
  ?></td>
  <td>
    <?php 
    $sel = mysqli_query($connect, "SELECT * FROM arabic_class WHERE id = '{$search_row['arabic_class']}'");
    foreach($sel as $c){
    echo $c['class'];
    
  }
  
   ?>
  </td>
  <td>
  <?php
    $sel = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$search_row['class']}'");
    foreach($sel as $c){
    echo $c['class'];
     }
   ?>
  </td>
<?php } ?>
</tbody>
</table>
  <?php } ?>
            </div>
           </div>
       </div>

   </div>
<!--------------- Modal To Edit And View Users' Details  --------------------->
   <?php 
   if(isset($_GET['class']) && isset($_GET['session'])){
 $u_sql = "SELECT * FROM students WHERE arabic_class = '$class' && session = '$session'";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['user_id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.8); min-height: 100%; top: 0; z-index: 2; display: none;">

  <form method="post" enctype="multipart/form-data" class="col-md-9 mx-auto mt-5">
    <h4 class="text-center text-light">Edit User's Details</h4>
    <hr class="bg-white">
    <div class="text-danger text-center">Note that only Arabic Class is Editable</div>
    <!-- <marquee class="text-light">Note that only name and Date of birth can be Editted</marquee> -->
    <div class="row mx-0">
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Name</label>
        <input type="text" readonly name="name<?php echo $user['user_id']; ?>" required="required" minlength="6" class="form-control text-center" 
            value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['name'];
                  }
             ?>">
      </div>
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Arabic Class</label>
        <select class="form-control text-center" name="arabic_class<?php echo $user['user_id']; ?>">
        <option value="<?php 
            $sl = mysqli_query($connect, "SELECT * FROM arabic_class WHERE id = '{$_GET['class']}'");
            while ($user_row = mysqli_fetch_array($sl)){
                echo $user_row['id'];
            }
        ?>">
        <?php 
            $sl = mysqli_query($connect, "SELECT * FROM arabic_class WHERE id = '{$_GET['class']}'");
            while ($user_row = mysqli_fetch_array($sl)){
                echo $user_row['class'];
            }
        ?>
        </option>
        <?php 
  $sql = "SELECT * FROM arabic_class";
  $query = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option class="<?php if($row['id'] == $_GET['class']){echo "d-none";} ?>" value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
  <?php } ?>
        </select>
       
      </div>
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Date of Birth</label>
        <input type="date" disabled name="dob<?php echo $user['user_id']; ?>" class="form-control text-center" required="required" 
            value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['dob'];
                  }
             ?>">
      </div>
       
       <!-- <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Registered Class</label>
        <input type="text"  disabled="disabled" name="name" class="form-control text-center" value="<?php 
          $show_class = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$user['class']}'");
          $sho = mysqli_fetch_array($show_class);
          echo $sho['class'];
          // $show_arm = mysqli_query($connect, "SELECT * FROM arms WHERE id = '{$user['arm']}'");
          // $show = mysqli_fetch_array($show_arm);
          // echo $show['arm'];
         ?>">
      </div> -->
       <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Current Class</label>
        
        <input type="text" class="form-control text-center" disabled value="<?php 
         $show_class = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '{$user['user_id']}' ORDER BY class DESC LIMIT 1");
          $sho = mysqli_fetch_array($show_class);
         
           $show_arm = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$sho['class']}'");
          $show = mysqli_fetch_array($show_arm);
          echo $show['class']; 
          ?>">
         
        
        
      </div>
       <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Session Registered</label>
        <input type="text"  disabled="disabled" class="form-control text-center" value="<?php 
          $show_class = mysqli_query($connect, "SELECT * FROM session WHERE id = '{$user['session']}'");
          $sho = mysqli_fetch_array($show_class);
          echo $sho['session'];
         
         ?>">
      </div>
       <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Current Session</label>
        <input type="text" disabled="disabled" class="form-control text-center" value="<?php 
         $show_class = mysqli_query($connect, "SELECT * FROM session WHERE id = '{$_GET['session']}'");
          $sho = mysqli_fetch_array($show_class);
          echo $sho['session'];
           
         ?>">
      </div>
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Registration Code</label>
        <input type="text" disabled="disabled" class="form-control text-center" value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['code'];
                  }
             ?>">
      </div>
       <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Registration Date</label>
        <input type="text" disabled="disabled" class="form-control text-center" value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['date'];
                  }
             ?>">
      </div>
      
      <!-- <div class="col-md-6"></div> -->
      
      <div class="col-md-6 mt-3 mx-auto">
      <button type="submit" name="edit<?php echo $user['user_id']; ?>" class="btn btn-success w-100">Update</button>
        </div>
                
    </div>
  </form>






<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">

<span id="clear<?php echo $user['user_id']; ?>"><button class="btn-danger btn">Cancel</button></span>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $("#del<?php echo $user['user_id']; ?>").click(function(){
  $("#fetch<?php echo $user['user_id']; ?>").toggle("slow");
  })
  $("#clear<?php echo $user['user_id']; ?>").click(function(){
  $("#fetch<?php echo $user['user_id']; ?>").hide("slow"); 
})
})                     
</script>
<?php 
$id = $user['user_id'];
// echo $id;
  if (isset($_POST['edit'.$id])) {
    //   echo "<script>alert('ERROR')</script>";

    $arabic_class = $_POST['arabic_class'.$id];
    $session = $_GET['session'];
    echo $arabic_class." ". $session;
    $update = mysqli_query($connect, "UPDATE students SET arabic_class = '{$arabic_class}' WHERE user_id = '{$user['user_id']}' && session = '{$session}'");
    if ($update) {
      header('location: a_students?class='.$class.'&session='.$session.'&success');
      // echo "Successful";
    }
  }

 ?>
<?php }} ?>
</div>
</body>
</html>
    <?php #include '../inc/footer.php'; ?>
