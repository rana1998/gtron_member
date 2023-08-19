<?php


$servername = "localhost";
// $username = "arialkhk_gtron";
// $password = "gtron@12g";
$username = "root";
$password = "";
 

// $servername = "localhost";
// $username = "arialkhk_gtron";
// $password = "?G/L!26=@";


try {

	$conn = new PDO("mysql:host=$servername;dbname=arialkhk_gtron", $username, $password);

    // set the PDO error mode to exception

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch(PDOException $e)

{

	echo "Connection failed: " . $e->getMessage();

}

?>