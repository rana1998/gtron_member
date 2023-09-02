<?php
include_once("template-parts/footer.php");
include_once("template-parts/header_links.php");
include_once("template-parts/navbar.php");
include_once("template-parts/sidebar.php");
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

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row withdrawalrow">
   <div class="col-md-4">
      <div class="leftwithdrawal">
         
         <h2>Submit a <span>Ticket</span></h2>

      </div>
   </div>
   <div class="col-md-6">
      <div class="rightwithdrawal">

       <label style="margin-top: -2vw;">Email</label>
       <input type="text" name="" placeholder="Enter email ID">

       <label>Select your Issue</label><br>
       <select>
          <option>-Select-</option>
       </select><br>

       <label>Write your Message</label><br>
       <textarea rows="5" placeholder="Type here..."></textarea><br>


       <button class="submit-btn">Submit Request</button>


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