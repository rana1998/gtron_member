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

	<title>Gtron MLM | Direct Team</title>
     
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
   
<h2><img src="assets/images/icons/team.svg">DIRECT TEAM<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="direct-team.php">/ Direct Team</a></span></h2>

<!-- <button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button> -->
<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>


<div class="row profilerow">
   <div class="col-md-11">

      <div class="row">
      <?php


$sql="SELECT * FROM user_registration WHERE sponsor_name = ?";
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result

if ($result->num_rows > 0) {

while( $data = $result->fetch_assoc()){


?>
         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/user-profile/<?php echo $data['profile_pic']?>" class="profile-img">
                  </div>
                  <h5 style="color:#6D1ED1" class="card-title text-center mt-2"><?php echo ucwords( $data['full_name']); ?></h5>
               </div>
               <p>Username</p>
               <h4><?php echo  $data['user_name'];?></h4>

               <p>Email</p>
               <h4><?php echo  $data['email']; ?></h4>

               <p>Total Invested</p>
               <h4><?php echo  '$'.$data['total_invest']; ?></h4>

               <p>Team Sales</p>
               <h4><?php echo  '$'.$data['team_sales']; ?></h4>
               <?php
           require 'connect.php';
           $sql= $conn->prepare("SELECT * FROM user_registration WHERE sponsor_name='".$data['user_name']."'");
           $sql->execute();
           $sql->setFetchMode(PDO::FETCH_ASSOC);
           if($sql->rowCount()>0){
           echo '
           <form method="POST" action="direct_team_2.php?username='.$data['user_name'].'">
           <input type="submit" value="Show Team"  class="form-control">
           </form>';
}
?>

            </div>
         </div>

         <?php 
  }
    $stmt->close();

    }else{
      echo "<p class='text-default pl-4'>You Don't have any members in your Direct Team.</p>";
      $stmt->close();

    }


 ?>

         <!-- <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-2.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-3.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-4.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-5.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

         <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-6.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div>

          <div class="col-md-3 col-6">
            <div class="profile_div">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="assets/images/profile-7.png" class="profile-img">
                  </div>
               </div>
               <p>Username</p>
               <h4>MLM45</h4>

               <p>Email</p>
               <h4>ronda56@gmail.com</h4>

               <p>Total Invested</p>
               <h4>$400</h4>

               <p>Team Sales</p>
               <h4>$3,000</h4>

            </div>
         </div> -->

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


</body>
</html>