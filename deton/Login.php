<?php
session_start();
if(isset($_POST["username"]) && isset($_POST["password"])) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$credentials = false;

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
	
	$result=$conn->query("SELECT * FROM users WHERE Username= '" .  $_POST["username"] . "' AND Password = '" .  $_POST["password"] . "'");
	if($result->num_rows > 0)
	   {
		    $row = $result->fetch_assoc();
			$credentials = true;
			$_SESSION["id"] = $row["Id"];
			$_SESSION["username"] = $row["Username"];
			if ($row["Role"] == "ADM")
			{
				$_SESSION["role"] = "admin";
			} else 
			{
				$_SESSION["role"] = "client";
			}
			$newURL = "http://localhost/deton/";
			header('Location: '.$newURL);
	   }
	
	
	$conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Deton</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="UTF-8">
</head>
<body>
<div class="container">
	<div id="loginBox" class="register">
		<h2 class="register-header">Login</h2>
		<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" class="register-container">
			<input id="user" type="text" name="username" placeholder="username" maxlength="25" required="required"><br>
			<input id="pass" type="password" name="password" placeholder="password"><br>
			<input id="loginBtn" type="submit" value="Login"></input>
				<?php if(isset($credentials) && $credentials == false){ ?>
				<span id="invCredentials">Invalid credentials, please retry!</span>
				<?php } ?>
			<p style="text-align: right;"> To register, press <a href="Register.php" style="font-weight: bold;">here</em></a></p>
		</form>
	</div>
</div>
</body>
</html>