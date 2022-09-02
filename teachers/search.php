<?php 
		include '../inc/config.php';


		if (!empty($_GET['see'])) {
			$see = $_GET['see'];
			$s_sql = "SELECT * FROM users WHERE class = '{$see}' ORDER BY name ASC";
			$s_query = mysqli_query($connect, $s_sql);
			$s_count = mysqli_num_rows($s_query);
			
		
		
 ?>
 						
 							<?php 
 							
 							while ($search = mysqli_fetch_array($s_query)) {

 							 ?>
 
				<option value="<?php echo $search['id']; ?>" id="search" class="text-capitalize">
					<?php echo $search['name']; ?>
				</option>
 			

 			<?php 	}} ?>
					
 			
