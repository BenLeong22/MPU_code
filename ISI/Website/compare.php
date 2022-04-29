<!DOCTYPE HTML>
<?php 
include 'functionset.php';
session_start();
if(isset($_SESSION['name'])){
    if($_SESSION['name'] == 'admin'){
        header("location: vendor.php");
    }
}
$pname2 ="";
$description2 ="";
$price2 ="";
$oldprice2 ="";
$inventory2 ="";
$monSize2 ="";
$OS2 ="";
$memory2 ="";
$f_cam2 ="";
$b_cam2 ="";
$RAM2 ="";
$brand2 ="";

$pname ="";
$description ="";
$price ="";
$oldprice ="";
$inventory ="";
$monSize ="";
$OS ="";
$memory ="";
$f_cam ="";
$b_cam ="";
$RAM ="";
$brand ="";


$u_id =getsession("u_id");
$name =getsession("name");

$sort = getelement("sort");
$brand = getelement("brand");
$category = getelement("category");
$searching  = getelement("searching"); 

$clean = getelement("clean");
if($clean =="y"){
    if (isset($_SESSION['compare1'])) {
    unset($_SESSION['compare1']);
 }
    if (isset($_SESSION['compare2'])) {
     unset($_SESSION['compare2']);
 }
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
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Brands</h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_1" style="" >
			<div class="card-body">

				
				<label class="custom-control custom-checkbox">
				  <input type="radio" name="brand" <?php if($brand==""){echo 'checked';}?> onclick="ft_brands(-1)" class="custom-control-input">
				  <div class="custom-control-label" value="">All  
				  	<b class="badge badge-pill badge-light float-right"><?php echo $count_row[0]?></b></div>
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
				  	<b class="badge badge-pill badge-light float-right"><?php echo $count_row[0]; ?></b>  </div>
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

if(isset($_SESSION["compare1"])){
$p_id=$_SESSION["compare1"];
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
}
       
if(isset($_SESSION["compare2"])){
$p_id=$_SESSION["compare2"];
$sql = "SELECT * FROM product where p_id = '$p_id'";
    
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);    

$pname2 =$row["pname"];
$description2 =$row["description"];
$price2 =$row["price"];
$oldprice2 =$row["oldprice"];
$inventory2 =$row["inventory"];
$monSize2 =$row["monSize"];
$OS2 =$row["OS"];
$memory2 =$row["memory"];
$f_cam2 =$row["f_cam"];
$b_cam2 =$row["b_cam"];
$RAM2 =$row["RAM"];
$brand2 =$row["b_id"];

        $sql ='SELECT * FROM picture WHERE p_id='.$p_id;
    $result =$conn->query($sql);
    $img2 = array();
    if($result->num_rows >0){
        $i =0;
        while($row = $result->fetch_assoc()){
            $img2[$i] =$row["location"];
            $i++;
        }
}
        

    }
    ?>
<a href="compare.php?clean=y"class="btn btn-block btn-primary">Clean the compare</a>
        </br>
<div class="row">
<table width="800" border="1">
  <tbody>
    <tr>
      <th scope="col">Image</th>
        
      <td scope="col" ><img src="img/<?php echo $img[0]?>" width="300px;"/></td>
      <td scope="col"><img src="img/<?php echo $img2[0]?>" width="300px;"/></td>
    </tr>
    <tr>
      <th scope="col">Product Name</th>
      <td scope="col"><?php echo $pname?></td>
      <td scope="col"><?php echo $pname2?></td>
    </tr>
    <tr>
      <th scope="col">Description</th>
      <td scope="col"><?php echo $description?></td>
      <td scope="col"><?php echo $description2?></td>
    </tr>
    <tr>
      <th scope="col">Price</th>
      <td scope="col" <?php if($price>=$price2){echo 'style="background-color:lightgreen;"';}?> >MOP: <?php echo $price?></td>
      <td scope="col"<?php if($price2>=$price){echo 'style="background-color:lightgreen;"';}?>>MOP: <?php echo $price2?></td>
    </tr>
    <tr>
      <th scope="col">Screen Size</th>
      <td scope="col"<?php if($monSize>=$monSize2){echo 'style="background-color:lightgreen;"';}?>><?php echo $monSize?> inch</td>
      <td scope="col"<?php if($monSize2>=$monSize){echo 'style="background-color:lightgreen;"';}?>><?php echo $monSize2?> inch</td>
    </tr>
    <tr>
      <th scope="col">Memory</th>
      <td scope="col" <?php if($memory>=$memory2){echo 'style="background-color:lightgreen;"';}?>><?php echo $memory?> </td>
      <td scope="col" <?php if($memory2>=$memory){echo 'style="background-color:lightgreen;"';}?>><?php echo $memory2?></td>
    </tr>
    <tr>
      <th scope="col">Screen Size</th>
      <td scope="col"><?php echo $OS?> </td>
      <td scope="col"><?php echo $OS2?></td>
    </tr>
    <tr>
      <th scope="col">Front Camera</th>
      <td scope="col" <?php if($f_cam>=$f_cam2){echo 'style="background-color:lightgreen;"';}?>><?php echo $f_cam?> </td>
      <td scope="col" <?php if($f_cam2>=$f_cam){echo 'style="background-color:lightgreen;"';}?>><?php echo $f_cam2?></td>
    </tr>
    <tr>
      <th scope="col">Main Camera</th>
      <td scope="col" <?php if($b_cam>=$b_cam2){echo 'style="background-color:lightgreen;"';}?>><?php echo $b_cam?> </td>
      <td scope="col" <?php if($b_cam2>=$b_cam){echo 'style="background-color:lightgreen;"';}?>><?php echo $b_cam2?></td>
    </tr>
    <tr>
      <th scope="col">RAM</th>
      <td scope="col"  <?php if($RAM>=$RAM2){echo 'style="background-color:lightgreen;"';}?>><?php echo $RAM?> </td>
      <td scope="col"  <?php if($RAM2>=$RAM){echo 'style="background-color:lightgreen;"';}?>><?php echo $RAM2?></td>
    </tr>
      
  </tbody>
</table>

	




	</main> <!-- col.// -->

</div>

</div> <!-- container .//  -->
</section>



</body>

</html>