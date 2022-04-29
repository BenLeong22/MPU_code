<!DOCTYPE HTML>
<?php 
include 'functionset.php';
session_start();


$to      = '22kingleong22@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


$u_id =getsession("u_id");
$name =getsession("name");
$sort = getelement("sort");
$brand = getelement("brand");
$category = getelement("category");
$searching  = getelement("searching"); 
 

if($name !="admin"){
    header("Refresh:0; url=index.php");
} 
    
if (!isset ($_GET['page']) || $_GET['page']<=0 ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  



$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
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
<script>
        function sortchange(){
                    var seach = document.getElementById("sort").value; 
                    var url = new URL(window.location.href);
                    var search_params = url.searchParams;
                    console.log(search_params);
                    search_params.delete('sort');
                    search_params.set('sort',seach)
                    url.search = search_params.toString();
                    var new_url = url.toString();
 
                    window.location.href = new_url;
            } 
    
            function ft_brands(id){
                    console.log(id);
                    var url = new URL(window.location.href);
                    var search_params = url.searchParams;
                    search_params.delete('brand');
                
                    if(id != -1){
                        search_params.set('brand',id);
                    }
                    else {
                        search_params.delete('brand');
                    }
                                        search_params.delete('page');
                    search_params.set('page',1)
                    search_params.delete('page');
                    search_params.set('page',1)
                    url.search = search_params.toString();
                    var new_url = url.toString();
 
                    window.location.href = new_url;             
            } 
            function search(){
                var myTextBox = document.getElementById("myTextBox");
                var value = myTextBox.value;
                
                 var url = new URL(window.location.href);
                    var search_params = url.searchParams;
                    search_params.delete('searching');
                    search_params.delete('page');
                    search_params.set('page',1)
                    search_params.set('searching',value);
                    url.search = search_params.toString();
                    var new_url = url.toString();
                    window.location.href = new_url;     
            }
    
            function myFunction(){
                    var order = document.getElementById("order").value; 
                    var url = new URL(window.location.href);
                    var search_params = url.searchParams;
                    search_params.delete('order');
                    search_params.set('order',order)
                    url.search = search_params.toString();
                    var new_url = url.toString();
                    console.log(new_url);
                    window.location.href = new_url;
            } 
        
    
</script>
<script type="text/javascript">
/// some script

// jquery ready start
//$(document).ready(function() {
//	// jQuery code
//
//    
//}); 
    
//function searchev(){
//        var seach = document.getElementById("searchbar"); 
//  
//        // This event is fired when button is clicked 
////        button.addEventListener("click", function () { 
////            var str = textBox.value; 
////
////        }); 
//  
//        seach.addEventListener("keyup", function (event) { 
//  
//            if (event.keyCode == 13) { 
//                   var url='index.php?searching='+seach.value;
//                   window.location.href = url;
//            } 
//        }); 
//}    
    
    

    
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
	<h2 class="title-page">Selling Report</h2>
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
<!-- ========================= SECTION INTRO END// ========================= -->
<?php 
    $count_sql='SELECT COUNT("brand") FROM product';
    $count_result =$conn->query($count_sql);
    $count_row =$count_result->fetch_array();

    ?>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<aside class="col-md-3">
		
<div class="card">
	<article class="filter-group">


	</article> <!-- filter-group  .// -->	
</div> <!-- card.// -->

	</aside> <!-- col.// -->
	<main class="col-md-9">
<?php 
    
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
      

$results_per_page = 9;  
$page_first_result = ($page-1) * $results_per_page;   
    
    if($brand !="" || $category !="" || $searching!=""){
    if($brand =="" && $category == "" && $searching !=""){ $sql =$sql. ' WHERE pname LIKE "%'.$searching.'%"' ;}
    if($brand =="" && $category != "" && $searching ==""){ $sql =$sql. ' WHERE c_id ='.$category ;}
    if($brand =="" && $category != "" && $searching !=""){ $sql =$sql. ' WHERE c_id ='.$category.'&& pname LIKE "%'.$searching.'%"' ;}
    if($brand !="" && $category == "" && $searching ==""){ $sql =$sql. ' WHERE b_id ='.$brand;}
    if($brand !="" && $category == "" && $searching !=""){ $sql =$sql. ' WHERE b_id ='.$brand.'&& pname LIKE "%'.$searching.'%"' ;}
    if($brand !="" && $category != "" && $searching ==""){ $sql =$sql. ' WHERE b_id ='.$brand.'&& c_id ='.$category ;}
    if($brand !="" && $category != "" && $searching !=""){ $sql =$sql. ' WHERE b_id ='.$brand.'&& c_id ='.$category.'&& pname LIKE "%'.$searching.'%"'  ;}
}
else {
    $sql = $sql;
}

$result = $conn->query($sql);
        
$number_of_result = mysqli_num_rows($result);  
$number_of_page = ceil ($number_of_result / $results_per_page);
        
$found = mysqli_num_rows($result);
//echo $sql;
if($sort == "low"){ $sql =$sql. " order by price LIMIT " . $page_first_result . ',' . $results_per_page;}
else if($sort == "high"){ $sql =$sql. " order by price DESC LIMIT " . $page_first_result . ',' . $results_per_page; }
else {{ $sql =$sql. " LIMIT " . $page_first_result . ',' . $results_per_page; }}

$result = $conn->query($sql);

    ?>
<main class="col-md-13">


<header class="mb-3">
		<div class="form-inline">
			<strong class="mr-md-auto"></strong>
			<select class="mr-2 form-control" id="order" onchange="myFunction()">
				<option value="">Order by </option>
				<option value="tol_price">Order by sales</option>
                <option value="qty">Order by quantity</option>
			</select>
		</div>
</header><!-- sect-heading -->

<?php
    if(isset($_GET["order"])){
        $order = $_GET["order"];
    }
    else {$order = 'qty';}
    
    $po_sql ='SELECT p_id,SUM(quantity) as qty,price*SUM(quantity) as tol_price FROM purchaseproducts a,purchaseorder b WHERE a.PNo=b.PNo AND a.PNo IN (SELECT PNO FROM purchaseorder WHERE develiveryDate BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()) GROUP BY p_id ORDER BY '.$order.' DESC';
    
    $po_result=$conn->query($po_sql);
    if($po_result->num_rows > 0){
        $i =0;
        while($po_row=$po_result->fetch_assoc()){
            $i++;
            $p_sql ='SELECT * FROM product WHERE p_id='.$po_row["p_id"];
            $p_result = mysqli_query($conn,$p_sql);
            $p_row = mysqli_fetch_assoc($p_result);
            
            $pho_sql ='SELECT * FROM picture WHERE p_id='.$po_row["p_id"];
            $pho_result = mysqli_query($conn,$pho_sql);
            $pho_row = mysqli_fetch_array($pho_result);
            echo '
            <article class="card card-product-list"  style="width:1100px;">
	<div class="row no-gutters">
		<aside class="col-md-3">
			<a href="#" class="img-wrap">
				<span class="badge badge-danger">TOP '.$i.'</span>
				<img src="img/'.$pho_row[2].'">
			</a>
		</aside> <!-- col.// -->
		<div class="col-md-6">
			<div class="info-main">
				<a href="product.php?p_id='.$po_row["p_id"].'" class="h5 title">'.$p_row["pname"].'</a>
				<div class="rating-wrap mb-2">
                        brand:'.'123456'.'
					<div class="label-rating">9/10</div>
				</div> <!-- rating-wrap.// -->
			


				<p> '.$p_row["description"].' </p>

			</div> <!-- info-main.// -->
		</div> <!-- col.// -->
		<aside class="col-sm-3" >
			<div class="info-aside" >
				<div class="price-wrap">
					<span class="h5 price" >Total sales：MOP:'.$po_row["tol_price"].'</span> 
				
				</div> <!-- price-wrap.// -->
				
				<p class="text-muted mt-3">Sales volume: '.$po_row["qty"].'</p>




			</div> <!-- info-aside.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</article> <!-- card-product .// -->
            ';
         
        }
    }
    
    
    ?>





	</main> <!-- col.// -->


</body>

</html>