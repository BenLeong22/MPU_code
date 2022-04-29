<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';
if(isset($_SESSION['name'])){
    if($_SESSION['name'] == 'admin'){
        header("location: vendor.php");
    }
}




$name = getsession("name");
$u_id = getsession("u_id");
$searching  = getelement("searching"); 


$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}

if(isset($_GET["c_qty"]) && $_GET["c_pid"]){
    if($_GET["c_qty"]<=0){$_GET["c_qty"]=1;}
    $cha = 'UPDATE `shoppingcart` SET `quantity`='.$_GET["c_qty"].' WHERE u_id='.$u_id.' AND p_id='.$_GET["c_pid"];
    mysqli_query($conn,$cha);
}  

if(isset($_GET["del_p_id"]) && isset($_GET["del_u_id"]) ){
   $del_p_id = $_GET["del_p_id"];
   $del_u_id = $_GET["del_u_id"];
   $del_p_sql = 'DELETE FROM `shoppingcart` WHERE u_id='.$del_u_id.' AND p_id='.$del_p_id;
   mysqli_query($conn,$del_p_sql);
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
    
function myFunction(p_id) {
   var id="q_"+p_id
   var qty=document.getElementById(id).value;
   var url='/shoppingcart.php?c_qty='+qty+"&c_pid="+p_id;
   window.location.href = url;
}
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
	<h2 class="title-page">Shopping cart</h2>
</div> <!-- container //  -->
</section>
    
    <section class="section-content padding-y">
<div class="container">

<div class="row">
	<main class="col-md-9">
<div class="card">

<table class="table table-borderless table-shopping-cart">
<thead class="text-muted">
    
<tr class="small text-uppercase">
  <th scope="col">Product</th>
  <th scope="col" width="120">Quantity</th>
  <th scope="col" width="120">Price</th>
  <th scope="col" class="text-right" width="200"> </th>
</tr>
</thead>
<tbody>
<?php
    $Total =0;
    $spc_sql='SELECT * FROM shoppingcart WHERE u_id='.$u_id;
    $spc_result =$conn->query($spc_sql);
    $pp_id = array();
    $qty = array();
    $price = array();
    $pp_subtotal = array();
    
    $checkbutton =0;
    if($spc_result->num_rows >0){
    $checkbutton =1;
          $Total =0;
  while($row = $spc_result->fetch_assoc()) {
  $p_sql = 'SELECT * FROM product WHERE p_id ='.$row['p_id'];
  $p_result = mysqli_query($conn,$p_sql);
  $p_row = mysqli_fetch_assoc($p_result);
  $p_id =$p_row["p_id"];
      
  $pic_sql = 'SELECT * FROM picture WHERE p_id ='.$row['p_id'];
  $pic_result = mysqli_query($conn,$pic_sql);
  $pic_row = mysqli_fetch_assoc($pic_result);
  $pic_row =$pic_row["location"];
      
  $b_sql = 'SELECT * FROM brand WHERE b_id ='.$p_row["b_id"];
  $b_result = mysqli_query($conn,$b_sql);
  $b_row = mysqli_fetch_assoc($b_result);
  $b_row =$b_row["b_type"];
  $p_qty=$row['quantity']-1;
  $n_qty=$row['quantity']+1;
      
  echo '<tr>
	<td>
		<figure class="itemside">
			<div class="aside"><img src="img/'.$pic_row.'" class="img-sm"></div>
			<figcaption class="info">
				<a href="product.php?p_id='.$p_row["p_id"].'">'.$p_row['pname'].'</a>
				<p class="text-muted small">OS: '.$p_row["OS"].', Memory: '.$p_row["memory"].' GB   <br> Brand: '.$b_row.'</p>
			</figcaption>
		</figure>
	</td>
	<td> 
		<div class="form-group col-lg flex-grow-0">
			<div class="input-group lg-9 input-spinner">
			  <div class="input-group-prepend">
                  <form action="product.php" method="get">
			    <a href="shoppingcart.php?c_qty='.$p_qty .'&'.'c_pid='.$p_id.'"><button class="btn btn-light" type="button" id="button-minus" > - </button></a>
			  </div>
			  <input type="text" class="form-control" style="width: 70px; padding: 2px;"  value="'.$row["quantity"].'" id="q_'.$p_id.'" oninput="myFunction('.$p_row["p_id"].')">
			  <div class="input-group-append">
			    <a href="shoppingcart.php?c_qty='.$n_qty .'&'.'c_pid='.$p_id.'"><button class="btn btn-light" type="button" id="button-plus" > + </button></a>
			  </div>
			</div>
		</div> <!-- col.// -->
	</td>
	<td> 
		<div class="price-wrap"> 
			<var class="price" style="width:100px;">MOP '.$row["quantity"]*$p_row['price'].'</var> 
			<small class="text-muted">Mop '.$p_row['price'].' each </small> 
		</div> <!-- price-wrap .// -->
	</td>
	<td class="text-right"> 
	<a href="shoppingcart.php?del_p_id='.$p_row["p_id"].'&del_u_id='.$u_id.'" class="btn btn-outline-danger" > Cancel</a>
	</td>
</tr>';
      
  
  array_push($pp_id,$row['p_id']);
  array_push($qty,$row['quantity']);
  array_push($price,$p_row['price']);
  array_push($pp_subtotal,$row['quantity']*$p_row['price']);
  $Total += $row['quantity']*$p_row['price'];
    }
    
    }
    
    
    
    ?>

    
    

</tbody>
</table>

<div class="card-body border-top">
	<a href="shoppingcart.php?button=" class="btn btn-primary float-md-right" 
       <?php if($checkbutton==0){echo 'style="pointer-events:none"'; }?>> 
        Make Purchase <i class="fa fa-chevron-right"></i> </a>
	<a href="index.php" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
</div>	
</div> <!-- card.// -->



	</main> <!-- col.// -->
	<aside class="col-md-3">
<!--
		<div class="card mb-3">
			<div class="card-body">
			<form>
				<div class="form-group">
					<label>Have coupon?</label>
					<div class="input-group">
						<input type="text" class="form-control" name="" placeholder="Coupon code">
						<span class="input-group-append"> 
							<button class="btn btn-primary">Apply</button>
						</span>
					</div>
				</div>
			</form>
			</div>  card-body.// 
		</div>   card .// 
-->
		<div class="card" style="width: 320px;">
			<div class="card-body" style="width: 310px;">
					<dl class="dlist-align">
					  <dt>Total price:</dt>
					  <dd class="text-right">MOP <?php echo $Total?></dd>
					</dl>

					<dl class="dlist-align">
					  <dt>Total:</dt>
					  <dd class="text-right  h6"><strong>MOP <?php echo $Total?></strong></dd>
					</dl>
					<hr>
					
			</div> <!-- card-body.// -->
		</div>  <!-- card .// -->
	</aside> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>

<?php 
if(isset($_GET["button"])){
    date_default_timezone_set("Asia/Hong_Kong");
    $date = date("Y-m-d H:i:s") . "<br>";
    
    $po_sql ='INSERT INTO `purchaseorder`(`uID`, `status`, `purchasedDate`,`po_subtotal`) VALUES ('.$u_id.',1,"'.$date.'",'.$Total.')';
    mysqli_query($conn,$po_sql);
  
    $del_sql = 'DELETE FROM `shoppingcart` WHERE u_id = '.$u_id;
    mysqli_query($conn,$del_sql);
    
    $PNoSQL = 'SELECT * FROM purchaseorder WHERE uID ='.$u_id.' AND purchasedDate = "'.$date.'"';
    $PNoresult = mysqli_query($conn,$PNoSQL);
    $row = mysqli_fetch_assoc($PNoresult);
  
    
    $PNo = $row["PNo"];
    $count =0;
    foreach ($qty as &$value) {
    $pp_sql = 'INSERT INTO `purchaseproducts`(`p_id`, `PNo`, `quantity`, `price`, `pp_subtotal`) VALUES ('.$pp_id[$count].','.$PNo.','.$qty[$count].','.$price[$count].','.$pp_subtotal[$count].')';
    mysqli_query($conn,$pp_sql);

    $count++;
}
    echo '<meta http-equiv=REFRESH CONTENT=1;url=purchaseddetailpage.php?PNo='.$PNo.'>';
    
} 
?>
    
</body>
</html>