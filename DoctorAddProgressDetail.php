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
						<h4 class="mt-4 mb-2  title-color">Add New Schedule</h4>
						<div class="form_container">
            <form action="" method="POST" class="contact__form">
              <div class="row">
                <div class="col-md-6 form-group">
                <label>Select Patient :</label>
                  <?php
                      $sel = "select * from patient where PID IN (select pid from appoinment where did=".$_SESSION['doctor_id']." group by PID)";
                      $result=mysqli_query($conn, $sel);
                    ?>
                    <select name="pid">
                      <?php while($r = mysqli_fetch_assoc($result)){                         
                    ?>
                    <option value="<?php echo $r["PID"] ?>"><?php echo $r["name"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6 form-group">
                <label>Select Appoinment ID :</label>
                  <?php
                      $sel = "select aid,(select name from patient where pid=appoinment.pid) as pid from appoinment where did=".$_SESSION["doctor_id"];
                      $result=mysqli_query($conn, $sel);
                    ?>
                    <select name="aid">
                      <?php while($r = mysqli_fetch_assoc($result)){                         
                    ?>
                    <option value="<?php echo $r["aid"] ?>"><?php echo $r["aid"]." - ".$r["pid"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6 form-group">
                <input type="text" name="progress" placeholder="Progress" />
                </div>
                </div>
                <div class="row">
                <div class="col-md-6 btn_box">
                  <input type="submit" value="Add Progress" name="patient_progress" class="btn btn-main btn-round-full" />
                </div>
                </div>
            </form>
          </div>
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
<?php
//Insert Records
if(isset($_REQUEST["patient_progress"])){
  $sql = "INSERT INTO patientprogress(`pid`,`did`,`aid`,`progress`) VALUES ('".$_REQUEST["pid"]."','".$_SESSION['doctor_id']."','".$_REQUEST["aid"]."','".$_REQUEST['progress']."')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>window.location='DoctorViewPatientProgress.php';</script>";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
mysqli_close($conn);
?>