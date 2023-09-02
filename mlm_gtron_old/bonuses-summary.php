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

	<title>Gtron MLM | Bonuses Summary</title>
     
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
   
<h2><img src="assets/images/icons/notice.svg">LEVEL BONUS SUMMARY<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="bonuses-summary.php">/ Level Bonus Summary</a></span></h2>

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row pendingrow">
   <div class="col-md-12 pending">
     
<div class="table-responsive">      
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr</th>
      <th scope="col">From</th>
      <th scope="col">Bonus Amount</th>
      <th scope="col">Level</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <!-- <tr>
      <td><p>1</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
    </tr> -->
  </tbody>
  <thead>
    <tr>
      <th scope="col">Sr</th>
      <th scope="col">From</th>
      <th scope="col">Bonus Amount</th>
      <th scope="col">Level</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
</table>
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