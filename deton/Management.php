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
<div class="container">
	<div id="managementBox" class="management">
		<img src="img/store.png" id="addImage" alt="add" onclick="myFunction()" />
		<img src="img/remove.png" id="removeImage" alt="remove" />
	</div>
</div>

<script>
function myFunction() {
    window.open("InsertConvict.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=400,width=500,height=500");
}
</script>

</body>
</html>