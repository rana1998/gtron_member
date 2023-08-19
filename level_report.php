<?php
include_once("components/footer.php");
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

	<title>Gtron MLM | Level Report</title>
     
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
   
<h2><img src="assets/images/icons/notice.svg">LEVEL REPORT<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="level-report.php">/ Level Report</a></span></h2>

<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>

<div class="row packagerow">
   <div class="col-md-5 package">
     
<div class="table-responsive">      
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr No.</th>
      <th scope="col">Bonus Received</th>
    </tr>
  </thead>
  <tbody>
        <?php
        $qyy="select  * from user_registration where user_name='$fectchUserName'";
        $result = mysqli_query($con,$qyy);
        $res= mysqli_fetch_assoc($result);
        ?>
        <tr>
            <td><?php echo 'Level 1'?></td>
            <td><?php echo '$'.$res['l1']?></td>
            
            
        </tr>
        <tr>
            <td><?php echo 'Level 2'?></td>
            <td><?php echo '$'.$res['l2']?></td>
                
        </tr>
        <tr>
            <td><?php echo 'Level 3'?></td>
            <td><?php echo '$'.$res['l3']?></td>
                
        </tr>
            <tr>
            <td><?php echo 'Level 4'?></td>
            <td><?php echo '$'.$res['l4']?></td>
                
        </tr>
            <tr>
            <td><?php echo 'Level 5'?></td>
            <td><?php echo '$'.$res['l5']?></td>
                
        </tr>
            <tr>
            <td><?php echo 'Level 6'?></td>
            <td><?php echo '$'.$res['l6']?></td>
                
        </tr>
            <tr>
            <td><?php echo 'Level 7'?></td>
            <td><?php echo '$'.$res['l7']?></td>
                
        </tr>
        <tr>
            <td><?php echo 'Level 8'?></td>
            <td><?php echo '$'.$res['l8']?></td>
                
        </tr>
        <tr>
            <td><?php echo 'Level 9'?></td>
            <td><?php echo '$'.$res['l9']?></td>
                
        </tr>
        <tr>
            <td><?php echo 'Level 10'?></td>
            <td><?php echo '$'.$res['l10']?></td>
                
        </tr>
    </tbody>

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