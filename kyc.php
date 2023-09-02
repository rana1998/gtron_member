<?php
include_once("components/header_links.php");
include_once("components/navbar.php");
include_once("components/sidebar.php");
// include_once("components/footer.php");

if($userKyc == 'Verified')
{
    $_SESSION['successMsg'] = "Kyc already verified.";
    header("Location: index.php");
    exit();
}


$user_name = $_SESSION['user_name'];
// Getting  Value from user_registration
$sql = "SELECT `ur`.`password`, `k`.`id` AS `kyc_user_id` , `k`.`image1`, `k`.`image2`, `k`.`image3` FROM user_registration AS ur
        LEFT JOIN kyc AS k
        ON `ur`.`user_name` = `k`.`user_name`
        WHERE `ur`.`user_name` = ?";
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$data = $result->fetch_assoc();
$password = $data['password'];
$image1 = $data['image1'];
$image2 = $data['image2'];
$image3 = $data['image3'];
$kyc_user_id = $data['kyc_user_id'];

// Check if image file is a actual image or fake image
if(isset($_POST["kyc_submit"])) {

$type        = mysqli_real_escape_string($con, $_POST['select_type'] );
$id_no       = mysqli_real_escape_string($con, $_POST['id_no']);
$issue_date  = mysqli_real_escape_string($con, $_POST['issuence_date'] );
$expire_date = mysqli_real_escape_string($con, $_POST['expire_date'] );
// $new_pass    = mysqli_real_escape_string($con,$_POST['pass']);

$img1=basename( $_FILES["fileToUpload"]["name"]);
$img2=basename( $_FILES["fileToUpload1"]["name"]);
$img3=basename( $_FILES["fileToUpload2"]["name"]);
// $img4=basename( $_FILES["fileToUpload3"]["name"]);


if(empty($type)){
    $_SESSION['errorMsg'] = "Select Your Document Type.";
    header("Location: kyc.php");
    exit();

}elseif( empty($img1)){
    $_SESSION['errorMsg'] = "Upload Personal Picture.";
    header("Location: kyc.php");
    exit();
}elseif( empty($img2)){
    $_SESSION['errorMsg'] = "Upload Document Front Picture.";
    header("Location: kyc.php");
    exit();
}elseif( empty($img3)){
    $_SESSION['errorMsg'] = "Upload Document Back Picture.";
    header("Location: kyc.php");
    exit();    
}
elseif(empty($id_no)){
    $_SESSION['errorMsg'] = "Enter Document ID";
    header("Location: kyc.php");
    exit();

}elseif(empty($issue_date)){
    $_SESSION['errorMsg'] = "Enter Document Issuance Date";
    header("Location: kyc.php");
    exit();

}elseif(empty($expire_date)){
    $_SESSION['errorMsg'] = "Enter Document Expire Date.";
    header("Location: kyc.php");
    exit();

}

    $target_dir = "assets/images/kyc/";

    $temp = explode(".", $img1); // store file extention e.g .png, .jpg, .jpeg, .gif
    $newfilename = uniqid('img1-') . '.' . end($temp);
    $target_file = strtolower( $target_dir . $newfilename);

    $temp1 = explode(".", $img2); // store file extention e.g .png, .jpg, .jpeg, .gif
    $newfilename1 = uniqid('img2-') . '.' . end($temp1);
    $target_file1 = strtolower( $target_dir . $newfilename1);

    $temp2 = explode(".", $img3); // store file extention e.g .png, .jpg, .jpeg, .gif
    $newfilename2 = uniqid('img3-') . '.' . end($temp2);
    $target_file2 = strtolower( $target_dir . $newfilename2);


    $temp3 = explode(".", $img4); // store file extention e.g .png, .jpg, .jpeg, .gif
    $newfilename3 = uniqid('img4-') . '.' . end($temp3);
    $target_file3 = strtolower( $target_dir . $newfilename3);
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    // $target_file1 = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
    // $target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);

    $uploadOk = 1;
    $uploadOk1 = 1;
    $uploadOk2 = 1;
    $uploadOk3 = 1;

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $imageFileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
    $imageFileType3 = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check  = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $check1 = getimagesize($_FILES["fileToUpload1"]["tmp_name"]);
    $check2 = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
    // $check3 = getimagesize($_FILES["fileToUpload3"]["tmp_name"]);

    if($check !== false and $check1 !== false and $check2 !== false) {

        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        // echo "File is an image - " . $check1["mime"] . ".";
        $uploadOk1 = 1;
        // echo "File is an image - " . $check2["mime"] . ".";
        $uploadOk2 = 1;
        // echo "File is an image - " . $check2["mime"] . ".";
        $uploadOk3 = 1;

    } else {
        $_SESSION['errorMsg'] = "File is not an image.";
        $uploadOk = 0;
        $uploadOk1 = 0;
        $uploadOk2 = 0;
        $uploadOk3 = 0;
        header("Location: kyc.php");
        exit();  
              

    }

// Check if file already exists
if (file_exists($target_file)) {
  $_SESSION['errorMsg'] = "Sorry, file already exists.";
  $uploadOk = 0;
  header("Location: kyc.php");
  exit();
}elseif (file_exists($target_file1)) {
  $_SESSION['errorMsg'] = "Sorry, file already exists.";
  $uploadOk = 0;
  header("Location: kyc.php");
  exit();
}elseif (file_exists($target_file2)) {
  $_SESSION['errorMsg'] = "Sorry, file already exists.";
  $uploadOk = 0;
  header("Location: kyc.php");
  exit();
}
elseif (file_exists($target_file3)) {
  $_SESSION['errorMsg'] = "Sorry, file already exists.";
  $uploadOk = 0;
  header("Location: kyc.php");
  exit();
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000 && $_FILES["fileToUpload1"]["size"] > 5000000 && $_FILES["fileToUpload2"]["size"] > 5000000 ) {
        $_SESSION['errorMsg'] = "Sorry, your file is too large.";
        $uploadOk = 0;
        $uploadOk1 = 0;
        $uploadOk2 = 0;
        $uploadOk3 = 0;
        header("Location: kyc.php");
        exit();   
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        $_SESSION['errorMsg'] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
        $uploadOk1 = 0;
        $uploadOk2 = 0;
        $uploadOk3 = 0;
        header("Location: kyc.php");
        exit();   
}elseif($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg" ){
        $_SESSION['errorMsg'] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
        $uploadOk1 = 0;
        $uploadOk2 = 0;
        $uploadOk3 = 0;
        header("Location: kyc.php");
        exit();   

}elseif($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" ){
        $_SESSION['errorMsg'] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
        $uploadOk1 = 0;
        $uploadOk2 = 0;
        $uploadOk3 = 0;
        header("Location: kyc.php");
        exit();   
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 || $uploadOk1 == 0 || $uploadOk2 == 0) {
        $_SESSION['errorMsg'] = "Sorry, your file was not uploaded.";
        $uploadOk = 0;
        $uploadOk1 = 0;
        $uploadOk2 = 0;
        $uploadOk3 = 0;
        header("Location: kyc.php");
        exit();    
// if everything is ok, try to upload file
} else {

  // if(file_exists($target_dir.$image1)){
  //   unlink($target_dir.$image1);
  // }
  // if(file_exists($target_dir.$image2)){
  //   unlink($target_dir.$image2);
  // }
  // if(file_exists($target_dir.$image3)){
  //   unlink($target_dir.$image3);
  // }
  // if(file_exists($target_dir.$image4)){
  //   unlink($target_dir.$image4);
  // }


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) and move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1) and move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)) {
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). "  has been uploaded.";
        // echo "The file ". basename( $_FILES["fileToUpload1"]["name"]). " has been uploaded.";
        // echo "The file ". basename( $_FILES["fileToUpload2"]["name"]). " has been uploaded.";
  } else {
        $_SESSION['errorMsg'] = "Sorry, there was an error uploading your file.";
        header("Location: kyc.php");
        exit();  
  }       
}        

// Insert in KYC Table
$sql = "REPLACE INTO `kyc` (`id`,`user_name`, `image1`, `image2`, `image3`,`image4`, `id_no`, `doc_type`, `issue_date`, `expire_date`)
          VALUES(?,?,?,?,?,?,?,?,?,?)";
$stmt = $con->prepare($sql);
$stmt->bind_param('isssssssss',$kyc_user_id, $user_name, $newfilename,$newfilename1,$newfilename2,$newfilename2,$id_no,$type,$issue_date,$expire_date);

if ($stmt->execute() === TRUE) {
  $stmt->close();
  $_SESSION['successMsg']='Your KYC request has been submitted!';
  header("Location: kyc.php");
  exit();

}else{
  $stmt->close();
  $_SESSION['errorMsg'] =  "Error inserting record: " . $con->error;
  header("Location: login.php");
  exit();
}



} // end of isset

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

  /* Style for the container of the file input */
.custom-file-input {
  display: inline-block;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f5f5f5;
  color: #333;
}

/* Style for the input element itself (hidden) */
/* .custom-file-input input[type="file"] {
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  cursor: pointer;
} */

/* Style for the label or selected file name */
/* .custom-file-input label {
  display: block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin: 0;
  padding: 0;
} */

/* Optional: Style for when the file input is focused or active */
/* .custom-file-input:focus-within {
  border-color: #66afe9;
  box-shadow: 0 0 5px rgba(102, 175, 233, 0.6);
} */

.custom-file-input-label {
  display: inline-block;
  padding: 10px 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f5f5f5;
  color: #333;
  cursor: pointer;
}

/* Hide the actual input element */
.custom-file-input {
  display: none;
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
   
<h2><img src="assets/images/icons/with.svg">KYC<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="kyc.php">/ KYC</a></span></h2>

<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>


<div class="row withdrawalrow">
   <div class="col-md-4">
      <div class="leftwithdrawal">
         
         <h2>Please complete your <span>KYC.</span></h2>

         <?php if(isset($_SESSION['successMsg'])): ?>
            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Success </h6>
                        <div class="text-white"><?php echo $_SESSION['successMsg']; ?></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php  unset($_SESSION['successMsg']);     endif;  ?>
            
            <?php if(isset($_SESSION['errorMsg'])): ?>
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Error </h6>
                        <div class="text-white"><?php echo $_SESSION['errorMsg']; ?></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php  unset($_SESSION['errorMsg']);     endif;  ?>      

      </div>
   </div>
   <div class="col-md-6">
      <div class="rightwithdrawal">

         <h2>Upload your Documents<span> Only .jpeg & .png files are allowed for upload</span></h2>
         
       <form method = "POST" enctype="multipart/form-data">

       <!-- <label>Document Type</label>
       <select>
          <option>Select Document Type</option>
       </select> -->

        <label for="documentType">Select Document Type</label>
        <select id="documentType" class="form-control form-control-rounded single-select" name="select_type">
            <option value="">Select Document Type</option>
            <option value="national_id">National Id</option>
            <option value="driving_licence">Driving Licence</option>
            <option value="passport">Passport</option>
        </select>

       <!-- <label>Enter Document ID Number</span></label>
       <input type="text" name="" placeholder="Enter email ID"> -->
        <div class="form-group mt-3">
            <label for="idNumber">Enter ID Number</label>
            <input type="text" class="form-control form-control-rounded" id="idNumber" name="id_no" placeholder="Enter Document ID">
        </div>

       <div class="row">
          <div class="col-md-6">
             <!-- <label>Issuance Date</label>
             <input type="date" name=""> -->
            <label for="issuanceDate ">Issuance Date</label>
            <input type="date" class="form-control form-control-rounded datepicker" id="issuanceDate" name="issuence_date" placeholder="Select Date..">
          </div>
          <div class="col-md-6">
             <!-- <label>Expiry Date</label>
             <input type="date" name=""> -->
                <label for="expiryDate">Expiry Date</label>
                <input type="date" class="form-control form-control-rounded datepicker" id="expiryDate" name="expire_date" placeholder="Select Date..">
          </div>
       </div>

       <div class="row">
          <div class="col-md-6">
             <label>Front Side of the Document</label>
             <div class="doc_div text-center">
                <img src="assets/images/icons/doc.svg" class="doc"><br>
                <label for="frontSide" class="custom-file-input-label choose-btn">Choose file</label>
                <input type="file" class="custom-file-input" id="frontSide" name="fileToUpload1" placeholder="">
                <!-- <button class="choose-btn">Choose Image</button> -->
             </div>
          </div>
          <div class="col-md-6">
             <label>Back Side of the Document</label>
             <div class="doc_div text-center">
                <img src="assets/images/icons/doc.svg" class="doc"><br>
                <label for="backSide" class="custom-file-input-label choose-btn">Choose file</label>
                <input type="file" class="custom-file-input" id="backSide" name="fileToUpload2" placeholder="">
                <!-- <button class="choose-btn">Choose Image</button> -->
             </div>
          </div>
          <div class="col-md-6">
             <label>Personal Picture</label>
            
             <div class="doc_div text-center">
                <img src="assets/images/icons/profilee.svg" class="doc"><br>
                <label for="personalPic" class="custom-file-input-label choose-btn">Choose file</label>
                <input type="file" class="custom-file-input" id="personalPic" name="fileToUpload" placeholder="">

                <!-- <button class="choose-btn">Choose Image</button> -->
             </div>
          </div>
       </div>

        


       <!-- <button class="submit-btn">Submit Request</button> -->
       <button type="submit" class="btn submit-btn  btn-round px-5" name = "kyc_submit"><i class="icon-lock"></i> Submit Request</button>


       </form>


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