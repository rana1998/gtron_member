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

	<title>Gtron MLM | Direct Team</title>
     
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
   
<h2><img src="assets/images/icons/team.svg">DIRECT TEAM<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="direct-team.php">/ Direct Team</a></span></h2>

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row profilerow">
   <div class="col-md-11">

      <div class="row">
         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-1.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-2.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-3.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-4.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-5.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-6.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

          <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-7.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

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