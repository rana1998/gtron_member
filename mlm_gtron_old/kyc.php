<?php
include_once("template-parts/footer.php");
include_once("template-parts/header_links.php");
include_once("template-parts/navbar.php");
include_once("template-parts/sidebar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<title>Gtron MLM | KYC</title>
     
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
   
<h2><img src="assets/images/icons/with.svg">KYC<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="kyc.php">/ KYC</a></span></h2>

<button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button>


<div class="row withdrawalrow">
   <div class="col-md-4">
      <div class="leftwithdrawal">
         
         <h2>Please complete your <span>KYC.</span></h2>

      </div>
   </div>
   <div class="col-md-6">
      <div class="rightwithdrawal">

         <h2>Upload your Documents<span> Only .jpeg & .png files are allowed for upload</span></h2>
         
       <form>

       <label>Document Type</label>
       <select>
          <option>Select Document Type</option>
       </select>

       <label>Enter Document ID Number</span></label>
       <input type="text" name="" placeholder="Enter email ID">

       <div class="row">
          <div class="col-md-6">
             <label>Issuance Date</label>
             <input type="date" name="">
          </div>
          <div class="col-md-6">
             <label>Expiry Date</label>
             <input type="date" name="">
          </div>
       </div>

       <div class="row">
          <div class="col-md-6">
             <label>Front Side of the Document</label>
             <div class="doc_div text-center">
                <img src="assets/images/icons/doc.svg" class="doc"><br>
                <button class="choose-btn">Choose Image</button>
             </div>
          </div>
          <div class="col-md-6">
             <label>Back Side of the Document</label>
             <div class="doc_div text-center">
                <img src="assets/images/icons/doc.svg" class="doc"><br>
                <button class="choose-btn">Choose Image</button>
             </div>
          </div>
          <div class="col-md-6">
             <label>Personal Picture</label>
             <div class="doc_div text-center">
                <img src="assets/images/icons/profilee.svg" class="doc"><br>
                <button class="choose-btn">Choose Image</button>
             </div>
          </div>
       </div>

        


       <button class="submit-btn">Submit Request</button>

       </form>


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