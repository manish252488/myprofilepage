<?php
$x=$_REQUEST["x"];
$p=$_REQUEST["p"];
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
if (!mysqli_query($conn,"SELECT * FROM programk")) 
{
	$sql="CREATE TABLE  programk(slno int NOT NULL AUTO_INCREMENT,subject varchar(250) NOT NULL,percentage int(100) NOT NULL,PRIMARY KEY (slno))";
	mysqli_query($conn,$sql);
}
mysqli_real_escape_string($conn,$x);
mysqli_real_escape_string($conn,$p);
$sql="INSERT INTO programk(subject,percentage) VALUES('$x','$p')";
if (mysqli_query($conn,$sql)) 
{
echo true;
}
else
echo false;
?>