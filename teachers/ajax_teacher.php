<?php 
		include '../inc/config.php';

if(isset($_GET['teach'])){
    $level = (int)$_GET['teach'];
  $sql = "SELECT * FROM register WHERE level ='{$level}' ORDER BY name ASC";
  $query = mysqli_query($connect, $sql);
?>

<option>--Select Teacher's Name--</option>
<?php
  while ($row = mysqli_fetch_array($query)) {
    
  
 ?>
 <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
 <?php }} ?>