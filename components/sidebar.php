

<?php 
function sidebar_($userStatus){ ?>

<!-- Modal -->
<div class="modal fade" id="copySponsorLink" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sponsor Link</h5>
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
                     <img src="assets/images/icons/link.svg" class="icon">Copy Sponsor Link
               </a>
               
         </li>
         <?php
         }
      ?>

      <li><a href="profile.php"><img src="assets/images/icons/profile.svg" class="icon">Profile</a></li>
      <li><a href="kyc.php"><img src="assets/images/icons/kyc.svg" class="icon">KYC</a></li>
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
         document.getElementById("linkCopiedMsg").innerText="Sponsor Link Copied";
      }
   </script>
<?php } ?>
