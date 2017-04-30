<?php
session_start();

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
<div class="container">
	<div id="profileBox" class="profile">
		<form id="profileFrm" action="" method="post" class="profile-container">	
			<img id="profilePicture" src="img/admin3.png" alt="No picture">
			<span>Name: </span><input name="firstname" type="text"><br><br>
			<span>Surname: </span><input name="surname" type="text"><br><br>
			<span>Password: </span><input name="password" type="password"><br><br>
			<span>Phone: </span><input name="phone" type="text"><br><br>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Save" name="submit">
		</form>		
	</div>
</div>
</body>
</html>