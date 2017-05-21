<?php
session_start();
include 'Connection.php';
$sqlTotalC = "SELECT COUNT(*) AS TOTALC FROM convicts";
$sqlTotalU = "SELECT COUNT(*) AS TOTALU FROM users";
$sqlTotalV = "SELECT COUNT(*) AS TOTALV FROM visit WHERE Status = 'Y'";
$sqlTotalM = "SELECT COUNT(*) AS TOTALM FROM messages";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Statistics</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="stats.css">
	<meta charset="UTF-8">
</head>
<body>
<?php 
include 'OwnFunctions.php';
if ($_SESSION["role"] == $_roleClient)
{
	include_once 'Navbar.php';	
	
} else if ($_SESSION["role"] == $_roleAdmin)
{
	include_once 'NavbarAdm.php'; ?>
	<div class="statContainer">
  
     
<a class="nounderline"  title="Total Convicts">
<div class="statBubbleContainer">
<div class="statBubble">
  <div class="statNum">
  #<?php
		$result = $conn->query($sqlTotalC);
		$data=$result->fetch_assoc();
		echo $data["TOTALC"];
  ?>
  </div>
</div>
  <h3>Number of convicts</h3>
</div>
</a>


<a class="nounderline" title="Total users">
<div class="statBubbleContainer">
<div class="statBubble">
  <div class="statNum">
  #<?php
		$result = $conn->query($sqlTotalU);
		$data=$result->fetch_assoc();
		echo $data["TOTALU"];
  ?>
  </div>
</div>
  <h3>Number of users</h3>
</div>
</a>
  
<a class="nounderline" title="Total visits">
<div class="statBubbleContainer">
<div class="statBubble">
  <div class="statNum">
  #<?php
		$result = $conn->query($sqlTotalV);
		$data=$result->fetch_assoc();
		echo $data["TOTALV"];
  ?>
  </div>
</div>
  <h3>Number of visits</h3>
</div>
</a>
  
 <a class="nounderline" title="Total messages">
<div class="statBubbleContainer">
<div class="statBubble">
  <div class="statNum">
  #<?php
		$result = $conn->query($sqlTotalM);
		$data=$result->fetch_assoc();
		echo $data["TOTALM"];
  ?>
  </div>
</div>
  <h3>Number of messages</h3>
</div>
</a>

</div>

	
<?php }
?>



</body>
</html>