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

	<title>Gtron MLM | Buy Package</title>
     
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
   
<h2><img src="assets/images/icons/dollar.svg">BUY PACKAGE<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="buy.php">/ Buy Package</a></span></h2>

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row buyrow">
   <div class="col-md-4">
      <div class="leftbuy">
         
         <h2>You Already
have <span>Package
Subscribed.</span></h2>

      <div class="green_div">
         <p>SUBSCRIBED</p>
         <h4>MLM1</h4>
         <img src="assets/images/icons/tick.svg">
      </div>

      <div class="grey_div">
         <p>Pending Referral Bonus</p>
         <h4>$977.00</h4>
      </div>
         
      </div>
   </div>
   <div class="col-md-6">
      <div class="rightbuy">
         
         <p>Select your desired package</p>

         <div class="row">
            <div class="col-md-6">
               <div class="package">
                  <p>MLM1</p>
                  <h4>$50</h4>
                  <button class="purchase-btn">Purchase</button>
               </div>
            </div>
            <div class="col-md-6">
               <div class="package">
                  <p>MLM2</p>
                  <h4>$100</h4>
                  <button class="purchase-btn">Purchase</button>
               </div>
            </div>
            <div class="col-md-6">
               <div class="package">
                  <p>MLM3</p>
                  <h4>$250</h4>
                  <button class="purchase-btn">Purchase</button>
               </div>
            </div>
            <div class="col-md-6">
               <div class="package">
                  <p>MLM4</p>
                  <h4>$500</h4>
                  <button class="purchase-btn">Purchase</button>
               </div>
            </div>
            <div class="col-md-6">
               <div class="package">
                  <p>MLM5</p>
                  <h4>$1000</h4>
                  <button class="purchase-btn">Purchase</button>
               </div>
            </div>
            <div class="col-md-6">
               <div class="package">
                  <p>TESTING</p>
                  <h4>$600</h4>
                  <button class="purchase-btn">Purchase</button>
               </div>
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