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
$file=fopen("../data/about.txt", "w");
if (fwrite($file, $x)) 
{
	echo true;
}
else
echo false;
fclose($file);
?>