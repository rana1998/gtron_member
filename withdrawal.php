<?php

include_once("components/header_links.php");
include_once("components/navbar.php");
include_once("components/sidebar.php");
include_once("components/footer.php");

$page_title = 'Withdrawal Request';
// include 'header.php'; 

// Suppress warnings for this block of code
error_reporting(E_ALL & ~E_WARNING);
    
//Sb(QUZi5@t}
//mailcheck@eighty5technologies.com
//

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

  $transactionpassword  = mysqli_real_escape_string($con , $_POST['transactionpassword']);
  $amount_after_tax  = mysqli_real_escape_string($con , $_POST['amount_after_tax']);
  $btc_address       = $userUsdtTrcAdress;
  $otpCode              = mysqli_real_escape_string($con, $_POST['2facode']);
  $mode = 'USDT.TRC20';
//   $bank =  mysqli_real_escape_string($con, $_POST['bankName']);
//   $accountTitle =  mysqli_real_escape_string($con, $_POST['accountTitle']);
//   $accountNo =  mysqli_real_escape_string($con, $_POST['accountNo']);

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
  $currentOTP = $data['otp_code'];
}
  
if (empty($otpCode)) {
  $_SESSION['errorMsg'] = "Enter Your 2FA Code.";
  header('Location: withdrawal.php');
  exit();
}elseif($currentOTP != $otpCode){
  $_SESSION['errorMsg'] = "Please Enter Valid 2FA Code.";
  header('Location: withdrawal.php');
  exit();
}elseif(password_verify($transactionPassword, $transactionpassword)){
  $_SESSION['errorMsg'] = "Please Enter Correct Transaction Password..";
  header('Location: withdrawal.php');
  exit();
}
    

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
      // $sql="INSERT INTO withdrawal( `user_name`, `email`, `desire_amount`, `amount_after_tax`, `tax`, `mode`, `btc_address`, `status` )
      //               VALUES(?,?,?,?,?,?,?,?)";
      // $stmt = $con->prepare($sql);
      // $stmt->bind_param("ssdddsss",$user_name,$email,$desired_amount,$amountAfterTax,$withdrawalPercentage1,$mode,$btc_address,'Completed');
      //   if ($stmt->execute() === TRUE) {
      //       $stmt->close();
      //   }else{
      //     die(__LINE__ .' Invalid Query '. $con->error );
      //   }
      $date = date('Y-m-d');
      
     echo $sql="INSERT INTO `withdrawal`(`id`, `user_name`, `email`, `desire_amount`, `amount_after_tax`, `tax`, `mode`, `bank`, `account_title`, `account_no`, `btc_address`, `status`, `reject_reason`, `date`) 
     VALUES ('','$user_name','$email','$desired_amount','$amountAfterTax','$withdrawalPercentage1','$mode','','','','$btc_address','Completed','','$date')";
                   $run_insert = mysqli_query($con, $sql);
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
      $stmt->bind_param("ds",$desired_amount, $user_name);
        if ($stmt->execute() === TRUE) {
            $stmt->close();
            $_SESSION['successMsg'] = "Your Withdrawal Request is Processed Successfully. Please wait for 3-4 Block Confirmation to reflect amount in Your Wallet.";
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
<?php echo sidebar_($userStatus); ?>
   <!-----SIDEBAR END---->

<div class="middlee">
   
<h2><img src="assets/images/icons/with.svg">WITHDRAWAL<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="withdrawal.php">/ Withdrawal</a></span></h2>

<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>

<div class="row withdrawalrow">
   <div class="col-md-4">
      <div class="leftwithdrawal">
         
         <h2>To Request your Withdrawal,<span> Please fill the following form.</span></h2>

         <?php if(isset($_SESSION['successMsg'])): ?>
            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Success </h6>
                        <div class="text-white"><?php echo $_SESSION['successMsg']; ?></div>
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
                        <h6 class="mb-0 text-white">Error </h6>
                        <div class="text-white"><?php echo $_SESSION['errorMsg']; ?></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php  unset($_SESSION['errorMsg']);     endif;  ?>  

      </div>
   </div>
   <div class="col-md-6">

   <form method = "POST">

      <div class="rightwithdrawal">
    
       <div class="avail_div">
         <div class="row">
          <div class="col-md-4">
             <p>Available Balance</p>
             <!-- <h4>$23,950.00</h4> -->
             <input type="text" class="" id="avail_balance_withdrawal" name="avail_balance" value="<?= $current_balance ?>"  readonly = "">

          </div>
           <div class="col-md-8 second">
              <p>Your USDT (TRC20) Address</p>
              <h6><?= $userUsdtTrcAdress ;?></h6>
           </div>
           </div>
       </div>

       <label>Desired Amount</label>
       <!-- <input type="text" name="" placeholder="e.g."> -->
       <input type="text" class="form-control " id="desireAmountWithdrawal" name="desired_amount" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   autocomplete="off" placeholder="e.g. <?php echo $withDrawalLimit;?>" >


       <label>Amount the you will Receive <span>( <?=$withdrawalPercentage1?>% Withdrawal Fee.)</span><span id="usdAmountHERE"></span></label>
       <!-- <input type="text" name="" placeholder="Street"> -->
       <input type="text" class="form-control " id="txtValueWithdrawal" name="amount_after_tax" value="$0" readonly="" >

       <?php
            if(empty($userUsdtTrcAdress))
            {
            ?>
            <br>
            <b>Your address is not set </b><a href="profile.php"><span class="badge bg-success">Click here</span></a> <b> to set address</b>
            <br>
            
            <?php
            }
            else
            {
            ?>
            <div class="form-group mt-3">
                <label>Your USDT (TRC20) Address</label>
                <br>
                <b class="text-primary"><?=$userUsdtTrcAdress?></b>
            </div>
            
            <?php
            }
        ?>


        <label>Request for 2FA Code</label>
        <div class="row">
           <div class="col-md-8">
            <!-- <input type="text" name="" placeholder="Enter 2FA Code Sent on Email">   -->
            <input type="text" name="otpCode" class="" value="<?php echo $email; ?>" placeholder="Enter 2FA Code Sent on Email" readonly>

           </div>
           <div class="col-md-4">
                <button class="btn btn-secondary sendOtpEmail send-btn" type="button" >Send Code</button>
              <!-- <button class="send-btn">Send Code</button> -->
           </div>  
        </div>

        <?php if($email !== ""){ ?>
                <label for="txtValue">Enter 2FA Code Sent on Email:</label>
                <input type="text" class="form-control " placeholder="Enter 2FA Code Sent on Email" name="2facode" value="">
                <?php }else{ ?><b>Don't have Email Set? </b><a href="profile.php"><span class="badge bg-success">Click here</span></a> <b> to set.</b>
         <?php } ?>

         <!-- <label>Enter 2FA Cide sent on Email</label>
       <input type="text" name="" placeholder="Enter 2FA Code Sent on Email"> -->

       <!-- <label>Enter Transaction Password</label>
       <input type="text" name="" placeholder="Enter Transaction Password"> -->
       <label for="txtValue">Enter Transaction Password: </label>
        <input type="password" class="" placeholder="Enter Transaction Password" name="transactionpassword" value="">

       <p class="dont_p">
          Dont have Transaction password set?  <a>Click Here</a> to set.
       </p>

       <!-- <button class="submit-btn">Submit Now</button> -->
       <input class="submit-btn" name="withdrawal_request" type="submit" value="Submit Now">



      </div>
      </form>

   </div>
</div>




</div>


</section>




<?php //include 'footer.php'; ?>


   <!---------FOOTER START------>
<?php echo footer_(); ?>
   <!---------FOOTER END------>

<!--------------------------- SCRIPTS ------------------------------------->

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script>

<script>

    
      
    $('#desireAmountWithdrawal').on('keyup', function() {
    //   var desireValue = parseFloat($('#desireAmountWithdrawal').val());
    //   var avail_balance = parseFloat($('#avail_balance_withdrawal').val());
     
    //     if(desireValue == '')
    //     {
    //          finalAmount= '$0';
    //          $('#taxPercentage').html('');
    //          $('#taxAmountError').html('Minimum 20$');
    //     }
    //     else if(desireValue < 20)
    //     {
    //          finalAmount= '$0';
    //          $('#taxPercentage').html('');
    //          $('#taxAmountError').html('Minimum 20$');
    //     }
    //     else if(desireValue <= 50)
    //     {
    //          finalAmount = '$'+ (desireValue - 2);
    //          $('#taxPercentage').html('$2');
    //          $('#taxAmountError').html('');
    //     }
    //     else if(desireValue > 50)
    //     {
    //         finalAmount = '$'+ (desireValue - desireValue*0.03);
    //         $('#taxPercentage').html("");
    //         $('#taxAmountError').html('');
    //     }

    //   // withdrawal_amount =Math.round(withdrawal_amount);
    //   $('#txtValueWithdrawal').val(finalAmount);
      
      var desireValue = parseFloat($('#desireAmountWithdrawal').val());
      var avail_balance = parseFloat($('#avail_balance_withdrawal').val());
        var per = '<?php echo $withdrawalTax1 ?>';
        console.log(per)
        finalAmount = '$'+ (desireValue - desireValue*parseFloat(per));
        amountHere = '($' + (desireValue*parseFloat(per)) + ')';
        
        document.getElementById('usdAmountHERE').innerHTML = amountHere;

        // withdrawal_amount =Math.round(withdrawal_amount);
        $('#txtValueWithdrawal').val(finalAmount);
      
    });



    //otp email 2nd
    $(".sendOtpEmail").click(function(){
        var sendMail = 'Email Send';
        $(".sendOtpEmail").prop('disabled', true);
        $(".sendOtpEmail").text('Processing');
        $.post("ajax/otp_generator.php",{otp_send:sendMail},function(feedback){
            // alert(feedback);
            $('.emailMessageAjax').text(feedback);
            $(".sendOtpEmail").prop('disabled', false);
            $(".sendOtpEmail").text('SEND CODE');
        })
    
    //  alert("button work");
    })
  </script>


</body>
</html>