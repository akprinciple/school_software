<?php
ob_start(); 
    include 'inc/session.php';
$msg = $phone = $email = $address = $job = $username = "";

 if (isset($_GET['success'])) {
      $msg = "<script>alert('Update Successful');</script>";
      
    }
if (isset($_POST['submit'])) {
$name = mysqli_real_escape_string($connect, $_POST['name']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$username = mysqli_real_escape_string($connect, $_POST['username']);
$phone = mysqli_real_escape_string($connect, $_POST['phone']);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$address = mysqli_real_escape_string($connect, $_POST['address']);
$job = mysqli_real_escape_string($connect, $_POST['job']);
$gender = mysqli_real_escape_string($connect, $_POST['gender']);
$code = "FP/".date('ym').rand(1000, 9999);
$date= date('d/M/Y');
$level = 3;
$status  = 1;
if ($gender == "--Select Gender--") {
$msg = "<div class='p-2 rounded text-danger text-center mb-2 mt-2'>Selection Error. Please try Again!</div>";
}
else{
$select = mysqli_query($connect, "SELECT * FROM register WHERE username = '$username'");
$count = mysqli_num_rows($select);
if ($count > 0) {
 $msg = "<div class='p-2 rounded text-danger text-center mb-2 mt-2'>Username has been Chosen</div>";
}else{
  $check = mysqli_query($connect, "SELECT * FROM register WHERE name = '$name' && email ='$email'");
  $counter = mysqli_num_rows($check);
  if ($counter > 0) {
    $msg = "<div class='p-2 rounded text-danger text-center mb-2 mt-2'>User is already existing</div>";
  }else{

$sql = "INSERT INTO register(name, username, password, gender, code, phone, email, address, job, date, level, status) VALUES ('$name', '$username', '$password', '$gender', '$code', '$phone', '$email', '$address', '$job', '$date', '$level', '$status')";
$query = mysqli_query($connect, $sql);
if($query){
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
  <title>Parents | Fidelity Schools</title>
  <?php include 'inc/link.php'; ?>
  <script type="text/javascript">
    function finder(val) {
               $.ajax({
                  type: "GET",
                  url: "ajax_ward.php",
                  data: 'set='+val,
                  success: function (data) {
                        $('#student').html(data);
                  }
               })
          }
  </script>
</head>
<body>
  <div>
  
<div class="">

            <div class="row ml-0 mr-0">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
            <h4 class="mt-3">Parents</h4>
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
  <a id="click" class="pointer btn btn-success fas fa-plus " title="Add new Parent/sponsor"></a> 
  <!-- Export Button -->

<a href="export/export_parents?all" class="pointer btn btn-primary fas fa-file-csv " title="Export all parents details as CSV"></a> 
<!-- Import Button -->
  <a href="javascript:void(0)" onclick="import_csv()" class="pointer btn btn-warning text-light fas fa-file-import " title="Import CSV file"></a>
<!-- Refresh Button -->
<a href="parents" class="btn btn-danger fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span> 
<div class="clearfix"></div>
            <?php
            if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Parents data has been imported successfully.';
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
                <h5 class="text-center font-weight-bold border-bottom">Import Parents</h5>
               
                <form method="post" action="import/import_parents.php" enctype="multipart/form-data">
                  
                  
                  
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



            <!-- Add New Parent/Sponsor's Section -->
            <div class="">
              <div class=" mt-3 border-bottom" id="reg" style="<?php if (!isset($_POST['submit'])) {
                echo "display: none";
              } ?> " >
                <h5 class="text-center font-weight-bold border-bottom">Add New Parent/Sponsor</h5>
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
                  <b>Username</b>
                 <input type="text" name="username" class="form-control" placeholder="Choose a username"  value="<?php echo $username; ?>">

                  </div>

                  <div class="form-group col-md-6">
                  <b>Password</b>
                 <input type="text" name="password" class="form-control" placeholder="Choose a password"  value="123456">

                  </div>
                  <div class="form-group col-md-6">
                  <b>phone Number</b>
                 <input type="number" name="phone" class="form-control" placeholder="+234 80* *** **** "  value="<?php echo $phone; ?>">

                  </div>

                  <div class="form-group col-md-6">
                  <b>Email</b>
                 <input type="email" name="email" class="form-control" placeholder="Enter the email address"  value="<?php echo $email; ?>">

                  </div>

                  <div class="form-group col-md-6">
                  <b>Occupation</b>
                 <input type="text" name="job" class="form-control" placeholder="Occupation"  value="<?php echo $job; ?>">

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
                  <b>Home Address</b>
                    <textarea placeholder="Enter Parent's Address" name="address" class="form-control"></textarea>
                  
                  </div>
                 
                  
                  <div class="w-100 text-center">
                  <button class="btn btn-success my-2 " name="submit" type="submit">Add User</button>
                  <button class="btn btn-danger my-2 " type="reset">Reset</button>
                  </div>
                  
                </form>
              </div>
</div>
        <!-- Parents without Children -->
        <?php
          if (!isset($_GET['class']) && !isset($_GET['session']) && !isset($_GET['search'])) {
          $sponsor = mysqli_query($connect, "SELECT * FROM register WHERE level = 3 && id != ALL(SELECT parent FROM register WHERE level = 0) ORDER BY id DESC");
          $n = 1;
          if ($sponsor->num_rows > 0) {
            # code...
          
        ?>

<h4 class="text-center">Parents/Sponsors with Zero number of Wards</h4>
         <table class="table table-striped table-bordered text-center text-capitalize">
  <thead class="bg-success text-light">
  <th>S/N</th>
  <th>Name</th>
  <th>Registration Code</th>

  <th>Username</th>
  <th>Password</th>
  <th>Number of wards</th>
  <th>Action</th>
</thead>
<tbody>
<?php 
  foreach ($sponsor as $key) {
            
          

 ?>
 <tr>
   <td><?php echo $n++; ?></td>
   <td><?php echo $key['name']; ?></td>
   <td><?php echo $key['code']; ?></td>
   <td><?php echo $key['username']; ?></td>
   <td><?php echo $key['password']; ?></td>
   <td>
     <?php 
      $parent = mysqli_query($connect, "SELECT COUNT(id) AS num FROM register WHERE parent = '{$key['id']}'");
      foreach ($parent as $k) {
       echo $k['num'];
      }
     ?>

   </td>
   <td>
    <span class="btn-danger btn fas fa-pen" id="del<?php echo $key['id']; ?>" title="Edit And View Users' Details"></span>
     
   </td>
 </tr>

<?php } ?>
</tbody>
</table>
<?php }} ?>




              <!-- Search by Student by class and Session -->
<?php 
if (isset($_GET['class']) && isset($_GET['session'])) {
    $session = $_GET['session'];
    $class = $_GET['class'];
    // $arm = $_GET['arm'];

  $select = "SELECT * FROM register WHERE EXISTS (SELECT * FROM students WHERE students.class ='{$class}'  && students.session = '{$session}' && register.parent != 0 && register.id = students.user_id)";
  $show = mysqli_query($connect, $select);
 $n = 1;
  $counts = mysqli_num_rows($show);
  ?>   


  <h5 class="text-center">Parents of Students of 
  <?php
  $sq = "SELECT * FROM class WHERE id = '{$_GET['class']}'";
  $quer = mysqli_query($connect, $sq);
  while ($rw = mysqli_fetch_array($quer)) {
    echo $rw['class']; }
    ?> Class of
   <?php
  $s = "SELECT * FROM session WHERE id = '{$session}'";
  $que = mysqli_query($connect, $s);
  while ($rw = mysqli_fetch_array($que)) {
    echo $rw['session']; }
    ?>
    Session. (<?php echo $counts; ?> Result(s) Found)</h5>    
      <table class="table table-striped table-bordered text-center text-capitalize">
  <thead class="bg-success text-light">
  <th>S/N</th>
  <th>Name</th>
  <th>Registration Code</th>
  <th>Ward's name</th>
  <th>Username</th>
  
  <th>Password</th>
  <th>No of Children</th>
  <th>Actions</th>
</thead>
<tbody>
  <?php

  
  
    
  while ($r_name = mysqli_fetch_array($show)) {
 ?>
  <tr>
  <td><?php echo $n++; ?></td>
  <td><?php 
  $name = $r_name['parent'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['name'];
  }
  

  ?></td>
  <td>
    <?php 
    $name = $r_name['parent'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['code'];
  } ?>
  </td>
  <td>
   
<?php 
    $name = $r_name['id'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['name'];
  } ?>
  </td>
  
  <td>
  <?php 
    $name = $r_name['parent'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['username'];
  } ?>


  </td>
  <td>
    <?php 
    $name = $r_name['parent'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");
  while ($pro = mysqli_fetch_array($s_name)) {
    echo $pro['password'];
  } ?>
  </td>
  <td>
  <?php 
    $name = $r_name['parent'];
  $r_id = $r_name['id'];

  $s_name = mysqli_query($connect, "SELECT * FROM register WHERE parent = '{$name}'");
    echo mysqli_num_rows($s_name);
  ?>
  </td>
  <td>
    <span class="btn-danger btn fas fa-pen" id="del<?php echo $r_name['id']; ?>" title="Edit And View Users' Details"></span>
    <!-- <a href="view_user?id=<?php echo md5($r_name ['user_id']); ?>" id="update" title="View user's Results" class="">
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
            $see = mysqli_query($connect, "SELECT * FROM register WHERE name LIKE '%".$q."%' && level = 3 ORDER BY name ASC");
            $counts = mysqli_num_rows($see);
            $n = 1;        
    ?>

<h5 class="text-center">Searching ... <i><?php echo $_GET['search']; ?></i>... (<?php echo $counts; ?> Results Found)</h5>    
      <table class="table table-striped table-bordered text-center text-capitalize">
  <thead class="bg-success text-light">
  <th>S/N</th>
  <th>Name</th>
  <th>Registration Code</th>

  <th>Username</th>
  <th>Password</th>
  <th>Number of wards</th>
  <th>Action</th>
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
    echo $search_row['code'];
   ?>
  </td>
 
  <td>
  <?php 
    echo $search_row['username'];
   ?>
  </td>
  <td>
  <?php 
    echo $search_row['password'];
   ?>
  </td>
  <td>
  <?php 
  $q = mysqli_query($connect, "SELECT * FROM register WHERE parent = '{$search_row['id']}'");
   echo mysqli_num_rows($q);
   ?>
  </td>
  <td>
  <span class="btn-danger btn fas fa-pen" id="del<?php echo $search_row['id']; ?>" title="Edit And View Users' Details"></span>

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
  $u_sql =  "SELECT * FROM register WHERE EXISTS (SELECT * FROM students WHERE students.class ='{$class}'  && students.session = '{$session}' && register.parent != 0 && register.id = students.user_id)";
  
    $u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.8); min-height: 100%; top: 0; z-index: 2; display: none;">
  <div style="height: 600px; overflow-y: scroll;" class="pt-3 text-light row mx-0">
  <form method="post" enctype="multipart/form-data" class="col-md-9 border-right">
    <h5 class="text-center text-light">Edit User's Details</h5>
    <hr class="bg-white">
    <div class="row mx-0">
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Name</label>
        <input type="text" name="name<?php echo $user['parent']; ?>" required="required" minlength="6" class="form-control text-center" 
            value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['name'];
                  }
             ?>">
      </div>
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Username</label>
        <input type="text" name="username<?php echo $user['parent']; ?>" class="form-control text-center"  
            value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['username'];
                  }
             ?>">
      </div>
       
       
       <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Password</label>
        <input type="text" name="password<?php echo $user['parent']; ?>" class="form-control text-center" value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['password'];
                  }
          
         ?>">
      </div>
       <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Phone Number</label>
        <input type="text" name="phone<?php echo $user['parent']; ?>" class="form-control text-center" value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['phone'];
                  } ?>">
      </div>
       <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Email:</label>
        <input type="text" name="email<?php echo $user['parent']; ?>" class="form-control text-center" value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['email'];
                  }
           
                  ?>">
      </div>
                  <div class="col-md-6 form-group">
                    <label class="font-weight-bold text-light">Occupation</label>
                    <input type="text" name="job<?php echo $user['parent']; ?>" class="form-control text-center" value="<?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['job'];
                  }
                         ?>">
                  </div>
                  <div class="col-md-6"></div>
                  <div class="col-md-6 mt-3 mx-auto text-right">
      <button type="submit" name="edit<?php echo $user['parent']; ?>" class="btn btn-success w-50">Update</button>
      <button type="reset"  class="btn btn-primary">Reset</button>
        </div>






        <h5 class="col-md-12 text-center border-bottom mt-4 text-light">Other Details</h5>
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Registration Code</label>
        <div  class="text-light border-bottom text-center"><?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['code'];
                  }
             ?></div>

      </div>
      <div class="col-md-6 form-group">
        <label class="font-weight-bold text-light">Registration Date</label>
        <div  class="text-light border-bottom text-center"><?php 
                $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  while ($user_row = mysqli_fetch_array($sl)){
                    echo $user_row['date'];
                  }
             ?></div>

      </div>
      
    </div>  
                
  </form>
  <form method="post" class="col-md-3">
      <h5 class="text-center">Add Wards</h5>
      <hr class="bg-white">
       <?php 
        $p_id = (int)$user['id'];
      if (isset($_POST['add_ward'.$p_id])) {
        $student = (int)$_POST['student'];
        $parent = (int)$user['parent'];

        if ($student == 0) {
          echo "<script>alert('Selection Error! Try again.')</script>";
        }else{
          $add_student = mysqli_query($connect, "UPDATE register SET parent = '$parent' WHERE id = '{$student}'");
          if ($add_student) {
      header('location: parents?class='.$class.'&session='.$session.'&success');
          }
        }
      }
  ?> 

  <script type="text/javascript">
    function finder<?php echo $p_id; ?>(val) {
               $.ajax({
                  type: "GET",
                  url: "ajax_ward.php",
                  data: 'set='+val,
                  success: function (data) {
                        $('#student<?php echo $p_id; ?>').html(data);
                  }
               })
          }
  </script>
      <div class="form-group">
        <label class="font-weight-bold">Class</label>
  <br>
  <select class="form-control" name="w_class" onchange="finder<?php echo $p_id; ?>(this.value)">
  <option value="0">Select Class</option>
  <?php 
  $sql = "SELECT * FROM class";
  $query = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
  <?php } ?>
  </select>
   <label class="font-weight-bold mt-3">Student's Name</label>
  <br>
  <select class="form-control" name="student" id="student<?php echo $p_id; ?>">
    <option value="0">Select Student</option>
  </select>

  <button class="btn btn-success w-100 mt-3" name="add_ward<?php echo $p_id; ?>" type="submit">Add</button>
</div>
    </form>
    <div class="col-md-12">
      <h5 class="col-md-12 text-light text-center">Wards</h5>
        <?php
          $selt = mysqli_query($connect, "SELECT * FROM register WHERE parent = '{$user['parent']}'");
          $n = 1;
        ?>
        <table class="table text-light table-striped table-bordered text-center">
        <?php foreach($selt as $call){ ?>
       <tr class="mb-5">
       <td><?php echo $n++; ?></td>
       <td><?= $call['name']; ?></td>
       <td>
       <?php
          $student_class = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '{$call['id']}' ORDER BY id DESC LIMIT 1");
          foreach($student_class as $c){
            $s =  mysqli_query($connect, "SELECT * FROM class WHERE id = '{$c['class']}'");
            foreach($s as $x){
              echo $x['class'];
            }
          }
       ?>
       </td>
       </tr>

          <?php } ?>

          </table>
    </div>
    </div>






<div class=" bg-d w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">

<span id="clear<?php echo $user['id']; ?>"><button class="btn-danger btn">Cancel</button></span>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $("#del<?php echo $user['id']; ?>").click(function(){
  $("#fetch<?php echo $user['id']; ?>").toggle("slow");
  })
  $("#clear<?php echo $user['id']; ?>").click(function(){
  $("#fetch<?php echo $user['id']; ?>").hide("slow"); 
})
})                     
</script>
<?php 
$id = $user['parent'];
// echo $id;
  if (isset($_POST['edit'.$id])) {
      // echo "<script>alert('ERROR')</script>";

    $name = $_POST['name'.$id];
    $username = $_POST['username'.$id];
    $password = $_POST['password'.$id];
    $job = $_POST['job'.$id];
    $phone = $_POST['phone'.$id];
    $email = $_POST['email'.$id];
    $update = mysqli_query($connect, "UPDATE register SET name = '{$name}', job = '{$job}', username = '{$username}', password = '{$password}', phone = '{$phone}', email = '{$email}' WHERE id = '{$user['parent']}'");
    if ($update) {
      header('location: parents?class='.$class.'&session='.$session.'&success');
      // echo "Successful";
    }else{
      echo "<script>
             alert('Error');
      </script>";
    }
  }

 ?>
      <!-- // Modal for Editing Search By Username -->
<?php }}
elseif(isset($_GET['search'])){
  $q = $_GET['search'];
 
 
  $u_sql = mysqli_query($connect, "SELECT * FROM register WHERE name LIKE '%".$q."%' && level = 3 ORDER BY name ASC");
  
  $n = 1;
  while ($user = mysqli_fetch_array($u_sql)) {
  ?>
  <div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.8); min-height: 100%; top: 0; z-index: 2; display: none;">
    <div style="height: 600px; overflow-y: scroll;" class="row mx-0 text-light pt-3">
    <form method="post" enctype="multipart/form-data" class="col-md-9 mx-auto border-right">
      <h5 class="text-center text-light">Edit User's Details</h5>
      <hr class="bg-white">
      <div class="row mx-0">
        <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Name</label>
          <input type="text" name="name<?php echo $user['id']; ?>" required="required"  class="form-control text-center" 
              value="<?php 
                  echo $user['name'];
               ?>">
        </div>
        <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Username</label>
          <input type="text" name="username<?php echo $user['id']; ?>" class="form-control text-center"  
              value="<?php 
                  echo $user['username'];
               ?>">
        </div>
         
         
         <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Password</label>
          <input type="text" name="password<?php echo $user['id']; ?>" class="form-control text-center" value="<?php 
                  echo $user['password'];
            
           ?>">
        </div>
         <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Phone Number</label>
          <input type="text" name="phone<?php echo $user['id']; ?>" class="form-control text-center" value="<?php 
                  echo $user['phone'];
                  ?>">
        </div>
         <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Email:</label>
          <input type="text" name="email<?php echo $user['id']; ?>" class="form-control text-center" value="<?php 
                  echo $user['email'];
             
                    ?>">
        </div>
                    <div class="col-md-6 form-group">
                      <label class="font-weight-bold text-light">Occupation</label>
                      <input type="text" name="job<?php echo $user['id']; ?>" class="form-control text-center" value="<?php 
                  $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  echo $user['job'];
                           ?>">
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6 mt-3 mx-auto text-right">
        <button type="submit" name="edit<?php echo $user['id']; ?>" class="btn btn-success w-50">Update</button>
        <button type="reset"  class="btn btn-primary">Reset</button>
          </div>
  
  
  
  
  
  
          <h5 class="col-md-12 text-center border-bottom mt-4 text-light">Other Details</h5>
        <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Registration Code</label>
          <div  class="text-light border-bottom text-center"><?php 
                echo $user['code'];
               ?></div>
  
        </div>
        <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Registration Date</label>
          <div  class="text-light border-bottom text-center"><?php 
                  echo $user['date'];
               ?></div>
  
        </div>
  
       
        <!-- <div class="col-md-6"></div> -->
        
      </div>  
                  
    </form>
    <!-- Form to Add ward for Parents -->
     <form method="post" class="col-md-3">
      <h5 class="text-center">Add Wards</h5>
      <hr class="bg-white">
       <?php 
        $p_id = (int)$user['id'];

      if (isset($_POST['add_ward'.$p_id])) {
        $student = (int)$_POST['student'];
        $parent = (int)$user['id'];

        if ($student == 0) {
          echo "<script>alert('Selection Error! Try again.')</script>";
        }else{
          $add_student = mysqli_query($connect, "UPDATE register SET parent = '$parent' WHERE id = '{$student}'");
          if ($add_student) {
      header('location: parents?search='.$q.'&success');
           
          }
        }
      }
  ?>
   <!-- Ajax script to add ward for parents -->
  <script type="text/javascript">
    function finder<?php echo $p_id; ?>(val) {
               $.ajax({
                  type: "GET",
                  url: "ajax_ward.php",
                  data: 'set='+val,
                  success: function (data) {
                        $('#student<?php echo $p_id; ?>').html(data);
                  }
               })
          }
  </script>
  <!-- Class -->
      <div class="form-group">
        <label class="font-weight-bold">Class</label>
  <br>
  <select class="form-control" name="w_class" onchange="finder<?php echo $p_id; ?>(this.value)">
  <option value="0">Select Class</option>
  <?php 
  $sql = "SELECT * FROM class";
  $query = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
  <?php } ?>
  </select>
  <!-- Student's Name -->
   <label class="font-weight-bold mt-3">Student's Name</label>
  <br>
  <select class="form-control" name="student" id="student<?php echo $p_id; ?>">
    <option value="0">Select Student</option>
  </select>

  <button class="btn btn-success w-100 mt-3" name="add_ward<?php echo $p_id; ?>" type="submit">Add</button>
</div>
    </form>
    <div class="col-md-12">
       <h5 class="col-md-12 text-light text-center">Wards</h5>
          <?php
            $selt = mysqli_query($connect, "SELECT * FROM register WHERE parent = '{$user['id']}'");
            $n = 1;
          ?>
          <table class="table text-light table-striped table-bordered text-center">
          <?php foreach($selt as $call){ ?>
         <tr class="mb-5">
         <td><?php echo $n++; ?></td>
         <td><?= $call['name']; ?></td>
         <td>
         <?php
            $student_class = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '{$call['id']}' ORDER BY id DESC LIMIT 1");
            foreach($student_class as $c){
              $s =  mysqli_query($connect, "SELECT * FROM class WHERE id = '{$c['class']}'");
              foreach($s as $x){
                echo $x['class'];
              }
            }
         ?>
         </td>
         </tr>
  
            <?php } ?>
  
            </table>
    </div>
      </div>
  
  
  
  
  
  
  <div class=" bg-d w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">
  
  <span id="clear<?php echo $user['id']; ?>"><button class="btn-danger btn">Cancel</button></span>
  </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function() {
    $("#del<?php echo $user['id']; ?>").click(function(){
    $("#fetch<?php echo $user['id']; ?>").toggle("slow");
    })
    $("#clear<?php echo $user['id']; ?>").click(function(){
    $("#fetch<?php echo $user['id']; ?>").hide("slow"); 
  })
  })                     
  </script> 
<!-- TO UPDATE pARENT'S DATA -->
<?php 
$id = $user['id'];
// echo $id;
  if (isset($_POST['edit'.$id])) {
      // echo "<script>alert('ERROR')</script>";

    $name = $_POST['name'.$id];
    $username = $_POST['username'.$id];
    $password = $_POST['password'.$id];
    $job = $_POST['job'.$id];
    $phone = $_POST['phone'.$id];
    $email = $_POST['email'.$id];
    $update = mysqli_query($connect, "UPDATE register SET name = '{$name}', job = '{$job}', username = '{$username}', password = '{$password}', phone = '{$phone}', email = '{$email}' WHERE id = '{$user['id']}'");
    if ($update) {
      header('location: parents?search='.$q.'&success');
      // echo "Successful";
    }else{
      echo "<script>
             alert('Error');
      </script>";
    }
  }

 ?>
  <?php
}}else{
    // Parents without Children
        
          
          $sponsor = mysqli_query($connect, "SELECT * FROM register WHERE level = 3 && id != ALL(SELECT parent FROM register WHERE level = 0) ORDER BY id DESC");
          $n = 1;
      foreach ($sponsor as $user) {
       
       ?>
         <div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed p-2 text-light" style="background-color: rgba(0,0,0,0.8); min-height: 100%; top: 0; z-index: 2; display: none;">
    <div style="height: 600px; overflow-y: scroll;" class="row mx-0">
    <form method="post" enctype="multipart/form-data" class="col-md-9 mx-auto border-right ">
      <h5 class="text-center text-light">Edit User's Details</h5>
      <hr class="bg-white">
      <div class="row mx-0">
        <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Name</label>
          <input type="text" name="name<?php echo $user['id']; ?>" required="required"  class="form-control text-center" 
              value="<?php 
                  echo $user['name'];
               ?>">
        </div>
        <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Username</label>
          <input type="text" name="username<?php echo $user['id']; ?>" class="form-control text-center"  
              value="<?php 
                  echo $user['username'];
               ?>">
        </div>
         
         
         <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Password</label>
          <input type="text" name="password<?php echo $user['id']; ?>" class="form-control text-center" value="<?php 
                  echo $user['password'];
            
           ?>">
        </div>
         <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Phone Number</label>
          <input type="text" name="phone<?php echo $user['id']; ?>" class="form-control text-center" value="<?php 
                  echo $user['phone'];
                  ?>">
        </div>
         <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Email:</label>
          <input type="text" name="email<?php echo $user['id']; ?>" class="form-control text-center" value="<?php 
                  echo $user['email'];
             
                    ?>">
        </div>
                    <div class="col-md-6 form-group">
                      <label class="font-weight-bold text-light">Occupation</label>
                      <input type="text" name="job<?php echo $user['id']; ?>" class="form-control text-center" value="<?php 
                  $sl = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$user['parent']}'");
                  echo $user['job'];
                           ?>">
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6 mt-3 mx-auto text-right">
        <button type="submit" name="edit<?php echo $user['id']; ?>" class="btn btn-success w-50">Update</button>
        <button type="reset"  class="btn btn-primary">Reset</button>
          </div>
  
  
  
  
  
  
          <h5 class="col-md-12 text-center border-bottom mt-4 text-light">Other Details</h5>
        <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Registration Code</label>
          <div  class="text-light border-bottom text-center"><?php 
                echo $user['code'];
               ?></div>
  
        </div>
        <div class="col-md-6 form-group">
          <label class="font-weight-bold text-light">Registration Date</label>
          <div  class="text-light border-bottom text-center"><?php 
                  echo $user['date'];
               ?></div>
  
        </div>
  
        
        <!-- <div class="col-md-6"></div> -->
        
      </div>  
                  
    </form>
    <form method="post" class="col-md-3">
      <h5 class="text-center">Add Wards</h5>
       <hr class="bg-white">
       <?php 
        $p_id = (int)$user['id'];

      if (isset($_POST['add_ward'.$p_id])) {
        $student = (int)$_POST['student'];
        $parent = (int)$user['id'];
        $selected_class = $_POST['w_class'];
        if ($student == 0) {
          echo "<script>alert('Selection Error! Try again.')</script>";
        }else{
          $add_student = mysqli_query($connect, "UPDATE register SET parent = '$parent' WHERE id = '{$student}'");
          if ($add_student) {
            $sl = mysqli_query($connect,"SELECT id FROM session WHERE status =1 ORDER BY id DESC LIMIT 1");
            $session_rw = mysqli_fetch_array($sl);
            $sess = $session_rw['id'];
            header('location: parents?session='.$sess.'&class='.$selected_class.'&success');
          }
        }
      }
  ?>
   <!-- Ajax script to add ward for parents -->
  <script type="text/javascript">
    function finder<?php echo $p_id; ?>(val) {
               $.ajax({
                  type: "GET",
                  url: "ajax_ward.php",
                  data: 'set='+val,
                  success: function (data) {
                        $('#student<?php echo $p_id; ?>').html(data);
                  }
               })
          }
  </script>
  <!-- Class -->
      <div class="form-group">
        <label class="font-weight-bold">Class</label>
  <br>
  <select class="form-control" name="w_class" onchange="finder<?php echo $p_id; ?>(this.value)">
  <option value="0">Select Class</option>
  <?php 
  $sql = "SELECT * FROM class";
  $query = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
  <?php } ?>
  </select>
  <!-- Student's Name -->
   <label class="font-weight-bold mt-3">Student's Name</label>
  <br>
  <select class="form-control" name="student" id="student<?php echo $p_id; ?>">
    <option value="0">Select Student</option>
  </select>

  <button class="btn btn-success w-100 mt-3" name="add_ward<?php echo $p_id; ?>" type="submit">Add</button>
</div>
    </form>
    <div class="col-md-12">
      <h5 class="col-md-12 text-light text-center">Wards</h5>
          <?php
            $selt = mysqli_query($connect, "SELECT * FROM register WHERE parent = '{$user['id']}'");
            $n = 1;
          ?>
          <table class="table text-light table-striped table-bordered text-center">
          <?php foreach($selt as $call){ ?>
         <tr class="mb-5">
         <td><?php echo $n++; ?></td>
         <td><?= $call['name']; ?></td>
         <td>
         <?php
            $student_class = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '{$call['id']}' ORDER BY id DESC LIMIT 1");
            foreach($student_class as $c){
              $s =  mysqli_query($connect, "SELECT * FROM class WHERE id = '{$c['class']}'");
              foreach($s as $x){
                echo $x['class'];
              }
            }
         ?>
         </td>
         </tr>
  
            <?php } ?>
  
            </table>
    </div>
      </div>
  

  
  
  
  
  <div class=" bg-d w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">
  
  <span id="clear<?php echo $user['id']; ?>"><button class="btn-danger btn">Cancel</button></span>
  </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function() {
    $("#del<?php echo $user['id']; ?>").click(function(){
    $("#fetch<?php echo $user['id']; ?>").toggle("slow");
    })
    $("#clear<?php echo $user['id']; ?>").click(function(){
    $("#fetch<?php echo $user['id']; ?>").hide("slow"); 
  })
  })                     
  </script> 

<?php 
$id = $user['id'];
// echo $id;
  if (isset($_POST['edit'.$id])) {
      // echo "<script>alert('ERROR')</script>";

    $name = $_POST['name'.$id];
    $username = $_POST['username'.$id];
    $password = $_POST['password'.$id];
    $job = $_POST['job'.$id];
    $phone = $_POST['phone'.$id];
    $email = $_POST['email'.$id];
    $update = mysqli_query($connect, "UPDATE register SET name = '{$name}', job = '{$job}', username = '{$username}', password = '{$password}', phone = '{$phone}', email = '{$email}' WHERE id = '{$user['id']}'");
    if ($update) {
      header('location: parents?search='.$q.'&success');
      // echo "Successful";
    }else{
      echo "<script>
             alert('Error');
      </script>";
    }
  }

 ?>
       <?php
      }
}
?>
</div>
</body>
</html>
    <?php #include '../inc/footer.php'; ?>
 