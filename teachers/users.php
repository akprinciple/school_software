<?php
ob_start(); 
    include 'inc/session.php';
$msg = "";

 

?>
<!DOCTYPE html>
<html>
<head>
  <title>Students | Fidelity Schools</title>
  <?php include 'inc/link.php'; ?>
</head>
<body>
  <div>
  
<div class="">

            <div class="row ml-0 mr-0">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
            <h4 class="mt-3">Students</h4>
            <?php include 'inc/hr.php'; ?>


            <div class="row mx-0">
<form class="col-md-10 row mx-auto">

  
  


  <div class="form-group col-md-6 p-1">
  <label class="font-weight-bold">Class</label>
  <br>
  <select class="custom-select" name="class">
  
 
  <?php 
  $sql = "SELECT * FROM class WHERE id='{$_SESSION['class']}'";
  $query = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option value="<?php echo md5($row['id']); ?>"><?php echo $row['class']; ?></option>
  <?php } ?>
  </select>
  </div>



  <div class="form-group col-md-6 p-1">
  <label class="font-weight-bold">Session</label>
  <br>
  <select class="custom-select" name="session">
  
  
  
  <?php 
  // $sql = "";
  $query = mysqli_query($connect, "SELECT * FROM session WHERE status = 1 ORDER BY id DESC");
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option value="<?php echo md5($row['id']); ?>"><?php echo $row['session']; ?></option>
  <?php } ?>
  </select>
  <button type="search" class="btn btn-success  rounded float-right mt-2">View</button>
  </div>


<div class="col-md-2">
  
</div>
</form>


  
</div>

















<span class="float-right mb-3 bot-left p-2 bg-white">

<a href="users" class="text-success fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span> 
<div class="clearfix"></div>
            

              <!-- Search by Student by class and Session -->
<?php 
if (isset($_GET['class'])  && isset($_GET['session'])) {
    $session = $_GET['session'];
    $class = $_GET['class'];
    // $arm = $_GET['arm'];

  $select = "SELECT * FROM students WHERE md5(class) ='{$class}'  && md5(session) = '{$session}'";
  $show = mysqli_query($connect, $select);

  $count = mysqli_num_rows($show);
  ?>   


  <h5 class="text-center"><?php echo $count; ?> Results Found</h5>    
      <table class="table table-striped table-bordered text-center text-capitalize">
  <thead class="bg-success text-light">
  <th>S/N</th>
  <th>Name</th>
  <th>Registration Code</th>
  <th>Username</th>
  <th>Actions</th>
  <!-- <th>Actions</th> -->
</thead>
<tbody>
  <?php

  $n = 1; 
  $r_sql = "SELECT * FROM students WHERE md5(class) ='{$class}'  && md5(session) = '{$session}' ORDER BY id ASC";
  $r_query = mysqli_query($connect, $r_sql);
    
  while ($r_name = mysqli_fetch_array($r_query)) {
 ?>
  <tr>
  <td><?php echo $n++; ?></td>
  <!-- Name -->
  <td><?php 
  $name = $r_name['user_id'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['name'];
  }
  

  ?></td>
  <!-- Registration Code -->
  <td>
    <?php 
    $name = $r_name['user_id'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['code'];
  } ?>
  </td>
  <!-- Username -->
  <td>
    <?php 
    $name = $r_name['user_id'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['username'];
  } ?>
  </td>
  
  <td>
    <span class="btn-danger btn fas fa-pen" id="del<?php echo $name; ?>" title="Edit And View Users' Details"></span>
    <a href="view_user?id=<?php echo md5($r_name ['user_id']); ?>" id="update" title="View user's Results" class="">
      <button class="fas fa-eye pointer btn-success btn"></button>
    </a>
  </td>
<?php } ?>
</tbody>
</table>

    <?php } ?> 
<!-- Search by keyword -->
    <?php
          if(isset($_GET['search'])){
            $q = $_GET['search'];
            $see = mysqli_query($connect, "SELECT * FROM register WHERE name LIKE '%".$q."%' && level = 0 ORDER BY name ASC");
            $counts = mysqli_num_rows($see);
            $n = 1;        
    ?>

<h5><?php echo $counts; ?> Results Found</h5>    
      <table class="table table-striped table-bordered text-center text-capitalize">
  <thead class="bg-success text-light">
  <th>S/N</th>
  <th>Name</th>
  <th>Registration Code</th>

  <th>Username</th>
  <!-- <th>Actions</th> -->
</thead>
<tbody>
<?php
 while ($search_row = mysqli_fetch_array($see)){

?>
<tr>
  <td><?php echo $n++; ?></td>
  <td><?php 
  echo $search_row['name'];
  

  ?></td>
  <td>
    <?php 
    echo $search_row['dob'];
   ?>
  </td>
  <td>
    <span class="btn-danger btn fas fa-pen" id="del<?php echo $search_row['id']; ?>" title="Edit And View Users' Details"></span>
    <!-- <a href="view_user.php?id=<?php echo md5($r_name ['user_id']); ?>" id="update" title="View user's Results" class="">
      <button class="fas fa-eye pointer btn-success btn"></button>
    </a> -->
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
 $u_sql = "SELECT * FROM students WHERE md5(class) ='$class' && md5(session) ='$session'";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['user_id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.8); min-height: 100%; top: 0; z-index: 2; display: none;">
<?php echo  $user['class']; ?>
  <div class="col-md-9 mx-auto mt-5">
    <h4 class="text-center text-light">View User's Details</h4>
    <hr class="bg-white">
   
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
        <label class="font-weight-bold text-light">Date of Birth</label>
        <input type="text" readonly name="dob<?php echo $user['user_id']; ?>" class="form-control text-center"  
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
        <input type="text" disabled="disabled" class="form-control text-center" value="<?php 
         $show_class = mysqli_query($connect, "SELECT * FROM class WHERE md5(id) = '{$_GET['class']}'");
          $sho = mysqli_fetch_array($show_class);
          echo $sho['class'];
          //  $show_arm = mysqli_query($connect, "SELECT * FROM arms WHERE id = '{$_GET['arm']}'");
          // $show = mysqli_fetch_array($show_arm);
          // echo $show['arm'];
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
         $show_class = mysqli_query($connect, "SELECT * FROM session WHERE md5(id) = '{$_GET['session']}'");
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
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Arabic Class</label>
        <input type="text" disabled="disabled" class="form-control text-center" value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM arabic_class WHERE id = '{$user['arabic_class']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['class'];
                  }
             ?>">
      </div>
      <!-- <div class="col-md-6"></div> -->
      
      
                
    </div>
  </div>






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
$id = $user['id'];
// echo $id;
  if (isset($_POST['edit'.$id])) {
      // echo "<script>alert('ERROR')</script>";

    $name = $_POST['name'.$id];
    $dob = $_POST['dob'.$id];
    $update = mysqli_query($connect, "UPDATE register SET name = '{$name}', dob = '{$dob}' WHERE id = '{$user['user_id']}'");
    if ($update) {
      header('location: users?class='.$class.'&session='.$session.'&success');
      // echo "Successful";
    }else{
      echo "<script>
             alert('Error');
      </script>";
    }
  }

 ?>
<?php }} ?>
</div>
</body>
</html>
    <?php #include '../inc/footer.php'; ?>
