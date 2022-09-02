<?php  
$msg = "";
    include 'inc/session.php';
    
    $msg = "";
    if($_SESSION['level'] != 4){
        header('location: promotion');
    }
    	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Promotion Page | Fidelity Schools</title>
	<?php include 'inc/link.php'; ?>
    
</head>
<body>
<div class="row ml-0 mr-0">
<!---------------- Sidebar  --------------->
<?php include 'inc/sidebar.php'; ?>
<div class="col-md-10 ">
<h4 class="ml-3 mt-3">Promotion Page</h4>
<?php 
include 'inc/hr.php';




?>
    <a href="promotion.php" class="float-right">
    <button class="btn btn-danger" >Leave page</button> 
    </a>  
    <div class="clearfix"></div>
    

    <div class="row mx-0">
<form class="col-md-8 row border-right mx-0">

	
	


	<div class="form-group col-md-6 p-1">
	<label class="font-weight-bold">Class</label>
	<br>
	<select class="custom-select" name="class">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['session'])) {
	 	echo "<option value='1'>Select Class</option>";
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
	<select class="custom-select" name="session">
	<?php 
	if (!isset($_GET['class']) && !isset($_GET['term']) && !isset($_GET['session'])) {
	 	echo "<option value='1'>Select Session</option>";
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
	?>
	<?php 
	$sql = "SELECT * FROM session";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		
	
	 ?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['session']; ?></option>
	<?php } ?>
	</select>
	</div>

	<div class="form-group col-md-6 p-1">
	
</div>

<div class="col-md-6 p-0">
	
	<button type="search" name="submit" class="btn btn-success d-block rounded w-100">Search</button>
</div>
</form>


	<div class="col-md-4 form-group p-2">
	<form>
	<label class="font-weight-bold">Search by keyword</label>
	<br>
	<input type="search" required="required" disabled name="search" placeholder="Search By keyword" class="form-control" value="<?php if (isset($_GET['search'])) {
	echo $_GET['search']; } ?>" 
	>
	<button class="btn btn-success rounded mt-1 float-right">Search</button>		
	</form>
	</div>
</div>

<?php
if (isset($_GET['class'])  && isset($_GET['session'])) { 
    $class = (int)$_GET['class'];
    $session = (int)$_GET['session'];

?>
<form method="post" enctype="multipart/form-data">
        <table class="table table-striped table-bordered mt-3 text-center border">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Session</th>
                        <th>Arabic Class</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                           
                        $sql = mysqli_query($connect, "SELECT * FROM students WHERE class='{$class}' && session = '{$session}'");
                        $n = 1;
                        while($row = mysqli_fetch_array($sql)){
                    ?>
                        <tr id="demo<?php echo $row['user_id']; ?>">
                            <td><?php echo $n++; ?></td>
                            <td>
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$row['user_id']}'");
                        while($rw = mysqli_fetch_array($query)){
                                echo $rw['name'];
                        }
                            
                             ?>
                            </td>
                            <td>
                            <select name="class<?php echo $row['user_id']; ?>"  style="width: 80px; outline: none; border:0;" class="p-2 custom-select">
                            <option value="<?php echo 1+$class; ?>" id="option<?php echo $row['user_id']; ?>">
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM class WHERE id = 1+'$class'");
                        while($rw = mysqli_fetch_array($query)){
                                echo $rw['class'];
                        } 
                        ?>
                        </option>
                       
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM class WHERE id != 1+'$class'");
                        while($rw = mysqli_fetch_array($query)){
                               
                                echo "<option value='{$rw["id"]}'>
                                 {$rw['class']}
                                </option>";
                        } 
                        ?>
                        
                        </select>
                            </td>
                            <!-- Session -->
                            <td>
                            <select name="session<?php echo $row['user_id']; ?>" style="width: 120px; outline: none; border:0;" class="p-2 custom-select">
                            <option value="<?php echo 1+$session; ?>">
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM session WHERE id = 1+'$session'");
                        while($rw = mysqli_fetch_array($query)){
                                echo $rw['session'];
                        } 
                        ?>
                        </option>
                       
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM session WHERE id != 1+'$session'");
                        while($rw = mysqli_fetch_array($query)){
                               
                                echo "<option value='{$rw["id"]}'>
                                 {$rw['session']}
                                </option>";
                        } 
                        ?>
                        
                        </select>
                            </td>

                            <!-- Arabic Class    -->
                            <td>
                            <select name="arabic_class<?php echo $row['user_id']; ?>" style="width: 200px; outline: none; border:0;" class="p-2 custom-select">
                            
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '{$row["user_id"]}' && class='{$class}' && session = '{$session}'");
                        while($rw = mysqli_fetch_array($query)){

                            ?>
                                    <option value='<?php echo 1+$rw['arabic_class']; ?>'>
                                <?php
                            $select = mysqli_query($connect, "SELECT * FROM arabic_class WHERE id =1+'{$rw['arabic_class']}'");
                            while($arabic = mysqli_fetch_array($select)){
                              echo $arabic['class'];
                            }
                            ?>
                                    </option>
                            <?php
                            
                           
                        } 
                        ?>
                        <?php
                            $query = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '{$row["user_id"]}' && class='{$class}' && session = '{$session}'");
                        $rw = mysqli_fetch_array($query);
                        $select = mysqli_query($connect, "SELECT * FROM arabic_class WHERE id !=1+'{$rw['arabic_class']}'");
                            while($arabic = mysqli_fetch_array($select)){
                            ?>
                                    <option value='<?php echo $arabic['id']; ?>'>
                                <?php echo $arabic['class']; ?>
                                    </option>
                            <?php } ?>
                        </select>
                            </td>
                            <td><i class="fas fa-trash-alt text-danger pointer" onclick="dnone<?php echo $row['user_id']; ?>()"></i></td>
                        </tr>
<?php
    if(isset($_POST['submit'])){
        $user = $row['user_id'];
        $classes = $_POST['class'.$user];
        $sessions = $_POST['session'.$user];
        $arabic_classes = $_POST['arabic_class'.$user];
        if($classes != -1){
        $check = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '$user' && class = '$classes' && session ='$sessions'");
        $count = mysqli_num_rows($check);
        if ($count > 0){
            $query = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$row['user_id']}'");
            while($rw = mysqli_fetch_array($query)){
                    
            echo "<div class='text-danger text-center'>{$rw['name']} is already existing for the selected class of the selected session.</div>";
        }

    }else{
        $insert = mysqli_query($connect, "INSERT INTO students (user_id, class, session, arabic_class) VALUES('$user', '$classes', '$sessions', '$arabic_classes')");
        if($insert){
            $query = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$row['user_id']}'");
            while($rw = mysqli_fetch_array($query)){
                    
            echo "<div class='text-success text-center'>{$rw['name']} has been Added Successfully</div>";
        }
        }
    }
    }
}

    ?>
<!-- This is for Deleting Unwanted row -->
<script>
function dnone<?php echo $row['user_id']; ?>() {
document.getElementById('demo<?php echo $row['user_id']; ?>').style.display= "none";
document.getElementById('option<?php echo $row['user_id']; ?>').value = "-1";
}
</script>
                        <?php } ?>
                </tbody>
        </table>
        <button type="submit" name="submit" class="btn btn-success float-right">Promote</button>
        <div class="clearfix"></div>
        </form>
<?php
}

?>
</div>
</div>




</body>
</html>

