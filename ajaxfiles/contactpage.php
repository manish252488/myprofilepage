<?php
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
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
$name=$_POST["name"];
$phno=$_POST["phno"];
$mail=$_POST["mail"];
$sugg=$_POST["sugg"];
$sql="SELECT * FROM suggestion";
if (!mysqli_query($conn,$sql)) 
{
$sql="CREATE TABLE suggestion(slno int not null AUTO_INCREMENT,name varchar(50),phno varchar(50),mail varchar(100),sugg varchar(220),submitTime TIMESTAMP,mailstatus boolean,PRIMARY KEY(slno))";
mysqli_query($conn,$sql);
}
$sub="regardings from @mainsh";
$msg="Thank you,".$name."! for your valuable suggestion.This is a system generated mail pls don't try to reply.we will reply you soon as we review your suggestion.";
mail($mail, $sub, $msg);
echo "<script>alert('thank you for your suggestion!');</script>";
mysqli_real_escape_string($conn,$name);
mysqli_real_escape_string($conn,$phno);
mysqli_real_escape_string($conn,$mail);
mysqli_real_escape_string($conn,$sugg);
$sqlinst="INSERT INTO suggestion(name,phno,mail,sugg) values('$name','$phno','$mail','$sugg')";
if (mysqli_query($conn,$sqlinst)) 
{
	echo "<script>alert('done!');window.location='../index.php';</script>";
}
else
echo "<script>alert('please try after some time!');window.location='../index.php';</script>";
}
?>