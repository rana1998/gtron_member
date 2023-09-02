<?php function sidebar_($userStatus,$userKyc){ ?>
	
	<!-- Sidebar Here -->
	<div class="left">
   <a href="index.php"><img src="assets/images/logo/logo.svg" class="logo"></a>
   <ul>
      <li><a href="index.php"><img src="assets/images/icons/dashboard.svg" class="icon">Dashboard</a></li>
      <li><a><img src="assets/images/icons/link.svg" class="icon">Copy Sponsor Link</a></li>
      <li><a href="profile.php"><img src="assets/images/icons/profile.svg" class="icon">Profile</a></li>
      <li><a><img src="assets/images/icons/kyc.svg" class="icon">KYC</a></li>
      <li><a href="buy.php"><img src="assets/images/icons/buy.svg" class="icon">Buy Package</a></li>
      <li><a href="withdrawal.php"><img src="assets/images/icons/withdrawal.svg" class="icon">Withdrawal</a></li>
      <li><a href="internal-wallet-transfer.php"><img src="assets/images/icons/wallet_transfer.svg" class="icon">Internal Wallet Transfer</a></li>
      <li><a href="direct-team.php"><img src="assets/images/icons/network.svg" class="icon">Network</a></li>
      <li>
         
         <div class="dropdown">
    <a type="button" class="dropdown-toggle" data-toggle="dropdown" style="background: #16171B;border: none;padding: 0rem;">
      <img src="assets/images/icons/summary.svg" class="icon">Summary
    </a>
    <div class="dropdown-menu" style="background:#000000;">
      <a class="dropdown-item" href="package-summary.php"><img src="assets/images/icons/summary.svg" class="icon">Package Summary</a>
      <a class="dropdown-item" href="pending-wallet-balance-summary.php"><img src="assets/images/icons/summary.svg" class="icon">Pending Wallet Balance Summary</a>
      <a class="dropdown-item" href="bonuses-summary.php"><img src="assets/images/icons/summary.svg" class="icon">Bonuses Summary</a>
      <a class="dropdown-item" href="level-report.php"><img src="assets/images/icons/summary.svg" class="icon">Level Report</a>
      <a class="dropdown-item" href="withdrawal-summary.php"><img src="assets/images/icons/summary.svg" class="icon">Withdrawal Summary</a>
      <a class="dropdown-item" href="wallet-summary.php"><img src="assets/images/icons/summary.svg" class="icon">Wallet Summary</a>
    </div>
  </div>

      </li>
      <li>
         
         <div class="dropdown">
    <a type="button" class="dropdown-toggle" data-toggle="dropdown" style="background: #16171B;border: none;padding: 0rem;">
      <img src="assets/images/icons/summary.svg" class="icon">Support
    </a>
    <div class="dropdown-menu" style="background:#000000;">
      <a class="dropdown-item" href="support.php"><img src="assets/images/icons/support.svg" class="icon">Support</a>
      <a class="dropdown-item" href="support-summary.php"><img src="assets/images/icons/support.svg" class="icon">Support Summary</a>
    </div>
  </div>

      </li>
   </ul>





   
   <button class="logout"><img src="assets/images/icons/logout.svg">Logout</button>

</div>

	
<?php } ?>
	