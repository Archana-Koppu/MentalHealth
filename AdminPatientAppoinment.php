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
						<h4 class="mt-4 mb-2  title-color">Manage Patient Appointment</h4>
						<table border=1 cellspacing=2 cellpadding=5>
            <?php
               $sql = "select aid,(select name from patient where patient.pid=appoinment.pid) as pid,(select name from doctor where doctor.did=appoinment.did) as did,date,time,disease,symptoms,status from appoinment";
              $result=mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                ?>
              <tr>
                <th>AID</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>date</th>
                <th>time</th>
                <th>Disease</th>
                <th>Symptoms</th>
                <th>Status</th>
                <th colspan="2">Tasks</th>
              </tr>  
              <?php
                while($row = mysqli_fetch_assoc($result)){
              ?>  
              <tr>
                <td><?php echo $row["aid"]; ?></td>
                <td><?php echo $row["pid"]; ?></td>
                <td><?php echo $row["did"]; ?></td>
                <td><?php echo $row["date"]; ?></td>
                <td><?php echo $row["time"]; ?></td>
                <td><?php echo $row["disease"]; ?></td>
                <td><?php echo $row["symptoms"]; ?></td>
                <td><?php echo $row["status"]; ?></td>
                <td><a href="AdminUpdateDeleteAppoinmentStatus.php?id=<?php echo $row["aid"]; ?>&task=update">Update</a></td>
                <td><a href="AdminUpdateDeleteAppoinmentStatus.php?id=<?php echo $row["aid"]; ?>&task=delete">Delete</td>
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