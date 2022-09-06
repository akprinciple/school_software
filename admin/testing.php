<?php
ob_start(); 
    include 'inc/session.php';
$msg = $phone = $email = $address = $job = $username = "";



?>
<!DOCTYPE html>
<html>
<head>
  <title>Parents | Fidelity Schools</title>
  <?php include 'inc/link.php'; ?>
</head>
<body>
  <div>
  
<div class="">

            <div class="row ml-0 mr-0">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
            <h4 class="mt-3">Parents</h4>
            <?php include 'inc/hr.php'; ?>
<?php
            if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
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
  <input type="search"  name="search" placeholder="Search By keyword" class="form-control" value="<?php if (isset($_GET['search'])) {
  echo $_GET['search']; } ?>" 
  >
  <button class="btn btn-success rounded mt-1 float-right">Search</button>    
  </form>
  </div>
</div>

















<span class="float-right  p-2">
  <a id="click" class="pointer btn btn-success fas fa-plus " title="Add new Parent/sponsor"></a> 
  <!-- Export Button -->

<a href="import/import?all" class="pointer btn btn-primary fas fa-file-csv " title="Export all parents details as CSV"></a> 

<!-- <span class="">/</span> -->
<a href="parents" class="btn btn-danger fas fa-expand-arrows-alt" title="Refresh Page"></a>
</span> 
<div class="clearfix"></div>

            <div class="">
              <div class=" mt-3 border-bottom" id="reg" style="<?php if (!isset($_POST['submit'])) {
                echo "display: none";
              } ?> " >
                <h5 class="text-center font-weight-bold border-bottom">Add New Parent/Sponsor</h5>
                <?php echo $msg; ?>
                <form method="post" action="import/import.php" enctype="multipart/form-data">
                  <div class="row mx-0">
                  
                  
                  <div class="form-group col-md-6">
                  <b>Username</b>
                 <input type="file" accept=".csv" name="file" class="form-control" placeholder="Choose a username"  value="<?php echo $username; ?>">

                  </div>

                 
                 
                  
                  <div class="w-100 text-center">
                  <button class="btn btn-success my-2 " name="submit" type="submit">Add User</button>
                  <button class="btn btn-danger my-2 " type="reset">Reset</button>
                  </div>
                  
                </form>
              </div>
</div>
              <!-- Search by Student by class and Session -->

</div>
</body>
</html>
    <?php #include '../inc/footer.php'; ?>
 