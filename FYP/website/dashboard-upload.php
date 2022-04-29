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
$target_dir = "icon_image";
$uid = $_SESSION["u_id"];
$target_file = $target_dir . basename($_FILES["file123"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($_FILES["file123"]["size"]>0){
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

// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file123"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file123"]["name"])). " has been uploaded.";
  } else {

  }
}
    }

?>
  
 <?php
        $id =$_SESSION['u_id'];
        if(isset($_POST["submit"])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $describe = $_POST['describe'];
            
           if($_FILES["file123"]["size"]>0){
                            $sql = 'UPDATE `user` SET `U_name`="'.$name.'",`U_email`="'.$email.'",`U_phone`="'.$phone.'" ,`U_image`="'.$target_file.'",`U_describe`="'.$describe.'" WHERE U_id='.$id;


            }else{
                            $sql = 'UPDATE `user` SET `U_name`="'.$name.'",`U_email`="'.$email.'",`U_phone`="'.$phone.'",`U_describe`="'.$describe.'" WHERE U_id='.$id;

            }
            

            $result = mysqli_query($conn,$sql);
        }    
    
    
echo '<meta http-equiv=REFRESH CONTENT=1;url=dashboard-my-profile.php>';      

    ?>    
    
</body>
</html>