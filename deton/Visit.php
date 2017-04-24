<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// make foo the current db
$db_selected = mysqli_select_db($conn, "deton");
if (!$db_selected) {
    die ('Can\'t use deton : ' . mysql_error());
}


$sql = "SELECT * FROM users";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
</head>
<body>
<?php include_once 'Navbar.php' ?>
<div class="container">
	<div id="scheduleBox" class="schedule">
		<form id="scheduleFrm" action="" method="post" class="schedule-container">
			<span>Choose date:</span><input type="date" name="scheduleDate" required="required"><br>	
			<span>Convict name:</span><input name="name" type="text" required="required"><br>
			<span>Convict id:</span><input name="id" type="number" required="required"><br>
			<span>Citizenship:</span><input name="citizenship" type="text" required="required"><br>
			<span>Relationship:</span>
			<select name="relationship">
				<option value="mother">Mother</option>
				<option value="father">Father</option>
				<option value="sister">Sister</option>
				<option value="wife">Wife</option>
				<option value="husband">Husband</option>
				<option value="brother">Brother</option>
				<option value="friend">Friend</option>
				<option value="other">Other</option>
			</select>
			<br>
			<span>Type of visit:</span>
			<select name="visit">
				<option value="informative">Informative</option>
				<option value="food">New food</option>
				<option value="clothes">New clothes</option>
			</select>
			<br>
			<span>Co-visitor Name:</span><input name="guest1" type="text"><br>
			<span>Co-visitor Name:</span><input name="guest2" type="text"><br>
			<input id="scheduleBtn" type="submit" value="Save" name="submitBtn">
			<br><br>
		</form>	
	</div>
</div>
</body>
</html>