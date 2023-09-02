<?php
ob_start();
$page_title="Dashboard";

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
<?php //echo sidebar_(); ?>
<?php echo sidebar_($userStatus,$userKyc); ?>

   <!-----SIDEBAR END---->

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
      <p id="walletAddressMsg"></p>
         <!-- <p>Wallet address : <span>0xAB99a674486F9A2856958214B413a33b91F1a4Df</span></p>  -->
         <p>Wallet address : <span id="walletAddressId"><?= $userUsdtTrcAdress ;?></span></p> 
         <!-- <button class="copy-btn"><img src="assets/images/icons/copy.svg">Copy</button> -->
         <!-- <p>Wallet address : <span>0xAB99a674486F9A2856958214B413a33b91F1a4Df</span></p>
         <button class="copy-btn"><img src="assets/images/icons/copy.svg">Copy</button> -->
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
      <div class="col-md-4 l-div">

         <div class="violet-div">
            <img src="assets/images/violet-graph.png">
            <p>Current Balance</p>
            <!-- <h2>$1,123.00</h2> -->
            <h2>$ <?= number_format($userCurrentBalance,2);?></h2>
           
         </div>
         <style>
               .middle .orange-div button {
                  width: 50%;
                  border: none;
                  background-color: #bdcad8;
                  margin-top: 0.3vw;
                  /* font-size: 0.55vw; */
                  padding: 0.4vw;
                  border-radius: 0.2vw;
               }
         </style>
         <div class="orange-div">
            <img src="assets/images/orange-graph.png">
            <p>Direct Referal</p>
            <!-- <h2>$8,964.00</h2> -->
            <h2><?= $totalDirectReferalCount ?></h2>
            <button   onclick="window.location.href='direct_team.php'">View</button>
         </div>

         <div class="grey-div">
            <div class="row">
               <div class="col-md-7 col-7">
                  <p>Level Bonus</p>
                  <!-- <h2>$867.00</h2> -->
                  <?=number_format($levelBonus,2)?>
               </div>
               <!-- <div class="col-md-5 col-5">
                  <p>Counts</p>
                  <h2>465</h2>
               </div> -->
            </div>
            <!-- <button>View</button> -->
            <button onclick="window.location.href='bonuses_summary.php'">View</button>
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
                  <img src="assets/images/pink-graph.png">
               </div>
            </div>
            <button>View</button>
      </div> -->

      <div class="pink-div">
            <div class="row">
               <div class="col-md-7">
                  <!-- <p>Referral Bonus(Pending)</p> -->
                  <p>Performance bonus</p>
                  <h2>$<?= number_format($pendingBalance,2);?></h2>
               </div>
               <div class="col-md-5">
                  <img src="assets/images/pink-graph.png">
               </div>
            </div>
            <button onclick="window.location.href='pending-wallet-balance-summary.php'">View</button>
      </div>


      <!-- <div class="green-div">
            <div class="row">
               <div class="col-md-7">
                  <p>Total Invested</p>
                  <h2>$1,556.00</h2>
               </div>
               <div class="col-md-5">
                  <img src="assets/images/green-graph.png">
               </div>
            </div>
      </div> -->


      <div class="blue-div">
            <!-- <div class="row">
               <div class="col-md-7 col-7">
                  <p>Divident Bonus</p>
                  <h2>$1,375.00</h2>
               </div>
               <div class="col-md-5 col-5">
                  <img src="assets/images/blue-graph-1.png">
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
                  <img src="assets/images/blue-graph-1.png">
               </div>
            </div>

            <!-- <div class="row second-row">
               <div class="col-md-7 col-7">
                  <p>Current 3x Bonus</p>
                  <h2>$1,375.00</h2>
               </div>
               <div class="col-md-5 col-5">
                  <img src="assets/images/blue-graph-2.png">
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
                  <img src="assets/images/blue-graph-2.png">
               </div>
            </div>

      </div>


      </div>
      <div class="col-md-3 r-div">
         
      <div class="package-div">
         <!-- <div class="white-div">
            <p>ACTIVE PACKAGE</p>
            <h2>100</h2>
            <img src="assets/images/white-graph.png">
         </div> -->
         <div class="white-div">
            <!-- <p>Active Investment</p> -->
            <p>ACTIVE PACKAGE</p>
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
            <img src="assets/images/white-graph.png">
         </div>

         <?php if($regDate != '') {?>
         <div class="row">
            <div class="col-md-12 text-center">
               <style>
               .rainbow-text.animated{
                  /* font-weight: 800!important; */
                  /* font-size: 18px!important; */
                  animation: rainbow-colors 2s linear infinite;
                  animation-delay: calc(-2s * var(--char-percent));
               }
               /* Unfortunately, browsers try to take the shortest distance between transition/animation properties, so a simple `0turn` to `1turn` doesn't get the proper effect. */
               @keyframes rainbow-colors {
                  0% { color: hsl(0turn, 90%, 65%); }
                  25% { color: hsl(.25turn, 90%, 65%); }
                  50% { color: hsl(.5turn, 90%, 65%); }
                  75% { color: hsl(.75turn, 90%, 65%); }
                  100% { color: hsl(1turn, 90%, 65%); }
               }
               </style>
               <!-- <h3>REMAINING TIME:</h3> -->
               <h3>JOINED TIME:</h3>
               <!-- <h4>01D   02H   07M   17S</h4> -->
               <h4 id="countdown" class="rainbow-text animated"></h4>

            </div>
         </div>
         <?php } ?>

         <!-- <button class="upgrade-btn"><img src="assets/images/icons/upgrade.svg">Upgrade</button> -->
         <button class="upgrade-btn" onclick="window.location.href='buy-pkg.php'"><img src="assets/images/icons/upgrade.svg">Upgrade Package</button>

         <hr/>
         <p>GTRON wallet balance</p>
         <h6>$<?php echo number_format($gtron_wallet,2); ?></h6>

         <p>FAST TRACK BONUS</p>


         <!-- <img src="assets/images/rewards.png" class="rewards"> -->
         <div class="super-outer">
         <?php


$sql="SELECT * FROM user_registration WHERE sponsor_name = ?";
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result

if ($result->num_rows > 0) {
$count = 0;
while( $data = $result->fetch_assoc()){
   if($count >  4) {
      break;
   }
$count = $count++;
   
?>
         <div class="super text-center">
            <h2><?php echo  '$'.$data['total_invest']; ?></h2>
            <p><?php echo  $data['user_name'];?></p>
         </div>
         <?php 
  }
    $stmt->close();

    }else{
      echo "<p class='text-default pl-4'>You Don't have any members in your Direct Team.</p>";
      $stmt->close();

    }


 ?>

         </div>


         <button onclick="window.location.href='direct_team.php'" class="tree-btn"> View</button>
         <style>
            .middle .package-div .pending-btn, .blocked-btn{
               color: grey;
               width: 100%;
               border: none;
               background-color: #FFFFFF;
               margin-top: 0.2vw;
               font-size: 0.55vw;
               padding: 0.4vw;
               border-radius: 0.2vw;
            }
         </style>
         <?php
         // Assume you retrieve the registered date from the database and store it in $registeredDate
         $registeredDate = new DateTime($regDate);

         // Get the current date and time as $currentDate
         $currentDate = new DateTime(); // This will use the current date and time

         $interval = $registeredDate->diff($currentDate);

         $daysInterval = $interval->days;

         if($count >=4 && $daysInterval == 7){
            ?>
         <button class="activated-btn">4x Activated</button>

         <?php } elseif($count < 4 && $daysInterval > 7)  {?>
            <button class="blocked-btn" disabled>4x blocked</button>

         <?php } else {?>
            <button class="pending-btn" disabled>4x pending</button>
         <?php }?>

      </div>

      </div>
   </div>



<div class="row">
   <!-- <div class="col-md-5 tree-div-outer">
      <div class="tree-div">
         <img src="assets/images/tree-view.png">
         <hr/>
         <h2>Tree View</h2>
      </div>
   </div> -->
   <div class="col-md-5 tree-div-outer">
      <div class="tree-div">
         <!-- <img src="assets/images/tree-view.png"> -->
          <div class="tree-div-inner">
             <img src="assets/images/icons/man.svg" class="main-man">
             <p class="text-1">MLM1</p>
             <img src="assets/images/icons/fork.svg" class="fork">
             <p class="text-2">MLM2</p>
             <p class="text-3">MLM3</p>
             <p class="text-4">MLM4</p>
             <p class="text-5">MLM5</p>
             <p class="text-6">MLM6</p>
             <p class="text-7">MLM7</p>
             <p class="text-8">MLM8</p>
             <p class="text-9">MLM9</p>
          </div>

         <hr/>
         <h2>Tree View</h2>
         <a href="tree.php"><button class="view-btn">View</button></a>
      </div>
   </div>
   <div class="col-md-7 announcements-outer">
   <?php 
         // Prepare and execute query
         $query = "SELECT * FROM announcement";
         $statement = $conn->prepare($query);
         $statement->execute();

         // Fetch data
         $announcements = $statement->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <div class="announcements">
         <h2><img src="assets/images/icons/horn.svg">Announcements:</h2>
         <?php foreach ($announcements as $announcement): ?>
            <p><img src="assets/images/icons/hor.svg"><?php echo $announcement['title']; ?> </p>
        <?php endforeach; ?>
         <!-- <p><img src="assets/images/icons/hor.svg">Refer more than 4 people and get exciting 
<b>GTRON Rewards.</b></p>
<p><img src="assets/images/icons/hor.svg">Refer more than 4 people and get exciting 
<b>GTRON Rewards.</b></p>
<p><img src="assets/images/icons/hor.svg">Refer more than 4 people and get exciting 
<b>GTRON Rewards.</b></p>
<p><img src="assets/images/icons/hor.svg">Refer more than 4 people and get exciting 
<b>GTRON Rewards.</b></p> -->
      </div>
   </div>
</div>



<div class="row">
   <div class="col-md-9 token-div">
      <!-- <p>GTron Token Wallet : <span>0xAB99a674486F9A2856958214B413a33b91F1a4Df</span></p>
      <h2>$957</h2> -->
      <p>GTron Token Wallet : <span><?= $userUsdtTrcAdress ;?></span></p>
      <h2>$0</h2>
      <a href="leadership-bonus.php"><button class="view-btn">View</button></a>
   </div>
</div>



</div>
<div class="right">
   
<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php echo $fectchUserName;?></button>


<h2><img src="assets/images/icons/withdrawals.svg">WITHDRAWALS</h2>


<div class="row">
   <div class="col-md-6 col-6" style="padding: 0.5vw;">
     <!-- <button onclick="window.location.href='withdrawal.php'" class="wallet-btn">TO GTRON WALLET</button>  -->
     <button onclick="window.location.href='withdrawal.php'" class="wallet-btn">WITHDRAWAL</button> 
   </div>
    <div class="col-md-6 col-6" style="padding: 0.5vw;">
      <button onclick="window.location.href='internal-wallet-transfer.php'" class="wallet-btn">Internal Wallet Transfer</button> 
    </div>
</div>


<!-- <div class="white-div text-center">
   <input type="text" name="" placeholder="Enter Here">
   <button class="withdraw-btn"><img src="assets/images/icons/withdraw.svg">Withdraw</button>
</div> -->



</div>

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

<script>
// Replace this timestamp with the timestamp from your table
// const tableTimestamp = new Date('2023-09-10T00:00:00Z').getTime();
const regDate = '<?php echo $regDate; ?>';
const tableTimestamp = new Date(regDate).getTime();

function updateCountdown() {
    // Get the current date and time
    const now = new Date().getTime();

    // Calculate the difference in milliseconds
   //  const timeRemaining = tableTimestamp - now;
    const timeRemaining = now - tableTimestamp;

    // Calculate days, hours, minutes, and seconds
    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    // Display the countdown
    if(document.getElementById('countdown')) {
      document.getElementById('countdown').innerHTML = `${days}D, ${hours}H, ${minutes}M, ${seconds}S`;
    }
}

// Initial update
updateCountdown();

// Update the countdown every second
setInterval(updateCountdown, 1000);
</script>


</body>
</html>