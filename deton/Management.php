<?php
session_start();
include 'Connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Statistics</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
</head>
<body>
<?php include_once 'NavbarAdm.php' ?>
<button onclick="myFunction()">Add a new one</button>
<img src="img/add.png" alt="add" onclick="myFunction()" />


<script>
function myFunction() {
    window.open("InsertConvict.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=400,width=500,height=500");
}
</script>

</body>
</html>