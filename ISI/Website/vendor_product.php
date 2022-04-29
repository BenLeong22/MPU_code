<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';

$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}

$p_id = getelement("p_id");
$pname = getelement("pname");
$description = getelement("description");
$price = getelement("price");
$oldprice = getelement("oldprice");
$inventory = getelement("inventory");
$monSize = getelement("monSize");
$OS = getelement("OS");
$memory = getelement("memory");
$f_cam = getelement("f_cam");
$b_cam = getelement("b_cam");
$RAM = getelement("RAM");
$searching  = getelement("searching"); 
 
    
if(isset($_GET["button"])){

$sql ='UPDATE product SET  p_id ='.$p_id.', pname ="'.$pname.'", description ="'.$description.'", price ='.$price.', oldprice ='.$oldprice.', monSize ='.$monSize.', OS ="'.$OS.'", memory ='.$memory.', f_cam ='.$f_cam.', b_cam ='.$b_cam.', RAM ='.$RAM.' ,inventory = '.$inventory.' WHERE p_id ='.$p_id;
mysqli_query($conn,$sql);
}    


$sql = "SELECT * FROM product where p_id = '$p_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$name = getsession("name");
$u_id = getsession("u_id");



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
$brand =$row["b_type"]

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
<?php  $sql ='SELECT * FROM picture WHERE p_id='.$p_id;
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
        <?php
        if(isset($img[0])){ echo '<div> <a href="#"><img src="img/'.$img[0].'" id="bigimg"></a></div>';}
        else {echo '<div> <a href="#"><img src="img/-2.png" id="bigimg"></a></div>';}
    ?>
	</div> <!-- slider-product.// -->
	<div class="thumbs-wrap">
    
    <?php 
    for($a=0;$a<count($img);$a++){
    $n_img = "'".$img[$a]."'";
    echo '<a class="item-thumb"> <img src="img/'.$img[$a].'" onclick="clickimg('.$n_img.')" ></a>';
        }
    ?></br>
    
    <button class="btn   btn-primary item-thumb"  href="photos_management.php?p_id='<?php echo $p_id;?>'&Edit=" style="width: 300px;"  name="button"><a href="photos_management.php?p_id=<?php echo $p_id;?>" style="color: aliceblue;">Photos Management</a><span class="text"></span> </button>

    </br>
	</div> 
</article> 
</div> <!-- card.// -->
		</aside>
		<main class="col-md-6">
<article class="product-info-aside">
<form action="vendor_product.php" method="GET">
<h2 class="title mt-3">Product Name:<input class="col-lg-7" name="pname" type="text" value="<?php echo $pname?>"></h2>

<div class="rating-wrap my-3">
	<ul class="rating-stars">
		<li style="width:80%" class="stars-active"> 
			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
			<i class="fa fa-star"></i> 
		</li>
		<li>
			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
			<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
			<i class="fa fa-star"></i> 
		</li>
	</ul>
	<small class="label-rating text-muted">132 reviews</small>
	<small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders </small>
</div> <!-- rating-wrap.// -->

<div class="mb-3"> 
	<var class="price h4">MOP:<input type="text" style="width: 150px" name="price" value="<?php echo $price.'  '?>"></var> 
	<span class="text-muted">MOP:<input type="text" class="col-lg-2" name="oldprice"  value="<?php echo $oldprice?>"></span> 
</div> <!-- price-detail-wrap .// -->
<dt class="col-lg-6">Description</dt>
<textarea type="text" class="col-sm-12" rows="5" name="description"><?php echo $description?></textarea>


<dl class="row">
    <dt class="col-lg-6" style="text-align: right">Brand</dt>
  <input class="col-sm-3" value="<?php echo $brand?>" name="brand" disabled></input>
    
  <dt class="col-lg-6" style="text-align: right">Screen Size</dt>
  <input class="col-sm-3" value="<?php echo $monSize?>" name="monSize">　inch</input>

  <dt class="col-lg-6" style="text-align: right">Mobile operating system</dt>
  <input class="col-sm-3" value="<?php echo $OS?>" name="OS"></input>

  <dt class="col-lg-6" style="text-align: right">Internal Memory</dt>
  <input class="col-sm-3" value="<?php echo $memory?>" name="memory">　GB</input>

  <dt class="col-lg-6" style="text-align: right">Front-facing camera</dt>
  <input class="col-sm-3" value="<?php echo $f_cam?>" name="f_cam">　Million pixels</input>
    
  <dt class="col-lg-6" style="text-align: right">Back-facing camera</dt>
  <input class="col-sm-3" value="<?php echo $b_cam?>" name="b_cam">　Million pixels</input>

  <dt class="col-lg-6" style="text-align: right">Random-access memory</dt>
  <input class="col-sm-3" value="<?php echo $RAM?>" name="RAM">　GB</input>
  <dt class="col-lg-6" style="text-align: right">Inventory</dt>
  <input class="col-sm-3" value="<?php echo $inventory?>" name="inventory"></input>
  <input type="hidden" value="<?php echo $p_id?>" name="p_id"></input>

  
</dl>

	<div class="form-row  mt-5">
		<div class="form-group col-lg flex-grow-0">

		</div> <!-- col.// -->
		<div class="form-group col-md">
            

                <button class="btn  btn-primary" type="submit" name="button">
				<i class="fas fa-shopping-cart"></i> <span class="text">Edit</span> 
                </button>
			<a href="#" class="btn btn-light-dangers">
        <i class="fas fa-envelope"></i> <span class="text">Reset</span> 
			</a>
		</div> <!-- col.// -->
	</div> <!-- row.// -->

</article> <!-- product-info-aside .// -->
		</main> <!-- col.// -->
	</div> <!-- row.// -->
</form>
<!-- ================ ITEM DETAIL END .// ================= -->


</div> <!-- container .//  -->
</section>


</body>
</html>