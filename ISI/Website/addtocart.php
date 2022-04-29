<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
    
<?php 
include 'functionset.php';
session_start();
    
$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}
    

 $searching  = getelement("searching");    
$p_id = getelement("p_id");  
$qty = getelement("qty");

 
 
if(isset($_GET['qty'])){
    if($_GET['qty'] !=""){
        
        if(isset($_SESSION['u_id'])){
            $u_id = $_SESSION['u_id'];
            date_default_timezone_set("Asia/Hong_Kong");
            $date = date("Y-m-d H:i:s") . "<br>";
            echo $date;
            $qty = $_GET['qty'];
            $check_sql = 'SELECT * from shoppingcart WHERE u_id ='.$u_id.'  && p_id ='.$p_id;
            echo $check_sql .'</br>';
            $check =mysqli_query($conn,$check_sql);
            
            if(mysqli_fetch_array($check) == false){
                $sql = "INSERT INTO `shoppingcart`(`u_id`, `p_id`, `quantity`, `addDate`) VALUES ('$u_id','$p_id','$qty','$date')";
            $result = mysqli_query($conn, $sql);
            header("Location: product.php?p_id=".$p_id."&msg=0");
            }
            else{
            header("Location: product.php?p_id=".$p_id."&msg=1");
            }
 
        }
        else{
            header("Location: product.php?p_id=".$p_id."&msg=2");
        };

    }
    
    
}
else{
    
};
    
    ?>
</body>
</html>