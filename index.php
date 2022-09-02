<?php  
	include 'inc/session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fidelity Connect</title>
  <style type="text/css">
    #col{
      display: none;
      animation: animation 0.7s linear  1;
    }
    @keyframes animation{
      from{
        transform: scale(0);
      }
      to{
        transform: scale(1);
      }
    }

  </style>
     
<?php include 'inc/link.php'; ?>
</head>
<?php include 'inc/sidebar.php'; ?>
			
				<ul class="nav nav-pills mt-4">
  <li class="nav-item">
    <a class="nav-link active p-1 mr-2" data-toggle="pill" href="#home">Class mates</a>
  </li>
  <!-- <li class="nav-item mr-2">
    <a class="nav-link p-1" data-toggle="pill" href="#menu1">Class Highest Score</a>
  </li> -->
  <li class="nav-item mr-2">
    <a class="nav-link p-1" data-toggle="pill" href="#menu2">Most Active Members</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active m-0 p-0" id="home">
<div class=" border mt-2"> 	                
<p class="border-bottom p-2 mb-0 mt-0 text-center font-weight-bold">Class Mates</p>
<p class="float-left mt-2 p-2 mb-0 mt-0">
    <b>Class:</b>
    <?php
        $select = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$_SESSION['class']}'");
        while ($row = mysqli_fetch_array($select)) {
          echo $row['class'];
        }
    ?>
</p>
<p class="float-right mt-2 p-2 mb-0 mt-0">
    <b>Current Session:</b>
    <?php
        $select = mysqli_query($connect, "SELECT * FROM session WHERE id = '{$_SESSION['session']}'");
        while ($row = mysqli_fetch_array($select)) {
          echo $row['session'];
        }
    ?>
</p>
<div class="clearfix"></div>
</div>
                 <table class="col-md-12 table text-center table-striped table-bordered">
                     <thead class="table-head">
                         <tr>
                             <th>S/N</th>
                             <th>Name</th>
                             <th>Registration Date</th>
                         </tr>
                     </thead>
                     <tbody>
 <?php 

$sql = "SELECT * FROM  students WHERE class = '{$_SESSION["class"]}' && session = '{$_SESSION['session']}'";
$query = mysqli_query($connect, $sql);
$n = 1;
while ($row = mysqli_fetch_array($query)) {
?>
<tr>
<td><?php echo $n++; ?></td>
<td><?php 
    $sel = mysqli_query($connect, "SELECT * FROM  register WHERE id = '{$row['user_id']}'");
    while ($r = mysqli_fetch_array($sel)) {
     echo $r['name'];
    }
 ?></td>
<td>
<?php 
    $sel = mysqli_query($connect, "SELECT * FROM  register WHERE id = '{$row['user_id']}'");
    while ($r = mysqli_fetch_array($sel)) {
     echo $r['date'];
    }
 ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
  
  <!-- <div class="tab-pane m-0 p-0 container fade" id="menu1">
<p class=" border mt-2 p-2 mb-0 text-center font-weight-bold">Class Highest Scores</p>
  	 
                 <table class="col-md-12 table text-center table-striped table-bordered" style="background-color:;">
                     <thead class="table-head">
                         <tr>
                             <th>S/N</th>
                             <th>Name</th>
                             <th>Score</th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php 
 
$sql = "SELECT * FROM  report WHERE class = '{$_SESSION["class"]}' AND term = '2' ORDER BY exam DESC LIMIT 5";
                            
$query = mysqli_query($connect, $sql);
$n = 1;
while ($row = mysqli_fetch_array($query)) {
                               
                            
 ?>
<tr>
<td><?php echo $n++; ?></td>
<td><?php 
$selt = "SELECT * FROM users WHERE id = '{$row["name"]}'";
$qry = mysqli_query($connect, $selt);
while ($show =mysqli_fetch_array($qry)) {
echo $show['name']; 
}
?>

</td>
<td><?php echo $row['exam']; ?></td>
</tr>
<?php } ?>
</tbody>
 </table>
  </div> -->
  <div class="tab-pane container fade m-0 p-0" id="menu2">
<p class=" border mt-2 p-2 mb-0 text-center font-weight-bold">Most Active Members</p>
 <table class="col-md-12 table text-center table-striped table-bordered">
                     <thead class="">
                         <tr>
                             <th>S/N</th>
                             <th>Name</th>
                             <th>Last Visit</th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php 
                            $sql = "SELECT * FROM  users_visit WHERE username!=''  && username != 'Toyeebah' ORDER BY times DESC LIMIT 5";
                            $query = mysqli_query($connect, $sql);
                            $n = 1;
                            while ($row = mysqli_fetch_array($query)) {
                               
                            
                         ?>
                         <tr>
                             <td><?php echo $n++; ?></td>
                             <td class="text-capitalize"><?php echo $row['username']; ?></td>
                             <td>
                              <?php 
                              if ($row['date'] == date('h:i d/M/Y')) {
                                echo "<b class='text-primary'>Online</b>";
                              }else{
                              echo $row['date']; }
                              ?>
                                
                              </td>
                         </tr>
                         <?php } ?>
                     </tbody>
                 </table>

  	
  </div>
</div>
			
	

<?php include 'inc/footer.php'; ?>

<div id="loader">
  <div class="pt-5"></div>
    <img src="images/Blocks-Loading.gif" width="50%" class="d-block m-auto w-50 pt-5">
</div>

<script type="text/javascript">
  var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("col").style.display = "block";
  }
</script>