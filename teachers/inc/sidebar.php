							
<?php 
		#include 'search.php';
 ?>	
  <script type="text/javascript">
          function find(val) {
               $.ajax({
                  type: "GET",
                  url: "search.php",
                  data: 'see='+val,
                  success: function (data) {
                        $('#search').html(data);
                  }
               })
          }
         
    </script>
    			<?php #include 'search.php'; ?>
							<div class="col-md-2 bg-dark p-0 " style="" id="left_side">




								<span class="fas fa-times fa-2x  float-right p-3 border text-light" id="cancel_bar"></span>
								<div class="nav-link p-3 text-center">
									<img src="../images/fidelity logo.jpg" class="w-50 round" style="border-radius: 50%"><br>
									<b class="text-light">Teacher</b><br>
									<i class="text-light">
									<?php
											foreach($ses_sql as $person){
												echo $person['name'];
											}
									?>
									</i>
									
								</div>
								
								

								<!-- <div class="nav-link text-light border-bottom">
									<h3>DASHBOARD</h3>
								</div> -->
								<a  href="index"  class="nav-link border-bottom text-light" title="Dashboard">
									<b class="fas fa-box text-light mr-3"></b>DASHBOARD
								</a>
								<div class="nav-link border-bottom text-light font-weight-bold">
								Navigation
									<b class="fas fa-caret-down text-light float-right"></b>

							</div>
<!------------------------------Members  ------------------------------->
							
								<a href="users" class="nav-link border-bottom text-light" title="Students">
								<b class="fas fa-users mr-3"></b>
								
								Students
								<b class="fas fa-caret-right float-right"></b>
								
							</a>
							<a href="subjects" class="nav-link border-bottom text-light" title="Subjects">
								<b class="fas fa-sun mr-3"></b>
								
								Subjects
								<b class="fas fa-caret-right float-right"></b>
								
							</a>
							
<!------------------------------Results  ------------------------------->
<div id="result_show" class="nav-link border-bottom text-light pointer result_show" title="Insert, View and Edit Results">
		<b class="fas fa-city mr-3"></b>
			Results
		<b class="fas fa-caret-down text-light float-right"></b>
</div>
	<div id="result" class="result" style="display: none">
		<!-- <a href="results.php" class="nav-link  border-bottom text-light" title="Weekly Test">
					<b class=" mr-3"></b>
						Weekly Test
					<b class="fas fa-caret-right text-light float-right"></b>
		</a> -->
		<a href="midterm_results" class="nav-link  border-bottom text-light" title="Insert and Edit Results">
					<b class=" mr-3"></b>
						Manage Results
					<b class="fas fa-caret-right text-light float-right"></b>
		</a>
		<!-- <a href="weekly_print.php" class="nav-link  border-bottom text-light" title="Print Weekly Test Result">
					<b class=" mr-3"></b>
						Print Weekly Result 
					<b class="fas fa-caret-right text-light float-right"></b>
		</a> -->
		<a href="midterm_print" class="nav-link  border-bottom text-light" title="Print MidTerm Test Result">
					<b class=" mr-3"></b>
						Print Midterm Result 
					<b class="fas fa-caret-right text-light float-right"></b>
		</a>
		<a href="terminalresults" class="nav-link  border-bottom text-light" title="Print Terminal Results">
					<b class=" mr-3"></b>
						Print Terminal Result 
					<b class="fas fa-caret-right text-light float-right"></b>
		</a>
		</div>							

<!------------------------------school Structures  ------------------------------->

								
								
							<!-- <b class="fas fa-caret-down float-right"></b> -->
						
						

							
<!------------------------------ Materials  ------------------------------->

							<a href="materials" title="Manage Course Materials" class="nav-link border-bottom text-light">
								<b class="fas fa-pager mr-3"></b>
								Manage Materials
								<b class="fas fa-caret-right float-right"></b>
							</a>
				<!------------------------------Projects  ------------------------------->
				<div id="" class="nav-link border-bottom text-light pointer page" title="Create and view Submitted projects">
					<b class="fas fa-ellipsis-h mr-3"></b>
					Manage Projects
					<b class="fas fa-caret-down text-light float-right"></b>
				</div>				
<!------------------------------ Submission type section  ------------------------------->
				<div style="display: none;" class="pages">			
					<a href="Projects" class="nav-link border-bottom text-light" title="Create and view Projects">
						<b class=" mr-3"></b>
							Projects
						<b class="fas fa-caret-right text-light float-right"></b>
					</a>
					<a href="submissions" class="nav-link border-bottom text-light" title="Submitted Projects">
						<b class="mr-3"></b>
							Submitted Projects
						<b class="fas fa-caret-right text-light float-right"></b>
					</a>
				</div>
				<a href="signature" class="nav-link border-bottom text-light" title="Signature">
			<b class="fas fa-sign-language mr-3"></b>
				Signature
			<b class="fas fa-caret-right text-light float-right"></b>
		</a>

								<a href="logout" class="nav-link border-bottom text-light" title="Logout">
									<b class="fas fa-question mr-3"></b>
										Logout
									<b class="fas fa-caret-right text-light float-right"></b>
								</a>

							</div>


					