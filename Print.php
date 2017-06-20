<?php
  include 'Connection.php';
  $id = $_GET['id'];
  // do some validation here to ensure id is safe


  $sql = "SELECT Image FROM users WHERE Id='" . $id . "'";
  $result = mysql_query("$sql");
  $row = mysql_fetch_assoc($result);


  
  echo $row['Image'];
?>