<?php 
$select3 = "select * from taxes where type='withdrawal'";
$result3 = mysqli_query($con,$select3);
$row3 = mysqli_fetch_assoc($result3);
$withdrawalPercentage = $row3['percentage'];
$withdrawalTax = $withdrawalPercentage/100;
//function footer_(){ 
    ?>

	<!-- Footer Here -->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
		
		

	<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>-->
	<!--treeview js end-->
	<script src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

	
	<!-- <script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
  <script src="assets/plugins/apexcharts-bundle/js/apex-custom.js"></script> -->

<?php //} ?>

<script>
	    // $('#tree1').treed();
	</script>
	<script>
      //copy code
            function copyReferal() {
              var copyText = document.getElementById("copyReferal");
              copyText.select();
              copyText.setSelectionRange(0, 99999)
              document.execCommand("copy");
            //   alert("Code Copied: " + copyText.value);
              document.getElementById("linkCopiedMsg").innerText="Sponsor Link Copied";
            }
            
</script>
  <script> 

    $( document ).ready(function() {
  
    
   $('.buttonProcessing').click(function(){
         
         $(".buttonProcessing").val('Processing...');
         
         setTimeout(function(){ 
             
             $(".buttonProcessing").prop('disabled', true);
             
         }, 1000);
     })
     
     
     
     $(function(){
   
    
    
    //transfer
    
    $('#receiverName').on('blur',function()
    {
        
        var message = $('#receiverName').val();
    //   alert(message);
        $.post("ajax/usercheck.php",{userchecktransfer:message},function(feedback){
            // alert(feedback);
            if(feedback=='flase')
            {
                $('#getUserName').text('Invalid Username').css({"color": "red"});
            }
            else
            {
                $('#getUserName').text(feedback).css({"color": "green"});
            }
            
            
            
        })
    });
    
   
    //withdrawal
      $('#bankName').css("display", "none");
     $('#paymentMode').on("change",function(){
        var paymentValue = $('#paymentMode').val();
        
        if(paymentValue=='Bank')
        {
             $('#bankName').css("display", "block");
             $('#usdt').css("display", "none");
        }
      
        else
        {
            $('#bankName').css("display", "none");
            $('#usdt').css("display", "block");
        }
         
     });
     
  

    
     }); 
});
</script>

<script>

    $('#desireAmountWithdrawal').on('keyup', function() {
      var desireValue = parseFloat($('#desireAmountWithdrawal').val());
      var avail_balance = parseFloat($('#avail_balance_withdrawal').val());
     
        finalAmount = '$'+ (desireValue - desireValue*<?php echo $withdrawalTax?>);
     
    

      // withdrawal_amount =Math.round(withdrawal_amount);
      $('#txtValueWithdrawal').val(finalAmount);
    });
    
    //withdrawal
      $('.bankName').css("display", "none");
     $('#paymentMode').on("change",function(){
        var paymentValue = $('#paymentMode').val();
        
        if(paymentValue=='Bank')
        {
             $('.bankName').css("display", "block");
              $('#usdt').css("display", "none");
        }
        else
        {
            $('.bankName').css("display", "none");
             $('#usdt').css("display", "block");
        }
         
     });
      
      //otp email 2nd
      $(".sendOtpEmail").click(function(){
    
        var sendMail = 'Email Send';
         $(".sendOtpEmail").prop('disabled', true);
        $(".sendOtpEmail").text('Processing');
        $.post("ajax/otp_generator.php",{otp_send:sendMail},function(feedback){
            // alert(feedback);
            $('.emailMessageAjax').text(feedback);
            $(".sendOtpEmail").prop('disabled', false);
            $(".sendOtpEmail").text('SEND CODE');
        })
        
      
        //  alert("button work");
    })
   $('.buttonProcessing').click(function(){
         
         $(".buttonProcessing").val('Processing...');
         
         setTimeout(function(){ 
             
             $(".buttonProcessing").prop('disabled', true);
             
         }, 1000);
     })

   $(".checkUserName").click(function(){
      $("#transfer_request").hide();
      var username = $('#username_serach').val();
      if(username == ""){
        $('.userdetailshere').text('');
        $('.userdetailsherered').text("Please enter valid username or emailid");
      }else{

        $(".checkUserName").prop('disabled', true);
      $(".checkUserName").text('Finding User...');
      $.post("ajax/find_user.php",{username:username},function(feedback){
          // alert(feedback);
          $("#transfer_request").show();
          $('.userdetailshere').html(feedback);
          $(".checkUserName").prop('disabled', false);
          $(".checkUserName").text('Search User');
          $('.userdetailsherered').text("");
      })
      }
      

   })


     
     
     
     //fund_transfer
      $('#desired_amount').on('keyup', function() {
      
      var dsireValue = parseFloat($(this).val());
      var avail_balance = parseFloat($('#avail_balance').val());
      var tax = dsireValue * 0.01;
      var withdrawal_amount = dsireValue - tax;
      withdrawal_amount.toFixed(2);

      // withdrawal_amount =Math.round(withdrawal_amount);
      $('#txtValue').val(withdrawal_amount);

    });
     
     // personal wallet
     
    $('#desired_amount2').on('keyup', function() {
      var dsireValue = parseFloat($(this).val());
      var avail_balance = parseFloat($('#avail_balance2').val());
      var tax = dsireValue * 0.02;
      var withdrawal_amount = dsireValue - tax;
      withdrawal_amount.toFixed(2);

      // withdrawal_amount =Math.round(withdrawal_amount);
      $('#txtValue2').val(withdrawal_amount);
    
        // alert('working');

    });
    
    
    $('#screenShotFile').hide();
    $('#bankChangeDisplay').on('change',function(){
        
      var bankName =  $('#bankChangeDisplay').val();
      
      $.post("ajax/bank-details.php",{changeBank:bankName},function(feedback){
            // alert(feedback);
          $('#bankDetailsShow').html(feedback);
        })
      
      $('#screenShotFile').show();
      
    })
    
</script>
<script>
    	
	// chart 8
	<?php if($userRoi=='' and $userIdb=='' and $userMonthlyShare=='')
	{
	 $userRoi='33.33';
	  $userIdb='33.33';
	  $userMonthlyShare='33.33';
	}?>
	var options = {
		series: [<?php echo $userRoi;?>, <?php echo $userIdb;?>, <?php echo $userMonthlyShare;?>],
		chart: {
			foreColor: '#9ba7b2',
			height: 300,
			type: 'pie',
		},
		colors: ["#003e82", "#0760c3", "#0094e4"],
		labels: ['ROI', 'Level Bonus', 'Monthly Share'],
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 360
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};
	// var chart = new ApexCharts(document.querySelector("#chart8"), options);
	// chart.render();
	
		
	// chart 9
		<?php 
		$remainingIncome = $userMaxIncome-$totalIncome;
		if($totalIncome=='' and $remainingIncome=='')
    	{
    	  $totalIncome='33.33';
    	  $remainingIncome='33.33';
    	 
    	}?>
	var options = {
		series: [<?php echo $totalIncome;?>, <?php echo $remainingIncome?>],
		chart: {
			foreColor: '#9ba7b2',
			height: 300,
			type: 'donut',
		},
		colors: ["#cba722", "#019951"],
		labels: ['Received Income', 'Remaining Income'],
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 320
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};
	// var chart = new ApexCharts(document.querySelector("#chart9"), options);
	// chart.render();
	
</script>

	
	