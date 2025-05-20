<?php include "Header.php" ?>
<?php if(isset($_SESSION["admin"])){
  ?>
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize text-lg">Welcome, <span><?php echo $_SESSION['admin']; ?></span></h2>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="service-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="service-block mb-5">
					<div class="content">
						<h4 class="mt-4 mb-2 title-color">Manage Tasks</h4>
						<?php include "AdminDashboardSideMenu.php"; ?>
					</div>
				</div>
			</div>

			<div class="col-lg-8 col-md-8 col-sm-8">
				<div class="service-block">
					<div class="content">
						<h4 class="mt-4 mb-2  title-color">View Mental Health Details</h4>
						<table border=1 cellspacing=2 cellpadding=5>
            <?php
               $sql = "select mh_id,(select name from patient where patient.pid=patient_mentalhealth_problem.pid) as 'name',problem,problem_description,pre_treatment,treatment_history,status from patient_mentalhealth_problem";
              $result=mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                ?>
              <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Mental Health Issue</th>
                <th>Mental Health Details</th>
                <th>Treatment Taken</th>
                <th>History of Treatment</th>
                <th>status</th>
                <th colspan="2">Tasks</th>
              </tr>  
              <?php
                while($row = mysqli_fetch_assoc($result)){
              ?>  
              <tr>
                <td><?php echo $row["mh_id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["problem"]; ?></td>
                <td><?php echo $row["problem_description"]; ?></td>
                <td><?php echo $row["pre_treatment"]; ?></td>
                <td><?php echo $row["treatment_history"]; ?></td>
                <td><?php echo $row["status"]; ?></td>
                <td><a href="AdminUpdateDeleteMentalHealthStatus.php?id=<?php echo $row["mh_id"]; ?>&task=update">Update</a></td>
                <td><a href="AdminUpdateDeleteMentalHealthStatus.php?id=<?php echo $row["mh_id"]; ?>&task=delete">Delete</td>
              </tr>
              <?php
              }
            }
              ?>
              </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
  <?php } else {
  echo "<script>window.location='Login.php';</script>";
} ?>
<?php include "Footer.php"; ?>