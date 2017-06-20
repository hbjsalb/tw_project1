<?php
if(isset($_POST["username"]) && isset($_POST["firstname"]) && isset($_POST["surname"]) && isset($_POST["password"]) && isset($_POST["email"])){
	include 'Connection.php';
	$usernameExists = false;
	
	$username = $_POST ['username'];
	$firstname = $_POST ['firstname'];
	$surname = $_POST ['surname'];
	$password = $_POST ['password'];
	$phone = $_POST ['phone'];
	$email = $_POST ['email'];
	$age = $_POST ['age'];
	$sex = $_POST ['sex'];
	
	$stmt = $conn->prepare("SELECT * FROM users WHERE Username = ?");
	$stmt->bind_param("s", $uid);
	
	$uid = $username;
	$stmt-> execute();
	
	$result = $stmt->get_result();
	
	 if($result->num_rows > 0)
	   {
			$usernameExists = true;
	   }
		
	if(!$usernameExists){
		
		$stmt = $conn->prepare ("INSERT INTO users (Username, Firstname, Surname, Password, Phone, Email, Age, Sex) VALUES (?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssssss",$uid, $nume, $prenume, $pw, $telefon, $mail, $varsta, $gen);
		$uid = $username;
		$nume = $firstname;
		$prenume = $surname;
		$pw = $password;
		$telefon = $phone;
		$mail = $email;
		$varsta = $age;
		$gen = $sex;
		
		$stmt->execute();
		$result= $stmt->get_result();
		
	
		

		if (!$result ) {
			$newURL = "http://localhost/deton/login.php";
			header('Location: '.$newURL);
		} else {
			echo "Error: " . $result . "<br>" . $conn->error;
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="UTF-8">
</head>
<body>
<div class="container">
	<div id="registerBox" class="register">
		<h2 class="register-header">Register</h2>
		<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" class="register-container">
			<?php if(isset($usernameExists) && $usernameExists == true){ ?>
				<span id="usrExisting">This username already exists</span>
			<?php } ?>
			<input id="registerField" name="username" type="text" placeholder="username" required="required"><br>
			<input id="registerField" name="firstname" type="text" placeholder="firstname"><br>
			<input id="registerField" name="surname" type="text" placeholder="surname"><br>
			<input id="registerField" name="password" type="password" placeholder="password"><br>
			<input id="registerField" name="phone" type="text" placeholder="phone number"><br>
			<input id="registerField" name="email" type="email" placeholder="email"><br>
			<input id="registerField" name="age" type="number" placeholder="age"><br>
			<div id="sex">
				Sex: <br />
				<label><input id="radioBtn" type="radio" name="sex" value="M" checked><span>Male</span></label>
				<label><input id="radioBtn" type="radio" name="sex" value="F"><span>Female</span></label>
			</div>
			<input id="registerBtn" type="submit" value="Register"></input>
		</form>
	</div>
</div>
</body>
</html>