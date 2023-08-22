<?php 
include "core/connection.php";
include('userInformation.php');
	// If the user is not logged in redirect to the login page...
if(!isset($_SESSION['user_name'])){
  header("Location: ../mlm_landing/index.php");
  exit();
}
$user_name = $_SESSION['user_name'];
// Getting User Status 
$sql = "SELECT * FROM user_registration WHERE user_name = ?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$data = $result->fetch_assoc();

$user_id = $data['id'];

$userStatus = $data['status'];
$total_invest = $data['total_invest'];
$totalIncome = $data['total_income'];
$full_name = $data['full_name'];
$fectchUserName = $data['user_name'];

$threexcamountt = $data['threex_amount'];
$userStreet = $data['address'];
$userCity = $data['city'];
$userState = $data['state'];
$userPostalCode = $data['postal_code'];
$userMobile = $data['phone'];
$userCountry = $data['country'];
$transactionPassword = $data['transaction_password'];
$userImage = $data['profile_pic'];
$email = $data['email'];
$userDirectBonus = $data['db'];
$userPassword = $data['password'];
$sponsorNameHeader = $data['sponsor_name'];
$userCurrentBalance = $data['current_balance'];
$userIWallet = $data['iwallet'];
// $userHoldBalance = $data['hold_balance'];
$userMaxIncome = $data['max_income'];
$userOldOtp = $data['otp_code'];
$pendingBalance = $data['pending_amount'];
$userUsdtTrcAdress = $data['wallet_address'];
$userPkgId = $data['pkg_id'];
// $dTeam = $data['d_team'];
$userDSales = $data['d_sale'];
$userTeamSales = $data['team_sales'];
$userDirectSales = $data['d_sale'];
$userTotalTeam = $data['total_team'];
$userDirectTeam = $data['direct_team'];
$userRank = $data['rank'];
$userKyc = $data['kyc'];
$roiToday = $data['roi_today'];
$roiDaily = $data['roi_daily'];
$sflag = $data['sflag'];
$userIdb= $data['idb'];
$userRoi= $data['roi'];
$userMonthlyShare = $data['monthly_share'];
// $leaderTeamSales = $data['leader_team_sales'];
// $leadershipBonus = $data['leadership_bonus'];
$activationFee = $data['activation_fee'];

$regDate=$data['date'];

$stmt->close();

// $packageId = $data['pkg_id'];
// if($packageId == 0){
//     header("location: buy-pkg.php?package_type=1");
// }

if($sflag != 1){
  unset($_SESSION['email']);
  unset($_SESSION['user_name']);
  $_SESSION['errorMsg'] = "Your account has been locked due to security reason.";
  header("Location: ../mlm_landing/index.php");
  exit();
}


// $packageDetailsQuery="select * from package where id='$userPkgId'";
// $packageDetailsQueryResult=mysqli_query($con,$packageDetailsQuery);
// $packageDetailsResult = mysqli_fetch_assoc($packageDetailsQueryResult);

// $userPkgName=$packageDetailsResult['pkg_name'];


$selectImages = "select * from project_management";
$resultImages = mysqli_query($con,$selectImages);
$rowImages = mysqli_fetch_assoc($resultImages);

$logo = $rowImages['logo'];
$favIcon = $rowImages['fav_icon'];

$logo1 = 'https://GTRON.com/admin_portal/'.$logo;
$favIcon1 = 'https://GTRON.com/admin_portal/'.$favIcon;
function header_links(){ 
	
?>
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Header Links Here -->
<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	
<?php } ?>
	
	