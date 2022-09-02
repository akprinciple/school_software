<?php 
		include 'inc/session.php';
		$msg = $session_msg = "";
		

    if (isset($_POST['session_submit'])) {
      $session = $_POST['session'];

      $session_sel = "SELECT * FROM session WHERE session = '{$session}'";
      $session_selt = mysqli_query($connect, $session_sel);
      $count = mysqli_num_rows($session_selt);
      if ($count > 0) {
        $session_msg = "<div class='p-2 rounded text-danger text-center mb-2'>session is already existing</div>";
      }
      else{
      $sql = "INSERT INTO session (session) VALUES ('$session')";
      $query = mysqli_query($connect, $sql);
      if ($query) {
        $session_msg = "<div class='p-2 rounded text-success text-center mb-2'>session Added Successfully</div>";
      }
      else{
        $session_msg = "<div class='p-2 rounded text-danger text-center mb-2'>Error</div>";
      }
    }
    }
		 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Session | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>

</head>
<body>
	<div class="h-100 pl-3 pr-3">
            <div class="row">
           <?php include 'inc/sidebar.php'; ?>

           <div class="col-md-10">
           		<h4 class="font-weight-bold ml-3 mt-3">Manage Session</h4>
           	<?php 
           		include 'inc/hr.php';
           	 ?>
           
      <div>
                  <form method="post" enctype="multipart/form-data">
                    <h5 class="">Add Session</h5>
                    <?php echo $session_msg; ?>
                    <div class="form-group mt-2 row p-3">
                      <input type="text" required="required" name="session" class="form-control w-75" placeholder="Add Session">
                      <input type="submit" name="session_submit" class="bg-success border-0 text-light outline" style="border-radius: 0px 20px 20px 0px; width: 20%" value="Add"><!-- Add</button> -->
                    </div>
                  </form>
                  <table class="table table-striped table-bordered text-center">
                    <thead class="bg-success text-light">
                      <tr>
                        <td class="">S/N</td>
                        <td class="">Class</td>
                        <td class="">Action</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $session_sel = "SELECT * FROM session ORDER BY session ASC";
                  $session_selt = mysqli_query($connect, $session_sel);
                  $n = 1;
                  while ($row = mysqli_fetch_array($session_selt)) {
                    
                  
                       ?>
                      <tr>
                        <td class=""><?php echo $n++; ?></td>
                        <td class=""><?php echo $row['session']; ?></td>
                        <td class="">
                          <a href="approve?approve_session=<?php echo $row['id']; ?>">
                            <button class="fas fa-check btn border-0
                            <?php 
                              if($row['status'] == 1){echo "btn-success";}else{echo "btn-warning";}
                             ?>
                            "></button>
                          </a>
                          <span title="Delete" id="del<?php echo $row['id']; ?>" class="fas fa-trash-alt  text-danger pointer ml-2"></span>
                        </td>
                      </tr>

                    <?php } ?>  
                    </tbody>
                  </table>


            </div>
                </div>
                  </div>
                  </div>
        <?php 
 $u_sql = "SELECT * FROM session";
$u_query = mysqli_query($connect, $u_sql);
$n = 1;
while ($user = mysqli_fetch_array($u_query)) {
?>
<div id="fetch<?php echo $user['id']; ?>" class="w-100 position-absolute position-fixed" style="background-color: rgba(0,0,0,0.5); min-height: 100%; top: 0; z-index: 2; display: none;">
<div class=" bg-dark w-100 text-light text-center position-absolute p-2" style="bottom: 0; ">Are you sure you want to delete <b> <?php echo $user['session']; ?> Session </b>permanently?
<a href="delete?del_session=<?php echo md5($user['id']); ?>"><button class="btn-success btn">Yes</button></a>
<span id="clear<?php echo $user['id']; ?>"><button class="btn-danger btn">No</button></span>
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
<?php } ?>
</body>
</html>
    <?php include '../inc/footer.php'; ?>
