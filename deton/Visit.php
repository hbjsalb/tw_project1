<?php
session_start();
include 'Connection.php';
$nowFormat = date("Y-m-d");
if(isset($_POST["scheduleDate"])) { 
	$visitCheckerD = true;
	$visitCheckerC = true;
	$visitCheckerU = true;
	$sqlValidate = "SELECT * from visit where Visit_date = '" . $_POST["scheduleDate"] . "' AND Convict_id = '" . $_POST["id"] . "'";
	$result=$conn->query($sqlValidate);
	if($result->num_rows > 0) {
		$visitCheckerD = false;
	}
	$sqlValidate = "SELECT * from convicts where Id = '" . $_POST["id"] . "'";
	$result=$conn->query($sqlValidate);
	if($result->num_rows < 1) {
		$visitCheckerC = false;
	} 
	$sqlValidate = "SELECT * from visit where Visit_date = '" . $_POST["scheduleDate"] . "' AND Username_id = '" . $_SESSION["id"] . "'";
	$result=$conn->query($sqlValidate);
	if($result->num_rows > 0) {
		$visitCheckerU = false;
	}
	if ($visitCheckerD == true && $visitCheckerC == true && $visitCheckerU == true) {
		$sqlName = "SELECT Full_name from convicts where Id = '" . $_POST["id"] . "'";
		$resultName = $conn->query($sqlName);
		$row = $resultName->fetch_assoc();
		$fullname = $row["Full_name"];
		$sql = "INSERT INTO visit (Username, Username_id, Convict_name, 
		Convict_id, Citizenship, Relationship, Type_of_visit, Objects, Co_visitor1, Co_visitor2, Visit_date) 
		VALUES ('" . $_SESSION["username"] . "', '" . $_SESSION["id"] . "', '" . $fullname . "', '" . $_POST["id"] . 
		"', '" . $_POST["citizenship"] . "', '" . $_POST["relationship"] . "', '" . $_POST["visit"] . "', '" . $_POST["objects"] . 
		"', '" . $_POST["guest1"] . "', '" . $_POST["guest2"] . "', '" . $_POST["scheduleDate"] . "')";
		if ($conn->query($sql) === TRUE) {
				$inserted = true;
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
	} else { }
		
}

$sqlAdm = "SELECT * FROM visit WHERE Status in ('Y','N','D') ORDER BY Visit_date DESC";
$resultAdm = $conn->query($sqlAdm);



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
	include_once 'Navbar.php'; ?>
	<div class="container">
		<div id="scheduleBox" class="schedule">
			<form id="scheduleFrm" action="" method="post" class="schedule-container">
				<?php if(isset($visitCheckerD) && $visitCheckerD == false){ ?>
					<script type="text/javascript">
						alert("The convict has another visit at that date. Please, choose another day!");
					</script>
				<?php } else if ((isset($visitCheckerC) && $visitCheckerC == false)) { ?>
					<script type="text/javascript">
						alert("The convict id is not valid. Please, insert a correct one!");
					</script>
				<?php } else if ((isset($visitCheckerU) && $visitCheckerU == false)) { ?>	
					<script type="text/javascript">
						alert("You already have a visit shdeuled for this date. Please, select another date!");
					</script>
				<?php } ?>
				<span>Choose date:</span><input type="date" name="scheduleDate" required="required" min="<?php echo htmlspecialchars($nowFormat); ?>"><br>	
				<!--<span>Convict name:</span><input name="name" type="text" required="required"><br> -->
				<span>Convict id:</span><input name="id" type="number" required="required"><br>
				<span>Citizenship:</span><input name="citizenship" type="text" required="required"><br>
				<span>Relationship:</span>
				<select name="relationship">
					<option value="mother">Mother</option>
					<option value="father">Father</option>
					<option value="sister">Sister</option>
					<option value="wife">Wife</option>
					<option value="husband">Husband</option>
					<option value="brother">Brother</option>
					<option value="friend">Friend</option>
					<option value="other">Other</option>
				</select>
				<br>
				<span>Type of visit:</span>
				<select name="visit">
					<option value="informative">Informative</option>
					<option value="food">New food</option>
					<option value="clothes">New clothes</option>
				</select>
				<br>
				<span>Objects:</span><input name="objects" type="text" maxlength="200"><br>
				<span>Co-visitor Name:</span><input name="guest1" type="text"><br>
				<span>Co-visitor Name:</span><input name="guest2" type="text"><br>
				<input id="scheduleBtn" type="submit" value="Save" name="submitBtn">
				<br><br>
			</form>	
		</div>
	</div>	
<?php } else if ($_SESSION["role"] == $_roleAdmin) {
	include_once 'NavbarAdm.php'; ?>
	<div class="container2">
	<h2 class="release-header">Visits history</h2>
	<form action="" method="post">
	<!-- TABLE -->
	<table class="table table-action">
	  
	  <thead>
		<tr>
		  <th class="t-small"></th>
		  <th class="t-medium">Username</th>
		  <th class="t-medium">Convict Name</th>
		  <th class="t-small">ID</th>
		  <th class="t-medium">Visit Date</th>
		  <th class="t-small">Status</th>
		</tr>
	  </thead>
	  
	  <tbody>
		
		 <?php if ($resultAdm && $resultAdm->num_rows > 0) {
					while($row = $resultAdm->fetch_assoc()) { ?>
					  <tr>
						 <td><label><input name="num[]" type="checkbox" value="<?php echo $row['Visit_id'];?>"></form></label></td>
						 <td><?php echo $row["Username"] ?></td>
						 <td><?php echo $row["Convict_name"] ?></td>
						 <td><?php echo $row["Convict_id"] ?></td>
						 <td><?php echo $row["Visit_date"] ?></td>
						 <td><?php if ($row["Status"] == "Y") { ?> <img src="img/check.png" alt="Y"> 
						 <?php } else if ($row["Status"] == "N") { ?>  <img src="img/uncheck.png" alt="N">
						 <?php } ?></td>
					  </tr>
				 <?php
						}
					}
					
				 ?>
		
	  </tbody>
	</table>
	<!-- END TABLE -->
	<input type="submit" value="Delete" name="del" id="delBtn" />
	</form>
	<?php
		if(isset($_POST["del"])) {
			$box=$_POST["num"];
			while(list($key,$val) = @each ($box)) {
				$sql="DELETE FROM visit WHERE Visit_id = '" . $val . "'";
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
		}
} ?>
</div>

</body>
</html>