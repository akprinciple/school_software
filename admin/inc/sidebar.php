							
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
									<b class="text-light">Administrator</b><br>
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
								<!-- <div class="nav-link border-bottom text-light font-weight-bold">
								Navigation
									<b class="fas fa-caret-down text-light float-right"></b>

							</div> -->
<!------------------------------Members  ------------------------------->
<div id="members" class="nav-link border-bottom text-light pointer" title="All Users">
		<b class="fas fa-users mr-3"></b>
			Users
		<b class="fas fa-caret-down text-light float-right"></b>
</div>
							<div id="users" style="display: none;">
								<a href="users" class="nav-link border-bottom text-light" title="Students">
								<b class=" mr-3"></b>
								
								Students
								<b class="fas fa-caret-right float-right"></b>
								
							</a>
							<a href="teachers" class="nav-link border-bottom text-light" title="Teachers">
								<b class=" mr-3"></b>
								
								Teachers
								<b class="fas fa-caret-right float-right"></b>
								
							</a>
							<a href="parents" class="nav-link border-bottom text-light" title="Parents">
								<b class=" mr-3"></b>
								
								Parents
								<b class="fas fa-caret-right float-right"></b>
								
							</a>
							</div>
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
						
						

							<div id="" class="nav-link border-bottom text-light pointer posts" title="Manage terms, class and session">
								<b class="fas fa-plus mr-3"></b>
								School Structures
								<b class="fas fa-caret-down text-light float-right"></b>
		</div>
							
							<div id="" style="display: none;" class="post">
<!------------------------------Weeks ------------------------------->

<!-- <a href="weeks.php" class="nav-link comment  border-bottom text-light" title="Manage Weeks">
									<b class=" mr-3"></b>
										Manage Weeks
									<b class="fas fa-caret-right text-light float-right"></b>
								</a> -->
<!------------------------------Manage Terms  ------------------------------->
								<a href="term" class="nav-link border-bottom text-light" title="Manage Terms">
									<b class=" mr-3"></b>
										Manage Terms
									<b class="fas fa-caret-right text-light float-right"></b>
								</a>
<!------------------------------Class ------------------------------->
							
								<a href="classes" class="nav-link comment  border-bottom text-light" title="Manage Class">
									<b class=" mr-3"></b>
										Manage Class
									<b class="fas fa-caret-right text-light float-right"></b>
								</a>
<!------------------------------Session ------------------------------->

								<a href="session" class="nav-link comment  border-bottom text-light" title="Manage Session">
									<b class=" mr-3"></b>
										Manage Session
									<b class="fas fa-caret-right text-light float-right"></b>
								</a>

<!------------------------------Subjects ------------------------------->

								<a href="subjects" class="nav-link comment  border-bottom text-light" title="Manage Subjects">
									<b class=" mr-3"></b>
										Manage Subjects
									<b class="fas fa-caret-right text-light float-right"></b>
								</a>
		</div>

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
<!------------------------------ Arabic Department  ------------------------------->
<div class="nav-link border-bottom text-light pointer" id="tap"  title="Arabic Department">
	<b class="fas fa-mosque mr-3"></b>
		Arabic 
	<b class="fas fa-caret-down text-light float-right"></b>
</div>
<div style="display: none;" id="showup">
<!------------------------------ Arabic Classes  ------------------------------->
		<a href="arabic_class" class="nav-link border-bottom text-light" title="Manage Arabic Classes">
			<b class=" mr-3"></b>
				Arabic Class
			<b class="fas fa-caret-right text-light float-right"></b>
		</a>

		<a href="arabic_subjects" class="nav-link border-bottom text-light" title="Manage Arabic Subjects">
			<b class=" mr-3"></b>
				Arabic Subjects
			<b class="fas fa-caret-right text-light float-right"></b>
		</a>
		<!------------------------------ Arabic Students  ------------------------------->
		<a href="a_students" class="nav-link border-bottom text-light" title="Manage Students for Arabic Class">
			<b class=" mr-3"></b>
				Students
			<b class="fas fa-caret-right text-light float-right"></b>
		</a>
		<!------------------------------ Arabic Results  ------------------------------->
		<a href="arabic_result" class="nav-link border-bottom text-light" title="Manage Arabic Results">
			<b class=" mr-3"></b>
				Arabic Results
			<b class="fas fa-caret-right text-light float-right"></b>
		</a>
		<!------------------------------ Arabic Results View  ------------------------------->
		<a href="arabic_result_view" class="nav-link border-bottom text-light" title="View Arabic Results">
			<b class=" mr-3"></b>
				View Results
			<b class="fas fa-caret-right text-light float-right"></b>
		</a>
		</div>
		<a href="promotion" class="nav-link border-bottom text-light" title="Promotion Page">
			<b class="fas fa-step-forward mr-3"></b>
				Promotion Page
			<b class="fas fa-caret-right text-light float-right"></b>
		</a>
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


					<!-- <div class="col-md-10 p-0">
						<div class="p-3 bg-white">
							<form method="post" enctype="multipart/form-data">
							<input type="text"  onkeyup="find(this.value);" placeholder="Search for ..." class="p-2  rounded-top rounded-left border-0 bg-light m-0 search">
							<button class="rounded-right rounded-bottom p-2 bg-primary border-0 fas">&#xf002;</button>
							
							<div class="col-md-2 border-left float-right">
								<b class="fas fa-envelope ml-2" style="color: #e1e1e1"></b>
								<b class="fas fa-bell ml-2" style="color: #e1e1e1"></b>
							</div>
						</form>
						</div>
							<div class="">
						 <div id="search"></div>
						</div> -->

						