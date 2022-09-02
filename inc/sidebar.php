<body style="font-weight: 400; background: linear-gradient(to right, rgba(255,255,255,0.1), rgba(255,255,255,.3)), url('images/element.jpg'); background-size: 100% 100%; background-attachment: fixed;" onload="myFunction();">

	<div class="col-md-10 m-auto p-0" id="col" style="border-top: 5px solid #00e6e6">
		<div class="bg-white p-2"><!--   -->
			<img src="images/fidelity logo.jpg" width="70px" class="float-left p-3">
			<p class="float-right pt-3">Logged in as <strong><?php echo $_SESSION['name']; ?></strong></p>
			<div class="clearfix"></div>
		</div>
		<div style="position: relative; ">
		<h5 class="text-light m-0 p-4" style="background-color: #171717;"> Offline portal
        
    </h5>	
        <div class="m-0 p-0 row" style="bottom: 0">
        <div class="w-25 bg-danger" style="height: 5px;"></div>
        <div class="w-75" style="background-color: #171717; height: 5px;"></div>
    </div>
        </div>
		<div class="bg-white p-3">
			<div class="col-md-9 offset-3 font-weight-bold p-2">Welcome</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 ">
				<button class="accordion">Dashboard</button>
<div class="panel">
<p class="m-0">
	<a href="index" class="nav-link p-1 border-bottom text-dark posts" title="Homepage">
	<b class="fas fa-city mr-3"></b>
	Homepage
<b class="fas fa-caret-right float-right"></b>
</a>

  	<a href="logout" class="nav-link p-1 text-dark" title="Logout">
<b class="fas fa-question mr-3"></b>
Logout
<b class="fas fa-caret-right float-right"></b>
</a>
</p>
</div>

<button class="accordion"> Materials</button>
<div class="panel">
  <p class="m-0">
  	<!-- <a href="home" class="nav-link p-1 border-bottom text-dark" title="Start Exam">
<b class="fas fa-question mr-3"></b>
Start Exam
<b class="fas fa-caret-right float-right"></b>
</a> -->

	<a href="material" class="nav-link p-1 border-bottom text-dark" title="Course Material">
									<b class="fas fa-users mr-3"></b>
										Course Material
									<b class="fas fa-caret-right float-right"></b>
								</a>
<!------------------------------Results ------------------------------->
							
								
<!------------------------------Submission page ------------------------------->

<a href="submit_page" class="nav-link p-1  text-dark page">
<b class="fas fa-pager mr-3"></b>
Submission Page
<b class="fas fa-caret-right float-right"></b>
</a>
								
</p>
</div>

<button class="accordion"> Records</button>
<div class="panel">
  <p>
  	<!-- <a href="results" class="nav-link p-1 comment  border-bottom text-dark" title="Check Your Result">
<b class="fas fa-plus mr-3"></b>
Result Checker
<b class="fas fa-caret-right float-right"></b>
</a> -->
<a href="projects" class="nav-link p-1 border-bottom text-dark" title="view projects">
<b class="fas fa-cogs mr-3"></b>
Submitted Projects
<b class="fas fa-caret-right text-dark float-right"></b>
</a>
<!-- <a href="Outline" class="nav-link p-1 text-dark">
<b class="fas fa-pen-nib mr-3"></b>
Course Outline
<b class="fas fa-caret-right float-right"></b>
</a> -->
  </p>
</div>
			</div>
			<div class="col-md-9 rounded p-0"  style="border-top: 3px solid #00e6e6">