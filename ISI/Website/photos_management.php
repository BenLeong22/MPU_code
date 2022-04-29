<!DOCTYPE HTML>
<?php
include 'functionset.php'; 
session_start();

$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}



if(isset($_POST['p_id'])){
    $p_id = $_POST["p_id"];

}
else{
    $p_id= "";
};
    
if(isset($_POST['o_location'])){
    $o_location = $_POST["o_location"];

}
else{
    $o_location= "";
};

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


$p_id = getelement("p_id");
$searching  = getelement("searching"); 



if(isset($_POST['submit'])){
 if($_POST["status"]==3){
      if(isset($_POST['p_id'])){
    $p_id = $_POST['p_id'];
  $d_sql = 'DELETE FROM `picture` WHERE p_id='.$p_id.' AND location="'.$o_location.'"';
  echo $d_sql;
    $result1 = mysqli_query($conn,$d_sql);
}}
     
 else {$num =$_POST["num"];
 $file='file'.$num;
 echo $file;
 $countfiles = count($_FILES[$file]['name']);

 for($i=0;$i<$countfiles;$i++){
  $filename = $_FILES[$file]['name'][$i];
  move_uploaded_file($_FILES[$file]['tmp_name'][$i],'img/'.$filename);
 }

if($_POST["status"] ==1){
      if(isset($_POST['p_id'])){
    $p_id = $_POST['p_id'];
  $sql = 'INSERT INTO `picture`(`p_id`, `location`) VALUES ('.$p_id.',"'.$filename.'")';
  $d_sql = 'DELETE FROM `picture` WHERE p_id='.$p_id.' AND location="'.$o_location.'"';
  echo $sql;
  echo $d_sql;
    $result1 = mysqli_query($conn,$d_sql);
    $result = mysqli_query($conn,$sql);

}
}
     
if($_POST["status"] ==2){
      if(isset($_POST['p_id'])){
    $p_id = $_POST['p_id'];
  $sql = 'INSERT INTO `picture`(`p_id`, `location`) VALUES ('.$p_id.',"'.$filename.'")';
  echo $sql;
    $result = mysqli_query($conn,$sql);
}
}
    

}
     
}

 

    
 


$sql = "SELECT * FROM product where p_id = '$p_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


if(isset($_SESSION['name'])){
	 $name =$_SESSION['name'];}
else {$name ="";}

if(isset($_SESSION['u_id'])){
	 $u_id =$_SESSION['u_id'];}
else {$u_id ="";}



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
    
<script>
  function check(id) { 
            var fileInput =  
                document.getElementById('file'+id); 
            var id ='sm'+id;
            console.log(id);
            document.getElementById(id).disabled = false;
  
  }
            
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
    
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<aside class="col-md-3">
		<nav class="list-group">
			<a class="list-group-item" href="page-profile-main.html"> Account overview  </a>
			<a class="list-group-item" href="page-profile-address.html"> My Address </a>
			<a class="list-group-item" href="page-profile-orders.html"> My Orders </a>
			<a class="list-group-item" href="page-profile-wishlist.html"> My wishlist </a>
			<a class="list-group-item active" href="page-profile-seller.html"> My Selling Items </a>
			<a class="list-group-item" href="page-profile-setting.html"> Settings </a>
			<a class="list-group-item" href="page-index-1.html"> Log out </a>
		</nav>
	</aside> <!-- col.// -->
	<main class="col-md-9">

		<article class="card">
			<div class="card-body">

		<div class="row">
             <?php 
    for($a=0;$a<5;$a++){
    if($a<count($img)){
    $n_img = "'".$img[$a]."'";
        
    echo '				<div class="col-md-4">
					<figure class="card card-product-grid">
						<div class="img-wrap"> 
							<img src="img/'.$img[$a].'">
						</div> <!-- img-wrap.// -->
						<figcaption class="info-wrap">
								
				 
                         <form name="addpic" method="post" action="photos_management.php" enctype="multipart/form-data">
                         <input class="btn btn-outline-primary btn-block" type="file" name="file'.$a.'[]" style="display:none;" id="file'.$a.'" onchange="check('.$a.')" multiple> </input>
                           <label class="btn btn-outline-primary btn-block" for="file'.$a.'" class="btn btn-large"><i class="fa fa-pen"></i> Select file</label>
                         <input type="hidden" name="p_id" value="'.$p_id.'">
                         <input type="hidden" name="o_location" value="'.$img[$a].'">
                         <input type="hidden" name="status" value="1">
                         <input type="hidden" name="num" value="'.$a.'">
                         <input class="btn btn-outline-primary btn-block" id="sm'.$a.'" disabled type="submit" name="submit" value="Submit">
                        </form>    
	
								<hr>
                        <form name="delpic" method="post" action="photos_management.php" enctype="multipart/form-data">  
                        <input type="hidden" name="p_id" value="'.$p_id.'">
                         <input type="hidden" name="o_location" value="'.$img[$a].'">
				        <input type="hidden" name="status" value="3">
                         <input type="hidden" name="num" value="'.$a.'">
                         <input class="btn btn-outline-primary btn-block" id="sm'.$a.'" type="submit" name="submit" value="Remove">
                                
                        </form>
						</figcaption>
					</figure>
				</div> <!-- col.// -->';
        }
    else {
     echo '		  
                    <div class="col-md-4">
					<figure class="card card-product-grid">
						<div class="img-wrap"> 
							<img src="/img/-2.png">
						</div> <!-- img-wrap.// -->
						<figcaption class="info-wrap">
								
				 
                         <form name="chanpic1" method="post" action="photos_management.php" enctype="multipart/form-data">
                         <input class="btn btn-outline-primary btn-block"  type="file" name="file'.$a.'[]" style="display:none;" onchange="check('.$a.')" id="file'.$a.'" multiple> </input>
                           <label class="btn btn-outline-primary btn-block" for="file'.$a.'" class="btn btn-large"><i class="fa fa-pen"></i> Add Photo</label>
                         <input type="hidden" name="p_id" value="'.$p_id.'">
                         <input type="hidden" name="status" value="2">
                         <input type="hidden" name="num" value="'.$a.'">
                         <input class="btn btn-outline-primary btn-block" id="sm'.$a.'" disabled type="submit" name="submit" value="Submit">
                        </form>   
	
								<hr>
                        <form name="delpic" method="post" action="photos_management.php" enctype="multipart/form-data">                           
                        <input type="hidden" name="p_id" value="'.$p_id.'">
                         
				        <input type="hidden" name="status" value="3">
                         <input type="hidden" name="num" value="'.$a.'">
                         <input class="btn btn-outline-primary btn-block" id="sm'.$a.'" type="submit" name="submit" value="Remove">
                                
                        </form>
						</figcaption>
					</figure>
				</div> <!-- col.// -->';
    }
    //echo '<a class="item-thumb"> <img src="img/'.$img[$a].'" onclick="clickimg('.$n_img.')" ></a>';
        }
    ?>



			</div> <!-- row .//  -->

			</div> <!-- card-body.// -->
		</article>


	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>


</body>
</html>