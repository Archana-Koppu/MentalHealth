<?php include "Header.php" ?>
<?php if(isset($_SESSION["doctor"])){
  if(isset($_REQUEST["updatepatient_progress"])){
  $sql = "UPDATE patientprogress SET `progress`='".$_REQUEST["progress"]."' WHERE pgid=".$_REQUEST["id"];

  if (mysqli_query($conn, $sql)) {
    echo "<script>window.location='DoctorViewPatientProgress.php';</script>";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  if(isset($_REQUEST["task"])){
  if($_REQUEST["task"]=="delete"){
    $sql = "DELETE FROM patientprogress WHERE pgid=".$_REQUEST["id"];
    if (mysqli_query($conn, $sql)) {
      echo "<script>window.location='DoctorViewPatientProgress.php';</script>";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  else if($_REQUEST["task"]=="update"){
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
						<h4 class="mt-4 mb-2  title-color">Update Progress</h4>
            <?php
            $sql = "select pgid,(select name from patient where pid=patientprogress.pid) as pid,aid,progress from patientprogress where pgid=".$_REQUEST["id"];
            $result=mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="form_container">
            <form action="" class="contact__form">
            <div class="row">
                <div class="col-lg-12">
                <label>Patient : <?php echo $row["pid"]; ?></label>
              </div>
              <div class="col-lg-12">
                <label>Appoinment ID : <?php echo $row["aid"]; ?></label>
              </div>
              
              <div class="col-lg-12">
                <div class="form-group"> 
                <input type="hidden" name="id" value="<?php echo $row["pgid"]; ?>" />	
                  <input type="text" name="progress" value="<?php echo $row["progress"]; ?>" placeholder="Progress" />
              </div>
              </div>
              <div class="col-lg-12"> 
                <input type="submit" value="Update Progress" name="updatepatient_progress" class="btn btn-main btn-round-full"/>
              </div>
            </form>
          </div>
          <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
}
}
} else {
  echo "<script>window.location='Login.php';</script>";
} ?>
<?php include "Footer.php"; ?>