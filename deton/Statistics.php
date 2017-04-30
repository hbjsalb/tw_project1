<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Statistics</title>
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



</body>
</html>