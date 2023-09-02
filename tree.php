<?php
// include_once("template-parts/footer.php");
// include_once("template-parts/header_links.php");
// include_once("template-parts/navbar.php");
// include_once("template-parts/sidebar.php");

include_once("components/header_links.php");
include_once("components/navbar.php");
include_once("components/sidebar.php");

require_once('core/db_config.php');
$pdo = getDB();  

// Function to fetch hierarchical MLM data from the database
function fetchMLMData($pdo,$parent_id = null) {
    $results = array();

    // Database connection details
    // $dsn = "mysql:host=localhost;dbname=database_name";
    // $username = "username";
    // $password = "password";

    try {
        // $pdo = new PDO($dsn, $username, $password);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM user_level_hierarchy WHERE parent_user_id " . ($parent_id === null ? "IS NULL" : "= :parent_id");
        $stmt = $pdo->prepare($sql);
        
        if ($parent_id !== null) {
            $stmt->bindParam(":parent_id", $parent_id, PDO::PARAM_INT);
        }

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $children = fetchMLMData($pdo,$row['id']); // Recursive call for child nodes
            $row['children'] = $children;
            $results[] = $row;
        }

        return $results;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Fetch the MLM data starting from the root node (where parent_user_id is NULL)
// $mlmData = fetchMLMData($pdo,null);
$mlmData = fetchMLMData($pdo,45);

// Now, $mlmData contains the hierarchical MLM data
// echo json_encode($mlmData); 
// Output the data as JSON for visualization

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<title>Gtron MLM | Tree View</title>
     
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
<?php //echo sidebar_(); ?>
<?php echo sidebar_($userStatus,$userKyc); ?>
   <!-----SIDEBAR END---->

<div class="middlee">
   
<h2><img src="assets/images/icons/with.svg">Tree View<span class="light"><a href="index.php">Home</a> </span><span class="dark"><a href="tree.php">/ Tree View</a></span></h2>

<!-- <button class="profile-btn"><img src="assets/images/icons/profile.png">Jayson Smith</button> -->
<button class="profile-btn"><img src="<?php if($userImage != '') { echo "assets/images/user-profile/".$userImage; } else {
    echo "assets/images/icons/profile.png";
}?>"><?php if($full_name != '') { echo $full_name; } else {
    echo $user_name;
}?></button>


<div class="row withdrawalrow">
   <div class="col-md-12">
      <div class="leftwithdrawal">
         
         <h2>Tree<span> View</span></h2>

          
   <div class="tree">
    <?php 
    // Define your dynamic data as an array
    $mlmData = array(
        array(
            'name' => 'MLM1',
            'children' => array(
                array(
                    'name' => 'MLM2',
                    'children' => array(
                        array('name' => 'MLM7'),
                        array('name' => 'MLM8'),
                        array('name' => 'MLM9'),
                        array('name' => 'MLM10'),
                        array('name' => 'MLM11'),
                    ),
                ),
                array(
                    'name' => 'MLM3',
                    'children' => array(
                        array('name' => 'MLM12'),
                        array('name' => 'MLM13'),
                        array('name' => 'MLM14'),
                    ),
                ),
                array('name' => 'MLM4'),
                array(
                    'name' => 'MLM5',
                    'children' => array(
                        array(
                            'name' => 'MLM15',
                            'children' => array(
                                array('name' => 'MLM16'),
                                array('name' => 'MLM17'),
                                array('name' => 'MLM18'),
                            ),
                        ),
                        array('name' => 'MLM19'),
                    ),
                ),
                array(
                    'name' => 'MLM6',
                    'children' => array(
                        array(
                            'name' => 'MLM20',
                            'children' => array(
                                array('name' => 'MLM21'),
                                array('name' => 'MLM22'),
                            ),
                        ),
                        array('name' => 'MLM23'),
                    ),
                ),
            ),
        ),
    );
    
    // Recursive function to generate the HTML structure
    function generateList($data) {
        echo '<ul>';
        foreach ($data as $item) {
            echo '<li>';
            echo '<a href="#"><img src="assets/images/icons/man.svg" class="man">' . $item['name'] . '</a>';
            if (isset($item['children'])) {
                generateList($item['children']);
            }
            echo '</li>';
        }
        echo '</ul>';
    }
    
    // Generate the HTML structure using the data
    generateList($mlmData);
    ?>
    
    <!-- <ul>
        <li>
            <a href="#"><img src="assets/images/icons/man.svg" class="man">MLM1</a>
            <ul>
                <li>
                    <a href="#"><img src="assets/images/icons/man.svg" class="man">MLM2</a>
                    <ul class="vertical">
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM7</a></li>
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM8</a></li>
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM9</a></li>
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM10</a></li>
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM11</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><img src="assets/images/icons/man.svg" class="man">MLM3</a>
                    <ul class="vertical">
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM12</a></li>
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM13</a></li>
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM14</a></li>
                    </ul>
                </li>
                <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM4</a></li>
                <li>
                    <a href="#"><img src="assets/images/icons/man.svg" class="man">MLM5</a>
                    <ul>
                        <li>
                            <a href="#"><img src="assets/images/icons/man.svg" class="man">MLM15</a>
                            <ul class="vertical">
                                <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM16</a></li>
                                <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM17</a></li>
                                <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM18</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM19</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><img src="assets/images/icons/man.svg" class="man">MLM6</a>
                    <ul>
                        <li>
                            <a href="#"><img src="assets/images/icons/man.svg" class="man">MLM20</a>
                            <ul class="vertical">
                                <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM21</a></li>
                                <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM22</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><img src="assets/images/icons/man.svg" class="man">MLM23</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul> -->
</div>




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