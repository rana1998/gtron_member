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

	<title>Gtron MLM | Wallet Summary</title>
     
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
   
<h2><img src="assets/images/icons/notice.svg">WALLET SUMMARY<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="package-summary.php">/ Wallet Summary</a></span></h2>

<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>

<div class="row packagerow">
   <div class="col-md-12 package">
     
<div class="table-responsive">      
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr No.</th>
      <th scope="col">Amount</th>
      <th scope="col">Description</th>
      <th scope="col">Type</th>
      <th scope="col">Date</th>
      <th scope="col">Transaction Status</th>
    </tr>
  </thead>
  <tbody>
<?php
$user_name = $_SESSION['user_name'];
$sql = "SELECT * FROM wallet_summary WHERE user_name = ? AND wallet_type = 'Cash Wallet' ORDER BY id DESC"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
if($result->num_rows < 1){
    echo ' <tr>No recode found.</tr>';
    $stmt->close();
}else{
    $x = 1;
    while ($data = $result->fetch_assoc()): ?>
    <?php $type = $data['type'];
          $primary = 0;
    // echo "$type";
    
    ?>
    

    <tr>
        <td><?= $x++; ?></td>
        <td><?= '$'. $data['amount'] ?></td>
        <td><?= $data['description'] ?></td>
        
        
        
        <td><?php if ($type == 'Credit') {
  	            echo "<span class=\"badge bg-success\">Credit</span>"; 
  	            }
  	            
  	            elseif ($type == 'Debit') {
  	            echo "<span class=\"badge bg-danger\">Debit</span>";
  	            }
  	            
  	            ?></td>
                <td><?= $data['date'] ?></td>
        <td><?php echo "<span class=\"badge bg-success\">Success</span>"; ?></td>
        
    </tr>


    <?php endwhile;

}

?>
              </tbody>
  <!-- <tbody>
    <tr>
      <td><p>1</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
    <tr>
      <td><p>2</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
    <tr>
      <td><p>3</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
    <tr>
      <td><p>4</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
    <tr>
      <td><p>5</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
    <tr>
      <td><p>6</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
    <tr>
      <td><p>7</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
    <tr>
      <td><p>8</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
    <tr>
      <td><p>9</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
    <tr>
      <td><p>10</p></td>
      <td><p>$5.87777776</p></td>
      <td><p>Pool Bonus</p></td>
      <td><p>USDT (TRC20)</p></td>
      <td><p>2023-07-15      09:09:56</p></td>
      <td><p class="green">Completed</p></td>
    </tr>
  </tbody> -->
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