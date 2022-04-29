<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';

$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}

$PNo = getelement("PNo");

$u_id = getsession("u_id");
$searching  = getelement("searching"); 
$name = getsession("name");


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

    <!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<aside class="col-md-3">
		<nav class="list-group">
			<a class="list-group-item" href="page-profile-main.html"> Account overview  </a>
			<a class="list-group-item" href="page-profile-address.html"> My Address </a>
			<a class="list-group-item active" href="page-profile-orders.html"> My Orders </a>
			<a class="list-group-item" href="page-profile-wishlist.html"> My wishlist </a>
			<a class="list-group-item" href="page-profile-seller.html"> My Selling Items </a>
			<a class="list-group-item" href="page-profile-setting.html"> Settings </a>
			<a class="list-group-item" href="page-index-1.html"> Log out </a>
		</nav>
	</aside> <!-- col.// -->
	<main class="col-md-9">

<?php   
$sql = "SELECT * FROM purchaseorder WHERE PNo = ".$PNo;
$result =mysqli_query($conn,$sql);
$row =mysqli_fetch_assoc($result);

$u_sql ="SELECT * FROM user WHERE u_id = ".$row["uID"];
$u_result = mysqli_query($conn,$u_sql);
$u_row =mysqli_fetch_assoc($u_result);
        
        ?>

		<article class="card order-item mb-4">
		<header class="card-header">
<!--			<a href="#" class="float-right"> <i class="fa fa-print"></i> Print</a>-->
			<strong class="d-inline-block mr-3">Order ID: <?php echo $row["PNo"]?></strong>
			<span>Order Date: <?php echo $row["purchasedDate"]?></span>
		</header>
		<div class="card-body">
			<div class="row"> 
				<div class="col-md-8">
					<h6 class="text-muted">Delivery to</h6>
					<p>Name: <?php echo $u_row["name"]?> <br>  
					Email: <?php echo $u_row["email"]?> <br>
			    	Address: <?php echo $u_row["address"]?><br> 
                    Status:     <?php     if($row["status"] ==1){
                                    echo '<td>Pending</td>';
                                }
                                else if($row["status"] ==2){
                                    echo '<td>Shipped</td><br>';
                                    echo '<td>Delivery Date: '.$row["develiveryDate"].'</td><br>';
                                }
                                else if($row["status"] ==3){
                                    echo '<td>Canceled</td> <br>';
                                    echo '<td>Canceled by: '.$row["cal_User"].'</td><br>';
                                    echo '<td>Canceled Date: '.$row["cancelDate"].'</td>';
                                }
                                else if($row["status"] ==4){
                                    echo '<td>Hold</td>';
                                    
                                }   

                                 ?>
			 		</p>
				</div>
				<div class="col-md-4">
<!--
					<h6 class="text-muted">Payment</h6>
					<span class="text-success">
						<i class="fab fa-lg fa-cc-visa"></i>
					    Visa  **** 4216  
					</span>
					<p>Subtotal: $356 <br>
					 Shipping fee:  $56 <br> 
-->
					 <span class="b"><h1>Total: <?php echo $row["po_subtotal"]?> </h1></span>
					</p>
				</div>
			</div> <!-- row.// -->
		</div> <!-- card-body .// -->
 <?php
$sql = "SELECT * FROM purchaseproducts WHERE PNo = ".$PNo;
$result =$conn->query($sql);
               
                         
    if($result->num_rows >0){
    $total =0;
    while($row = $result->fetch_assoc()){
       $p_sql = 'SELECT * FROM product WHERE p_id ='.$row["p_id"];
       $p_result =mysqli_query($conn,$p_sql);
       $p_row =mysqli_fetch_assoc($p_result); 
        
        $pp_sql = 'SELECT * FROM picture WHERE p_id ='.$row["p_id"];
       $pp_result =mysqli_query($conn,$pp_sql);
       $pp_row =mysqli_fetch_assoc($pp_result);  
        
        echo '		<div class="table-responsive">  
		<table class="table table-hover">
			<tbody>
                <tr>
				<td width="65">

					<img src="img/'.$pp_row["location"].'" class="img-xs border">
				</td>
				<td> 
					<a href="product.php?p_id='.$row["p_id"].'"> <p class="title mb-0">'.$p_row["pname"].'</p></a>
					<var class="price text-muted">MOP '.$row["price"].'</var>
				</td>
				<td style="float:left; "> Quantity <br> '.$row["quantity"].' </td>
				<td width="250"> <a href="product.php?p_id='.$row["p_id"].'" class="btn btn-outline-primary">Subtotal: MOP:'.$row["pp_subtotal"].'</a>  
					<div class="dropdown d-inline-block">
						 <div class="dropdown-menu dropdown-menu-right">
						 	<a href="#" class="dropdown-item">Return</a>
						 	<a href="#"  class="dropdown-item">Cancel order</a>
						 </div>
					</div> <!-- dropdown.// -->
				</td>
			</tr>

                
		</tbody></table>
		</div> <!-- table-responsive .end// -->';
    
    
    
    }
                    
}  
                         
?>
        

		</article> <!-- card order-item .// -->


	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
    

</body>
</html>