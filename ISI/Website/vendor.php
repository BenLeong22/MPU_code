<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';

$name = getsession("name");
$u_id = getsession("u_id");
$sort = getelement("sort"); 
$p_id = getelement("p_id");
$brand = getelement("brand");
$category = getelement("category");
$searching  = getelement("searching"); 
    
if (!isset ($_GET['page']) || $_GET['page']<=0 ) {  
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
    
            function ft_category(id){
                    console.log(id);
                    var url = new URL(window.location.href);
                    var search_params = url.searchParams;
                    search_params.delete('category');
                
                   if(id != -1){
                        search_params.set('category',id);
                    }
                    else {
                        search_params.delete('category');
                    }
                    
                    
                    search_params.delete('page');
                    search_params.set('page',1)
                    url.search = search_params.toString();
                    var new_url = url.toString();
 
                    window.location.href = new_url;       
            }
    
            function searchbyno() {
                    var searchby = document.getElementById("searchby");
                    var value = searchby.value;
                    var url = new URL(window.location.href);
                    var search_params = url.searchParams;
                    search_params.delete('searching');
                    search_params.delete('page');
                    search_params.set('p_id',value)
                    url.search = search_params.toString();
                    var new_url = url.toString();
 
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
	<h2 class="title-page">Vendor Products Pages</h2>
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

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<aside class="col-md-3">
				<div class="filter-content collapse show" id="collapse_1" style="">
			<div class="card-body">



			</div> <!-- card-body.// -->
		</div>
<div class="card">
	<article class="filter-group">
        
		<header class="card-header">
            			<a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Search by Product Number</h6></br>
			</a>
            				<form class="pb-3">
				<div class="input-group">
				  <input type="text" class="form-control" id="searchby" placeholder="Search Product Number">
				  <div class="input-group-append">
				    <button class="btn btn-light" type="button" onClick="searchbyno()"><i class="fa fa-search"></i></button>
				  </div>
				</div>
				</form>
			<a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Brands</h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_1" style="" >
			<div class="card-body">
<?php

                $count_sql ='SELECT COUNT("brand") FROM product';
                $count_result =$conn->query($count_sql);
                $count_row =$count_result->fetch_array();
?>
				
				<label class="custom-control custom-checkbox">
				  <input type="radio" name="brand" <?php if($brand==""){echo 'checked';}?> onclick="ft_brands(-1)" class="custom-control-input">
				  <div class="custom-control-label" value="">All  
				  	<b class="badge badge-pill badge-light float-right"><?php echo $count_row[0]?></b>  </div>
				</label>
                
<?php 
                $sql = "SELECT * FROM brand";
                $result = $conn->query($sql);
                ///         
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                if($brand==$row["b_id"]){$checkbrand = 'checked';}
                      else {$checkbrand="";}
                      
                $count_sql ='SELECT COUNT("brand") FROM product WHERE b_id='.$row["b_id"];
                $count_result =$conn->query($count_sql);
                $count_row =$count_result->fetch_array();
           //      
                  echo '				<label class="custom-control custom-checkbox">
				  <input type="radio" name="brand" class="custom-control-input" '.$checkbrand.' value="'.$row["b_id"].'" onclick="ft_brands('.$row["b_id"].')">
				  <div class="custom-control-label">'.$row["b_type"].'  
				  	<b class="badge badge-pill badge-light float-right">'.$count_row[0].'</b>  </div>
				</label>';


                  }
                } else {
                  echo "0 results";
                } 
                
                $count_sql ='SELECT COUNT("category") FROM product';
                $count_result =$conn->query($count_sql);
                $count_row =$count_result->fetch_array();
?>
			

			</div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group  .// -->
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Categories </h6>
			</a>
		</header>
        
		<div class="filter-content collapse show" id="collapse_2" style="">
			<div class="card-body">
            
                <label class="custom-control custom-checkbox">
				  <input type="radio" name="test1"  <?php if($category==""){echo 'checked';}?> class="custom-control-input" onclick="ft_category(-1)">
				  <div class="custom-control-label">All  
				  	<b class="badge badge-pill badge-light float-right"><?php echo $count_row[0]?></b>  </div>
				</label>
                
        <?php 
                $sql = "SELECT * FROM category";
                $result = $conn->query($sql);
                ///         
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                if($category==$row["c_id"]){$checkcategory = 'checked';}
                      else {$checkcategory="";}
                $count_sql ='SELECT COUNT("category") FROM product WHERE c_id='.$row["c_id"];
                $count_result =$conn->query($count_sql);
                $count_row =$count_result->fetch_array();
                  echo '			<label class="custom-control custom-checkbox">
				  <input type="radio" '.$checkcategory.' name="test1" class="custom-control-input" onclick="ft_category('.$row["c_id"].')">
				  <div class="custom-control-label">'.$row["c_type"].'  
				  	<b class="badge badge-pill badge-light float-right">'.$count_row[0].'</b>  </div>
				</label>';


                  }
                } else {
                  echo "0 results";
                } 
?>

	</div>  
    	</div>
	</article> <!-- filter-group .// -->
	
</div> <!-- card.// -->

	</aside> <!-- col.// -->
	<main class="col-md-9">
<?php 
    
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
      

$results_per_page = 9;  
$page_first_result = ($page-1) * $results_per_page;   
    
if($p_id ==""){
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
}else {
    $sql = $sql.' WHERE p_id = '.$p_id;
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
<header class="border-bottom mb-4 pb-3">
    
		<div class="form-inline">
			<span class="mr-md-auto"><?php echo $found;?> found </span>
            
			<select class="mr-2 form-control" name="sort" id="sort" onChange="sortchange()">
                <option value="" <?php if($sort==""){echo 'selected';}?>>Default</option>
				<option value="low" <?php if($sort=="low"){echo 'selected';}?>>Low To High</option>
				<option value="high" <?php if($sort=="high"){echo 'selected';}?>>High To Low</option>

			</select>
            
		</div>
    <br>
       <?php echo '<a href="vendor_new_product.php?" class="btn btn-block btn-primary">Add New Product</a>';?>
</header><!-- sect-heading -->
<div class="row">
<?php 
    
    
    
    if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $img_sql = 'SELECT * FROM picture where p_id = '.$row["p_id"];
    $img_result = mysqli_query($conn, $img_sql);
    $img_row = mysqli_fetch_array($img_result);
    $sql1 ='SELECT * FROM brand WHERE b_id='.$row["b_id"];
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);
    echo '<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="img-wrap">';
                 
        if(isset($img_row[2])){ echo '<img src="img/'.$img_row[2].'">';}
        else {echo '<img src="img/-2.png">';}
        
      echo '<a class="btn-overlay" href="vendor_product.php?p_id='.$row["p_id"].'"><i class="fa fa-search-plus"></i> Quick view</a>
			</div> <!-- img-wrap.// -->
			<figcaption class="info-wrap">
				<div class="fix-height">
					<a href="vendor_product.php?p_id='.$row["p_id"].'" class="title">'.$row["pname"].'</a>
					<div class="price-wrap mt-2">
						<span class="price"> $ '.$row["price"].'</span>
					</div> <!-- price-wrap.// -->
                    
				</div>
					<span class="title">Brand: '.$row1["b_type"].'</span></br></br>

                    
	
                
                
				<a href="vendor_product.php?p_id='.$row["p_id"].'" class="btn btn-block btn-primary">Edit Information</a>	
			</figcaption>
		</figure>
	</div> <!-- col.// -->';

  }
} else {
  echo "0 results";
}
    
    ?>

	


<nav class="container-fluid">
  <ul class="pagination">
<!--
    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
-->
      
<?php 
      $p_page =$page-1;
     echo '<li class="page-item"><a class="page-link" href = "vendor.php?page=' . $p_page . '&sort='.$sort.'&brand='.$brand.'&category='.$category.'&searching='.$searching.' "><</a></li>';
    for($page1 = 1; $page1<= $number_of_page; $page1++) {  
        if($page == $page1){ echo '<li class="page-item"><a class="page-link" style="background-color:Lightgray;" href = "vendor.php?page=' . $page1 . '&sort='.$sort.'&brand='.$brand.'&category='.$category.'&searching='.$searching.' ">' . $page1 . ' </a></li>';}
        else { echo '<li class="page-item"><a class="page-link" href = "vendor.php?page=' . $page1 . '&sort='.$sort.'&brand='.$brand.'&category='.$category.'&searching='.$searching.' ">' . $page1 . ' </a></li>';}
} 
    if($page<$number_of_page){
        $n_page =$page+1;
        echo '<li class="page-item"><a class="page-link" href = "vendor.php?page=' . $n_page . '&sort='.$sort.'&brand='.$brand.'&category='.$category.'&searching='.$searching.' "> ></a></li>';
    }
    else {
        echo '<li class="page-item"><a class="page-link" href = "vendor.php?page=' . $number_of_page . '&sort='.$sort.'&brand='.$brand.'&category='.$category.'&searching='.$searching.' ">> </a></li>';
    }
    
?>
  </ul>
</nav>

	</main> <!-- col.// -->

</div>

</div> <!-- container .//  -->
</section>



</body>

</html>