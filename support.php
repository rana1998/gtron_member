<?php
include_once("components/header_links.php");
include_once("components/navbar.php");
include_once("components/sidebar.php");
include_once("components/footer.php");



if (isset($_POST['submit_ticket'])) {
    $user_name = $_SESSION['user_name'];
    $subject = mysqli_real_escape_string($con, $_POST['subject']) ;
    $message = mysqli_real_escape_string($con, $_POST['message']) ;

    if(empty($subject) || empty($message)){
          $_SESSION['errorMsg'] =  "Please Complete the following form";
          header("Location: support.php");
          exit();

    }

    $sql="INSERT INTO support (`user_name`,`subject`,`message`) VALUES (?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $user_name, $subject, $message);
      if ($stmt->execute() === TRUE) {
          $stmt->close();
          $_SESSION['successMsg']='You Ticket has been submmit successfully.';
          header("Location: support.php");
          exit();

      }else{
          $_SESSION['errorMsg'] =  "Error inserting record: " . $con->error;
          $stmt->close();
          header("Location: support.php");
          exit();
      }

  } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<title>Gtron MLM | Support</title>
     
  <?php echo header_links(); ?>

</head>
<body >


 <style>
  .owl-nav.disabled{
    display: none !important;
  }
</style>   

   <!---------NAVBAR START------>
<?php echo navbar_(); ?>
   <!-----NAVBAR END---->



<section id="outer">

   <!---------SIDEBAR START------>
<?php echo sidebar_($userStatus,$userKyc); ?>
   <!-----SIDEBAR END---->

<div class="middlee">
   
<h2><img src="assets/images/icons/supportt.svg">SUPPORT<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="support.php">/ Support</a></span></h2>

<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>

<div class="row withdrawalrow">
   <div class="col-md-4">
      <div class="leftwithdrawal">
         
         <h2>Submit a <span>Ticket</span></h2>
         <?php if(isset($_SESSION['successMsg'])): ?>
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white">Success </h6>
                    <div class="text-white"><?php echo $_SESSION['successMsg']; ?></div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php  unset($_SESSION['successMsg']);     endif;  ?>
        
        <?php if(isset($_SESSION['errorMsg'])): ?>
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white">Error </h6>
                    <div class="text-white"><?php echo $_SESSION['errorMsg']; ?></div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php  unset($_SESSION['errorMsg']);     endif;  ?>


      </div>
   </div>
   <div class="col-md-6">
      <div class="rightwithdrawal">
      <form method = "POST">

       <label style="margin-top: -2vw;">Email</label>
       <input type="text" name="" value="<?= $email?>" placeholder="Enter email ID" readonly>

        <label for="selectIssue">Select Issue</label>
        <select id="selectIssue" class="form-control form-control-rounded single-select" name="subject">
            <option value="">-Select-</option>
            <option value="Registration Related Issue">Registration Related Issue</option>
            <option value="Password Related Issue">Password Related Issue</option>
            <option value="Deposit Related Issue">Deposit Related Issue</option>
            <option value="Membership Related Issue">Membership Related Issue</option>
            <option value="Other">Other</option>
        </select>
       
       <br>

       <!-- <label>Write your Message</label><br>
       <textarea rows="5" placeholder="Type here..."></textarea><br> -->
        <label for="messageText">Message</label>
		<textarea class="form-control" id="messageText" name="message" rows="5" placeholder="Message" ></textarea>
       <!-- <button class="submit-btn">Submit Request</button> -->
        <div class="form-group">
            <button type="submit" class="btn  submit-btn mt-3" name = "submit_ticket"><i class="icon-lock"></i> Submit Request</button>
        </div>
       </form>


      </div>
   </div>
</div>




</div>


</section>

















   <!---------FOOTER START------>
<?php echo footer_(); ?>
   <!---------FOOTER END------>

<!--------------------------- SCRIPTS ------------------------------------->

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script>


</body>
</html>