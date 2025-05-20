  <?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  require 'PHPMailer/src/Exception.php';

  include "Header.php";
  
  ?>
  <?php if(isset($_SESSION["patient"])){ ?>
    <section class="contact-form-wrap section">
    <div class="container">
      <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <h2 class="text-md mb-2">Book Appointment</h2>
                    <div class="divider mx-auto my-4"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form id="contact-form" class="contact__form " method="post">
                    <div class="row">
                        <div class="col-lg-6">
                        <div class="form-group">
                        <input type="text" class="form-control" name="patient_name" value="<?php echo $_SESSION['patient']; ?>" />
                        </div>
                        </div>    
                        <div class="col-lg-6">
                            <div class="form-group">
                            <?php
                                $sel = "select * from doctor";
                                $result=mysqli_query($conn, $sel);
                              ?>
                              <select name="did" class="form-control">
                                <?php while($r = mysqli_fetch_assoc($result)){                         
                              ?>
                              <option>--- Select Doctor ---</option>
                              <option value="<?php echo $r["DID"] ?>"><?php echo $r["name"]; ?></option>
                              <?php } ?>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                            <input type="date" name="appoinment_date" class="form-control" placeholder="Appoinment Date" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <select name="selTime" class="form-control">
                              <option value="">--- Select Time ---</option>
                              <option value="10:00 AM TO 11:00 AM">10:00 AM TO 11:00 AM</option>
                              <option value="11:00 AM TO 12:00 PM">11:00 AM TO 12:00 PM</option>
                              <option value="01:00 PM TO 02:00 PM">01:00 PM TO 02:00 PM</option>
                              <option value="02:00 PM TO 03:00 PM">02:00 PM TO 03:00 PM</option>
                              <option value="04:00 PM TO 05:00 PM">04:00 PM TO 05:00 PM</option>
                              <option value="05:00 PM TO 06:00 PM">05:00 PM TO 06:00 PM</option>
                              <option value="06:00 PM TO 07:00 PM">06:00 PM TO 07:00 PM</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <input type="text" name="disease" placeholder="Disease" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <input type="text" name="symptoms" class="form-control" placeholder="Symptoms Details" />
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-main btn-round-full" type="submit" value="Book Appoinment" name="appoinment_book"></input>
                    </div>
                </form>
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
if(isset($_REQUEST["appoinment_book"])){
  $patientId = $_SESSION['patient_id'];
  $getPatientQuery = "SELECT name, email FROM patient WHERE pid = '$patientId'";
  $patientResult = mysqli_query($conn, $getPatientQuery);

  if ($patientResult && mysqli_num_rows($patientResult) > 0) {
      $row = mysqli_fetch_assoc($patientResult);
  } else {
      echo "<script>alert('Failed to retrieve patient details.');</script>";
      exit();
  }

  //$sql = "INSERT INTO `appoinment`(`pid`, `did`, `date`, `time`, `disease`, `symptoms`, `status`) VALUES ('".$_SESSION['patient_id']."','".$_REQUEST["did"]."','".$_REQUEST["appoinment_date"]."','".$_REQUEST["selTime"]."','".$_REQUEST["disease"]."','".$_REQUEST["symptoms"]."','waiting')";

  //if (mysqli_query($conn, $sql)) {
    //echo "<script>window.location='PatientViewAppoinment.php';</script>";
    $mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'archnakoppu@gmail.com'; // SMTP username
    $mail->Password   = 'ptcc vlim vzbn vdrl'; // SMTP password
    $mail->SMTPSecure = 'tls'; // or 'ssl'
    $mail->Port       = 587; // 465 for SSL
    $mail->SMTPDebug = 2;  

    // Recipients
    $mail->setFrom('archnakoppu@gmail.com', 'Mental Health Care');
    $mail->addAddress($row['email'], $row['name']); // Patient's email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Appointment Confirmation';
    $mail->Body    = "
        <h3>Dear {$row['name']},</h3>
        <p>Your appointment has been successfully booked.</p>
        <p><strong>Details:</strong></p>
        <ul>
            <li><strong>Doctor ID:</strong> {$_REQUEST['did']}</li>
            <li><strong>Date:</strong> {$_REQUEST['appoinment_date']}</li>
            <li><strong>Time:</strong> {$_REQUEST['selTime']}</li>
            <li><strong>Disease:</strong> {$_REQUEST['disease']}</li>
            <li><strong>Symptoms:</strong> {$_REQUEST['symptoms']}</li>
        </ul>
        <p>Status: <strong>Waiting</strong></p>
        <br>
        <p>Thank you for using our service.</p>
    ";

    $mail->send();
    echo "<script>alert('Appointment booked and confirmation email sent.');</script>";
} catch (Exception $e) {
    echo "<script>alert('Appointment booked but email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
}
  //} else {
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  //}
}
mysqli_close($conn);
?>
