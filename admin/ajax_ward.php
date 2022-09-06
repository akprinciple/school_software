<?php 
		include '../inc/config.php';

if(isset($_GET['set'])){
    $class = (int)$_GET['set'];
    $sel = mysqli_query($connect,"SELECT id FROM session WHERE status =1 ORDER BY id DESC LIMIT 1");
    $rw = mysqli_fetch_array($sel);
    $session = $rw['id'];
  $sql = "SELECT * FROM students WHERE class = '{$class}' && session = '{$session}' ORDER BY (SELECT name FROM register WHERE id = user_id ORDER BY name ASC) ASC";
  $query = mysqli_query($connect, $sql);
?>

<option value="0">--Select Student's Name--</option>
<?php
  while ($row = mysqli_fetch_array($query)) {
    
  
 ?>
 <option value="<?php echo $row['user_id']; ?>"><?php 
  $fetch = mysqli_query($connect,"SELECT name FROM register WHERE id = '{$row['user_id']}'");
  $assoc = $fetch->fetch_assoc();
 echo $assoc['name']; ?></option>
 <?php }} ?>