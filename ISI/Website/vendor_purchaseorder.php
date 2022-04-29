<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';




$order = getelement("order");
$name = getsession("name");
$u_id = getsession("u_id");
$sort = getelement("sort");
$brand = getelement("brand");
$page = getelement("page");
$searching  = getelement("searching"); 


$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}
date_default_timezone_set("Asia/Hong_Kong");
$date = date("Y-m-d H:i:s");
if(isset($_GET["cancel"])){
    $cancel =$_GET["cancel"];
  $checkstatus ='SELECT * FROM purchaseorder WHERE PNo='.$cancel;
  $checkstatus_resuilt = mysqli_query($conn,$checkstatus);
  $checkstatus_row =mysqli_fetch_array($checkstatus_resuilt);
  if($checkstatus_row[2] ==1 ||$checkstatus_row[2] ==4){
    mysqli_query($conn,'LOCK TABLES purchaseorder WRITE;');
    $can_sql ='UPDATE purchaseorder SET status =3, cancelDate = "'.$date.'", cal_User ="'.$_SESSION["name"].'" WHERE PNo ='.$cancel;
    $nofi_sql ='INSERT INTO `notification`(`u_id`, `PNo`, `status`, `time`, `isRead`) VALUES ('.$_GET["u_id"].','.$cancel.',3,"'.$date.'",0)';
    mysqli_query($conn,$can_sql);
    mysqli_query($conn,'UNLOCK TABLES;');
    mysqli_query($conn,$nofi_sql);
    $sql ='SELECT * FROM user WHERE u_id='.$_GET["u_id"];
    $result =mysqli_query($conn,$sql);
    $row =mysqli_fetch_assoc($result);
    sendmail('Cancel Notice','Dear '.$row["name"]."\n\n Your order(No:$cancel) has been cancelled.",'22kingleong22@gmail.com');

}else{ header("Refresh:0; url=vendor_purchaseorder.php");}
}

if(isset($_GET["hold"])){
    $hold =$_GET["hold"];
    
      $checkstatus ='SELECT * FROM purchaseorder WHERE PNo='.$hold;
  $checkstatus_resuilt = mysqli_query($conn,$checkstatus);
  $checkstatus_row =mysqli_fetch_array($checkstatus_resuilt);
  if($checkstatus_row[2] ==1){
    mysqli_query($conn,'LOCK TABLES purchaseorder WRITE;');
    $hold_sql ='UPDATE `purchaseorder` SET `status`=4 WHERE PNo='.$hold;
    mysqli_query($conn,$hold_sql);
    mysqli_query($conn,'UNLOCK TABLES;');
    $nofi_sql ='INSERT INTO `notification`(`u_id`, `PNo`, `status`, `time`, `isRead`) VALUES ('.$_GET["u_id"].','.$hold.',4,"'.$date.'",0)';

    mysqli_query($conn,$nofi_sql);
    $sql ='SELECT * FROM user WHERE u_id='.$_GET["u_id"];
    $result =mysqli_query($conn,$sql);
    $row =mysqli_fetch_assoc($result);
 //   sendmail('Hold Notice','Dear '.$row["name"]."\n\n We have received your order(No:$hold) and are preparing the shipment for you.",'');

}else{ header("Refresh:0; url=vendor_purchaseorder.php");}
}

if(isset($_GET["shipped"])){
    date_default_timezone_set("Asia/Hong_Kong");
    $date = date("Y-m-d H:i:s") . "<br>";
    $shipped =$_GET["shipped"];
    
          $checkstatus ='SELECT * FROM purchaseorder WHERE PNo='.$shipped;
  $checkstatus_resuilt = mysqli_query($conn,$checkstatus);
  $checkstatus_row =mysqli_fetch_array($checkstatus_resuilt);
  if($checkstatus_row[2] ==1 || $checkstatus_row[2] ==4){
    mysqli_query($conn,'LOCK TABLES purchaseorder WRITE;');
    $shipped_sql ='UPDATE `purchaseorder` SET `status`=2 , `develiveryDate`="'.$date.'" WHERE PNo='.$shipped;
    mysqli_query($conn,$shipped_sql);
    mysqli_query($conn,'UNLOCK TABLES;');
    $nofi_sql ='INSERT INTO `notification`(`u_id`, `PNo`, `status`, `time`, `isRead`) VALUES ('.$_GET["u_id"].','.$shipped.',2,"'.$date.'",0)';

    mysqli_query($conn,$nofi_sql);
    $sql ='SELECT * FROM user WHERE u_id='.$_GET["u_id"];
    $result =mysqli_query($conn,$sql);
    $row =mysqli_fetch_assoc($result);
    sendmail('Shopped Notice','Dear '.$row["name"]."\n\n Your order(No:$shipped) has been delivered.",'22kingleong22@gmail.com');

}else{ header("Refresh:0; url=vendor_purchaseorder.php");}
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


$outofstock =0;
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
    
            function searchbyno() {
                    var searchby = document.getElementById("searchby");
                    var value = searchby.value;
                    var url = new URL(window.location.href);
                    var search_params = url.searchParams;
                    search_params.delete('searching');
                    search_params.delete('page');
                    search_params.set('PNo',value)
                    url.search = search_params.toString();
                    var new_url = url.toString();
 
                    window.location.href = new_url;   
                
                
            }
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
	<h2 class="title-page">Category products</h2>
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
                 <form class="pb-3" action="vendor_purchaseorder.php" method="get">
				<div class="input-group">
				  <input type="text" class="form-control" id="searchby" placeholder="Search Purchaseorder Number">
				  <div class="input-group-append">
				    <button class="btn btn-light" type="button" onClick="searchbyno()"><i class="fa fa-search"></i></button>
				  </div>
				</div>
				</form>
			<nav class="list-group">
				<a class="list-group-item <?php if($order=="") {echo 'active';}?>" href="vendor_purchaseorder.php">All Order  </a>
				<a class="list-group-item <?php if($order==1) {echo 'active';}?>"  href="vendor_purchaseorder.php?order=1">Pending Order </a>
                <a class="list-group-item <?php if($order==4) {echo 'active';}?>" href="vendor_purchaseorder.php?order=4">Hold Order  </a>
				<a class="list-group-item <?php if($order==23) {echo 'active';}?>" href="vendor_purchaseorder.php?order=23">Shipped and Cancelled  </a>

			</nav>
		</aside> <!-- col.// -->
        
        
       
        
		<main class="col-md-9">

<!--		<a href="#" class="btn btn-light mb-3"> <i class="fa fa-plus"></i> Add new address </a>-->

        <div class="row">
            
            <?php 
                    if($order==1){$o_sql ='status=1 ';}
                    else if($order==4){$o_sql ='status=4 ';}
                    else if($order==23){$o_sql ='status=2 OR status=3';}
                    else {$o_sql ='PNo >0';}
                    $sql = 'SELECT * FROM purchaseorder WHERE '.$o_sql.' ORDER BY PNo DESC';
                    if(isset($_GET["PNo"])){$sql = 'SELECT * FROM purchaseorder WHERE PNo='.$_GET["PNo"];}
                    $result = $conn->query($sql);  
                    $iscancel =0;
                    if($result->num_rows >0){
                        while($row = $result->fetch_assoc()){
                        $outofstock = 0;    
                        $po_sql ='SELECT * FROM purchaseproducts WHERE PNo='.$row["PNo"];
                        $po_result =$conn->query($po_sql);
                        if($po_result->num_rows >0){
                            while($po_row =$po_result->fetch_assoc()){
                                $p_sql ='SELECT * FROM product WHERE p_id='.$po_row["p_id"];
                                $p_result =$conn->query($p_sql);
                                $u_sql ='SELECT * FROM user WHERE u_id='.$row["uID"];
                                $u_result =mysqli_query($conn,$u_sql);
                                $u_row =mysqli_fetch_assoc($u_result);
                                if($p_result->num_rows >0){
                                    while($p_row =$p_result->fetch_assoc()){
                                        if($p_row["inventory"] <=0){
                                            $outofstock = 1;
                                        }
                                    }
                                }
                                
                            }
                        }
                            
                        if($row["status"]==1){$status ="Pending";}
                        else if($row["status"]==2){$status ="Shipped";}
                         else if($row["status"]==3){$status ="Canceled"; $iscancel=1;} 
                           else if($row["status"]==4){$status ="Hold";}     
                        echo '    <div class="col-md-6">
                <article class="box mb-4">
                    <a href="vendor_purchaseddetailpage.php?PNo='.$row["PNo"].'"><h6>Purchaseorder Number: <span style="font-size: 20px;">'.$row["PNo"].'</span> </h6></a>
                    <p>Purchase Date and time: '.$row["purchasedDate"].' <br>  </p>
                    <p>Customer name: '.$u_row["name"].' <br>  </p>';
                    
                     if($status =="Pending"){echo '<a href="#" class="btn btn-primary disabled">Status: '.$status.'</a> ';}
                     if($status =="Shipped"){echo '<a href="#" class="btn btn-success disabled">Status: '.$status.'</a> ';}
                    if($status =="Canceled"){echo '<a href="#" class="btn btn-danger disabled">Status: '.$status.'</a> ';}
                    if($status =="Hold"){echo '<a href="#" class="btn btn-warning disabled">Status: '.$status.'</a>';}
                     
                     
                     if ($status =="Pending"){
                         
                         if($outofstock ==0){echo ' <a href="vendor_purchaseorder.php?shipped='.$row["PNo"].'&order='.$order.' &u_id='.$row["uID"].'" class="btn btn-light"> <i class="text-success fa fa-truck"></i>  </a>';}
                         else {echo '<a href="vendor_purchaseorder.php?shipped='.$row["PNo"].'&order='.$order.' &u_id='.$row["uID"].'" class="btn btn-light disabled" > <i class="text-success fa fa-truck"></i> </a>';
                         }
                         
                         echo ' <a href="vendor_purchaseorder.php?hold='.$row["PNo"].'&order='.$order.' &u_id='.$row["uID"].'" class="btn btn-warning"> Hold  </a>';

                         echo ' <a href="vendor_purchaseorder.php?cancel='.$row["PNo"].'&order='.$order.' &u_id='.$row["uID"].'" class="btn btn-light"> <i class="text-danger fa fa-trash"></i>  </a>';
                         
                         
                    }
                            
                    if ($status =="Hold"){
                         if($outofstock ==0){echo ' <a href="vendor_purchaseorder.php?shipped='.$row["PNo"].'&order='.$order.' &u_id='.$row["uID"].'" class="btn btn-light"> <i class="text-success fa fa-truck"></i>  </a>';}
                         else {echo '<a href="vendor_purchaseorder.php?shipped='.$row["PNo"].'&order='.$order.' &u_id='.$row["uID"].'" class="btn btn-light disabled" > <i class="text-success fa fa-truck"></i> </a>';
                         }
						echo ' <a href="vendor_purchaseorder.php?cancel='.$row["PNo"].'&order='.$order.' &u_id='.$row["uID"].'" class="btn btn-light "> <i class="text-danger fa fa-trash"></i> Cancel</a>'; 
                
                    }
                            
                    echo '<var class="price" style="width:100px; margin-left:10px; font-size: 20px;">MOP '.$row["po_subtotal"].'</var> 
                    <br>';
                    if($outofstock ==0){echo '<p>&emsp;</p>';}
                    else if($status == "Hold" ||$status == "Pending" ){echo '<p style="color:red;">**This order is out of stock</p>';}
                    else {echo '<p>&emsp;</p>';}
                    
                echo '</article>
            </div>  <!-- col.// -->';
            
            
    }
                    }
            else{echo "no result";}
            
?>
         

            
            
            
        </div> <!-- row.// -->

	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>



</body>
</html>