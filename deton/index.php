
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
<table>
	  <thead>
		  <tr>
			 <th>ID</th>
			 <th>Firstname</th>
			 <th>Surname</th>
			 <th>Phone No</th>
			 <th>Email</th>
			 <th>Age</th>
		  </tr>
	  </thead>
	  <tbody>
		  
		  <?php if ($result && $result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { ?>
					  <tr>
						 <td><?php echo $row["Id"] ?></td>
						 <td><?php echo $row["Firstname"] ?></td>
						 <td><?php echo $row["Surname"] ?></td>
						 <td><?php echo $row["Phone"] ?></td>
						 <td><?php echo $row["Email"] ?></td>
						 <td><?php echo $row["Age"] ?></td>
					  </tr>
				 <?php
						}
					}
					$conn->close();
				 ?>
	  </tbody>
	</table>
</div>


</body>
</html>