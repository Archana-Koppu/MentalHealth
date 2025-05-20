<?php include "Header.php" ?>
<?php if(isset($_SESSION["admin"])){
  if(isset($_REQUEST["updatePatientAppoinment"])){
  $sql = "UPDATE appoinment SET status='".$_REQUEST["status"]."' WHERE aid=".$_REQUEST["id"];

  if (mysqli_query($conn, $sql)) {
    echo "<script>window.location='AdminPatientAppoinment.php';</script>";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  if(isset($_REQUEST["task"])){
  if($_REQUEST["task"]=="delete"){
    $sql = "DELETE FROM appoinment WHERE aid=".$_REQUEST["id"];
    if (mysqli_query($conn, $sql)) {
      echo "<script>window.location='AdminPatientAppoinment.php';</script>";
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
						<h4 class="mt-4 mb-2  title-color">Update Patient Appoinment Status</h4>
						<?php
            $sql = "select aid,(select name from patient where patient.pid=appoinment.pid) as pid,(select name from doctor where doctor.did=appoinment.did) as did,date,time,disease,symptoms,status from appoinment where aid=".$_REQUEST["id"];
            $result=mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="form_container">
            <form action="" class="contact__form">
            <div class="row">
                <div class="col-lg-12">
                <input type="hidden" value="<?php echo $row["aid"]; ?>" name="id"/>
                <label>Name : <?php echo $row["pid"]; ?></label>
                </div>
              
              <div class="col-lg-12">
                <label>Doctor : <?php echo $row["did"]; ?></label>
              </div>
              <div class="col-lg-12">
                <label>Date : <?php echo $row["date"]; ?>, Time : <?php echo $row["time"]; ?></label>
              </div>
              <div class="col-lg-12">
              <div class="form-group">
                <label>Update Appoinment Status :</label>
                <select name="status" class="form-control">
                    <option value="Visit Complete">Visit Complete</option>
                    <option value="Cancel">Cancel</option>
                </select>
            </div>
              </div>
              <div class="col-lg-12">
                <input type="submit" value="Update" class="btn btn-main btn-round-full" name="updatePatientAppoinment" />
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