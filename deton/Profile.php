<?php
session_start();
if(isset($_POST["submit"])) {
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
	
	if ($_FILES["fileToUpload"]["size"] != 0) {
		$imageName = mysql_real_escape_string($_FILES["fileToUpload"]["name"]);
		$imageData = mysql_real_escape_string(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
		$imageType = mysql_real_escape_string($_FILES["fileToUpload"]["type"]);
		
		if (substr($imageType,0,5) == "image") {
			$sql = "UPDATE users SET Image_Name = '" . $imageName . "', Image = '" . $imageData . "' WHERE Id = '" . $_SESSION["id"] . "'";
			if ($conn->query($sql) === TRUE) {
				echo "row updataed";
			}
		} else {
			echo "not image";
		}
		
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
	include_once 'NavbarAdm.php';
}
?>
<?php
include 'showimage.php';
?>
<div class="container">
	<div id="profileBox" class="profile">
		<form id="profileFrm" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="profile-container" enctype="multipart/form-data">	
			<img id="profilePicture" src="showimage.php?id=23" alt="No picture">
			<span>Name: </span><input name="firstname" type="text"><br><br>
			<span>Surname: </span><input name="surname" type="text"><br><br>
			<span>Password: </span><input name="password" type="password"><br><br>
			<span>Phone: </span><input name="phone" type="text"><br><br>
			<input type="file" name="fileToUpload" id="fileToUploads">
			<input type="submit" value="Save" name="submit">
		</form>		
	</div>
</div>
</body>
</html>