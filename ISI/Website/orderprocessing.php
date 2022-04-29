<!DOCTYPE HTML>
<?php
include 'functionset.php'; 
session_start();
if(isset($_SESSION['name'])){
    if($_SESSION['name'] == 'admin'){
        header("location: vendor.php");
    }
}


$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}

$PNo = getelement("PNo");
$u_id = getsession("u_id");
$searching  = getelement("searching"); 


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

		<article class="card mb-4">
		<header class="card-header">
			<a href="#" class="float-right"> <i class="fa fa-print"></i> Print</a>
			<strong class="d-inline-block mr-3">Order ID: 6123456789</strong>
			<span>Order Date: 16 December 2018</span>
		</header>
		<div class="card-body">
			<div class="row"> 
				<div class="col-md-8">
					<h6 class="text-muted">Delivery to</h6>
					<p>Michael Jackson <br>  
					Phone +1234567890 Email: myname@gmail.com <br>
			    	Location: Home number, Building name, Street 123, <br> 
			    	P.O. Box: 100123
			 		</p>
				</div>
				<div class="col-md-4">
					<h6 class="text-muted">Payment</h6>
					<span class="text-success">
						<i class="fab fa-lg fa-cc-visa"></i>
					    Visa  **** 4216  
					</span>
					<p>Subtotal: $356 <br>
					 Shipping fee:  $56 <br> 
					 <span class="b">Total:  $456 </span>
					</p>
				</div>
			</div> <!-- row.// -->
		</div> <!-- card-body .// -->
		<div class="table-responsive">
		<table class="table table-hover">
			<tbody><tr>
				<td width="65">
					<img src="images/items/1.jpg" class="img-xs border">
				</td>
				<td> 
					<p class="title mb-0">Product name goes here </p>
					<var class="price text-muted">USD 145</var>
				</td>
				<td> Seller <br> Nike clothing </td>
				<td width="250"> <a href="#" class="btn btn-outline-primary">Track order</a> 
					<div class="dropdown d-inline-block">
						 <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-outline-secondary">More</a>
						 <div class="dropdown-menu dropdown-menu-right">
						 	<a href="#" class="dropdown-item">Return</a>
						 	<a href="#"  class="dropdown-item">Cancel order</a>
						 </div>
					</div> <!-- dropdown.// -->
				</td>
			</tr>
			<tr>
				<td>
					<img src="images/items/2.jpg" class="img-xs border">
				</td>
				<td> 
					<p class="title mb-0">Another name goes here </p>
					<var class="price text-muted">USD 15</var>
				</td>
				<td> Seller <br> ABC shop </td>
				<td> 
					<a href="#" class="btn btn-outline-primary">Track order</a>
					<div class="dropdown d-inline-block">
						 <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-outline-secondary">More</a>
						 <div class="dropdown-menu dropdown-menu-right">
						 	<a href="#" class="dropdown-item">Return</a>
						 	<a href="#"  class="dropdown-item">Cancel order</a>
						 </div>
					</div> <!-- dropdown.// -->
				</td>
			</tr>
			<tr>
				<td>
					<img src="images/items/3.jpg" class="img-xs border">
				</td>
				<td> 
					<p class="title mb-0">The name of the product  goes here </p>
					<var class="price text-muted">USD 145</var>
				</td>
				<td> Seller <br> Wallmart </td>
				<td> <a href="#" class="btn btn-outline-primary">Track order</a> 
					<div class="dropdown d-inline-block">
						 <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-outline-secondary">More</a>
						 <div class="dropdown-menu dropdown-menu-right">
						 	<a href="#" class="dropdown-item">Return</a>
						 	<a href="#"  class="dropdown-item">Cancel order</a>
						 </div>
					</div> <!-- dropdown.// -->
				</td>
			</tr>
		</tbody></table>
		</div> <!-- table-responsive .end// -->
		</article> <!-- card order-item .// -->

<?  
        
        ?>

		<article class="card order-item mb-4">
		<header class="card-header">
			<a href="#" class="float-right"> <i class="fa fa-print"></i> Print</a>
			<strong class="d-inline-block mr-3">Order ID: 6123456789</strong>
			<span>Order Date: 16 December 2018</span>
		</header>
		<div class="card-body">
			<div class="row"> 
				<div class="col-md-8">
					<h6 class="text-muted">Delivery to</h6>
					<p>Michael Jackson <br>  
					Phone +1234567890 Email: myname@pixsellz.com <br>
			    	Location: Home number, Building name, Street 123,  Tashkent, UZB <br> 
			    	P.O. Box: 100123
			 		</p>
				</div>
				<div class="col-md-4">
					<h6 class="text-muted">Payment</h6>
					<span class="text-success">
						<i class="fab fa-lg fa-cc-visa"></i>
					    Visa  **** 4216  
					</span>
					<p>Subtotal: $356 <br>
					 Shipping fee:  $56 <br> 
					 <span class="b">Total:  $456 </span>
					</p>
				</div>
			</div> <!-- row.// -->
		</div> <!-- card-body .// -->
		<div class="table-responsive">
		<table class="table table-hover">
			<tbody>
                
                <tr>
				<td width="65">
					<img src="images/items/1.jpg" class="img-xs border">
				</td>
				<td> 
					<p class="title mb-0">Product name goes here </p>
					<var class="price text-muted">USD 145</var>
				</td>
				<td> Seller <br> Nike clothing </td>
				<td width="250"> <a href="#" class="btn btn-outline-primary">Track order</a>  
					<div class="dropdown d-inline-block">
						 <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-outline-secondary">More</a>
						 <div class="dropdown-menu dropdown-menu-right">
						 	<a href="#" class="dropdown-item">Return</a>
						 	<a href="#"  class="dropdown-item">Cancel order</a>
						 </div>
					</div> <!-- dropdown.// -->
				</td>
			</tr>

                
		</tbody></table>
		</div> <!-- table-responsive .end// -->
		</article> <!-- card order-item .// -->


	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
    

</body>
</html>