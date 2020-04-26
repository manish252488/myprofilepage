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
$x=$x."%";
$k="";
mysqli_real_escape_string($conn,$x);
$sql="SELECT DISTINCT mail FROM suggestion WHERE mail LIKE '$x'";
$res=mysqli_query($conn,$sql);
while($r=mysqli_fetch_row($res))
{
$k=$k."<option onclick='entervalue(this.value)'>".$r[0]."</option>"; 
}
echo $k; 
?>