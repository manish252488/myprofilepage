<?php
$x=$_REQUEST["x"];
$servername="localhost";
$username="manish25";
$password="1997";
$db="profile";
try
{
$conn=mysqli_connect($servername,$username,$password,$db);
}
catch(exception $e)
{
	echo "error:".$e;
}
mysqli_real_escape_string($conn,$x);
$sql="DELETE FROM programk WHERE slno='$x'";
if (mysqli_query($conn,$sql)) 
{
echo true;
}
else
echo false;
?>