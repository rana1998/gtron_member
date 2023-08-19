<?php
ob_start();
$page_title="Dashboard";

include_once("components/footer.php");
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

.parent-container-alert {
   position: relative;
}   
.transparent-bg {
    background-color: rgba(0, 0, 0, 0); 
    border: none; /* No border */
    box-shadow: none; /* No shadow */
}
.alert-overlay {
    text-align: center;
    width: 100%; /* Adjust the width as needed */
    margin: 0 auto;
    
}

.alert {
    margin: 0;
    border-radius: 0;
    font-size: 1em; 
    white-space: wrap; 
}

.alert-dismissible {
    padding-right: 35px; /* To make space for the close button */
}

.alert strong {
    font-weight: bold;
}

/* Responsive Font Sizing using Media Queries */
@media (max-width: 992px) {
    :root {
        font-size: 14px; /* Adjust base font size for smaller screens */
    }

    .alert {
        font-size: 0.875em; /* Adjust font size for smaller screens */
    }
}
</style>   

   <!---------NAVBAR START------>
<?php echo navbar_(); ?>
   <!-----NAVBAR END---->



<section id="outer">
<?php
require 'connect.php';
$isPackageActive = 0;
$levelBonus = 0;

$sql = $conn->prepare("SELECT COUNT(*) AS total_count FROM user_registration WHERE sponsor_name = '".$_SESSION['user_name']."'");
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
$result = $sql->fetch();
$totalDirectReferalCount = $result['total_count'];


$sql= $conn->prepare("SELECT * FROM user_registration WHERE user_name='".$_SESSION['user_name']."'");
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
if($sql->rowCount()>0){
    foreach (($sql->fetchAll()) as $key => $row) {

        $threex_amount = $row['threex_amount'];
        $threex_amount_limit = $row['threex_amount_limit'];

        $limit = $threex_amount - $threex_amount_limit;

        $packageId = $row['pkg_id'];

        $current_bonus_status = $row['current_bonus_status'];

        if($packageId == 0){

            header("location: buy-pkg.php?package_type=1");

        }
        $threex_amount_limit_rem = $threex_amount_limit - 50;
        if($threex_amount >= $threex_amount_limit_rem){

            $isPackageActive = 1;

        }

        //find total level bonus
        $levelBonus = $row['l1'] + $row['l2'] + $row['l3'] + $row['l4'] + $row['l5'] + $row['l6'] + $row['l7'] + $row['l8'] + $row['l9'] + $row['l10'];
    }
}
?>



 <!---------SIDEBAR START------>
 <?php echo sidebar_(); ?>
   <!-----SIDEBAR END---->

<!-- <div class="left">
   <img src="assets-new/images/logo/logo.svg" class="logo">
   <ul>
      <li><a><img src="assets-new/images/icons/dashboard.svg" class="icon">Dashboard</a></li>
      <li><a><img src="assets-new/images/icons/link.svg" class="icon">Copy Sponsor Link</a></li>
      <li><a><img src="assets-new/images/icons/profile.svg" class="icon">Profile</a></li>
      <li><a><img src="assets-new/images/icons/kyc.svg" class="icon">KYC</a></li>
      <li><a><img src="assets-new/images/icons/buy.svg" class="icon">Buy Package</a></li>
      <li><a><img src="assets-new/images/icons/withdrawal.svg" class="icon">Withdrawal</a></li>
      <li><a><img src="assets-new/images/icons/wallet_transfer.svg" class="icon">Internal Wallet Transfer</a></li>
      <li><a><img src="assets-new/images/icons/network.svg" class="icon">Network</a></li>
      <li><a><img src="assets-new/images/icons/summary.svg" class="icon">Summary</a></li>
      <li><a><img src="assets-new/images/icons/support.svg" class="icon">Support</a></li>
   </ul>
   
   <button class="logout"><img src="assets-new/images/icons/logout.svg">Logout</button>

</div> -->
<div class="middle">

<!-- Start alert div managing -->
<div class="parent-container-alert">
<?php   
   if($isPackageActive == 1){
        echo '<div class="alert-overlay"><div class="alert alert-danger alert-dismissible transparent-bg">
        <strong>Your Package is about to expire. Please Purchase New Package to Start Using Our Service.</strong>
        </div></div>';
    } else  if($isPackageActive == 2){
        echo '<div class="alert-overlay"><div class="alert alert-danger alert-dismissible transparent-bg">
        <strong>Your Package is expired. Please Purchase New Package to Start Using Our Service.</strong>
        </div></div>';
    }  
?>   

<?php if(isset($_SESSION['successMsg'])): ?>
    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Success </h6>
                <div class=""><?php echo $_SESSION['successMsg']; ?></div>
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
                <h6 class="mb-0">Error </h6>
                <div class=""><?php echo $_SESSION['errorMsg']; ?></div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php  unset($_SESSION['errorMsg']);     endif;  ?>
</div>

<!-- END alert div managing -->

   
   <h1>
      <!-- <img src="assets-new/images/icons/profile.png"> -->
      <img src="<?php if($userImage == 'user-profile.png	') {echo "./user-profile.png";} else { echo $userImage;};?>">
      Welcome, <span><?php echo $fectchUserName;?></span>
   </h1>

   <div class="input-div">
    <img src="assets-new/images/icons/search.svg" class="search-icon">  
   <input class="search" type="search"  aria-label="Search">
    <button class="search-btn">Search</button>
   </div>


   <div class="row">
      <div class="col-md-8 wallet-div">
         <!-- <p>Wallet address : <span>0xAB99a674486F9A2856958214B413a33b91F1a4Df</span></p>  -->
         <p>Wallet address : <span><?= $userUsdtTrcAdress ;?></span></p> 
         <button class="copy-btn"><img src="assets-new/images/icons/copy.svg">Copy</button>
      </div>
      <div class="col-md-4 id-div">
         <div class="id-div-inner">
            <!-- <p>My User ID</p> 
            <span>15364</span> -->
            <p>My User ID</p> 
            <span><?= $user_id ;?></span>
         </div>
      </div>
   </div>

   
   <div class="row">
      <div class="col-md-4 l-div">

         <div class="violet-div">
            <img src="assets-new/images/violet-graph.png">
            <p>Current Balance</p>
            <h2>$<?= number_format($userCurrentBalance,2);?></h2>
         </div>
          
         <!-- <div class="orange-div">
            <img src="assets-new/images/orange-graph.png">
            <p>Direct Referal</p>
            <h2>$8,964.00</h2>
         </div> -->

         <div class="orange-div">
            <img src="assets-new/images/orange-graph.png">
            <p>Direct Referral</p>
            <h2><?= $totalDirectReferalCount ?></h2>
         </div>

         <div class="grey-div">
            <div class="row">
               <div class="col-md-7 col-7">
                  <p>Level Bonus</p>
                  <h2>$<?=number_format($levelBonus,2)?></h2>
               </div>
               <!-- <div class="col-md-5 col-5">
                  <p>Counts</p>
                  <h2>465</h2>
               </div> -->
            </div>
            <button>View</button>
         </div>


      </div>
      <div class="col-md-5 m-div">

       <!-- <div class="pink-div">
            <div class="row">
               <div class="col-md-7">
                  <p>Leadership Bonus</p>
                  <h2>$795.55</h2>
               </div>
               <div class="col-md-5">
                  <img src="assets-new/images/pink-graph.png">
               </div>
            </div>
            <button>View</button>
      </div> -->

      <div class="pink-div">
            <div class="row">
               <div class="col-md-7">
                  <p>Referral Bonus(Pending)</p>
                  <h2>$<?= number_format($pendingBalance,2);?></h2>
               </div>
               <div class="col-md-5">
                  <img src="assets-new/images/pink-graph.png">
               </div>
            </div>
            <button>View</button>
      </div>



      <!-- <div class="green-div">
            <div class="row">
               <div class="col-md-7">
                  <p>Total Invested</p>
                  <h2>$1,556.00</h2>
               </div>
               <div class="col-md-5">
                  <img src="assets-new/images/green-graph.png">
               </div>
            </div>
      </div> -->
      <div class="green-div">
            <div class="row">
               <div class="col-md-7">
                  <p>Total Invest</p>
                  <h2>$<?=number_format($total_invest,2)?></h2>
               </div>
               <div class="col-md-5">
                  <img src="assets-new/images/green-graph.png">
               </div>
            </div>
      </div>


      <div class="blue-div">
            <!-- <div class="row">
               <div class="col-md-7 col-7">
                  <p>Divident Bonus</p>
                  <h2>$1,375.00</h2>
               </div>
               <div class="col-md-5 col-5">
                  <img src="assets-new/images/blue-graph-1.png">
               </div>
            </div> -->
            <div class="row">
               <div class="col-md-7 col-7">
               <?php
                  require 'connect.php';
                  $sql= $conn->prepare("SELECT * FROM user_registration WHERE user_name='".$_SESSION['user_name']."'");
                  $sql->execute();
                  $sql->setFetchMode(PDO::FETCH_ASSOC);
                  if($sql->rowCount()>0){
                     foreach (($sql->fetchAll()) as $key => $row) {
                  
                        $pool_bonus = $row['threex_amount'];

                     }
                  }
               ?>
                  <p>Divident Bonus</p>
                  <h2>$<?php echo number_format($pool_bonus,2); ?></h2>
               </div>
               <div class="col-md-5 col-5">
                  <img src="assets-new/images/blue-graph-1.png">
               </div>
            </div>

            <!-- <div class="row second-row">
               <div class="col-md-7 col-7">
                  <p>Current 3x Bonus</p>
                  <h2>$1,375.00</h2>
               </div>
               <div class="col-md-5 col-5">
                  <img src="assets-new/images/blue-graph-2.png">
               </div>
            </div> -->

            <div class="row second-row">
               <div class="col-md-7 col-7">
                  <?php if($current_bonus_status == 'threeex'){ ?>
                        <p>Current 3x Amount: </p>
                  <?php }elseif($current_bonus_status == 'fourex'){ ?>
                     <p>Current 4x Amount: </p>
                  <?php } else{ ?>
                     <p>Current 2x Amount: </p>
                  <?php } ?>
                  <h2>$<?=number_format($threexcamountt,2)?></h2>
               </div>
               <div class="col-md-5 col-5">
                  <img src="assets-new/images/blue-graph-2.png">
               </div>
            </div>

      </div>


      </div>
      <div class="col-md-3 r-div">
         
      <div class="package-div">
         <!-- <div class="white-div">
            <p>ACTIVE PACKAGE</p>
            <h2>100</h2>
            <img src="assets-new/images/white-graph.png">
         </div> -->

         <div class="white-div">
            <p>Active Investment</p>
            <?php
                  require 'connect.php';
                  $sql= $conn->prepare("SELECT * FROM user_registration WHERE user_name='".$_SESSION['user_name']."'");
                  $sql->execute();
                  $sql->setFetchMode(PDO::FETCH_ASSOC);
                  if($sql->rowCount()>0){
                     foreach (($sql->fetchAll()) as $key => $row) {
                        $active_investment = $row['active_investment'];
                     }
                  }
            ?>
            <h2>$<?php echo number_format($active_investment,2); ?></h2>
            <img src="assets-new/images/white-graph.png">
         </div>

         <div class="row">
            <div class="col-md-12 text-center">
               <h3>REMAINING TIME:</h3>
               <h4>01D   02H   07M   17S</h4>
            </div>
         </div>

         <button class="upgrade-btn"><img src="assets-new/images/icons/upgrade.svg">Upgrade</button>

         <hr/>

         <p>SUPER REWARDS</p>
         <img src="assets-new/images/rewards.png" class="rewards">

         <button class="tree-btn">Tree View</button>
         <button class="activated-btn">4x Activated</button>



      </div>

      </div>
   </div>




<div class="row">
   <div class="col-md-5 tree-div-outer">
      <div class="tree-div">
         <img src="assets-new/images/tree-view.png">
         <hr/>
         <h2>Tree View</h2>
      </div>
   </div>
   <div class="col-md-7 announcements-outer">
      <div class="announcements">
         <h2><img src="assets-new/images/icons/horn.svg">Announcements:</h2>
         <p><img src="assets-new/images/icons/hor.svg">Refer more than 4 people and get exciting 
<b>GTRON Rewards.</b></p>
<p><img src="assets-new/images/icons/hor.svg">Refer more than 4 people and get exciting 
<b>GTRON Rewards.</b></p>
<p><img src="assets-new/images/icons/hor.svg">Refer more than 4 people and get exciting 
<b>GTRON Rewards.</b></p>
<p><img src="assets-new/images/icons/hor.svg">Refer more than 4 people and get exciting 
<b>GTRON Rewards.</b></p>
      </div>
   </div>
</div>



<div class="row">
   <div class="col-md-9 token-div">
      <!-- <p>GTron Token Wallet : <span>0xAB99a674486F9A2856958214B413a33b91F1a4Df</span></p> -->
      <!-- <h2>$957</h2> -->
      <p>GTron Token Wallet : <span><?= $userUsdtTrcAdress ;?></span></p>
      <h2>$0</h2>
   </div>
</div>



</div>
<div class="right">
   
<button class="profile-btn">
<!-- <img src="assets-new/images/icons/profile.png"> -->
<img src="<?php if($userImage == 'user-profile.png	') {echo "./user-profile.png";} else { echo $userImage;};?>">
<?php echo $fectchUserName;?></button>
<h2><img src="assets-new/images/icons/withdrawals.svg">WITHDRAWALS</h2>


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
   <button class="withdraw-btn"><img src="assets-new/images/icons/withdraw.svg">Withdraw</button>
</div>



</div>

</section>

















   <!---------FOOTER START------>
<?php echo footer_(); ?>
   <!---------FOOTER END------>

<!--------------------------- SCRIPTS ------------------------------------->

<script src="assets-new/js/bootstrap.min.js"></script>
<script src="assets-new/js/owl.carousel.min.js"></script>
<script src="assets-new/js/sweetalert2.min.js"></script>

<!--Added for alert Include Bootstrap CSS and JavaScript -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

</body>
</html>