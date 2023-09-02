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

	<title>Gtron MLM | Support Summary</title>
     
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
   
<h2><img src="assets/images/icons/supportt.svg">SUPPORT SUMMARY<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="support-summary.php">/ Support Summary</a></span></h2>

<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>

<div class="row pendingrow">
   <div class="col-md-12 pending">
     
<div class="table-responsive">      
<table id="data-table-id" class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr</th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Reply</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
        <?php
        $qyy="select  * from support where  user_name='$fectchUserName'";
        $result = mysqli_query($con,$qyy);
        $count=1;
        while ($res=mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $count?></td>
            <td><?php echo $res['subject']?></td>
            <td><?php echo $res['message']?></td>
            <td><?php echo $res['reply']?></td>
            <td><?php echo $res['status']?></td>
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
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Reply</th>
      <th scope="col">Status</th>
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