<?php 
		include '../inc/config.php';

if(isset($_GET['subjt'])){
  $sql = "SELECT * FROM subjects";
  $query = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_array($query)) {
    
  
 ?>
 <div class="col-md-3 form-check">
 <input type="checkbox" class="form-check-input" name="subject[]" value="<?php echo $row['id']; ?>" id="subject<?php echo $row['id']; ?>">
  <label for="subject<?php echo $row['id']; ?>"><?php echo $row['subject']; ?></label>
 </div>
 <?php }} ?>