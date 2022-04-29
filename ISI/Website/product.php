<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';

$name = getsession("name");
$u_id = getsession("u_id");
$searching  = getelement("searching"); 
$compare  = getelement("addcompare");



if($compare !="") {
    if(isset($_SESSION["compare1"]))
       {$_SESSION["compare2"] = $compare;}
    else {$_SESSION["compare1"] = $compare;}
}


$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}
$p_id = getelement("p_id");

if($u_id !=""){
    $sql ="SELECT COUNT(u_id) FROM shoppingcart WHERE u_id =".$u_id;
    $result =mysqli_query($conn,$sql);
    $row =mysqli_fetch_array($result);
    $item =$row[0];
}

$sql = "SELECT * FROM product where p_id = '$p_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);    

$pname =$row["pname"];
$description =$row["description"];
$price =$row["price"];
$oldprice =$row["oldprice"];
$inventory =$row["inventory"];
$monSize =$row["monSize"];
$OS =$row["OS"];
$memory =$row["memory"];
$f_cam =$row["f_cam"];
$b_cam =$row["b_cam"];
$RAM =$row["RAM"];
$brand =$row["b_id"];

$sql ="SELECT * FROM brand WHERE b_id=".$brand;
$result =mysqli_query($conn,$sql);
$row =mysqli_fetch_assoc($result);
$brand =$row["b_type"];

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

<title>Product</title>

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
function clickimg(location) {
    console.log(location);
    document.getElementById("bigimg").src = "img/"+location;
}
    
function minus(){
    var qty =parseInt(document.getElementById("qty").value);
    if(qty ==1){document.getElementById("qty").value =1;}
    else{
        document.getElementById("qty").value =qty-1;
    }      
}
    
function plus(){
    var qty =parseInt(document.getElementById("qty").value);
   document.getElementById("qty").value =qty+1;     
}

function addcompare(){
            var seach = document.getElementById("addcompare").value; 
            console.log(seach);
            var url = new URL(window.location.href);
            var search_params = url.searchParams;
            console.log(search_params);
            search_params.delete('addcompare');
            search_params.set('addcompare',seach)
            url.search = search_params.toString();
            var new_url = url.toString();
 
            window.location.href = new_url;
            } 
    
function addtocart() {
                    var qty =parseInt(document.getElementById("qty").value);
                    var url = new URL(window.location.href);
                    var search_params = url.searchParams;
                    var p_id =search_params.get("p_id");
                    console.log(qty);

                    window.location.href = "addtocart.php?qty="+qty+"&p_id="+p_id;   
}

var msg_url = new URL(window.location.href);
var msg_search_params = msg_url.searchParams;
var msg =msg_search_params.get("msg");
const p_id =msg_search_params.get("p_id");

if(msg ==0){alert("Add to the cart successful");}
if(msg ==1){alert("This product already exit in shopping cart");}
if(msg ==2){alert("Please Login first");
           window.location.href = "login.php?p_id="+p_id; 
           }
    

var add =msg_search_params.get("addcompare");
if(add !=null){alert("Add to compare successful");}

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

<section class="section-content bg-white padding-y">
<div class="container">

<!-- ============================ ITEM DETAIL ======================== -->
	<div class="row">
		<aside class="col-md-6">
<?php  
    $sql ='SELECT * FROM picture WHERE p_id='.$p_id;
    $result =$conn->query($sql);
    $img = array();
    if($result->num_rows >0){
        $i =0;
        while($row = $result->fetch_assoc()){
            $img[$i] =$row["location"];
            $i++;
        }
    }
            
            ?>
<div class="card">
<article class="gallery-wrap"> 
	<div class="img-big-wrap">
	  <div> <a href="#"><img src="img/<?php echo $img[0] ?>" id="bigimg"></a></div>
	</div> <!-- slider-product.// -->
	<div class="thumbs-wrap">
    
    <?php 
    for($a=0;$a<count($img);$a++){
    $n_img = "'".$img[$a]."'";
    echo '<a class="item-thumb"> <img src="img/'.$img[$a].'" onclick="clickimg('.$n_img.')" ></a>';
        }
    ?>

	</div> 
</article> 
</div> <!-- card.// -->
		</aside>
		<main class="col-md-6">
<article class="product-info-aside">
<?php 
    $sql ='SELECT * FROM purchaseproducts WHERE p_id='.$p_id;
    $result =$conn->query($sql);    
    ?>
<h2 class="title mt-3"><?php echo $pname?></h2>
    <div style="float: right">
    <h1><?php 
    $rate ='SELECT AVG(rate) FROM purchaseproducts WHERE p_id='.$p_id;
    $rate_result =mysqli_query($conn,$rate);
    $rate_row =mysqli_fetch_array($rate_result);
    echo round($rate_row[0], 2);
        ?><span style="font-size: 20px;">/5<span></h1>
    <small>*Average Rate</small>
</div>

<div class="rating-wrap my-3">
	<ul class="rating-stars">

	</ul>
	<small class="label-rating text-muted">132 reviews</small>
	<small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders </small>
</div> <!-- rating-wrap.// -->


<div class="mb-3"> 
	<var class="price h4"><?php echo 'MOP '.$price.'  '?></var> 
	<span class="text-muted"><?php echo 'MOP '.$oldprice?></span> 
</div> <!-- price-detail-wrap .// -->

<p><?php echo $description?></p>


<dl class="row">
    <dt class="col-lg-6">Brand</dt>
  <dd class="col-sm-5"><?php echo $brand.""?></dd>
    
  <dt class="col-lg-6">Screen Size</dt>
  <dd class="col-sm-5"><?php echo $monSize." inch"?></dd>

  <dt class="col-lg-6">Mobile operating system</dt>
  <dd class="col-sm-5"><?php echo $OS?></dd>

  <dt class="col-lg-6">Internal Memory</dt>
  <dd class="col-sm-5"><?php echo $memory." GB"?></dd>

  <dt class="col-lg-6">Front-facing camera</dt>
  <dd class="col-sm-5"><?php echo $f_cam." Million pixels"?></dd>
    
  <dt class="col-lg-6">Back-facing camera</dt>
  <dd class="col-sm-5"><?php echo $b_cam." Million pixels"?></dd>

  <dt class="col-lg-6">Random-access memory</dt>
  <dd class="col-sm-5"><?php echo $RAM." GB"?></dd>
  
</dl>

	<div class="form-row  mt-5">
		<div class="form-group col-lg flex-grow-0">
			<div class="input-group lg-9 input-spinner">
			  <div class="input-group-prepend">
                  <form action="product.php" method="get">
			    <button class="btn btn-light" type="button" id="button-minus" onClick="minus()"> - </button>
			  </div>
			  <input type="text" class="form-control" style="width: 70px; padding: 2px;" value="1" id="qty" onChange="">
			  <div class="input-group-append">
			    <button class="btn btn-light" type="button" id="button-plus" onClick="plus()"> + </button>
			  </div>
			</div>
		</div> <!-- col.// -->
		<div class="form-group col-md">
			<a href="#"  class="btn  btn-primary" onClick="addtocart()" style="margin-left:25px"> 
				<i class="fas fa-shopping-cart"></i> <span class="text">Add to cart</span> 
			</a>
			<a href="#" class="btn btn-light">
       <span class="text"  onClick="addcompare()">Add to compare</span>
                <input type="text" id="addcompare" value=<?php echo $p_id; ?> hidden=""></input>
			</a>
		</div> <!-- col.// -->
	</div> <!-- row.// -->

</article> <!-- product-info-aside .// -->
		</main> <!-- col.// -->
	</div> <!-- row.// -->

<!-- ================ ITEM DETAIL END .// ================= -->


</div> <!-- container .//  -->
</section>
	<main class="col-md-9" style="  margin: auto;
  width: 55%;
  padding: 10px;">

<header class="border-bottom mb-4 pb-3">

</header><!-- sect-heading -->
<?php

    
    if($result->num_rows >0){
        while($row =$result->fetch_assoc()){
            echo '<article class="card card-product-list">
	<div class="row no-gutters">

		<div class="col-md-6">
			<div class="info-main">
				<p class="h5 title">Comment time: '.$row["com_date"].'</p>
				<div class="rating-wrap mb-3">
					<ul class="rating-stars">
						<li  class="stars-active"> ';
							 
                    for($i=1;$i<=$row["rate"];$i++){
                        echo '<i class="fa fa-star">  </i>';
                    }

                    echo '</li>
						<li>
							<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
							<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
							<i class="fa fa-star"></i> 
						</li>
					</ul>
					<div class="label-rating">'.$row["rate"].'/5</div>
				</div> <!-- rating-wrap.// -->
				
				<p><strong>Comment:</strong> '.$row["comment"].'</p>
			</div> <!-- info-main.// -->
		</div> <!-- col.// -->

	</div> <!-- row.// -->
</article> <!-- card-product .// -->';
            
        }
    }
?>









<nav aria-label="Page navigation sample">
  <ul class="pagination">
    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>

	</main> <!-- col.// -->

</body>
</html>