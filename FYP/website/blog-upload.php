<!doctype html>
<html>
<?php
include 'functionset.php';
    
$conn =connection();                       
?>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$target_dir = "blogimage/";
$uid = $_SESSION["u_id"];
$target_file = $target_dir . basename($_FILES["file123"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file123"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["file123"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file123"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file123"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>
 
<?php   
$tittle =$_POST["tittle"];
$content =$_POST["content"];
$sql = 'INSERT INTO `blog`(`B_tittle`, `B_content`, `B_author`, `B_image`, `B_date`) VALUES ("'.$tittle.'","'.$content.'","'.$uid.'","'.$target_file.'",NOW()'.')';
$result = mysqli_query($conn, $sql);

$sql = 'SELECT * FROM blog ORDER BY B_id DESC LIMIT 1';
echo $sql;
$result = mysqli_query($conn, $sql);

$row =mysqli_fetch_array($result);
$B_id =$row["B_id"];

echo '<meta http-equiv=REFRESH CONTENT=1;url=blog-single.php?B_id='.$B_id.'>';   
    ?>    

</body>
</html>