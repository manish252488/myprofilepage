<?php session_start();
?>
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
	$mail=$_POST["replytxt"];
	$reply=$_POST["reply"];
	$sub="@manishsingh";
	$mail=trim($mail);
	if (!mysqli_query($conn,"SELECT * FROM adminreply")) 
	{
		$sql="CREATE TABLE adminreply(slno int not null AUTO_INCREMENT,tomail varchar(50),replytext varchar(250),uptime TIMESTAMP,PRIMARY KEY(slno))";
		mysqli_query($conn,$sql);
	}
	if(mail($mail,$sub,$reply))
	{
		mysqli_real_escape_string($conn,$mail);
		mysqli_real_escape_string($conn,$reply);
		$sql="INSERT INTO adminreply(tomail,replytext) VALUES('$mail','$reply')";
		mysqli_query($conn,$sql);
		echo "<script>window.location='../msgpanel.php';</script>";
	}
	else
	{
		echo "<script>alert('try after some time!!');</script>";
		echo "<script>window.location='../msgpanel.php';</script>";
	}
}
?>