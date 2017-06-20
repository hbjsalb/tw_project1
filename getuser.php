<!DOCTYPE html>
<html>
<head>


</head>
<body>

<?php

$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"deton");
$sql="SELECT * FROM convicts WHERE Id = '".$q."'";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
      
    echo $row['Full_name'];
    
}
echo "</table>";
mysqli_close($con);

?>
 
</body>
</html>