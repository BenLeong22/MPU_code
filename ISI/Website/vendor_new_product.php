<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';
$name = getsession("name");
$u_id = getsession("u_id");

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
$brand = getelement("brand");
$category = getelement("category");
$searching  = getelement("searching"); 

$item=0;
$o_item=0;
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


if(isset($_GET["button"])){

$sql ='INSERT INTO `product`(`c_id`, `b_id`, `pname`, `description`, `price`, `oldprice`, `inventory`, `monSize`, `OS`, `memory`, `f_cam`, `b_cam`, `RAM`) VALUES ('.$category.','.$brand.',"'.$pname.'","'.$description.'",'.$price.','.$oldprice.','.$inventory.','.$monSize.',"'.$OS.'",'.$memory.','.$f_cam.','.$b_cam.','.$RAM.')';

    
if ($conn->query($sql) === TRUE) {
  $p_id = $conn->insert_id;
 header("location:vendor_product.php?p_id=".$p_id);
}
    
}    


$sql = "SELECT * FROM product where p_id = '$p_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$name = getsession("name");
$u_id = getsession("u_id");



if($u_id !=""){
    $sql ="SELECT COUNT(u_id) FROM shoppingcart WHERE u_id =".$u_id;
    $result =mysqli_query($conn,$sql);
    $row =mysqli_fetch_array($result);
    $item =$row[0];
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
            
            ?>
<div class="card">
<article class="gallery-wrap"> 
	<div class="img-big-wrap">
	  <div> <a href="#"><img src="img/<?php 
                  if(isset($img)){
                      echo $img[0];
                  }else {echo "-2.png";} 
                             
                             
                             ?>" id="bigimg"></a></div>
	</div> <!-- slider-product.// -->
	<div class="thumbs-wrap">
    

    
    <button class="btn   btn-primary item-thumb"  href="photos_management.php?p_id='<?php echo $p_id;?>'&Edit=" style="width: 300px;"  name="button"><a href="photos_management.php?p_id=<?php echo $p_id;?>" style="color: aliceblue;">Photos Management</a><span class="text"></span> </button>

    </br>
	</div> 
</article> 
</div> <!-- card.// -->
		</aside>
		<main class="col-md-6">
<article class="product-info-aside">
<form action="vendor_new_product.php" method="GET">
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
<?php 
    $sql ='SELECT * FROM brand';
    $result =$conn->query($sql);
    $c_brand_id=array();                                     
    $c_brand=array();  
    $c_category=array(); 
    if($result->num_rows >0){
        while($row=$result->fetch_assoc()){
            array_push($c_brand,$row["b_type"]);
            array_push($c_brand_id,$row["b_id"]);
        }
    }
    echo $c_brand[1];
    
    $sql ='SELECT * FROM brand';
    $result =$conn->query($sql);
    $c_brand_id=array();                                     
    $c_brand=array();
    $c_category_id=array();
    $c_category=array(); 
    if($result->num_rows >0){
        while($row=$result->fetch_assoc()){
            array_push($c_brand,$row["b_type"]);
            array_push($c_brand_id,$row["b_id"]);
        }
    }
                                           
    $sql ='SELECT * FROM category';
    $result =$conn->query($sql);
    if($result->num_rows >0){
        while($row=$result->fetch_assoc()){
            array_push($c_category,$row["c_type"]);
            array_push($c_category_id,$row["c_id"]);
        } }
      
                                         
                                           
    ?>

<dl class="row">
  <dt class="col-lg-6" style="text-align: right">Brand</dt>
        
    <select name="brand"> 
    <?php 
    for($i=0;$i<count($c_brand);$i++){
        echo '<option value="'.$c_brand_id[$i].'">'.$c_brand[$i].'</option>';
    }    
    ?>
    </select>
    <dt class="col-lg-6" style="text-align: right">Category</dt>
    <select name="category"> 
    <?php 
    for($i=0;$i<count($c_category);$i++){
        echo '<option value="'.$c_category_id[$i].'">'.$c_category[$i].'</option>';
    }    
    ?>
    </select>
    
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
   <input type="hidden" value="success" name="edited"></input>
  
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
<script type="text/javascript">
var msg_url = new URL(window.location.href);
var msg_search_params = msg_url.searchParams;
var msg =msg_search_params.get("edited");
    
console.log(msg);
if(msg =="success"){
    alert("Add product successful")
}
</script>

</body>
</html>