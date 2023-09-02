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

	<title>Gtron MLM | Package Summary</title>
     
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
   
<h2><img src="assets/images/icons/notice.svg">PACKAGE SUMMARY<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="package-summary.php">/ Package Summary</a></span></h2>

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row packagerow">
   <div class="col-md-12 package">
     
<div class="table-responsive">      
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr No.</th>
      <th scope="col">Package</th>
      <th scope="col">Price</th>
      <th scope="col">Mode</th>
      <th scope="col">Transaction ID</th>
      <th scope="col">Transaction Status</th>
      <th scope="col">Order Date</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><p>1</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>
    <tr>
      <td><p>2</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>
    <tr>
      <td><p>3</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>
    <tr>
      <td><p>4</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>
    <tr>
      <td><p>5</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>
    <tr>
      <td><p>6</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>
    <tr>
      <td><p>7</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>
    <tr>
      <td><p>8</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>
    <tr>
      <td><p>9</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>
    <tr>
      <td><p>10</p></td>
      <td><p>MLM1</p></td>
      <td><p>$50</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>TXN-8347583577d</p></td>
      <td><p class="green">Completed</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
    </tr>

  </tbody>
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