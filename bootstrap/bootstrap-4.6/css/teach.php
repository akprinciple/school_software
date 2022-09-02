<?php
ob_start(); 
    include 'inc/session.php';
$msg = "";

 if (isset($_GET['success'])) {
      $msg = "<script>alert('Update Successful');</script>";
      
    }
if (isset($_POST['submit'])) {
$name = mysqli_real_escape_string($connect, $_POST['name']);
$subject =  $_POST['subject'];
$session = mysqli_real_escape_string($connect, $_POST['session']);
$dob = mysqli_real_escape_string($connect, $_POST['dob']);
$gender = mysqli_real_escape_string($connect, $_POST['gender']);
$code = "FMSC/".date('ym').rand(000, 999);
$date= date('d/M/Y');

if ($session == "--Select Session--" || $gender == "--Select Gender--") {
$msg = "<div class='p-2 rounded text-danger text-center mb-2 mt-2'>Selection Error. Please try Again!</div>";
}
else{
$select = mysqli_query($connect, "SELECT * FROM teachers WHERE code = '$code'");
$count = mysqli_num_rows($select);
if ($count > 0) {
  "<div class='p-2 rounded alert-danger mb-2 mt-2'>Kindly try Again!</div>";
}
else{


  $check = mysqli_query($connect, "SELECT * FROM teachers WHERE name = '$name' && session = '$session'");
  $counter = mysqli_num_rows($check);
  if ($counter > 0) {
    $msg = "<div class='p-2 rounded text-danger text-center mb-2 mt-2'>User is already existing</div>";
  }else{
    foreach($subject as $sub){

$sql = "INSERT INTO teachers(name, session, gender, dob, code, subject, date) VALUES ('$name', '$session', '$gender', '$dob', '$code', '$sub', '$date')";
$query = mysqli_query($connect, $sql);
    }
if ($query) {

  # code...
$msg = "<div class='p-2 rounded text-success text-center mb-2 mt-2'>$name was Added Successfully</div>";
}

else{
$msg = "<div class='p-2 rounded alert-danger mb-2 mt-2'>Error</div>";
}
}
}
}
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Teachers | Fidelity Schools</title>
  <?php include 'inc/link.php'; ?>
</head>
<body>
  <div>
  
<div class="">

            <div class="row ml-0 mr-0">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
            <h4 class="mt-3">All Users</h4>
            <?php include 'inc/hr.php'; ?>


            <div class="row mx-0">
<form class="col-md-8 row border-right mx-0">

  
  


  <div class="form-group col-md-6 p-1">
  <label class="font-weight-bold">Class</label>
  <br>
  <select class="form-control" name="teacher">
  <?php 
  if (!isset($_GET['teacher']) && !isset($_GET['session'])) {
    echo "<option>--Select Teacher--</option>";
  }
  
  else {
  echo $_GET['teacher'];
  } 
  ?>
  
  <?php 
  $sql = "SELECT DISTINCT name FROM  teachers";
  $query = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option><?php echo $row['name']; ?></option>
  <?php } ?>
  </select>
  </div>



  <div class="form-group col-md-6 p-1">
  <label class="font-weight-bold">Session</label>
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
<a id="click" class="pointer text-success fas fa-plus mr-2" title="Add New Teacher"></a> 
<!-- <span class="">/</span> -->
<a href="teachers" class="text-success fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span> 
<div class="clearfix"></div>
            <div class="">
              <div class=" mt-3 border-bottom" id="reg" style="<?php #if (!isset($_POST['submit'])) {
                echo "display: none";
              #} ?> " >
                <h5 class="text-center font-weight-bold border-bottom">Add New Teacher</h5>
                <?php echo $msg; ?>
                <form method="post" enctype="multipart/form-data">
                  <div class="row mx-0">
                  <div class="form-group col-md-6">
                  <span class="text-danger font-weight-bold">*</span><b> Name</b>
                  <input type="text" name="name" required="required" class="form-control" placeholder="Input Full Name (Surname first)" value="<?php if (isset($_POST['name'])) {
                echo "{$_POST['name']}";
              } ?>" required="required" autofocus>
                  </div>
                  

                  

                  

                  <div class="form-group col-md-6">
                  <span class="text-danger font-weight-bold">*</span> <b>Session</b>
                  <select name="session" class="form-control">
                    <?php 
                    if (isset($_POST['submit']) && $_POST['session'] !== "--Select Session--"){
                     ?>
                    }
                    <option value="<?php  echo "{$_POST['session']}"; ?>">
                      <?php 
                      $slt = mysqli_query($connect, "SELECT * FROM session WHERE id ='{$_POST['session']}' ");
                      $sow = mysqli_fetch_array($slt);
                      echo $sow['session'];
                       ?>

                    </option>

                 

              
                      <?php  }else {
                           ?>
                    <option>--Select Session--</option>

                  <?php } ?>
                    <?php 
                      $sql = "SELECT * FROM session";
                      $query = mysqli_query($connect, $sql);
                      while ($row = mysqli_fetch_array($query)) {
                        
                      
                     ?>
                     <option value="<?php echo $row['id']; ?>"><?php echo $row['session']; ?></option>
                     <?php } ?>
                  </select>
                  
                  </div>

                  <div class="form-group col-md-6">
                  <span class="text-danger font-weight-bold">*</span> <b>Gender</b>
                  <select name="gender" class="form-control">
                    <option>--Select Gender--</option>
                    
                     <option value="male">Male</option>
                     <option value="female">Female</option>
                     
                  </select>
                  
                  </div>

                  <div class="form-group col-md-6">
                    <b>Date of Birth</b>
                  <input type="date" name="dob" class="form-control">
                    
                  
                  </div>
                  <div class="form-group mt-3 row mx-0">
               
<?php 
  $sql = "SELECT * FROM subjects";
  $query = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($query)) {
    
  
 ?>
 <div class="col-md-3">
 <input type="checkbox" name="subject[]" value="<?php echo $row['id']; ?>"> <?php echo $row['subject']; ?><br>
 </div>
 <?php } ?>


</div>
                 
                  <div class="col-md-6"></div>
                  <div class=" col-md-6">
                  <button class="btn btn-success my-2 float-right" name="submit" type="submit">Add User</button>
                 <div class="clearfix"></div>
                  </div>
                  </div>
                </form>
              </div>
              


<form method= "post" enctype="mltipart/form-data">

<?php
       if (isset($_GET['teacher'])  && isset($_GET['session'])) {
             $session = $_GET['session'];
           $name = $_GET['teacher'];
                   
   $select = "SELECT * FROM subjects WHERE EXISTS (SELECT * FROM teachers WHERE subject = subjects.id && name = '{$name}')";
          $show = mysqli_query($connect, $select);
        
          $count = mysqli_num_rows($show);
         
          foreach($show AS $teach){
      
    
       

 ?> <div class="form-check">
     <input type="checkbox" checked="checked" class="form-check-input form-check-inline" name="subj<?php echo $teach['id']; ?>" value="<?php echo $teach['subject']; ?>"><?php echo $teach['subject']; ?><br>
     </div>
          <?php
          $id = $teach['id'];
          if(isset($_POST['update']) && empty($_POST['subj'.$id])){
            $del = mysqli_query($connect, "DELETE FROM teachers WHERE subject = '{$id}'");
          }
          }
          $select = "SELECT * FROM subjects WHERE !EXISTS (SELECT * FROM teachers WHERE subject = subjects.id && name = '{$name}')";
          $show = mysqli_query($connect, $select);
        
          $count = mysqli_num_rows($show);
         
          foreach($show AS $teach){
            $id = $teach['id'];
            if(isset($_POST['update']) && !empty($_POST['subj'.$id])){
              $del = mysqli_query($connect, "INSERT INTO teachers (name, session, subject) VALUES('$name', '$session', '$id')");
            }
    
       

 ?>
     <input type="checkbox" name="subj<?php echo $teach['id']; ?>" value="<?php echo $teach['subject']; ?>"><?php echo $teach['subject']; ?><br>
          <?php
          if(isset($_POST['update'])){
            header('location: teachers?teacher='.$name.'&&session='.$session.'');
          }
          }
       
        ?>

<button type="submit" name="update" class="btn btn-success">Update</button>
<?php  } ?>
</form>




























              <!-- Search by Student by class and Session -->
<?php 
if (isset($_GET['teach'])  && isset($_GET['session'])) {
    $session = $_GET['session'];
    $name = $_GET['teacher'];
    // $arm = $_GET['arm'];

  $select = "SELECT * FROM teachers WHERE name ='{$name}'";
  $show = mysqli_query($connect, $select);

  $count = mysqli_num_rows($show);
  ?>   


  <h5><?php echo $count; ?> Results Found</h5>    
      <table class="table table-striped table-bordered text-center text-capitalize">
  <thead class="bg-success text-light">
  <th>S/N</th>
  <th>Name</th>
  <th>Registration Code</th>
  <th>Username</th>
  <th>Password</th>
  
  <th>Actions</th>
  <!-- <th>Actions</th> -->
</thead>
<tbody>
  <?php

  $n = 1; 
  $r_sql = "SELECT * FROM teachers WHERE name ='{$name}' ORDER BY id ASC";
  $r_query = mysqli_query($connect, $r_sql);
    
  while ($r_name = mysqli_fetch_array($r_query)) {
 ?>
  <tr>
  <td><?php echo $n++; ?></td>
  <td><?php 
  echo $name;
  

  ?></td>
  <td>
    <?php 
    echo $r_name['code'];
    ?>
  </td>
  <td>
    <?php 
    $r_name['session'];
   ?>
  </td>
  
  <td>
    <!-- <span class="btn-danger btn fas fa-pen" id="del<?php echo $name; ?>" title="Edit And View Users' Details"></span>
    <a href="view_user?id=<?php echo md5($r_name ['user_id']); ?>" id="update" title="View user's Results" class="">
      <button class="fas fa-eye pointer btn-success btn"></button>
    </a> -->
  </td>
<?php } ?>
</tbody>
</table>

    <?php } ?> 
<!-- Search by keyword -->
    <?php
          if(isset($_GET['search'])){
            $q = $_GET['search'];
            $see = mysqli_query($connect, "SELECT * FROM register WHERE name LIKE '%".$q."%' ORDER BY name ASC");
            $counts = mysqli_num_rows($see);
            $n = 1;        
    ?>

<h5><?php echo $counts; ?> Results Found</h5>    
      <table class="table table-striped table-bordered text-center text-capitalize">
  <thead class="bg-success text-light">
  <th>S/N</th>
  <th>Name</th>
  <th>D.O.B.</th>
  <th>Action</th>
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
   if(isset($_GET['teacher']) && isset($_GET['session'])){
 $u_sql = "SELECT * FROM teachers WHERE name='$name' && session='$session'";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['user_id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.8); min-height: 100%; top: 0; z-index: 2; display: none;">

  <form method="post" enctype="multipart/form-data" class="col-md-9 mx-auto mt-5">
    <h4 class="text-center text-light">Edit User's Details</h4>
    <hr class="bg-white">
    <div class="text-danger text-center">Note that only name and Date of birth are Editable</div>
    <!-- <marquee class="text-light">Note that only name and Date of birth can be Editted</marquee> -->
    <div class="row mx-0">
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Name</label>
        <input type="text" name="name<?php echo $user['user_id']; ?>" required="required" minlength="6" class="form-control text-center" 
            value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['name'];
                  }
             ?>">
      </div>
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Date of Birth</label>
        <input type="date" name="dob<?php echo $user['user_id']; ?>" class="form-control text-center"  
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
         $show_class = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$_GET['class']}'");
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
