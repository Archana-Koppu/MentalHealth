<?php session_start(); ?>
<?php include "DBConnect.php" ?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
  <meta name="author" content="themefisher.com">

  <title>Mental Healthcare</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
  <!-- Slick Slider  CSS -->
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body id="top">

<header>
	<div class="header-top-bar">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<ul class="top-bar-info list-inline-item pl-0 mb-0">
						<li class="list-inline-item"><a href="mailto:support@gmail.com"><i class="icofont-support-faq mr-2"></i>mentalhealth@gamil.com</a></li>
						<li class="list-inline-item"><i class="icofont-phone mr-2"></i> +23-345-67890</li>
					</ul>
				</div>
				<div class="col-lg-6">
					<div class="text-lg-right top-right-bar mt-2 mt-lg-0">
						<?php
                  if(isset($_SESSION['patient']) || isset($_SESSION['doctor']) || isset($_SESSION['admin'])){
                  ?>
						<a href="Logout.php" >
							<span>Logout</span>
						</a>
					<?php } else {
						?>
						<a href="Login.php" >
							<span>Sign In</span>
						</a>
						<?php
					} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navigation" id="navbar">
		<div class="container">
		 	 <a class="navbar-brand" href="index.html">
			  	<img src="images/logo.png" alt="" class="img-fluid">
			  </a>

		  	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icofont-navigation-menu"></span>
		  </button>
	  
		  <div class="collapse navbar-collapse" id="navbarmain">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="index.php">Home</a>
			  </li>
			   <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
			    <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
			    <li class="nav-item"><a class="nav-link" href="department.php">Department</a></li>
			  	<!--<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="doctor.html" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Doctors <i class="icofont-thin-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdown03">
						<li><a class="dropdown-item" href="doctor.html">Doctors</a></li>
						<li><a class="dropdown-item" href="doctor-single.html">Doctor Single</a></li>
						<li><a class="dropdown-item" href="appoinment.html">Appoinment</a></li>
					</ul>
			  	</li> -->
				  <?php
                  if(isset($_SESSION['patient'])){
                  ?>
				  <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="doctor.html" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Apoointment & Progress <i class="icofont-thin-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdown03">
						<li>
							<a class="dropdown-item" href="BookAppoinment.php">Book Appointment</a>
						</li>
						<li>
							<a class="dropdown-item" href="PatientViewAppoinment.php">View Appointment</a>
						</li>
						<li>
							<a class="dropdown-item" href="PatientViewProgress.php">View Progress</a>
						</li>
					</ul>
			  	</li>
                  
                  <?php 
                  }
                  ?>
                  <?php
                  if(isset($_SESSION['doctor'])){
                  ?>
                  <li class="nav-item">
                    <a class="nav-link" href="DoctorDashboard.php">Doctor Dashboard</a>
                  </li>
                  <?php 
                  }
                  ?>
                  <?php
                  if(isset($_SESSION['admin'])){
                  ?>
                  <li class="nav-item">
                    <a class="nav-link" href="AdminDashboard.php">Admin Dashboard</a>
                  </li>
                  <?php 
                  }
                  ?>
			    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
			</ul>
		  </div>
		</div>
	</nav>
</header>