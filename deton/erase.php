<?php
include_once("Connection.php");
$cheks = implode("','", $_POST['checkbox']);
$sql = "delete from convicts where Id in ('$cheks')";
$result = mysql_query($sql) or die(mysql_error());
mysql_close();
?>