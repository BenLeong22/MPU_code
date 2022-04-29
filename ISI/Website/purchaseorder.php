<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';




$order = getelement("order");
$name = getsession("name");
$u_id = getsession("u_id"); 
$sort = getelement("sort");
$brand = getelement("brand");
$category = getelement("category");
$searching  = getelement("searching"); 
    
if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  

if(isset($_GET['searching'])){
    $searching = $_GET["searching"];
}
else{
    $searching = "";
};

$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}

if(isset($_GET["cancel"])){
  $cancel =$_GET["cancel"];
  $checkstatus ='SELECT * FROM purchaseorder WHERE PNo='.$cancel;
  $checkstatus_resuilt = mysqli_query($conn,$checkstatus);
  $checkstatus_row =mysqli_fetch_array($checkstatus_resuilt);
  if($checkstatus_row[2] ==1 || $checkstatus_row[2] ==4 ){
    date_default_timezone_set("Asia/Hong_Kong");
    $date = date("Y-m-d H:i:s") . "<br>";
    mysqli_query($conn,'LOCK TABLES purchaseorder WRITE;');
    $can_sql ='UPDATE purchaseorder SET status =3, cancelDate = "'.$date.'", cal_User ="'.$_SESSION["name"].'" WHERE PNo ='.$cancel;
    mysqli_query($conn,$can_sql);
    mysqli_query($conn,'UNLOCK TABLES;');
    header("location: purchaseorder.php");
  }else{ header("Refresh:0; url=purchaseorder.php");}
}

$noti =0;
$item=0;
$o_item=0;
if($u_id !=""){
    $sql ="SELECT COUNT(u_id) FROM shoppingcart WHERE u_id =".$u_id;
    $result =mysqli_query($conn,$sql);
    $row =mysqli_fetch_array($result);
    $item =$row[0];
}

if($u_id !=""){
    $sql ='SELECT COUNT(uID) FROM purchaseorder WHERE uID ='.$u_id.' && status="1"';
    $result =mysqli_query($conn,$sql);
    $row =mysqli_fetch_array($result);
    $o_item =$row[0];
}
if($u_id !=""){
    $sql ='SELECT COUNT(u_id) FROM notification WHERE u_id ='.$u_id.' && isRead="0"';
    $result =mysqli_query($conn,$sql);
    $row =mysqli_fetch_array($result);
    $noti =$row[0];
}


?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Website title - bootstrap html template</title>

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">

<!-- jQuery -->
<script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="fonts/fontawesome/css/all.min.css" type="text/css" rel="stylesheet">

<!-- plugin: fancybox  -->
<script src="plugins/fancybox/fancybox.min.js" type="text/javascript"></script>
<link href="plugins/fancybox/fancybox.min.css" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="css/ui.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<!-- custom javascript -->
<script src="js/script.js" type="text/javascript"></script>

<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

}); 
// jquery end
</script>

</head>
<body>

<header class="section-header">
<section class="header-main border-bottom">
	<div class="container">
<div class="row align-items-center">
	<div class="col-lg-2 col-4">
		<a href="index.php" class="brand-wrap">
			<img class="logo" src="images/logo.png">
		</a> <!-- brand-wrap.// -->
	</div>
	<div class="col-lg-6 col-sm-12">
		
			<div class="input-group" style="width: 450px;">
                
			    <input type="text"  class="form-control" <?php if($searching==""){echo 'placeholder="Search"';} else{echo 'value="'.$searching.'"';}?>  id="myTextBox" name="searching" >
			    <div class="input-group-append">
			      <button class="btn btn-primary" onClick="search()">
			        <i class="fa fa-search"></i> Search
			      </button>
			    </div>
		    </div>
		
	</div> <!-- col.// -->
    <div class="col-lg-4 col-sm-4 col-15" style="width: 500px;">
     <div class="widgets-wrap float-md-right" style="width: 500px;">
         
 <?php 
        getheader($name,$item,$o_item,$noti);
                
?>               

				

			</div>

		</div> <!-- widgets-wrap.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->
	</div> <!-- container.// -->
</section> <!-- header-main .// -->
</header> <!-- section-header.// -->
    
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page">Processing Order</h2>
	<nav>
	<ol class="breadcrumb text-white">
<!--
	    <li class="breadcrumb-item"><a href="#">Home</a></li>
	    <li class="breadcrumb-item"><a href="#">Best category</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Great articles</li>
-->
	</ol>  
	</nav>
</div> <!-- container //  -->
</section>
<?php 
    
    
    ?>
    
<section class="section-content padding-y">
	<div class="container">
	
	<div class="row">
		<aside class="col-md-3">
			<nav class="list-group">
				<a class="list-group-item <?php if($order=="") {echo 'active';}?>" href="purchaseorder.php"> My All Order  </a>
				<a class="list-group-item <?php if($order==14) {echo 'active';}?>"  href="purchaseorder.php?order=14"> My Pending and Hold Order </a>
				<a class="list-group-item <?php if($order==23) {echo 'active';}?>" href="purchaseorder.php?order=23"> My Shipped and Cancelled  </a>

			</nav>
		</aside> <!-- col.// -->
        
        
       
        
		<main class="col-md-9">

<!--		<a href="#" class="btn btn-light mb-3"> <i class="fa fa-plus"></i> Add new address </a>-->

        <div class="row">
            
            <?php 
                    if($order==14){$o_sql ='AND  (status=1 OR status=4)';}
                    else if($order==23){$o_sql ='AND  (status=2 OR status=3)';}
                    else {$o_sql ='';}
                    $sql = 'SELECT * FROM purchaseorder WHERE uID ='.$u_id.' '.$o_sql. ' ORDER BY PNo DESC';
                    $result = $conn->query($sql);  
                    $iscancel =0;
                    if($result->num_rows >0){
                        while($row = $result->fetch_assoc()){
                        if($row["status"]==1){$status ="Pending";}
                        else if($row["status"]==2){$status ="Shipped";}
                         else if($row["status"]==3){$status ="Canceled"; $iscancel=1;} 
                           else if($row["status"]==4){$status ="Hold";}     
                        echo '    <div class="col-md-6">
                <article class="box mb-4">
                    <a href="purchaseddetailpage.php?PNo='.$row["PNo"].'"><h6>Purchaseorder Number: <span style="font-size: 20px;">'.$row["PNo"].'</span> </h6></a>
                    <p>Purchase Date and time: '.$row["purchasedDate"].' <br> Floor: 22, Aprt: 12  </p>';
                     if($status =="Pending"){echo '<a href="#" class="btn btn-primary disabled">Status: '.$status.'</a> ';}
                     if($status =="Shipped"){echo '<a href="#" class="btn btn-success disabled">Status: '.$status.'</a> ';}
                    if($status =="Canceled"){echo '<a href="#" class="btn btn-danger disabled">Status: '.$status.'</a> ';}
                    if($status =="Hold"){echo '<a href="#" class="btn btn-warning disabled">Status: '.$status.'</a> ';}
               if ($status =="Pending" ||$status =="Hold"){echo ' <a href="purchaseorder.php?cancel='.$row["PNo"].'" class="btn btn-light"> <i class="text-danger fa fa-trash"> Cancel</i>  </a>';}
                    echo '<var class="price" style="width:100px; margin-left:10px; font-size: 20px;">MOP '.$row["po_subtotal"].'</var> 
        
                </article>
            </div>  <!-- col.// -->';
            
            
    }
                    }
            
?>
         

            
            
            
            
        </div> <!-- row.// -->

	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>



</body>
</html>