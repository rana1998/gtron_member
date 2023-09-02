

<?php 
function sidebar_($userStatus,$userKyc){ ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="d-flex justify-content-between">
         <a href="index.php" class="navbar-brand logo"><img src="assets/images/logo/logo.svg" class="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      </div>
        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Your navigation items here -->
                <li class="nav-item">
                  <!-- <a href="index.php"><img src="assets/images/icons/dashboard.svg" class="icon">Dashboard</a> -->
                  <a href="index.php"><img src="assets/images/icons/dashboard.svg" class="icon">Dashboard</a>

                  </li>
                  <!-- <li class="nav-item">
                  <a href="#"><img src="assets/images/icons/link.svg" class="icon">Copy Sponsor Link</a>
                  </li> -->
                  <?php
                     if($userStatus=='Approved')
                     {
                     ?>
                     <li class="nav-item">
                     
                           <a style="border: 1px solid white;padding:4px" href="#" data-bs-toggle="modal" data-bs-target="#copySponsorLink" class=" text-white bg-gradient-rose-button-dark">
                                 <img src="assets/images/icons/link.svg" class="icon">Copy Referral Link
                           </a>
                           
                     </li>
                     <?php
                     }
                  ?>
                  <li class="nav-item">
                  <!-- <a href="profile.php"><img src="assets/images/icons/profile.svg" class="icon">Profile</a> -->
                  <a href="profile.php"><img src="assets/images/icons/profile.svg" class="icon">Profile</a>
                  </li>
                  <li class="nav-item">
                  <!-- <a href="kyc.php"><img src="assets/images/icons/kyc.svg" class="icon">KYC</a> -->
                  <a href="kyc.php"><img src="assets/images/icons/kyc.svg" class="icon">KYC <?php if($userKyc == 'Verified')
                     { ?>
                     <!-- <span style="display: flex; justify-content:flex-end;"> -->
                        <img src="assets/images/check-success.png" class="icon">
                        <!-- </span> -->
                     <?php } ?> 
                   </a>
                  </li>
                  <li class="nav-item">
                  <!-- <a href="buy.php"><img src="assets/images/icons/buy.svg" class="icon">Buy Package</a> -->
                  <a href="buy-pkg.php"><img src="assets/images/icons/buy.svg" class="icon">Buy Package</a>
                  </li>
                  <li class="nav-item">
                  <!-- <a href="withdrawal.php"><img src="assets/images/icons/withdrawal.svg" class="icon">Withdrawal</a> -->
                  <a href="withdrawal.php"><img src="assets/images/icons/withdrawal.svg" class="icon">Withdrawal</a>
                  </li>
                  <li class="nav-item">
                  <!-- <a href="internal-wallet-transfer.php"><img src="assets/images/icons/wallet_transfer.svg" class="icon">Internal Wallet Transfer</a> -->
                  <a href="internal-wallet-transfer.php"><img src="assets/images/icons/wallet_transfer.svg" class="icon">Internal Wallet Transfer</a>
                  </li>
                  <li class="nav-item">
                  <!-- <a href="direct-team.php"><img src="assets/images/icons/network.svg" class="icon">Network</a> -->
                  <a href="direct_team.php"><img src="assets/images/icons/network.svg" class="icon">Referral Team</a>
                  </li>
                  <li class="nav-item">
         
                  <div class="dropdown">
                     <a type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background: #16171B;border: none;padding: 0rem;">
                     <img src="assets/images/icons/summary.svg" class="icon">Summary
                     </a>
                     <div class="dropdown-menu" style="background:#000000;">
                        <a class="dropdown-item" href="package_summary.php"><img src="assets/images/icons/summary.svg" class="icon">Package Summary</a>
                        <a class="dropdown-item" href="pending-wallet-balance-summary.php"><img src="assets/images/icons/summary.svg" class="icon">Pending Wallet Balance Summary</a>
                        <a class="dropdown-item" href="bonuses_summary.php"><img src="assets/images/icons/summary.svg" class="icon">Level Bonus Summary</a>
                        <a class="dropdown-item" href="level_report.php"><img src="assets/images/icons/summary.svg" class="icon">Level Report</a>
                        <a class="dropdown-item" href="withdrawal_summary.php"><img src="assets/images/icons/summary.svg" class="icon">Withdrawal Summary</a>
                        <a class="dropdown-item" href="cash_wallet_summary.php"><img src="assets/images/icons/summary.svg" class="icon">Wallet Summary</a>
                     </div>
            </div>

                  </li>
                  <li class="nav-item">
         
                  <div class="dropdown">
                  <a type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background: #16171B;border: none;padding: 0rem;">
                  <img src="assets/images/icons/summary.svg" class="icon">Support
                  </a>
                  <div class="dropdown-menu" style="background:#000000;">
                  <a class="dropdown-item" href="support.php"><img src="assets/images/icons/support.svg" class="icon">Submit Ticket</a>
                  <a class="dropdown-item" href="support_summary.php"><img src="assets/images/icons/support.svg" class="icon">Support Summary</a>
                  </div>
                  </div>

                  </li>
            </ul>
            <!-- <form class="d-flex"> -->
                <!-- <button class="btn btn-primary logout-btn" type="submit">Logout</button> -->
                <!-- <button class="logout btn btn-primary logout-btn" onclick="window.location='logout.php'"><img src="assets/images/icons/logout.svg">Logout</button> -->
                <button class="logout btn btn-primary logout-btn" onclick="window.location='logout.php'">Logout</button>
            <!-- </form> -->
        </div>
    </nav>


<!-- Modal -->
<div class="modal fade" id="copySponsorLink" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Referral Link</h5>
        <span id="linkCopiedMsg" style="font-size:18px" class="text-success"></span>
      </div>
      <div class="modal-body">
        <div class="">
        <input type="text" readonly value="https://mlm-user.eighty5technologies.com/mlm_landing/index.php?reff=<?php echo $user_name?>" class="form-control form-control-sm" id="copyReferal">
        
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="copyReferal()" class="btn btn-sm">Copy</button>
      </div>
    </div>
  </div>
</div>

<!--modal end-->
	
	<!-- Sidebar Here -->
	<div class="left">
   <a href="index.php"><img src="assets/images/logo/logo.svg" class="logo"></a>
   <ul>
      <li><a href="index.php"><img src="assets/images/icons/dashboard.svg" class="icon">Dashboard</a></li>

      <!-- <li><a><img src="assets/images/icons/link.svg" class="icon">Copy Sponsor Link</a></li> -->

      <?php
         if($userStatus=='Approved')
         {
         ?>
         <li >
         
               <a style="border: 1px solid white;padding:4px" href="#" data-bs-toggle="modal" data-bs-target="#copySponsorLink" class=" text-white bg-gradient-rose-button-dark">
                     <img src="assets/images/icons/link.svg" class="icon">Copy Referral Link
               </a>
               
         </li>
         <?php
         }
      ?>

      <li><a href="profile.php"><img src="assets/images/icons/profile.svg" class="icon">Profile</a></li>
      <li><a href="kyc.php"><img src="assets/images/icons/kyc.svg" class="icon">KYC <?php if($userKyc == 'Verified')
{ ?>
<!-- <span style="display: flex; justify-content:flex-end;"> -->
   <img src="assets/images/check-success.png" class="icon">
   <!-- </span> -->
<?php } ?> </a></li>
      <li><a href="buy-pkg.php"><img src="assets/images/icons/buy.svg" class="icon">Buy Package</a></li>
      <li><a href="withdrawal.php"><img src="assets/images/icons/withdrawal.svg" class="icon">Withdrawal</a></li>
      <li><a href="internal-wallet-transfer.php"><img src="assets/images/icons/wallet_transfer.svg" class="icon">Internal Wallet Transfer</a></li>
      <li><a href="direct_team.php"><img src="assets/images/icons/network.svg" class="icon">Referral Team</a></li>
      <li>
         
         <div class="dropdown">
         <a type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background: #16171B;border: none;padding: 0rem;">
         <img src="assets/images/icons/summary.svg" class="icon">Summary
         </a>
         <div class="dropdown-menu" style="background:#000000;">
            <a class="dropdown-item" href="package_summary.php"><img src="assets/images/icons/summary.svg" class="icon">Package Summary</a>
            <a class="dropdown-item" href="pending-wallet-balance-summary.php"><img src="assets/images/icons/summary.svg" class="icon">Pending Wallet Balance Summary</a>
            <a class="dropdown-item" href="bonuses_summary.php"><img src="assets/images/icons/summary.svg" class="icon">Level Bonus Summary</a>
            <a class="dropdown-item" href="level_report.php"><img src="assets/images/icons/summary.svg" class="icon">Level Report</a>
            <a class="dropdown-item" href="withdrawal_summary.php"><img src="assets/images/icons/summary.svg" class="icon">Withdrawal Summary</a>
            <a class="dropdown-item" href="cash_wallet_summary.php"><img src="assets/images/icons/summary.svg" class="icon">Wallet Summary</a>
         </div>
  </div>

      </li>
      <li>
         
         <div class="dropdown">
         <a type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background: #16171B;border: none;padding: 0rem;">
            <img src="assets/images/icons/summary.svg" class="icon">Support
         </a>
         <div class="dropdown-menu" style="background:#000000;">
            <a class="dropdown-item" href="support.php"><img src="assets/images/icons/support.svg" class="icon">Submit Ticket</a>
            <a class="dropdown-item" href="support_summary.php"><img src="assets/images/icons/support.svg" class="icon">Support Summary</a>
         </div>
  </div>

  

      </li>
   </ul>


   <button class="logout" onclick="window.location='logout.php'"><img src="assets/images/icons/logout.svg">Logout</button>


</div>

	<script>
      function copyReferal() {
         var copyText = document.getElementById("copyReferal");
         copyText.select();
         copyText.setSelectionRange(0, 99999)
         document.execCommand("copy");
      //   alert("Code Copied: " + copyText.value);
         document.getElementById("linkCopiedMsg").innerText="Referral Link Copied";
      }
   </script>
<?php } ?>
