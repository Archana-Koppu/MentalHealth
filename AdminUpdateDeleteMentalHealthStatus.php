<?php include "Header.php" ?>
<?php if(isset($_SESSION["admin"])){
  if(isset($_REQUEST["updatePatientStatus"])){
  $sql = "UPDATE patient_mentalhealth_problem SET status='".$_REQUEST["status"]."' WHERE mh_id=".$_REQUEST["id"];

  if (mysqli_query($conn, $sql)) {
    echo "<script>window.location='AdminMentalHeathDetails.php';</script>";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  if(isset($_REQUEST["task"])){
  if($_REQUEST["task"]=="delete"){
    $sql = "DELETE FROM patient_mentalhealth_problem WHERE mh_id=".$_REQUEST["id"];
    if (mysqli_query($conn, $sql)) {
      echo "<script>window.location='AdminMentalHeathDetails.php';</script>";
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
						<h4 class="mt-4 mb-2  title-color">Update Patient Status</h4>
						<?php
            $sql = "select mh_id,(select name from patient where patient.pid=patient_mentalhealth_problem.pid) as 'name',problem,problem_description,status from patient_mentalhealth_problem where mh_id=".$_REQUEST["id"];
            $result=mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="form_container">
            <form action="">
              <div class="row">
              <div class="col-lg-12 form-group">
                <input type="hidden" value="<?php echo $row["mh_id"]; ?>" name="id"/>
                <label>Name : <?php echo $row["name"]; ?></label>
              </div>
              <div class="col-lg-12 form-group">
                <label>Mental Problem : <?php echo $row["problem"]; ?></label>
              </div>
              <div class="col-lg-12 form-group">
                <label>Description : <?php echo $row["problem_description"]; ?></label>
              </div>
              <div class="col-lg-12 form-group">
                <label>Update Patient Status :</label>
                <select name="status" class="form-control">
                    <option value="new">new</option>
                    <option value="old">old</option>
                </select>
                
              </div>
              <div class="col-lg-12 form-group">
                <input type="submit" class="btn btn-main btn-round-full" value="Update" name="updatePatientStatus" />
              </div>
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