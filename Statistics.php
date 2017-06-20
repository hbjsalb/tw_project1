<?php
session_start();
if ($_SESSION["isLogged"] == true) {
	include 'Connection.php';
	$sqlTotalC = "SELECT COUNT(*) AS TOTALC FROM convicts";
	$sqlTotalU = "SELECT COUNT(*) AS TOTALU FROM users";
	$sqlTotalV = "SELECT COUNT(*) AS TOTALV FROM visit WHERE Status = 'Y'";
	$sqlTotalM = "SELECT COUNT(*) AS TOTALM FROM messages";
	$sqlTotalVU = "SELECT COUNT(*) AS TOTALVU FROM visit WHERE Status = 'Y' AND Username_id = '" . $_SESSION["id"] . "'";
	$sqlLastV = "SELECT MAX(Visit_date) AS LASTV FROM visit WHERE Status = 'Y' and Username_id ='" . $_SESSION["id"] . "'";
	$sqlTotalR = "SELECT COUNT(*) AS TOTALR FROM visit WHERE Username_id = '" . $_SESSION["id"] . "'";
	$sqlTotalMU = "SELECT COUNT(*) AS TOTALMU FROM messages WHERE Username = '" . $_SESSION["username"] . "'";
	$sql = "SELECT * FROM visit WHERE Username_id= '" . $_SESSION["id"] . "'";

	$response = array();
    $visit = array();
	$result = $conn->query($sql);
	if($result->num_rows>0){ 
          while($row = $result->fetch_assoc()){ 
		
	$username=$row["Username"];
    $convict_name=$row["Convict_name"];
    $convict_id=$row["Convict_id"];	
	$userid=$row["Username_id"];
	$citizenship=$row["Citizenship"];
	$relationship=$row['Relationship'];
	$type_of_visit=$row['Type_of_visit'];
	$objects=$row['Objects'];
	$co_visitor1=$row['Co_visitor1'];
	$co_visitor2=$row['Co_visitor2'];
	$visit_date=$row['Visit_date'];
	$status=$row['Status'];
	
	$visit[] = array('Username'=> $username, 'User Id'=>$userid,'Convict name'=> $convict_name,'convict Id'=>$convict_id,
	                  'Citizenship'=>$citizenship, 'Relationship'=>$relationship, 'Type_of_visit'=>$type_of_visit,
					   'Objects'=>$objects, 'Co_visitor1'=>$co_visitor1, 'Co_visitor2'=>$co_visitor2, 'Visit_date'=>$visit_date,
					   'Status'=>$status);
					   
	$fp = fopen($username.'.json', 'w');				   

	}	 }

	$response['Visit'] = $visit;

	//$fp = fopen('statistics.json', 'w');
	fwrite($fp, json_encode($response));
	fclose($fp);


} else {
	$newURL = "http://localhost/deton/login.php";
	header('Location: '.$newURL);
}
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
	include_once 'Navbar.php';	?>
<div class="statContainer">
	<a class="nounderline"  title="Total Visits">
	<div class="statBubbleContainer">
	<div class="statBubble">
	  <div class="statNum">
	  #<?php
			$result = $conn->query($sqlTotalVU);
			$data=$result->fetch_assoc();
			echo $data["TOTALVU"];
	  ?>
	  </div>
	</div>
	  <h3>Number of visits</h3>
	</div>
	</a>


	<a class="nounderline" title="Closest date">
	<div class="statBubbleContainer">
	<div class="statBubble">
	  <div class="statNum">
	  #<?php
			$result = $conn->query($sqlLastV);
			$data=$result->fetch_assoc();
			$nowFormat = date("Y-m-d");
			$sqlDif = "select datediff('" . $nowFormat . "', '" . $data['LASTV'] . "') AS DAYS;";
			$result2=$conn->query($sqlDif);
			$data2=$result2->fetch_assoc();
			echo $data2["DAYS"];
	  ?>
	  </div>
	</div>
	  <h3>Closest date - days</h3>
	</div>
	</a>
	  
	<a class="nounderline" title="Total requests">
	<div class="statBubbleContainer">
	<div class="statBubble">
	  <div class="statNum">
	  #<?php
			$result = $conn->query($sqlTotalR);
			$data=$result->fetch_assoc();
			echo $data["TOTALR"];
	  ?>
	  </div>
	</div>
	  <h3>Number of requests</h3>
	</div>
	</a>
	
	<a class="nounderline" title="Total sent">
	<div class="statBubbleContainer">
	<div class="statBubble">
	  <div class="statNum">
	  #<?php
			$result = $conn->query($sqlTotalMU);
			$data=$result->fetch_assoc();
			echo $data["TOTALMU"];
	  ?>
	  </div>
	</div>
	  <h3>Number of messages</h3>
	</div>
	</a>
	  

</div>
	
<?php
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