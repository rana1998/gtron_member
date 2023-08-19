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

	<title>Gtron MLM | Withdrawal Summary</title>
     
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
   
<h2><img src="assets/images/icons/notice.svg">WITHDRAWAL SUMMARY<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="bonuses-summary.php">/ Withdrawal Summary</a></span></h2>

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row pendingrow">
   <div class="col-md-12 pending">
     
<div class="table-responsive">      
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr</th>
      <th scope="col">Amount</th>
      <th scope="col">Fee</th>
      <th scope="col">After Fee</th>
      <th scope="col">Withdrawal Address</th>
      <th scope="col">Transaction Status</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $qyy="select  * from withdrawal where user_name='$fectchUserName'";
    $result = mysqli_query($con,$qyy);
    $count=1;
    while ($res=mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?php echo $count?></td>
        <td><?php echo $res['desire_amount']?></td>
        <td><?php echo $res['tax']?></td>
        <td><?php echo $res['amount_after_tax']?></td>
        <td><?php echo $res['btc_address']?></td>
        <td><?php 
        $status= $res['status'];
        if($status == 'Pending')
        {
            echo '<span class="badge bg-warning"> Pending </span>';
        }
        elseif($status == 'Rejected')
        {
            echo '<span class="badge bg-danger"> Rejected</span>';
        }
        elseif($status == 'Completed')
        {
            echo '<span class="badge bg-success"> Completed </span>';
        }
        
        ?></td>
        <td><?php echo $res['date']?></td>
        
    </tr>
<?php
$count++;
    }
?>
</tbody>
  <thead>
    <tr>
      <th scope="col">Sr</th>
      <th scope="col">Amount</th>
      <th scope="col">Fee</th>
      <th scope="col">After Fee</th>
      <th scope="col">Withdrawal Address</th>
      <th scope="col">Transaction Status</th>
      <th scope="col">Date</th>
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