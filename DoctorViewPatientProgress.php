<?php include "Header.php" ?>
<?php if(isset($_SESSION["doctor"])){
  ?>
  <section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize text-lg">Welcome, <span><?php echo $_SESSION['doctor']; ?></span></h2>
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
						<?php include "DoctorDashboardSideMenu.php"; ?>
					</div>
				</div>
			</div>

			<div class="col-lg-8 col-md-8 col-sm-8">
				<div class="service-block">
					<div class="content">
						<h4 class="mt-4 mb-2  title-color">Patient Progress Detail</h4>
            <a href="DoctorAddProgressDetail.php">Add Progress detail of the Patient</a>
						<table border=1 cellspacing=2 cellpadding=5>
            <?php
              $sql = "select pgid, aid, (select name from patient where pid=patientprogress.pid) as pid, progress from patientprogress where did=".$_SESSION['doctor_id'];
              
              $result=mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                ?>
              <tr>
                <th>Progreess ID</th>
                <th>Appintment ID</th>
                <th>Patient</th>
                <th>Progress</th>
                <th colspan="2">Tasks</th>
              </tr>  
              <?php
                while($row = mysqli_fetch_assoc($result)){
              ?>  
              <tr>
                <td><?php echo $row["pgid"]; ?></td>
                <td><?php echo $row["aid"]; ?></td>
                <td><?php echo $row["pid"]; ?></td>
                <td><?php echo $row["progress"]; ?></td>
                <td><a href="DoctorUpdateDeleteProgress.php?id=<?php echo $row["pgid"]; ?>&task=update">Update</a></td>
                <td><a href="DoctorUpdateDeleteProgress.php?id=<?php echo $row["pgid"]; ?>&task=delete">Delete</td>
              </tr>
              <?php
                }
              } else {
              	echo "<br>There is no Progress reports...";
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