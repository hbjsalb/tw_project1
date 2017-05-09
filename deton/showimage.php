<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	// make deton the current db
	$db_selected = mysqli_select_db($conn, "deton");
	if (!$db_selected) {
		die ('Can\'t use deton : ' . mysql_error());
	}
	if (isset($_GET['id'])) {
		$id = mysql_real_escape_string($_GET['id']); 
		$sql = mysql_query("SELECT * FROM users WHERE Id = 'id'");
		while ($row = mysql_fetch_assoc($sql)) {
			$imageData = $row["Image"];
			echo "imagineeee";
		}
		header("content-type: image/jpeg");
		echo $imageData;
	} else {
		echo "error";
	}
?>