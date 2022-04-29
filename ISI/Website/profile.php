<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';


$name = getsession("name");
$u_id = getsession("u_id");
$searching  = getelement("searching"); 


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
	<h2 class="title-page">My account</h2>
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
<?php 
$sql = 'SELECT * FROM user where name ="'.$_SESSION["name"].'"';
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
    
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
			<a class="list-group-item" href="page-profile-seller.html"> My Selling Items </a>
			<a class="list-group-item active" href="page-profile-setting.html"> Settings </a>
			<a class="list-group-item" href="page-index-1.html"> Log out </a>
		</nav>
	</aside> <!-- col.// -->
	<main class="col-md-9">

	<div class="card">
      <div class="card-body">
     <form class="row" action="profile.php" method="POST">
     	<div class="col-md-9">
     		<div class="form-row">
				<div class="col form-group">
					<label>Name</label>
				  	<input type="text" class="form-control" disabled value="<?php echo $row[1] ?>" name="name">
				</div> <!-- form-group end.// -->
				<div class="col form-group">
					<label>Email</label>
				  	<input type="email" class="form-control" value="<?php echo $row[2] ?>" name="email">
				</div> <!-- form-group end.// -->
			</div> <!-- form-row.// -->

			<div class="form-row">
				<div class="form-group col-md-6">
				  <label>Address</label>
				  <input type="text" class="form-control" style="width: 600px;" name="address" value="<?php echo $row[4] ?>">
				</div> <!-- form-group end.// -->

			</div> <!-- form-row.// -->

			<button class="btn btn-primary">Save</button>	
			<button class="btn btn-light"><a href="changepassword.php">Change password</a></button>	

			<br><br><br><br><br><br>

     	</div> <!-- col.// -->
<!--
     	<div class="col-md">
     		<img src="images/avatars/avatar1.jpg" class="img-md rounded-circle border">
     	</div>   col.// 
-->
      </form>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->



	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

$address = $_POST['address'];
$email = $_POST['email'];



$sql1= 'UPDATE `user` SET `email`="'.$email.'" ,`address`="'.$address.'" WHERE u_id ='.$u_id;
mysqli_query($conn, $sql1);
  echo '<meta http-equiv="refresh" content="0; url=profile.php" />' ;
    }
    ?>
</body>
</html>