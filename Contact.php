<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
</head>
<body>
<?php include 'Navbar.php' ?>
<div class="container">
	<div id="contactBox" class="information">
		<h2 class="information-header">Contact Us</h2>
		<form id="contactFrm" method="post" action="" class="information-container">
			<input id="contactField" name="subject" type="text" placeholder="Subject" maxlength="45"><br>
		</form>
		<textarea form ="contactFrm" name="contactText" ></textarea>
		<button type="submit" form="contactFrm" value="Submit">Send</button>
	</div>
</div>
</body>
</html>