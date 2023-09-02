<?php
include_once("components/header_links.php");
include_once("components/navbar.php");
include_once("components/sidebar.php");
// include_once("components/footer.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<title>Gtron MLM | Package Summary</title>
     
  <?php echo header_links(); ?>

</head>
<body >


 <style>
  .owl-nav.disabled{
    display: none !important;
  }

  .red {
    color: #dc3545;
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
   
<h2><img src="assets/images/icons/team.svg">PACKAGE SUMMARY<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="package-summary.php">/ Package Summary</a></span></h2>

<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>


<div class="row packagerow">
   <div class="col-md-12 package">
     
<div class="table-responsive">      
<table id="data-table-id" class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr No.</th>
      <th scope="col">Package</th>
      <th scope="col">Price</th>
      <th scope="col">Mode</th>
      <th scope="col">Transaction ID</th>
      <th scope="col">Transaction Status</th>
      <th scope="col">Order Date</th>
    </tr>
  </thead>
  <tbody>
        <?php
        $qyy="select  * from package_details where user_name='$fectchUserName'";
        $result = mysqli_query($con,$qyy);
        $count=1;
        while ($res=mysqli_fetch_assoc($result)){
        ?>
        <tr>
        <td><p><?php echo $count?></p></td>
        <td><p><?php echo $res['pkg_name']?></p></td>
        <td><p>$<?php echo $res['pkg_price']?></p></td>
        <td><p>USDT (TRC20)</p></td>
        <td><p><?php echo $res['trans_id']?></p></td>
        <td><?php if($res['status'] == "Approved"){ echo "<p class='green'>Completed<b>"; }else{ echo "<p class='red'>Failed"; }?></p></td>
        <td><p><?php echo $res['date']?></p></td>
        </tr>
    <?php
    $count++;
        }
    ?>
    </tbody>
</table>
</div>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
   $(document).ready(function() {
         $('#data-table-id').DataTable();
      });
   </script>


</body>
</html>