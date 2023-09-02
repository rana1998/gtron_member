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

	<title>Gtron MLM | Profile</title>
     
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
   
<h2><img src="assets/images/icons/user.svg">USER PROFILE<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="profile.php">/ Profile</a></span></h2>

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row profilerow">
   <div class="col-md-4">
      <div class="leftprofile">
         <div class="row">
            <div class="col-md-12 text-center">
               <img src="assets/images/profile.png" class="profile-img">
               <h3>Jayson Smith</h3>
               <button class="upload-btn">Upload New</button>
               <button class="remove-btn">Remove Photo</button>                 
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 col-6">
               <h4>Registered Date</h4>
               <h4>Account Status</h4>
               <h4>KYC Status</h4>
               <h4>Current Package</h4>
            </div>
            <div class="col-md-6 col-6 text-right">
               <h4 class="grey">July 12, 3033</h4>
               <h4 class="green">Active</h4>
               <h4 class="green">Verified</h4>
               <h4 class="blue">Starter</h4>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="rightprofile">
         <h2>Edit your<br><span>Profile</span></h2>
         <button class="save-btn">Save Changes</button>
         
         <div class="row input_row">
            <div class="col-md-6 col-6">
               <label>Full Name</label>
               <input type="text" name="" placeholder="Jayson Smith">
            </div>
            <div class="col-md-6 col-6">
               <label>Email Address</label>
               <input type="text" name="" placeholder="jayson56@gmail.com">
            </div>
         </div>

         <div class="row second_row">
            <div class="col-md-12">
               <label>Address</label>
               <input type="text" name="" placeholder="Street">
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <input type="text" name="" placeholder="City">
            </div>
            <div class="col-md-6">
               <input type="text" name="" placeholder="State">
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <input type="number" name="" placeholder="Pincode">
            </div>
            <div class="col-md-6">
               <input type="number" name="" placeholder="Phone">
            </div>
         </div>

         <div class="row second_row">
            <div class="col-md-6">
               <label>Country</label><br>
               <select name="country" id="country">
                <option value="India">India</option>
                <option value="usa">USA</option>
                <option value="england">England</option>
              </select>

            </div>
         </div>

         <div class="row second_row">
            <div class="col-md-6">
               <label>Transaction Password</label>
               <input type="password" name="" placeholder="********">
            </div>
            <div class="col-md-6">
               <p>Password should contain:</p>
               <ul>
                  <li>Minimum 8 characters</li>
                  <li>1 Digit</li>
                  <li>1 Capital Letter</li>
                  <li>1 Small Letter</li>
                  <li>1 Number</li>
               </ul>
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