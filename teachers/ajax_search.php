<?php 
		include '../inc/config.php';


		if (!empty($_GET['set'])) {
           if($_GET['set'] == 1){
            $see = $_GET['set'];  
            
            ?>
            <option>--Select Class--</option>
            <?php
			$sql = "SELECT * FROM class";
  $query = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($query)) {
    
  
   ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
  <?php }}else{ ?>
 			<option value="0">Proceed to Submit</option>

  <?php }} ?>

 