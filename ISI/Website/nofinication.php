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


$sql ='UPDATE `notification` SET `isRead`=1 WHERE u_id ='.$u_id;
$result =$conn->query($sql);


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
	<h2 class="title-page">Notification</h2>
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
$sql = 'SELECT * FROM notification where u_id ="'.$u_id.'" ORDER BY time DESC';
$result = $conn->query($sql);


    ?> 
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<aside class="col-md-3">

	</aside> <!-- col.// -->
	<main class="col-md-9">
        <?php 
        if($result->num_rows > 0){
            while($row =$result->fetch_assoc()){
                if($row["status"]==1){$status ="Pedding";}
                if($row["status"]==2){$status ="Shipped";}
                if($row["status"]==3){$status ="Canceled";}
                if($row["status"]==4){$status ="Hold";}
               
                echo '<article class="card mb-4">
		      <header class="card-header">
			<strong class="d-inline-block mr-3">'.$status.' Notice #<a href="purchaseddetailpage.php?PNo='.$row["PNo"].'">'.$row["PNo"].'</a></strong>
			<span>'.$row["time"].'</span>
		</header>
		<div class="card-body">
			<div class="row"> 
				<div class="col-md-8">
					<h6 class="text-muted">Dear '.$name.'</h6>
					<p>Your Product(s) （Purchase Order Number:<a href="purchaseddetailpage.php?PNo='.$row["PNo"].'">'.$row["PNo"].'</a>）  have been '.$status.'
			 		</p>
				</div>
			
			</div> <!-- row.// -->
		</div> <!-- card-body .// -->
		</article>';
            }
        }
        ?> <!-- card order-item .// -->




	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>   