<?php
ob_start(); 
    include 'inc/session.php';
$msg = "";

 if (isset($_GET['success'])) {
      $msg = "<script>alert('Update Successful');</script>";
      
    }
    if (isset($_GET['Image_success'])) {
      $msg = "<script>alert('Image Successfully updated');</script>";
      
    }
if (isset($_POST['submit'])) {

$name = mysqli_real_escape_string($connect, $_POST['name']);
$class = mysqli_real_escape_string($connect, $_POST['class']);
$arabic_class = mysqli_real_escape_string($connect, $_POST['arabic_class']);
$session = mysqli_real_escape_string($connect, $_POST['session']);
$dob = mysqli_real_escape_string($connect, $_POST['dob']);
$parent = mysqli_real_escape_string($connect, $_POST['parent']);
$gender = mysqli_real_escape_string($connect, $_POST['gender']);
$code = "FMSC/".rand(1000, 9999);
$date= date('d/M/Y');
$image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];
$type = pathinfo("upload/$image", PATHINFO_EXTENSION);
if ($class == "--Select Class--" || $parent == "Select Parent" || $session == "--Select Session--" || $gender == "--Select Gender--") {
$msg = "<div class='p-2 rounded text-danger text-center mb-2 mt-2'>Selection Error. Please try Again!</div>";
}
else{
$select = mysqli_query($connect, "SELECT * FROM register WHERE code = '$code'");
$count = mysqli_num_rows($select);
if ($count > 0) {
  "<div class='p-2 rounded alert-danger mb-2 mt-2'>Kindly try Again!</div>";
}else{
  $check = mysqli_query($connect, "SELECT * FROM register WHERE name = '$name' && class ='$class' && session = '$session' && arabic_class = '$arabic_class'");
  $counter = mysqli_num_rows($check);
  if ($counter > 0) {
    $msg = "<div class='p-2 rounded text-danger text-center mb-2 mt-2'>User is already existing</div>";
  }else{
    if ($_FILES["image"]["size"] > 100000) {
      $msg = "<div class='text-center text-danger p-2  font-weight-bold'>Sorry, your file size should be less than 100kb.</div>";
      }
      elseif ($type != "JPG" && $type != "jpg"  && $type != "PNG" && $type != "png" && $type != "") {
            $msg = "<div class='text-danger text-center p-2 font-weight-bold'>Only jpg and png files are allowed</div>";
          }else{

$sql = "INSERT INTO register(name, gender, code, parent, class, arabic_class, session, dob, date, image) VALUES ('$name', '$gender', '$code', '$parent', '$class', '$arabic_class', '$session', '$dob', '$date', '$image')";
$query = mysqli_query($connect, $sql);
if ($query) {
  move_uploaded_file($tmp, "../images/$image");
$fetch = mysqli_query($connect, "SELECT * FROM register WHERE name = '$name' && class ='$class' && session = '$session' && arabic_class = '$arabic_class' ORDER BY id DESC LIMIT 1");
$vet = mysqli_fetch_array($fetch);
$user_id = $vet['id'];
$insert = mysqli_query($connect, "INSERT INTO students (user_id, class, arabic_class, session) VALUES ('$user_id', '$class', '$arabic_class', '$session')");
if ($insert) {
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
}
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
  
<div class="">

            <div class="row ml-0 mr-0">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
            <h4 class="mt-3">Students</h4>
            <?php include 'inc/hr.php'; ?>


            <div class="row mx-0">
<form class="col-md-8 row border-right mx-0">

  
  


  <div class="form-group col-md-6 p-1">
  <label class="font-weight-bold">Class</label>
  <br>
  <select class="form-control" name="class">
  <?php 
  if (!isset($_GET['class']) && !isset($_GET['session'])) {
    echo "<option>--Select Class--</option>";
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

















<span class="float-right  p-2">
  <a id="click" class="pointer btn btn-success fas fa-plus " title="Add new Student"></a> 
  <!-- Export Button -->
<?php  
    if (isset($_GET['class'])  && isset($_GET['session'])) {
    $session = $_GET['session'];
    $class = $_GET['class'];
 ?>
<a href="export/export_students?class=<?php echo $class; ?>&session=<?php echo $session; ?>" class="pointer btn btn-primary fas fa-file-csv " title="Export as CSV"></a> 
<?php } ?>
<?php  
    if (!isset($_GET['class'])  && !isset($_GET['session'])) {
    
 ?>
<a href="export/export_students?all" class="pointer btn btn-primary fas fa-file-csv " title="Export all students details as CSV"></a> 
<?php } ?>
<!-- Import Button -->
  <a href="javascript:void(0)" onclick="import_csv()" class="pointer btn btn-warning text-light fas fa-file-import " title="Import CSV file"></a> 
<!-- Refresh Button -->
<a href="users" class="btn btn-danger fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span> 
<div class="clearfix"></div>




<?php
            if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Student data has been imported successfully.';
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
                <h5 class="text-center font-weight-bold border-bottom">Import Students</h5>
               
                <form method="post" action="import/import_students.php" enctype="multipart/form-data">
                  
                  
                  
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

    <!-- Add new Student section -->

            <div class="">
              <div class=" mt-3 border-bottom" id="reg" style="<?php if (!isset($_POST['submit'])) {
                echo "display: none";
              } ?> " >
                <h5 class="text-center font-weight-bold border-bottom">Add New Student</h5>
                <?php echo $msg; ?>
                <form method="post" enctype="multipart/form-data">
                <div class="col-md-3 m-auto">
                      <img src="../images/avatar5.png" alt="User's Avatar" class="rounded w-100">
                      <div class="form-group">
                        <input type="file" name="image" id="" class="form-control" accept=".jpg,.png">
                      </div>
                  </div>
                  <div class="row mx-0">
                  <!-- User's Image -->
                  
                  <div class="form-group col-md-6">
                  <span class="text-danger font-weight-bold">*</span><b> Name</b>
                  <input type="text" name="name" required="required" class="form-control" placeholder="Input Full Name (Surname first)" value="<?php if (isset($_POST['name'])) {
                echo "{$_POST['name']}";
              } ?>" required="required" autofocus>
                  </div>
                  

                  <div class="form-group col-md-6">
                  <span class="text-danger font-weight-bold">*</span> <b>Class</b>
                  <select name="class" class="form-control">
                    <?php if (isset($_POST['submit']) && $_POST['class'] !== "--Select Class--") {

                    ?>
                    <option value=" <?php echo "{$_POST['class']}";?>">
                <?php
                
                 $slt = mysqli_query($connect, "SELECT * FROM class WHERE id ='{$_POST['class']}' ");
                $sow = mysqli_fetch_array($slt);
                echo $sow['class'];
              

              ?>
            </option>
            <?php
              }else{
               ?>
               <option>--Select Class--</option>
               <?php
              } 

              ?>

                      
                    </option>
                    <?php 
                      $sql = "SELECT * FROM class";
                      $query = mysqli_query($connect, $sql);
                      while ($row = mysqli_fetch_array($query)) {
                        
                      
                     ?>
                     <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
                     <?php } ?>
                  </select>

                  </div>

                  <div class="form-group col-md-6">
                   <b>Arabic Class</b>
                  <select name="arabic_class" class="form-control">
                    <?php
                  if (isset($_POST['submit']) && $_POST['arabic_class'] !== "--Select Arabic Class--") {
                    ?>

                    <option value="<?php echo "{$_POST['arabic_class']}"; ?>" >
                      <?php 
                
                 $slt = mysqli_query($connect, "SELECT * FROM arabic_class WHERE id ='{$_POST["arabic_class"]}' ");
                $sow = mysqli_fetch_array($slt);
                echo $sow['class'];
                ?>
                    </option>

               <?php  }else{ ?> 

                  <option>--Select Arabic Class--</option>
              <?php 
              } ?>
                    <!-- <option>--Select Arabic Class--</option> -->
                    <?php 
                      $sql = "SELECT * FROM arabic_class";
                      $query = mysqli_query($connect, $sql);
                      while ($row = mysqli_fetch_array($query)) {
                        
                      
                    ?>
                     <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
                     <?php } ?>
                  </select>
                  
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
                  <input type="date" name="dob" class="form-control" value="">
                    
                  
                  </div>
                  <div class="col-md-6">
                 <b>Parent/Sponsor</b>
                 <select class="custom-select" name="parent">
                    <option value="0">Select Parent</option>
                    <?php
                        $all = mysqli_query($connect, "SELECT * FROM register WHERE level = 3 ORDER BY name ASC");
                        foreach($all as $call){
                    ?>

                    <option value="<?php echo $call['id']; ?>"><?php echo $call['name']; ?></option>
                        <?php } ?>
                 </select>
                  </div>
                 
                  <!-- <div class="col-md-6"></div> -->
                  <div class=" col-md-6">
                  <button class="btn btn-success w-100 mt-4 mb-3" name="submit" type="submit">Add User</button>
                  </div>
                  </div>
                </form>
              </div>

              <!-- Search by Student by class and Session -->
<?php 
if (isset($_GET['class'])  && isset($_GET['session'])) {
    $session = $_GET['session'];
    $class = $_GET['class'];
    // $arm = $_GET['arm'];

  $select = "SELECT * FROM students WHERE class ='{$class}'  && session = '{$session}'";
  $show = mysqli_query($connect, $select);

  $count = mysqli_num_rows($show);
  ?>   


  <h5 class="text-center"><?php echo $count; ?> Result(s) Found</h5>    
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
  $r_sql = "SELECT * FROM students WHERE class ='{$class}'  && session = '{$session}' ORDER BY (SELECT name FROM register WHERE id = user_id) ASC";
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
    $name = $r_name['user_id'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['code'];
  } ?>
  </td>
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
    <?php 
    $name = $r_name['user_id'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['password'];
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
   if(isset($_GET['class']) && isset($_GET['session'])){
 $u_sql = "SELECT * FROM students WHERE class='$class' && session='$session'";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['user_id']; ?>" class="w-100 position-absolute position-fixed " style="background-color: rgba(0,0,0,0.8); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class="row mx-0" style="height: 600px; overflow-y: scroll">
  <div class="col-md-6 mt-2">
    <h4 class="text-center text-light">Edit User's Details</h4>
    <hr class="bg-white">
    <!-- <div class="text-danger text-center">Note that only name and Date of birth are Editable</div> -->
    <!-- <marquee class="text-light">Note that only name and Date of birth can be Editted</marquee> -->
    <form method="post" enctype="multipart/form-data" class="col-md-4 m-auto">
    
    <?php 
        $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
        while ($user_row = mysqli_fetch_array($sl)){
          if(!empty($user_row['image'])){    
            ?>
    <img src="../images/<?php echo $user_row['image']; ?>" alt="User Image" class="card-img">
        <?php }else{ ?>
    <img src="../images/avatar5.png" alt="User Image" class="card-img">
        <?php }} ?>
        <input type="file" name="image<?php echo $user['user_id']; ?>" class="form-control" accept=".jpg,.png">
        <input type="submit" name="upload<?php echo $user['user_id']; ?>" value="Change Image" class="btn btn-success float-right my-2">
        <div class="clearfix"></div>
         </form>
            <form method="post" enctype="multipart/form-data">
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
        <input type="text" name="dob<?php echo $user['user_id']; ?>" class="form-control text-center"  
            value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['dob'];
                  }
             ?>">
      </div>
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Username</label>
        <input type="text" name="username<?php echo $user['user_id']; ?>" required="required" class="form-control text-center" 
            value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['username'];
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
        <label class="font-weight-bold text-light">Password</label>
        <input type="text" name="password<?php echo $user['user_id']; ?>" required="required" minlength="4" class="form-control text-center" 
            value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['password'];
                  }
             ?>">
      </div>
      <div class="col-md-6">
                 <b>Parent/Sponsor</b>
                 <select class="custom-select" name="parent<?php echo $user['user_id']; ?>">
                 <?php
                  $select_student = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
                  while ($user_row = mysqli_fetch_array($select_student)){
                    if($user_row['parent'] == 0){
                 ?>
                    <option value="0">Select Parent</option>
                    <?php }else{ 
                      $select_parent = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user_row['parent']}'");
                      foreach($select_parent as $call){
                             echo "<option value='{$call['id']}'>{$call['name']}</option>";
                      }
                      ?>
                      
                    <?php }} ?>
                    <?php
                        $all = mysqli_query($connect, "SELECT * FROM register WHERE level = 3 ORDER BY name ASC");
                        foreach($all as $call){
                    ?>

                    <option value="<?php echo $call['id']; ?>"><?php echo $call['name']; ?></option>
                        <?php } ?>
                 </select>
                  </div>
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
      
      <div class="col-md-6 mt-4 text-right mb-4 mx-auto">
      <button type="submit" name="edit<?php echo $user['user_id']; ?>" class="btn btn-success w-50">Update</button>
      <button type="reset" class="btn btn-primary">Reset</button>
        </div>
                
    </div>
  </form>
  </div>

<div class="col-md-6 text-light">
         <h4 class="text-center text-light mb-0 mt-2">Sponsor's/Parent's Details</h4>   
    <hr class="bg-white">

    <b>Sponsor's/Parent's name: </b><br>
    <div class="border-bottom text-center p-1 mb-2">
    <?php 
      $select_student = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
      while ($user_row = mysqli_fetch_array($select_student)){
      $select_parent = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user_row['parent']}'");
       foreach($select_parent as $call){
         if($call['name'] == "male"){
           echo "Mr. ";
         }else{
           echo "Mrs. ";
         }
              echo $call['name'];
       }
      }
     ?>
    </div>

    <b>Registration Code: </b><br>
    <div class="border-bottom text-center mb-2 p-1">
    <?php 
      $select_student = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
      while ($user_row = mysqli_fetch_array($select_student)){
      $select_parent = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user_row['parent']}'");
       foreach($select_parent as $call){
              echo $call['code'];
       }
      }
     ?>
    </div>

    <b>Phone Number: </b><br>
    <div class="border-bottom text-center mb-2 p-1">
    <?php 
      $select_student = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
      while ($user_row = mysqli_fetch_array($select_student)){
      $select_parent = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user_row['parent']}'");
       foreach($select_parent as $call){

        ?>
            <a href='tel:<?=$call["phone"]; ?>' class="text-light"><?=$call['phone']; ?></a>
        <?php
              echo "";
       }
      }
     ?>
    </div>

    <b>Email: </b><br>
    <div class="border-bottom text-center mb-2 p-1">
    <?php 
      $select_student = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
      while ($user_row = mysqli_fetch_array($select_student)){
      $select_parent = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user_row['parent']}'");
       foreach($select_parent as $call){

        ?>
          <a href="mailto: <?php echo $call['email']; ?>" class="text-light"><?php echo $call['email']; ?></a>
        <?php
              
       }
      }
     ?>
    </div>

    <b>Occupation: </b><br>
    <div class="border-bottom text-center mb-2 p-1">
    <?php 
      $select_student = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
      while ($user_row = mysqli_fetch_array($select_student)){
      $select_parent = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user_row['parent']}'");
       foreach($select_parent as $call){
              echo $call['job'];
       }
      }
     ?>
    </div>

    <b>Home Address: </b><br>
    <div class="border-bottom text-center mb-2 p-1">
    <?php 
      $select_student = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['user_id']}'");
      while ($user_row = mysqli_fetch_array($select_student)){
      $select_parent = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user_row['parent']}'");
       foreach($select_parent as $call){
              echo $call['address'];
       }
      }
     ?>
    </div>
</div>




</div>
<div class=" w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">

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

if (isset($_POST['upload'.$id])) {
  $image = $_FILES['image'.$id]['name'];
  $tmp = $_FILES['image'.$id]['tmp_name'];
$type = pathinfo("upload/$image", PATHINFO_EXTENSION);
if ($_FILES["image".$id]["size"] > 100000) {
  echo "<script>
  alert('Sorry, your file size should be less than 100kb.');
</script>";
  }
  elseif ($type != "JPG" && $type != "jpg"  && $type != "PNG" && $type != "png" && $type != "") {
   echo "<script>
    alert('Only jpg and png files are allowed');
</script>";
      }else{
        move_uploaded_file($tmp, "../images/$image");        
        $file_sql = mysqli_query($connect, "UPDATE register SET image = '{$image}' WHERE id = '{$user['user_id']}'"); 
        if ($file_sql) {
          header('location: users?class='.$class.'&session='.$session.'&Image_success');
          echo "<script>
  alert('Users Image update was successful');
</script>";
        }
      }
}
if (isset($_POST['edit'.$id])) {
 
      
    $name = $_POST['name'.$id];
    $dob = $_POST['dob'.$id];
    $username = $_POST['username'.$id];
    $password = $_POST['password'.$id];
    $parent = $_POST['parent'.$id];
    $update = mysqli_query($connect, "UPDATE register SET name = '{$name}', dob = '{$dob}', username = '{$username}', password = '{$password}', parent = '{$parent}' WHERE id = '{$user['user_id']}'");
    if ($update) {
      header('location: users?class='.$class.'&session='.$session.'&success');
      echo "Successful";
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
