<?php
session_start();
include 'Connection.php';
$display = false;
$sqlAdm = "SELECT * FROM visit where status = 'P'";
$resultAdm = $conn->query($sqlAdm);
if($resultAdm->num_rows > 0) {
	$display = true;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="table.css">
	<meta charset="UTF-8">
</head>
<body>
<?php 
include 'OwnFunctions.php';
if ($_SESSION["role"] == $_roleClient) {
	include_once 'Navbar.php';	?>
	

<?php } else if ($_SESSION["role"] == $_roleAdmin) {	
	include_once 'NavbarAdm.php'; 
	if ($display == true) { ?>
	<div class="container2">
	<h2 class="release-header">Curent requests</h2>
	<form action="" method="post">
	<!-- TABLE -->
	<table class="table table-action">
	  
	  <thead>
		<tr>
		  <th class="t-small"></th>
		  <th class="t-medium">Username</th>
		  <th class="t-medium">Convict name</th>
		  <th class="t-small">ID</th>
		  <th class="t-medium">Relationship</th>
		  <th class="t-medium">Visit type</th>
		  <th class="t-medium">Objects</th>
		  <th class="t-medium">Visit Date</th>
		</tr>
	  </thead>
	  
	  <tbody>
		
		 <?php if ($resultAdm && $resultAdm->num_rows > 0) {
					while($row = $resultAdm->fetch_assoc()) { ?>
					  <tr>
						 <td><label><input name="num[]" type="checkbox" value="<?php echo $row['Visit_id'];?>"></label></td>
						 <td><?php echo $row["Username"] ?></td>
						 <td><?php echo $row["Convict_name"] ?></td>
						 <td><?php echo $row["Convict_id"] ?></td>
						 <td><?php echo $row["Relationship"] ?></td>
						 <td><?php echo $row["Type_of_visit"] ?></td>
						 <td><?php echo $row["Objects"] ?></td>
						 <td><?php echo $row["Visit_date"] ?></td>
					  </tr>
				 <?php
						}
					}
					
				 ?>
		
	  </tbody>
	</table>
	<!-- END TABLE -->
	<div id="divider">
	<input type="submit" value="Approve" name="app" id="appBtn" />
	<input type="submit" value="Reject" name="rej" id="rejBtn" />
	</div>
	</form>
		<?php
		if(isset($_POST["rej"])) {
			$box=$_POST["num"];
			while(list($key,$val) = @each ($box)) {
				$sql="UPDATE visit SET Status = 'N' WHERE Visit_id = '" . $val . "'";
				if ($conn->query($sql) === TRUE) {
				$ok=true;
			} else {
				echo "Error deleting record: " . $conn->error;
			}
			}
		?>
		<script type="text/javascript">
		window.location.href=window.location.href;
		</script>
		<?php
		} if(isset($_POST["app"])) {
			$box=$_POST["num"];
			while(list($key,$val) = @each ($box)) {
				$sql="UPDATE visit SET Status = 'Y' WHERE Visit_id = '" . $val . "'";
				if ($conn->query($sql) === TRUE) {
				$ok=true;
			} else {
				echo "Error deleting record: " . $conn->error;
			}
			}
		?>
		<script type="text/javascript">
		window.location.href=window.location.href;
		</script> 
</div>
		<?php
		}
	} else { ?> 
	 <div class="container2">
	 <h2 class="release-header" id="noReq">There aren't any new requests</h2>
	 </div>
	<?php }
} ?>
</body>
</html>