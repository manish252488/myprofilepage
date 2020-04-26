<?php
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
$t="images/";
if (!file_exists($t)) 
{
mkdir($t);
}
$uploadok=1;
$tg=$t.basename($_FILES["dpup"]["tmp_name"]);
//check 
if ($_FILES["dpup"]["size"]>5000000) //5mb
{
	$uploadok=0;
	echo "size error";
}
if ($uploadok==0) 
{
	echo "file not uploaded";
}
else
if (move_uploaded_file($_FILES["dpup"]["tmp_name"],$tg)) 
{
	correctImageOrientation($tg);
	rename($tg,$t."profile.jpg");
	echo "<script>window.location='index.php'</script>";
}
else
echo "<script>alert(unknown errror);window.location='index.php';</script>";
}
?>