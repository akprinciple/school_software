<?php 
		include '../inc/config.php';


		if (!empty($_GET['mat'])) {
			$see = $_GET['mat'];
			$s_sql = "SELECT * FROM materials WHERE class = '{$see}' OR class = 'all' ORDER BY id DESC";
			$s_query = mysqli_query($connect, $s_sql);
			$s_count = mysqli_num_rows($s_query);
			
		
		
 ?>
     <img src="../images/loader.gif" class="m-auto d-block">
 <h4 class=" d-block">
 <?php  
                
                $se = "SELECT * FROM class WHERE id = '{$see}'";
                $sel = mysqli_query($connect, $se);
                $count = mysqli_num_rows($sel);
                if ($count > 0) {
                while ($row = mysqli_fetch_array($sel)){
                echo $row['class']. ' Class';
                }	# code...
                }
                else{
                    echo "All Classes";
                }
                        
                ?> 
    </h4>	

<!-- <h4 class="mt-3">Manage Course Materials</h4> -->

 <table class="table table-bordered table-striped text-center table-responsive-lg">
	<thead class="bg-success text-light">
	<tr>
	<th>S/N</th>
	<th>Material Name</th>
	<!-- <th>Class</th> -->
	<th>Date</th>
	<th>Actions</th>
	</tr>
	</thead>
	<tbody>
 						
            <?php 
            $n = 1;
            
            while ($search = mysqli_fetch_array($s_query)) {

 							 ?>
        <tr>
            <td class=""><?php echo $n++; ?></td>
            <td class=""><?php echo $search['name']; ?></td>
            <!--  -->
            <td class=""><?php echo $search['date']; ?></td>
            <td class="">
                <span onclick="appr<?php echo $search['id']; ?>(this.value)" title="<?php if($search['status'] == 1){echo "click to Unapprove";}else{echo "Click to Approve";} ?>"><button id="txtHint<?php echo $search['id']; ?>" class="fas fa-check btn p-1 
                    <?php if($search['status'] == 1){echo "btn-success";}else{echo "btn-warning";} ?>"></button></span>
                <span title="Delete" id="del<?php echo $search['id']; ?>" class="fas fa-times text-danger pointer"></span>
            </td>
    </tr>
				
    <script type="text/javascript">
$(document).ready(function() {
  $("#del<?php echo $search['id']; ?>").click(function(){
  $("#fetch<?php echo $search['id']; ?>").toggle("slow");
  })
  $("#clear<?php echo $search['id']; ?>").click(function(){
  $("#fetch<?php echo $search['id']; ?>").hide("slow"); 
})
})                     
</script>
<script type="text/javascript">
							function appr<?php echo $search['id']; ?>() {
								// body...
						if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
						} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint<?php echo $search['id']; ?>").className = this.responseText.split('|')[0];
						document.getElementById("txtHint<?php echo $search['id']; ?>").title = this.responseText.split('|')[1];
						}
						};
						xmlhttp.open("GET","approve?approve=<?php echo $search['id']; ?>",true);
						xmlhttp.send();
							}

						</script>

             <?php 	} ?>
             
             </tbody>
</table>

        <?php } ?>
					
 			
