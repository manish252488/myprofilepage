<?php
session_start();
?>
<?php
$servername="localhost";
$username="manish25";
$password="1997";
$db="profile";
error_reporting(0);
ini_set('display_errors', 0);
try
{
$conn=mysqli_connect($servername,$username,$password,$db);
   if ($_SESSION["USER"]=="") 
    throw new Exception("Error Processing Request", 1);
}
catch(exception $e)
{
	echo "error:".$e."<br>";
	echo "<button class='btn btn-lg' id='updatebtn' onclick='redirect()' autofocus>back</button>";
}
?>
<script type="text/javascript">
	function redirect() {
	window.location="index.php";
	}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>MessagePanel</title>
	<link rel="icon" type="image/png" href="icons/avataric.png">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="cssfol/file1.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script src="script1.js"></script>
</head>
<body>
	<div id="messageconatiner">
		<?php 
$sql="SELECT * FROM suggestion";
$res=mysqli_query($conn,$sql);
while ($r=mysqli_fetch_row($res))
{
	echo "<div class='msgbox'>";
	echo "<div class='box1'>";
	echo "<span class='name'>".$r[1]."</span><span class='mail'>@".$r[2]."@".$r[3]."</span><br>";
echo "<span class='textmsg'>".$r[4]."</span><br>";

if ($r[6])
	echo "<span class='msta1'>mailsent";
else
	echo "<span class='msta2'>mail not sent";
	echo "</div>";
	echo "</div>";
}
	?>
		</div>
		<div id="replypanel">
			<div id="predid">
			</div>
			<form action="ajaxfiles/replymail.php" method="post" id="replyform">
		<input type="text" name="replytxt" id="replybox" placeholder="To search a mail adderss start with @k.." onkeyup="check(this.value)" required>
		<input type="text" name="reply" placeholder="Type to reply....." class="textbox" required>
		<button class="btn btn-lg" type="submit">send</button>
	</form>
	</div>
</body>
</html>