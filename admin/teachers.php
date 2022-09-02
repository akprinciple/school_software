<?php
ob_start(); 
    include 'inc/session.php';
$msg = "";

 if (isset($_GET['success'])) {
      $msg = "<script>alert('Update Successful');</script>";
      
    }
    // $subject = 0;
if (isset($_POST['submit'])) {
$name = mysqli_real_escape_string($connect, $_POST['name']);
if (isset($_POST['subject'])) { $subject =  $_POST['subject']; } 
$session = mysqli_real_escape_string($connect, $_POST['session']);
$dob = mysqli_real_escape_string($connect, $_POST['dob']);
$class = mysqli_real_escape_string($connect, $_POST['class']);
$level = mysqli_real_escape_string($connect, $_POST['level']);
$gender = mysqli_real_escape_string($connect, $_POST['gender']);
$code = "FT".date('ym').rand(00, 99);
$date= date('d/M/Y');

if ($session == "--Select Session--" || $gender == "--Select Gender--" || $level == "--Select Section--") {
$msg = "<div class=' text-danger text-center my-2'>Selection Error. Please try Again!</div>";
}
else{
$select = mysqli_query($connect, "SELECT * FROM register WHERE code = '$code'");
$count = mysqli_num_rows($select);
if ($count > 0) {
  "<div class='p-2 rounded alert-danger mb-2 mt-2'>Kindly try Again!</div>";
}
else{


  $check = mysqli_query($connect, "SELECT * FROM register WHERE name = '$name' && session = '$session' && gender = '$gender' && level ='$level'");
  $counter = mysqli_num_rows($check);
  if ($counter > 0) {
    $msg = "<div class=' text-danger text-center my-2'>User seems to be existing</div>";
  }else{
    if($level == 1){
// For Regular Teachers
      $insert = mysqli_query($connect, "INSERT INTO register (name, gender, dob, session, level, class, code, date) VALUES ('$name', '$gender', '$dob', '$session', '$level', '$class', '$code', '$date')");
    if($insert){
      $sel = $insert = mysqli_query($connect, "SELECT * FROM register WHERE name = '$name' && gender = '$gender' && level = '$level' && class = '$class' && session = '$session' ORDER BY id DESC LIMIT 1");
      $fetch = mysqli_fetch_array($sel);
      $id = $fetch['id'];
      // To insert Subjects For a Teacher
      if (isset($_POST['subject'])) {
       foreach($subject as $sub){
      $sql = "INSERT INTO teachers(name, subject) VALUES ('$id', '$sub')";
      $sql_query = mysqli_query($connect, $sql);
      
      if($sql_query){
        $msg = "<div class=' text-success text-center my-2'>User successfully added with the Subjects</div>";
    
          }else{
        $msg = "<div class=' text-danger text-center my-2'>Error! Please try again.</div>";
    
          }
      
     }
    }
    }
    if($insert){
      $msg = "<div class=' text-success text-center my-2'>User successfully added</div>";
  
        }else{
      $msg = "<div class=' text-danger text-center my-2'>Error! Please try again.</div>";
  
        }
        // Inserting Arabic teachers
    }elseif($level == 2){
      $insert = mysqli_query($connect, "INSERT INTO register (name, gender, dob, session, level, code, date) VALUES ('$name', '$gender', '$dob', '$session', '$level', '$code', '$date')");
      if($insert){
        $msg = "<div class=' text-success text-center my-2'>User successfully added</div>";
    
          }else{
        $msg = "<div class=' text-danger text-center my-2'>Error! Please try again.</div>";
    
          }
    }
    

    
   
// if ($query) {

//   # code...
// $msg = "<div class='p-2 rounded text-success text-center mb-2 mt-2'>$name was Added Successfully</div>";
// }

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
  <script type="text/javascript">
  // For Fetchng Classes
          function finder(val) {
               $.ajax({
                  type: "GET",
                  url: "ajax_search.php",
                  data: 'set='+val,
                  success: function (data) {
                        $('#search').html(data);
                  }
               })
          }
          // For fetching Subject
          function finder_subject(val) {
               $.ajax({
                  type: "GET",
                  url: "ajax_subject.php",
                  data: 'subjt='+val,
                  success: function (data) {
                        $('#display').html(data);
                  }
               })
          }
          // For fetching names of teachers By Level
          function finder_teacher(val) {
               $.ajax({
                  type: "GET",
                  url: "ajax_teacher.php",
                  data: 'teach='+val,
                  success: function (data) {
                        $('#play').html(data);
                  }
               })
          }
    </script>
    <?php include('ajax_search.php'); ?>
    <?php include('ajax_subject.php'); ?>
    <?php include('ajax_teacher.php'); ?>
</head>
<body>
  <div>
  
<div class="">

            <div class="row ml-0 mr-0">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
            <h4 class="mt-3">Teachers</h4>
            <?php include 'inc/hr.php'; ?>


            <div class="row mx-0">
<form class="col-md-12 row  mx-0">

  
  


  <div class="form-group col-md-6 p-1">
  <label class="font-weight-bold">Section</label>
  <br>
  <select class="custom-select" name="section" onchange="finder_teacher(this.value);">
  <?php 
  if (!isset($_GET['section']) && !isset($_GET['teacher'])) {
    echo "<option>--Select Section--</option>";
  }else{
   
    if($_GET['section'] == 1){
        echo "<option value='1'>Regular Section</option>";
    }elseif($_GET['section'] == 2){
  echo "<option value='2'>Arabic Section</option>";
    }
  } 
  ?>
   <option value="1">Regular Section</option>
   <option value="2">Arabic Section</option>
  
  </select>
  </div>



  <div class="form-group col-md-6 p-1 mb-0">
  <label class="font-weight-bold">Teacher</label>
  <br>
  <select class="custom-select" name="teacher" id="play">
  <?php 
  if (!isset($_GET['teacher']) && !isset($_GET['section'])) {
    echo "<option>Select Teacher</option>";
  }
  
  else {
  $t = $_GET['teacher'];
  $sq = "SELECT * FROM register WHERE id = '{$t}'";
  $quer = mysqli_query($connect, $sq);
  while ($rw = mysqli_fetch_array($quer)) {
    $tm = $rw['name'];
    echo "<option value='$t'>$tm</option>";
   }
   $t_sql = "SELECT * FROM register WHERE id != '{$t}' && level ='{$_GET['section']}'";
  $quer = mysqli_query($connect, $t_sql);
  while ($rw = mysqli_fetch_array($quer)) {
    $tm = $rw['name'];
    $t = $rw['id'];
    echo "<option value='$t'>$tm</option>";
   }
  } 
  ?>
  
  
  </select>
  </div>

<div class="col-md-6"></div>
<div class="col-md-6">
  
  <button type="search" class="btn btn-success mb-2 float-right">Search</button>
  <div class="clearfix"></div>
</div>
</form>


  
</div>

















<span class="float-right mb-3 bot-left p-2 bg-white">
<a id="click" class="pointer text-success fas fa-plus mr-2" title="Add New Teacher"></a> 
<!-- <span class="">/</span> -->
<a href="teachers" class="text-success fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span> 
<div class="clearfix"></div>
<!-- Section to add a new teacher -->
            <div class="">
              <div class=" mt-3 border-bottom" id="reg" style="<?php if (!isset($_POST['submit'])) {
                echo "display: none";
              } ?> " >
                <h5 class="font-weight-bold border-bottom">Add New Teacher</h5>
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
                  <span class="text-danger font-weight-bold">*</span> <b>Gender</b>
                  <select name="gender" class="custom-select">
                    <option>--Select Gender--</option>
                    
                     <option value="male">Male</option>
                     <option value="female">Female</option>
                     
                  </select>
                  
                  </div>

                 

                  <div class="form-group col-md-6">
                    <b>Date of Birth</b>
                  <input type="date" name="dob" class="form-control">
                    
                  
                  </div>


                  <div class="form-group col-md-6">
                  <span class="text-danger font-weight-bold">*</span> <b>Session</b>
                  <select name="session" class="custom-select">
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
                    <option selected="selected">--Select Session--</option>

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
                  <span class="text-danger font-weight-bold">*</span> <b>School Section</b>
                  <select name="level" class="custom-select" onchange="finder(this.value);">
                    <option>--Select Section--</option>
                    
                     <option value="1">Regular Section</option>
                     <option value="2">Arabic Section</option>
                     
                  </select>
                  
                  </div>

                  <div class="form-group col-md-6">
                  <span class="text-danger font-weight-bold">*</span><b> Class</b>
  <select class="custom-select" name="class" id="search" onchange="finder_subject(this.value);">
  <?php 
  if (!isset($_GET['class']) && !isset($_GET['session'])) {
    echo "<option>----</option>";
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
 
  
  </select>
  </div>

                  

               
                  <div class="form-group mt-3 row mx-0 " id="display">
               



</div>
                 
                  <div class="col-md-6"></div>
                  <!-- Add User Button -->
                  <div class=" col-md-6">
                  <button class="btn btn-success my-2 float-right" name="submit" type="submit">Add User</button>
                 <div class="clearfix"></div>
                  </div>
                  </div>
                </form>
              </div>
              


<form method= "post" enctype="mltipart/form-data">

<!-- Section View And Edit Teachers -->
<?php
       if (isset($_GET['teacher'])  && isset($_GET['section'])) {
            $section = $_GET['section'];
            $name = $_GET['teacher'];
            
            $selt = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$name}'");

            ?>
          <div class="row shadow mx-0 p-3 bg-white rounded">
            <?php
            foreach ($selt as $key) {
             
            
         ?>
         <div class="col-md-12">
         <h5 class="font-weight-bold text-center text-capitalize">
            <?php
              if($key['gender'] == "male"){echo "Mr. ";}elseif($key['gender'] == "female"){echo "Miss/Mrs. ";}
              echo $key['name']; 
              if($section == 2){echo " (Uztazh)";}
            ?>
         <hr class="bg-success mt-0">
         </h5>
         </div>
        <div class="col-md-6 form-group">
        <label class="font-weight-bold">Name</label>
              <input type="text" name="name" value="<?php echo $key['name']; ?>" class="form-control text-center">
        </div>
        

        <div class="col-md-6 form-group">
        <label class="font-weight-bold">Date of Birth</label>
        <input type="text" name="dob" class="form-control text-center"  
            value="<?php echo $key['dob']; ?>">
      </div>

      <div class="col-md-6 form-group">
        <label class="font-weight-bold">Class Teacher Of</label>
        <select class="custom-select" name="class">
          <option value="<?php echo $key['class']; ?>" class="">
            <?php 
             $sql = mysqli_query($connect, "SELECT class FROM class WHERE id = '{$key['class']}'");
             foreach($sql AS $low){echo $low['class'];}
             ?>
             </option>
             <?php
                 $sql = mysqli_query($connect, "SELECT * FROM class WHERE id != '{$key['class']}'");
                 foreach($sql AS $low){echo "<option value='{$low['id']}'>{$low['class']}</option>";}
             ?>
             <select>
      </div>
        <div class="col-md-6 form-group">
        <label class="font-weight-bold">Username</label>
              <input type="text" name="username" value="<?php 
                  echo $key['username'];
                  ?>" class="form-control text-center">
        </div>
        <div class="col-md-6 form-group">
        <label class="font-weight-bold">Password</label>
              <input type="text" name="password" value="<?php 
                  echo $key['password'];
                  ?>" class="form-control text-center">
        </div>
                  <div class="col-md-6 form-group">
                    <label class="font-weight-bold">Session Registered</label>
                          <input type="text" value="<?php 
                              $sql = mysqli_query($connect, "SELECT session FROM session WHERE id = '{$key['session']}'");
                              foreach($sql AS $low){echo $low['session'];}
                          ?>" class="form-control text-center" disabled>
                    </div>
                  <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Registration Code</label>
                        <input type="text" value="<?php 
                            echo $key['code'];
                        ?>" class="form-control text-center" disabled>
                  </div>
        <div class="col-md-6 form-group">
        <label class="font-weight-bold">Registration Date</label>
              <input type="text" value="<?php 
                  echo $key['date'];
              ?>" class="form-control text-center" disabled>
        </div>
         <?php
         }
         if($section == 1){
         $show = mysqli_query($connect, "SELECT * FROM teachers WHERE name = '{$name}'");
        
          $count = mysqli_num_rows($show);
         ?>
         <!--Section For the Alotted Subjects For Each Teacher  -->
        <div class="row mx-0 col-md-12 mt-3">
        <h5 class="col-md-12 border-top border-bottom text-center border-success p-2">
         Alotted Subjects
        
        </h5>

         <?php
          foreach($show AS $teach){
      
    
       

 ?> 
 <div class="form-check col-md-3">

     <input type="checkbox" checked="checked" class="form-check-input" name="subj<?php echo $teach['id']; ?>" value="<?php echo $teach['subject']; ?>">
     <?php 
        $select = mysqli_query($connect, "SELECT * FROM subjects WHERE id = '{$teach['subject']}'");
        foreach($select AS $call){
     echo $call['subjectcode']; 
        }
     ?>
  </div>
  
          <?php
          $id = $teach['id'];
          if(isset($_POST['update']) && empty($_POST['subj'.$id])){
            $del = mysqli_query($connect, "DELETE FROM teachers WHERE id = '{$id}'");
          }
          }
          $select = "SELECT * FROM subjects WHERE !EXISTS (SELECT * FROM teachers WHERE subject = subjects.id && name = '{$name}')";
          $show = mysqli_query($connect, $select);
        
          $count = mysqli_num_rows($show);
         
          foreach($show AS $teach){
            $id = $teach['id'];
            if(isset($_POST['update']) && !empty($_POST['subject'.$id])){
              $del = mysqli_query($connect, "INSERT INTO teachers (name, subject) VALUES('$name', '$id')");
            }
    
       

 ?>
    <div class="form-check col-md-3">
     <input type="checkbox" class="form-check-input" name="subject<?php echo $teach['id']; ?>" value="<?php echo $teach['subject']; ?>">
     <?php echo $teach['subjectcode']; ?>
         </div>
       
          <?php
          }
         
          }
          if(isset($_POST['update'])){
            $t_name = $_POST['name'];
            $t_dob = $_POST['dob'];
            $t_class = $_POST['class'];
            $t_username = $_POST['username'];
            $t_password = $_POST['password'];
            $t_update = mysqli_query($connect, "UPDATE register SET name='$t_name', dob ='$t_dob', class = '$t_class', username = '$t_username', password = '$t_password' WHERE id = '$name'");
            if($t_update){
            header('location: teachers?teacher='.$name.'&&section='.$section.'&&success');
          }
          else{
            echo "<script>alert('Error!')<script>";
          }
          }
          
        
       
        ?>
        
<div class="col-md-4 mx-auto mt-4">
<button type="submit" name="update" class="btn btn-success col-md-6">Update</button>
<button type="reset" name="update" class="btn btn-danger col-md-5">Reset</button>
<!-- <button type="submit" name="" class="btn btn-danger">Ban User</button> -->

<div class="clearfix">
</div>
</div>
</div>
</div>
</div>
<div>
<?php  } ?>
</form>


</div>
</body>
</html>
    <?php #include '../inc/footer.php'; ?>
