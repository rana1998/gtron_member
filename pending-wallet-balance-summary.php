<?php
include_once("components/header_links.php");
include_once("components/navbar.php");
include_once("components/sidebar.php");
include_once("components/footer.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<title>Gtron MLM | Pending Wallet Balance Summary</title>
     
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
   
<h2><img src="assets/images/icons/notice.svg">CASH WALLET<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="pending-wallet-balance-summary.php">/ Cash Wallet</a></span></h2>

<!-- <button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button> -->
<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>


<div class="row pendingrow">
   <div class="col-md-9 pending">
     
<div class="table-responsive">      
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Amount</th>
      <th scope="col">Expires at</th>
      <th scope="col">Is Expired</th>
    </tr>
  </thead>
  <tbody>
<?php

$user_name = $_SESSION['user_name'];
$sql = "SELECT * FROM pending_pacakge_amount WHERE userid = ? ORDER BY id DESC"; // SQL with parameters
$stmt = $con->prepare($sql);

if ($stmt === false) {
    die('Error: ' . $con->error); // Display the error message
}

$stmt->bind_param("s", $user_name); // Bind the parameter
$stmt->execute(); // Execute the statement
$result = $stmt->get_result();
if($result->num_rows < 1){
    echo ' <tr>No recode found.</tr>';
    $stmt->close();
}else{
    $x = 1;
    while ($data = $result->fetch_assoc()): ?>

    

    <tr>
        <td><?= $x++; ?></td>
        <td><?= '$'. $data['amount'] ?></td>
        
        
        <td><?= $data['expires_at'] ?></td>
        <td><?php if ($data['is_expired'] == 0) {
  	            echo "<span class=\"badge bg-success\">No</span>"; 
  	            }
  	            
  	            else{
  	            echo "<span class=\"badge bg-danger\">Yes</span>";
  	            }
  	            
  	            ?></td>
                
        
        
        
        
        

        
    </tr>


    <?php endwhile;

}

?>
              </tbody>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Amount</th>
      <th scope="col">Expires at</th>
      <th scope="col">Is Expired</th>
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