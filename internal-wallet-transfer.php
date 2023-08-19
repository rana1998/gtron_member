<?php
include_once("components/footer.php");
include_once("components/header_links.php");
include_once("components/navbar.php");
include_once("components/sidebar.php");

$page_title = 'Internal Wallet Transfer';


// require 'connect.php';
include 'core/db_config.php';
$conn = getDB();

$sql= $conn->prepare("SELECT * FROM user_registration WHERE user_name='".$_SESSION['user_name']."'");
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
if($sql->rowCount()>0){
    foreach (($sql->fetchAll()) as $key => $row) {

        $threex_amount = $row['threex_amount'];
        $threex_amount_limit = $row['threex_amount_limit'];

        $limit = $threex_amount - $threex_amount_limit;

        $packageId = $row['pkg_id'];

        if($packageId == 0){

            header("location: buy-pkg.php?package_type=1");

        }
    }
}

// $day = date('l', time());
// if($day != 'Saturday' && $day != 'Sunday' ){
//     $_SESSION['errorMsg'] = "Withdrawal is available only Saturday and Sunday.";
//     header('Location: index.php');
//     exit();
// }

if($userKyc!='Verified')
{
    $_SESSION['errorMsg'] = "Please approve your KYC";
    header('Location: index.php');
    exit();
}


$sel = "select * from withdrawal_limit where id = '1'";
$res = mysqli_query($con,$sel);
$rr = mysqli_fetch_assoc($res);
$withDrawalLimit = $rr['amount'];


$sql = "SELECT * FROM user_registration WHERE user_name = ?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
if($result->num_rows < 1){
  $stmt->close();
  $_SESSION['errorMsg']='Invalid Request';
  header("Location: index.php");
  exit();
}else{
  $data = $result->fetch_assoc();
  $current_balance = $data['current_balance'];
  $email = $data['email'];
  $password = $data['password'];
}






    $select9 = "select * from taxes where type='withdrawal'";
    $result9 = mysqli_query($con,$select9);
    $row9 = mysqli_fetch_assoc($result9);
    $withdrawalPercentage1 = $row9['percentage'];
    $withdrawalTax1 = $withdrawalPercentage1/100;
    








if (isset($_POST['withdrawal_request']) && $_POST) {

  $avail_balance     = $userCurrentBalance;
  $desired_amount    = floatval( mysqli_real_escape_string($con , $_POST['desired_amount']) );
 

  $finalAmountTax = $desired_amount * $withdrawalTax1;
   



  // $tax = floatval($tax);
  // $tax = number_format($tax, 2);
  $amount_after_tax  = mysqli_real_escape_string($con , $_POST['amount_after_tax']);
  $btc_address       = $userUsdtTrcAdress;
  $otpCode              = mysqli_real_escape_string($con, $_POST['otpCode']);
  $mode = 'USDT.TRC20';
//   $bank =  mysqli_real_escape_string($con, $_POST['bankName']);
//   $accountTitle =  mysqli_real_escape_string($con, $_POST['accountTitle']);
//   $accountNo =  mysqli_real_escape_string($con, $_POST['accountNo']);


    
    

  // Check Validation
  if($avail_balance < $withDrawalLimit ){
    $_SESSION['errorMsg'] = "Your Available Balance is less than $withDrawalLimit.";
    header('Location: withdrawal.php');
    exit();
  }elseif ($desired_amount < $withDrawalLimit ) {
    $_SESSION['errorMsg'] = "Minimum withdrawal amount is $withDrawalLimit.";
    header('Location: withdrawal.php');
    exit();
  }elseif ($desired_amount > $avail_balance ) {
    $_SESSION['errorMsg'] = "Withdrawal amount is greater than your current balance.";
    header('Location: withdrawal.php');
    exit();
  }elseif (empty($otpCode)) {
    $_SESSION['errorMsg'] = "Enter Your 2FA Code.";
    header('Location: withdrawal.php');
    exit();
  }elseif($userOldOtp != $otpCode){
    $_SESSION['errorMsg'] = "Please Enter Valid 2FA Code.";
    header('Location: withdrawal.php');
    exit();
  }
  elseif(empty($mode))
  {
        $_SESSION['errorMsg'] = "Please Select Mode.";
        header('Location: withdrawal.php');
        exit();
  }
  elseif($mode=='USDT.TRC20' && empty($btc_address)) {
    $_SESSION['errorMsg'] = "Set your wallet address in profile";
    header('Location: withdrawal.php');
    exit();
  }
 
  else{
     
      
          
          $amountAfterTax = $desired_amount - $finalAmountTax;
          
         
          // Insert in Withdrawal table
      $sql="INSERT INTO withdrawal( `user_name`, `email`, `desire_amount`, `amount_after_tax`, `tax`, `mode`, `btc_address` )
                    VALUES(?,?,?,?,?,?,?)";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("ssdddss",$user_name,$email,$desired_amount,$amountAfterTax,$withdrawalPercentage1,$mode,$btc_address);
        if ($stmt->execute() === TRUE) {
            $stmt->close();
        }else{
          die(__LINE__ .' Invalid Query '. $con->error );
        }

// Insert Into Wallet Summary
          $insert = "INSERT INTO wallet_summary(`user_name`,`amount`,`description`,`wallet_type`,`type`) 
          VALUES('$user_name', '$desired_amount', 'Withdrawal Request', 'Cash Wallet', 'Debit')";
    
          $run_insert = mysqli_query($con, $insert);
          if(!$run_insert){
            echo '<h6>'.mysqli_error($con).'</h6>';
          }

      // Update User Balance $desired_amount $uname
      
      $sql = "UPDATE user_registration SET current_balance = current_balance - ? , otp_code = NULL WHERE  user_name = ?";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("ds",$amount_after_tax, $user_name);
        if ($stmt->execute() === TRUE) {
            $stmt->close();
            $_SESSION['successMsg'] = "Your Withdrawal Request Submit Successfully.";
            header('Location: withdrawal.php');
            exit();

        }else{
          die(__LINE__ .' Invalid Query '. $con->error );
        }
        
        //insert wallet summary
      
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<title>Gtron MLM | Internal Wallet Transfer</title>
     
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
<?php echo sidebar_(); ?>
   <!-----SIDEBAR END---->

<div class="middlee">
   
<h2><img src="assets/images/icons/with.svg">INTERNAL WALLET TRANSFER<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="internal-wallet-transfer.php">/ Internal Wallet Transfer</a></span></h2>

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row withdrawalrow">
   <div class="col-md-4">
      <div class="leftwithdrawal">
         
         <h2>To Transfer Available balance, <span>Please fill the following form.</span></h2>

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

       <label>Amount to be Transfered</label>
       <input type="text" name="" placeholder="e.g.">

       <label>Amount the you will Receive <span>( 10% Withdrawal Fee.)</span></label>
       <input type="text" name="" placeholder="$0">

        <label>Search user by Username</label>
        <div class="row">
           <div class="col-md-8">
            <input type="text" name="" placeholder="Enter Username or Email">  
           </div>
           <div class="col-md-4">
              <button class="send-btn">Search</button>
           </div>  
        </div>


       <button class="submit-btn">Submit</button>


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