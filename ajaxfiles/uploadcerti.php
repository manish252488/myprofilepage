<?php
$servername="localhost";
$username="manish25";
$password="1997";
$db="profile";
try
{
$conn=mysqli_connect($servername,$username,$password,$db);
$sql="CREATE TABLE certificate(slno int NOT NULL AUTO_INCREMENT,image LONGBLOB,imtext varchar(200),uploadtime TIMESTAMP,primary key(slno))";
mysqli_query($conn,$sql);
}
catch(exception $e)
{
	echo "error:".$e;
}
function correctImageOrientation($filename) {
  if (function_exists('exif_read_data')) {
    $exif = exif_read_data($filename);
    if($exif && isset($exif['Orientation'])) {
      $orientation = $exif['Orientation'];
      if($orientation != 1){
        $img = imagecreatefromjpeg($filename);
        $deg = 0;
        switch ($orientation) {
          case 3:
            $deg = 180;
            break;
          case 6:
            $deg = 270;
            break;
          case 8:
            $deg = 90;
            break;
        }
        if ($deg) {
          $img = imagerotate($img, $deg, 0);        
        }
        // then rewrite the rotated image back to the disk as $filename 
        imagejpeg($img, $filename, 95);
      } // if there is some rotation necessary
    } // if have the exif orientation info
  } // if function exists      
}
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$text=$_POST["img_det"];
	$t="certificates/";
	$tg=$t.basename($_FILES["certificate"]["tmp_name"]);
	if (!file_exists($t)) 
	{
		mkdir($t);
	}
	else {
		$uploadok=1;
if ($_FILES["certificate"]["size"]>5000000) //5mb
{
	$uploadok=0;
	echo "<script>alert('FILE SIZE TOO BIG');window.location='../index.php';</script>";
}
if ($uploadok==0) 
{
	echo "file not uploaded";
}
else
if (move_uploaded_file($_FILES["certificate"]["tmp_name"],$tg)) 
{
correctImageOrientation($tg);
	$k=random_int(10000, 1000000);
	while (file_exists($t.$k.".jpg")) {
	$k=random_int(10000, 1000000);
	}
	rename($tg,$t.$k.".jpg");
	$newname=$t.$k.".jpg";
	mysqli_real_escape_string($conn,$newname);
	mysqli_real_escape_string($conn,$text);
	$sql="INSERT INTO certificate(image,imtext) VALUES('$newname','$text')";
	mysqli_query($conn,$sql);
	echo "<script>alert('UPLOADED!')</script>";
	echo "<script>window.location='../index.php'</script>";
}
else
echo "<script>alert('unknown errror');window.location='../index.php';</script>";
}
}

?>