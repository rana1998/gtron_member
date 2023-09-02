<?php
// include_once("template-parts/footer.php");
// include_once("template-parts/header_links.php");
// include_once("template-parts/navbar.php");
// include_once("template-parts/sidebar.php");

include_once("components/header_links.php");
include_once("components/navbar.php");
include_once("components/sidebar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<title>Gtron MLM | Main</title>
     
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
<?php //echo sidebar_(); ?>
<?php echo sidebar_($userStatus,$userKyc); ?>

   <!-----SIDEBAR END---->

<div class="middle">
   
   <!-- <h1><img src="assets/images/icons/profile.png">Welcome, <span>Jayson</span></h1> -->
   <h1>
      <!-- <img src="assets/images/icons/profile.png"> -->
      <!-- <img src="<?php if($userImage == 'user-profile.png	') {echo "./user-profile.png";} else { echo $userImage;};?>"> -->
      <img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>">

      Welcome, <span><?php echo $fectchUserName;?></span>
   </h1>

   <!-- <div class="input-div">
    <img src="assets/images/icons/search.svg" class="search-icon">  
   <input class="search" type="search"  aria-label="Search">
    <button class="search-btn">Search</button>
   </div> -->


   <div class="row">
      <div class="col-md-8 wallet-div">
         <!-- <p>Wallet address : <span>0xAB99a674486F9A2856958214B413a33b91F1a4Df</span></p>
         <button class="copy-btn"><img src="assets/images/icons/copy.svg">Copy</button> -->
         <p id="walletAddressMsg"></p>
         <!-- <p>Wallet address : <span>0xAB99a674486F9A2856958214B413a33b91F1a4Df</span></p>  -->
         <p>Wallet address : <span id="walletAddressId"><?= $userUsdtTrcAdress ;?></span></p> 
         <!-- <button class="copy-btn"><img src="assets/images/icons/copy.svg">Copy</button> -->
      </div>
      <div class="col-md-4 id-div">
         <div class="id-div-inner">
            <p>My User ID</p> 
            <!-- <span>15364</span> -->
            <span><?= $user_id ;?></span>
         </div>
      </div>
   </div>


   <div class="row">
      <div class="col-md-7 leadership">
         <div class="row">
            <div class="col-md-6 col-6">
               <!-- <h2>Leadership Bonus</h2>
               <h3>795.00</h3> -->
               <h2>GTRON wallet balance</h2>
         <h3>$<?php echo number_format($gtron_wallet,2); ?></h3>
            </div>
            <div class="col-md-6 col-6">
               <img src="assets/images/pink-graph.png">
            </div>
         </div>
        

        <div class="table-responsive">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Source</th>
      <th scope="col">USDT Amount</th>
      <th scope="col">GTC Amount</th>
      <th scope="col">Datetime</th>
    </tr>
  </thead>
  <tbody>
   <?php 
   $count = 0;
   $sql="SELECT * FROM referral_performance_bonus WHERE user_id = ?";
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $$user_id);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result

if ($result->num_rows > 0) {
while( $data = $result->fetch_assoc()){
   ?>
    <tr>
      <td><?php echo $count;?></td>
      <td><?php echo "Referral Performance Bonus";?></td>
      <td><?php echo $data['usdt_bonus'];?></td>
      <td><?php echo $data['gtc_bonus'];?></td>
      <td><?php echo $data['date'];?></td>
   </tr>
<?php 
$count = $count++;
  }
    $stmt->close();

    }else{ ?>
      <tr>
      <td>--</td>
      <td><?php echo "Referral Performance Bonus";?></td>
      <td>--</td>
      <td>--</td>
      <td>--</td>
   </tr>
     <?php   
     //echo "<p class='text-default pl-4'>You Don't have any members in your Direct Team.</p>"; 
      $stmt->close();

    }


 ?>

<?php 
   $sql="SELECT * FROM package_bonuses WHERE wallet_address = ?";
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $$userUsdtTrcAdress);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result

if ($result->num_rows > 0) {
while( $data = $result->fetch_assoc()){
   ?>
    <tr>
      <td><?php echo $count;?></td>
      <td><?php echo "Package bonuses";?></td>
      <td>--</td>
      <td><?php echo $data['gtc_bonus'];?></td>
      <td><?php echo $data['date'];?></td>
   </tr>
<?php 
$count = $count++;
  }
    $stmt->close();

    }else{ ?>
      <tr>
      <td>--</td>
      <td><?php echo "Package bonuses";?></td>
      <td>--</td>
      <td>--</td>
      <td>--</td>
   </tr>
     <?php   
     //echo "<p class='text-default pl-4'>You Don't have any members in your Direct Team.</p>"; 
      $stmt->close();

    }


 ?>

 
<?php 
   $sql="SELECT * FROM pre_registration WHERE contact_no = ?";
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $$userMobile);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result

if ($result->num_rows > 0) {
while( $data = $result->fetch_assoc()){
   ?>
    <tr>
      <td><?php echo $count;?></td>
      <td><?php echo "Preregistration bonus";?></td>
      <td><?php echo $data['gtron'];?></td>
      <td>--</td>
      <td><?php echo $data['registration_date'];?></td>
   </tr>
<?php 
$count = $count++;
  }
    $stmt->close();

    }else{ ?>
      <tr>
      <td>--</td>
      <td><?php echo "Preregistration bonuse";?></td>
      <td>--</td>
      <td>--</td>
      <td>--</td>
   </tr>
     <?php   
     //echo "<p class='text-default pl-4'>You Don't have any members in your Direct Team.</p>"; 
      $stmt->close();

    }


 ?>

  </tbody>
</table>
</div>

<button class="collapse-btn">Token</button>

      </div>
   </div>

   
 



</div>
<!-- <div class="right">
   
<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>
<h2><img src="assets/images/icons/withdrawals.svg">WITHDRAWALS</h2>


<div class="row">
   <div class="col-md-6 col-6" style="padding: 0.5vw;">
     <button class="wallet-btn">TO GTRON WALLET</button> 
   </div>
    <div class="col-md-6 col-6" style="padding: 0.5vw;">
      <button class="wallet-btn">TO CRYPTO WALLET</button> 
    </div>
</div>


<div class="white-div text-center">
   <input type="text" name="" placeholder="Enter Here">
   <button class="withdraw-btn"><img src="assets/images/icons/withdraw.svg">Withdraw</button>
</div>



</div> -->

</section>

















   <!---------FOOTER START------>
<?php //echo footer_(); ?>
<?php include_once("components/footer.php"); ?>

   <!---------FOOTER END------>

<!--------------------------- SCRIPTS ------------------------------------->

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script>

<script>
$(document).ready(function() {
        $(".copy-btn").click(function() {
            // Get the wallet address text
            var walletAddress = $("#walletAddressId").text();

            // Create a hidden input element
            var tempInput = $("<input>");
            $("body").append(tempInput);
            tempInput.val(walletAddress).select();

            // Copy the wallet address to the clipboard
            document.execCommand("copy");
            tempInput.remove();

            // Show success message
            $("#walletAddressMsg").text("Copied address successfully").css("color", "green");

            // Hide the message after a delay
            setTimeout(function() {
                $("#walletAddressMsg").text("").css("color", ""); // Clear the message and reset color
            }, 3000); // 3000 milliseconds (3 seconds) delay

        });
    });
</script>

</body>
</html>