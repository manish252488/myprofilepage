
<?php
session_start();
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
	$user=$_POST["userid"];
	$psw=$_POST["psw"];
	$sql="SELECT username,password FROM admindet";
	$res=mysqli_query($conn,$sql);
	$r=mysqli_fetch_row($res);
	if ($r[0]==$user && $r[1]==$psw) 
	{
	$_SESSION["USER"]="manish";
	echo "<script>window.location='index.php';</script>";
	}
	else{
		$_SESSION["USER"]="";
		echo "<script>alert('wrong credentials');</script>";
	}
}
 error_reporting(0);
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Profile</title>
	<link rel="icon" type="image/png" href="icons/avataric.png">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="cssfol/file1.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script src="script1.js"></script>
    <?php
    if ($_SESSION["USER"]=="") 
    {
    	echo "<style>
    	#updatebtn
{
	position: absolute;
	right:1vw;
	top: 1vw;
	display: none;
}
#adminmsg
{
	display:none;
}
#delbtn
{
	display:none;
}
    	</style>";
    }
    else
    	echo "<style>
#updatebtn
{
	position: absolute;
	right:1vw;
	top: 1vw; 
	display:block;
}
#adminmsg
{
	display:block;
}
#delbtn
{
	display:block;
}
#dp:hover #uploadpanel
{
	display: block;
opacity: 0.9;
}
#dp:hover #picon
{
	display: none;
}
    </style>";
    ?>
</head>


<body>
	<div id="frame">
		<img src="iconfol/close.png" id="closebtn" onclick="openframe(false)">
		<div class="imageframe"><img src="#" id="framecontent"></div>
		<div id="imagetext"></div>
	</div>
	<div id="loginpanel">
		<img src="iconfol/close.png" id="closebtn" onclick="adminpanel(false)">
		<form id="logform" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
	<table>
		<tr><td>ID</td><td><input type="text" name="userid" class="textbox" required></td></tr>
		<tr><td>PASSWORD</td><td><input type="password" name="psw" class="textbox" required></td></tr>
		<tr><td><button class="btn btn-lg">login</button></td></tr>
	</table>
</form>
</div>
<div id="updatepanel">
	<img src="iconfol/close.png" id="closebtn" onclick="closepanel()">
	<div id="abt1">
		<textarea id="abt" rows="5" cols="50"></textarea><br>
	<button class="btn btn-lg" onclick="uploadabout()" >upload</button>
</div>
<div id="addknow">
	SUBJECT<br>
	<input type="text" name="sub" class="textbox" id="sub" required>
	<br>
	PERCENTAGE
	<br>
	<input type="number" name="percent" class="textbox" id="percent" required max="100">
	<br>
	<button class="btn btn-lg" onclick="uploadknowledge()">upload</button>
</div>
<div id="certiup">
	<form action="ajaxfiles/uploadcerti.php" method="post" enctype="multipart/form-data">
	<input type="file" name="certificate" class="textbox" required>
	<input type="text" name="img_det" class="textbox" required>
	<input type="submit" value="upload" class="btn btn-lg">
</form>
</div>
</div>
	<header>
		<button class="btn trans btn-lg" onclick="document.getElementById('content1').scrollIntoView();">INTRO</button>
		<button class="btn trans btn-lg" onclick="document.getElementById('content2').scrollIntoView();">ABOUT</button>
		<button class="btn trans btn-lg" onclick="document.getElementById('content3').scrollIntoView();">KNOWLEDGE</button>
		<button class="btn trans btn-lg" onclick="document.getElementById('content4').scrollIntoView();">CERTIFICATES</button>
		<button class="btn trans btn-lg" onclick="document.getElementById('content5').scrollIntoView();">EXPERIENCE</button>
		<button class="btn trans btn-lg" onclick="document.getElementById('content6').scrollIntoView();">CONTACT</button>
		<?php
		   if ($_SESSION["USER"]=="") 
		   	echo "<button class='btn trans btn-lg' onclick='adminpanel(true)''><img src='iconfol/admin.png' id='icon'>ADMIN</button>";
		   else
		   	echo "<button class='btn trans btn-lg' onclick='logout()'>ADMIN>Manish(logout)</button>
		   <img src='iconfol/msg-ico.png' id='adminmsg' onclick='suggestionpanel()'>";
		?>
	</header>
	<div id="container">
		<div class="content" id="content1">
			<div id="prof">
				I<span style="color:red;">'</span>M <br> MANISH<br>SINGH<span style="color: red;">.</span><br><br><span id="m011media">I'm a Developer.</span>
			</div>
			<div id="dp">
					<?php if (file_exists("images/profile.jpg")) {
						 echo "<img id='picon' src='images/profile.jpg'>";
					}
					else
						echo "<img id='picon' src='iconfol/admin.png'>";
					?>
				<div id="uploadpanel">
					<form action="upload.php" method="post" enctype="multipart/form-data" id="upload">
					<input type="file" name="dpup" id="dpup" oninput="uploadfile()">
					</form>
				</div>
			</div>
		</div>
		<div class="content" id="content2">
			<div class ="title">About<span style="color:green;font-size: 5vw;">.</span></div>
			<button class='btn btn-lg' id='updatebtn' onclick='updatepanel(1)'>CHANGE ABOUT TEXT</button>
			<div id="box">
				<?php
				if(file_exists("data/about.txt"))
					{
						$file=fopen("data/about.txt","r");
				while (!feof($file)) 
				{
					$x=fgets($file);
					if ($x!="") {
						echo $x;
					}
					else
					{
				   	echo "i'm a small paragraph about you.you can change me any time you want im editable text stored in data base just click the edit button whenever you want to edit me...";
				  	break;
				   }

					
				}
			}
			else
				echo "i'm a small paragraph about you.you can change me any time you want im editable text stored in data base just click the edit button whenever you want to edit me...";
				   
				  ?>
			</div>
		</div>
		<div class="content" id="content3">
				<div class ="title">MY KNOWLEDGE IN PROGRAMMING LANGUAGES<span style="color:green;font-size: 5vw;">.</span></div>
				<button class='btn btn-lg' id='updatebtn' onclick='updatepanel(2)'>update</button>
<table id="subjecttable">

<?php 
$sql="SELECT slno,subject,percentage FROM programk";
if ($res=mysqli_query($conn,$sql)) 
{
	while ($r=mysqli_fetch_row($res)) 
	{
		echo "<tr><td class='text001'>".$r[1]."</td><td class='barcont'><div class='bar' style='width:".$r[2]."%;'><div class='barani'></div></div></td><td class='text001'>".$r[2]."%</td><td><button class='btn btn-sm' id='delbtn' onclick='deletetext(".$r[0].")'>delete</button></td></tr>";
	}
}
?>
</table>
</div>
<div class="content" id="content4">
	<div class ="title">Certificates<span style="color:green;font-size: 5vw;">.</span></div>
	<button class='btn btn-lg' id='updatebtn' onclick='updatepanel(3)'>upload files</button>
	<div id="ccontainer">
 <?php 
$extract="SELECT slno,image FROM certificate";
if($result=mysqli_query($conn,$extract))
while($image=mysqli_fetch_row($result))
{
	$i=$image[0];
	echo "<div class='imagecontainer'><img src='ajaxfiles/".$image[1]."' class='image001' onclick='openframe(true,this.src,$i)'>
<img src='iconfol/close.png' class='delbtn' onclick='delcerti($i)'></div>";
$i++;
} ?>
	</div>
</div>
<div class="content" id="content5">
	<div class ="title">Experience<span style="color:green;font-size: 5vw;">.</span></div><button class='btn btn-lg' id='updatebtn' onclick='updatepanel()'>Add Experiences</button>
</div>
<div class="content" id="content6">
	<div id="contactcontainer">
	<div>
		<span id="mmm">CONTACT</span><br>Hello, viewer this is Manish.<br>Be free to contact me for<br>suggestions.<br><br><span id="thank">THANK YOU<span style="color: tomato;">!</span></span>
	</div>
	<div>
			<form action="ajaxfiles/contactpage.php" method="post" onsubmit="return validate();">
					
			<table>
				<tr><td><input type="text" name="name" id="name" class="contactbox" placeholder="FULLNAME" required="required"></td>
					<td><input type="number" class="contactbox" name="phno" id="phno" placeholder="MOBILE NO" required="required"></td>
				</tr>
				<tr><td><input type="email" class="contactbox" name="mail" id="mail" placeholder="EMAIL ID" required="required"></td>
					<td id="err"></td></tr>
				<tr><td><textarea  rows="4" cols="50" class="contactbox" name="sugg"></textarea></td></tr>
				<tr><td><input type="submit" value="SEND" class="btn btn-lg"></td></tr>
			</table>
			</form>
	</div>
</div>
</div>
</div>
<footer>
	COPYRIGHT ® This page was made by Manish singh no other authority can have the credits.
</footer>
</body>

</html>