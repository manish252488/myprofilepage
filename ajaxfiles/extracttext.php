<?php
$x=$_REQUEST["x"];
$servername="localhost";
$username="manish25";
$password="1997";
$db="profile";
$text="";
try
{
$conn=mysqli_connect($servername,$username,$password,$db);
}
catch(exception $e)
{
	echo "error:".$e;
}
mysqli_real_escape_string($conn,$x);
$extract="SELECT imtext FROM certificate where slno='$x'";
$result=mysqli_query($conn,$extract);
$text=mysqli_fetch_row($result);
echo $text[0];
?>