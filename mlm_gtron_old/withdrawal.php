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

	<title>Gtron MLM | Withdrawal</title>
     
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
   
<h2><img src="assets/images/icons/with.svg">WITHDRAWAL<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="withdrawal.php">/ Withdrawal</a></span></h2>

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row withdrawalrow">
   <div class="col-md-4">
      <div class="leftwithdrawal">
         
         <h2>To Request your Withdrawal,<span> Please fill the following form.</span></h2>

      </div>
   </div>
   <div class="col-md-6">
      <div class="rightwithdrawal">
         
       <div class="avail_div">
         <div class="row">
          <div class="col-md-4">
             <p>Available Balance</p>
             <h4>$23,950.00</h4>
          </div>
           <div class="col-md-8 second">
              <p>Your USDT (TRC20) Address</p>
              <h6>0xAB99a674486F9A2856958214B413a33b91F1a4Df</h6>
           </div>
           </div>
       </div>

       <form>

       <label>Desired Amount</label>
       <input type="text" name="" placeholder="e.g.">

       <label>Amount the you will Receive <span>( 10% Withdrawal Fee.)</span></label>
       <input type="text" name="" placeholder="Street">

        <label>Request for 2FA Code</label>
        <div class="row">
           <div class="col-md-8">
            <input type="text" name="" placeholder="Enter 2FA Code Sent on Email">  
           </div>
           <div class="col-md-4">
              <button class="send-btn">Send Code</button>
           </div>  
        </div>

         <label>Enter 2FA Cide sent on Email</label>
       <input type="text" name="" placeholder="Enter 2FA Code Sent on Email">

       <label>Enter Transaction Password</label>
       <input type="text" name="" placeholder="Enter Transaction Password">

       <p class="dont_p">
          Dont have Transaction password set?  <a>Click Here</a> to set.
       </p>

       <button class="submit-btn">Submit Now</button>

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