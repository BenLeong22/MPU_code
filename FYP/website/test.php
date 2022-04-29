<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
</head>

<body>
<?php
include 'functionset.php';    
$conn =connection();
$u_id =getsession("u_id");

$actual_link = "$_SERVER[QUERY_STRING]";
$json = file_get_contents('http://172.28.18.182:8080/query?'.$actual_link);

$json = str_replace("'", "", $json);

$sql = "INSERT INTO `records`( `r_data`, `r_user_id`) VALUES ('$json','$u_id')";

    
if (mysqli_query($conn, $sql)) {
    echo "新记录插入成功";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<br>";
} 

    
    
$sql ="SELECT * FROM records ORDER BY r_id DESC LIMIT 1";
$result = mysqli_query($conn,$sql);

echo 'SQL';
echo '<br>';
echo $sql;
echo '<br>';  
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $id= $row["r_id"];
  }
} else {
  echo "0 results";
}

header('Location: destination-list.php?id='.$id);
    ?>
</body>
</html>