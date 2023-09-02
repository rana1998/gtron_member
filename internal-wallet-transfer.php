<?php
include_once("components/header_links.php");
include_once("components/navbar.php");
include_once("components/sidebar.php");
// include_once("components/footer.php");


// Suppress warnings for this block of code
error_reporting(E_ALL & ~E_WARNING);

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
<?php echo sidebar_($userStatus,$userKyc); ?>
   <!-----SIDEBAR END---->

<div class="middlee">
   
<h2><img src="assets/images/icons/with.svg">INTERNAL WALLET TRANSFER<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="internal-wallet-transfer.php">/ Internal Wallet Transfer</a></span></h2>

<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>


<div class="row withdrawalrow">
   <div class="col-md-4">
      <div class="leftwithdrawal">
         
         <h2>To Transfer Available balance, <span>Please fill the following form.</span></h2>

      </div>
   </div>
   <div class="col-md-6">
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
            <!-- <hr> -->
         <form method = "POST">
      <div class="rightwithdrawal">
       <div class="avail_div">
         <div class="row">
          <div class="col-md-4">
             <p>Available Balance</p>
             <!-- <h4>$23,950.00</h4> -->
             <input type="text" class="" id="avail_balance" name="avail_balance" value="<?= $current_balance ?>"  readonly = "">

          </div>
           <div class="col-md-8 second">
              <p>Your USDT (TRC20) Address</p>
              <h6><?= $userUsdtTrcAdress ;?></h6>
           </div>
           </div>
       </div>

       <label>Amount to be Transfered</label>
       <!-- <input type="text" name="" placeholder="e.g."> -->
       <input type="number" class="form-control " id="desireAmountWithdrawal" name="desired_amount" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   autocomplete="off" placeholder="e.g. <?php echo $withDrawalLimit;?>" >


       <label>Amount the you will Receive <span>( 10% Withdrawal Fee.)</span></label>
       <!-- <input type="text" name="" placeholder="$0"> -->
         <input type="text" class="form-control " id="txtValueWithdrawal" name="amount_after_tax" value="$0" readonly="" >
         <input type="hidden" class="form-control " id="txtValueWithdrawalHidden" name="amount_after_tax_hidden" value="0" readonly="" >

        <label>Search user by Username</label>
        <div class="row">
           <div class="col-md-8">
            <!-- <input type="text" name="" placeholder="Enter Username or Email">   -->
            <input type="text" placeholder="Enter user name or Email" class="form-control " id="username_serach" name="username" value="">

           </div>
           <div class="col-md-4">
              <button class="send-btn checkUserName">Search</button>
           </div>  
        </div>


       <!-- <button class="submit-btn buttonProcessing" id="transfer_request" onclick="transfer_request();">Submit</button> -->
       <!-- <a class="btn bg-gradient-rose-button text-white buttonProcessing" id="transfer_request" onclick="transfer_request();">Submit</a> -->
       <a class="btn bg-gradient-rose-button submit-btn buttonProcessing" id="transfer_request" style="display: flex;align-items: center;justify-content: center;width: 20%;" onclick="transfer_request();">Submit</a>

      </div>
            </form>
   </div>
</div>




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

<?php //include 'footer.php'; ?>


<script>
   //   $(document).ready(function() {
   //  $('.js-example-basic-single').select2();
   //    });
   </script>
   
   <script>
     
     function SelectedUser() {
  var x = document.getElementById("selectedUser").value;
  document.getElementById("demo").innerHTML = "Username: " + x;
}


      function transfer_request(){
         var avail_balance = $('#avail_balance').val();
         var desired_amount_transfer = $('#desireAmountWithdrawal').val();
         var selectedUser = $('#username_serach').val();
         var amount_after_tax = $('#txtValueWithdrawalHidden').val();

         // alert(avail_balance);

         if (desired_amount_transfer=='') {
            // alert("Please enter the amount to be transfered");
            Toastify({
  text: "Please enter the amount to be transfered",
  duration: 3000,
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "center", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #FF0000, #CB4335)",
  },
  onClick: function(){} // Callback after click
}).showToast();
        }
        else if(selectedUser==''){
          // alert("Please select an user");
          Toastify({
  text: "Please Enter User Name",
  duration: 3000,
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "center", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #FF0000, #CB4335)",
  },
  onClick: function(){} // Callback after click
}).showToast();
        }
        else{



          $.ajax

    ({

   type: "POST",

   url: "internal-wallet-transfer-GET.php",

   data : {
  avail_balance:avail_balance,
  desired_amount_transfer:desired_amount_transfer,
  amount_after_tax:amount_after_tax,
  selectedUser:selectedUser,
  },

success: function (data) {


              if(data==1){

             // alert("Balance Transfered Successfully!");
            Toastify({
  text: "Balance Transfered Successfully!",
  duration: 3000,
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "center", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #00b09b, #96c93d)",
  },
  onClick: function(){} // Callback after click
}).showToast();
setTimeout(function(){
   window.location.reload();
}, 2000);


              }
              else if(data==2){
                // alert("Transfer money is more than your available balance");
                Toastify({
  text: "Transfer money is more than your available balance!",
  duration: 3000,
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "center", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #FF0000, #CB4335)",
  },
  onClick: function(){} // Callback after click
}).showToast();

              } else if(data==5){
                // alert("Transfer money is more than your available balance");
                Toastify({
  text: "User with this Email or User name not found! Please Enter Correct details and click on Search User.",
  duration: 3000,
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "center", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #FF0000, #CB4335)",
  },
  onClick: function(){} // Callback after click
}).showToast();

              }

              else{

            // alert("Error sending money");
              Toastify({
  text: "Error sending money!",
  duration: 3000,
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "center", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #FF0000, #CB4335)",
  },
  onClick: function(){} // Callback after click
}).showToast();

              }

         

      }

   });

    
          
        }


      }

   </script>


   
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
      var avail_balance = parseFloat($('#avail_balance').val());
        var per = '<?php echo $withdrawalTax ?>';
        console.log(per)
        finalAmountHidden = (desireValue - desireValue*parseFloat(per));
        finalAmount = '$'+ (desireValue - desireValue*parseFloat(per));
        amountHere = '($' + (desireValue*parseFloat(per)) + ')';
        
        document.getElementById('usdAmountHERE').innerHTML = amountHere;

        // withdrawal_amount =Math.round(withdrawal_amount);
        $('#txtValueWithdrawalHidden').val(finalAmountHidden);
        $('#txtValueWithdrawal').val(finalAmount);
      
    });
  </script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</body>
</html>