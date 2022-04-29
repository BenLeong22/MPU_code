<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';
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
$searching  = getelement("searching"); 
$name = getsession("name");
$u_id = getsession("u_id");
$p_id  = getelement("p_id"); 


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


if(isset($_GET["submit"])){
    $PNo = getelement("PNo");
    $p_id  = getelement("p_id");
    $comment  = getelement("comment");
    $rate  = getelement("rate");
    date_default_timezone_set("Asia/Hong_Kong");
    $date = date("Y-m-d H:i:s") . "<br>";
    $sql ='UPDATE `purchaseproducts` SET `rate`='.$rate.',`comment`="'.$comment.'<br>",`com_date`="'.$date.'" WHERE p_id ='.$p_id.' AND PNo ='.$PNo;
    $result =mysqli_query($conn,$sql);
    
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
<style type="text/css">
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}    
    
</style>
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
    $sql ='SELECT * FROM product WHERE p_id='.$p_id;
    $result =mysqli_query($conn,$sql);
    $row =mysqli_fetch_assoc($result);
    
    $img_sql ='SELECT * FROM picture WHERE p_id='.$p_id;
    $img_result =mysqli_query($conn,$img_sql);
    $img_row =mysqli_fetch_assoc($img_result);
    
    $po_sql ='SELECT * FROM purchaseproducts WHERE p_id='.$p_id.' AND PNo='.$PNo;
    $po_result =mysqli_query($conn,$po_sql);
    $po_row =mysqli_fetch_assoc($po_result);
    ?>
<?php 
if(($po_row["rate"] !=0)){
    echo '<div class="row no-gutters"><p style="color:red;">*** This product has been reviewed</p></div>';
}    
    
?>

    

<article class="card card-product-list">
    <form action="comment.php" method="get">

	<div class="row no-gutters">
		<aside class="col-md-3">
			<a href="#" class="img-wrap">
				<img src="img\<?php echo $img_row["location"]?>">
			</a>
		</aside> <!-- col.// -->
		<div class="col-md-6">
			<div class="info-main">
				<a href="product.php?p_id=<?php echo $p_id;?>"? class="h4 title"><?php echo $row["pname"];?></a>
                
                <br>
                <h5>Rating:</h5>
				<div class="rating-wrap mb-2">
                    <?php if($po_row["rate"] ==0) {echo 
                            ' <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" checked="checked" />
                            <label for="star1" title="text">1 star</label>
                          </div>'
                    ;
                    echo '<div class="label-rating"></div>
                        </div> <!-- rating-wrap.// -->
                        <br>
                        <h5>Comment:</h5>
                        <p> <textarea type="text" name="comment" style="width: 400px;" multiple rows="5" cols="10"></textarea></p>
                        </div> <!-- info-main.// -->
                          </div> <!-- col.// -->';
                    }
                    else {
                       echo '<div class="rate">';
                        for($i=5;$i>=1;$i--){
                         if($i !=$po_row["rate"]){
                            echo '<input type="radio" id="star1" name="rate" value="1" disabled/>
                            <label for="star1" title="text">1 star</label>';  
                        }
                        else {
                            echo '<input type="radio" id="star1" name="rate" value="1" checked disabled/>
                            <label for="star1" title="text">1 star</label>';  
                        }
                        }
   
                        echo '</div>
                        <div class="label-rating"></div>
                            </div> <!-- rating-wrap.// -->
                            <br>
                            <h5>Comment:</h5>
                            <p> <textarea type="text" name="comment" style="width: 400px;" multiple rows="5" cols="10" disabled>'.strip_tags($po_row["comment"]).'</textarea></p>
                        </div> <!-- info-main.// -->
                    </div> <!-- col.// -->';
                        
                    }
                    
                    ?>


		<aside class="col-sm-3">
			<div class="info-aside">
				<div class="price-wrap">
                    <span class="h2 price"> Subtotal:</span> <br>
                    <br>
                    <br>
					<span class="h5 price"> MOP$ <?php echo $po_row["pp_subtotal"]?></span> 
				</div> <!-- price-wrap.// -->
                <br>
                <br>
                <br>
				<p class="mt-3">
                    <input type="text" name="p_id" value="<?php echo $p_id?> " hidden>
                    <input type="text" name="PNo" value="<?php echo $PNo?> " hidden>
                    <?php 
                    if($po_row["rate"] ==0){
                        echo '<input type="submit" name="submit" class="btn btn-outline-primary" style="width: 150px;" value="Submit">';
                    }
                    
                    ?>
                </form>
				</p>

			</div> <!-- info-aside.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</article> <!-- card-product .// -->


    


	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
    
</section>    