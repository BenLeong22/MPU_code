<!DOCTYPE HTML>
<?php
include 'functionset.php';
session_start();

$searching  = getelement("searching"); 

if(isset($_POST['name'])){
    $lname =$_POST['name'];
}else{
    $lname ="";
}

if(isset($_GET["p_id"])){
    $p_id =$_GET["p_id"];
}else{
    $p_id ="";
}

if(isset($_POST["p_id"])){
    $p_id =$_POST["p_id"];
}else{
    
}

echo $p_id;
if($_SERVER["REQUEST_METHOD"] == "POST"){

$name = $_POST['name'];
$pw = $_POST['pw'];

$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}

$sql = "SELECT * FROM user where name = '$name'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($name != null && $pw != null && $name == 'admin' && $pw == 'admin')
{		
        $_SESSION['name'] = 'admin';
        $_SESSION['u_id'] = 'admin';
		header("location: vendor.php");
        echo 'Login successful';
//        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
else
{
      //  echo 'Login unsuccessful';
//        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
    if($name != null && $pw != null && $row[1] == $name && password_verify($pw, $row[3]))
{		
        $_SESSION['name'] = $name;
        $_SESSION['u_id'] = $row[0];
		
        echo 'Login successful';
        if($p_id==""){
             header("location: index.php");
        }
        else {header("location: product.php?p_id=".$p_id);}
//        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
else
{
        header("location: login.php?verify=no&p_id=".$p_id);
//        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
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

<!-- custom style -->
<link href="css/ui.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<!-- custom javascript -->
<script src="js/script.js" type="text/javascript"></script>

<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {

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
		<form action="index.php" class="search" method="get">
			<div class="input-group w-100">
			    <input type="text" class="form-control" placeholder="Search"  id="searchbar" name="searching">
			    <div class="input-group-append">
			      <button class="btn btn-primary" type="submit" >
			        <i class="fa fa-search"></i> Search
			      </button>
			    </div>
		    </div>
		</form> <!-- search-wrap .end// -->
	</div> <!-- col.// -->
    <div class="col-lg-4 col-sm-6 col-12">
     <div class="widgets-wrap float-md-right">
         <div class="widget-header  mr-3">
 <?php 
        if($lname !=""){
	echo '<a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
				<span class="badge badge-pill badge-danger notify">0</span>
			</div>
			<div class="widget-header icontext">
            <a href="login.php" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>';
        }
        else {echo '<div class="text">
					<span class="text-muted">Welcome! New User</span>
					<div> 
						<a href="login.php">Sign in</a> |  
						<a href="register.php"> Register</a>
					</div>
				</div>';}        
?>               

				

			</div>

		</div> <!-- widgets-wrap.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->
	</div> <!-- container.// -->
</section> <!-- header-main .// -->
</header> <!-- section-header.// -->



<!-- ========================= SECTION CONTENT ========================= -->
    
  

<section class="section-content padding-y">
<!-- ============================ COMPONENT REGISTER   ================================= -->
	<div class="card mx-auto" style="max-width:520px; margin-top:40px;">
      <article class="card-body">
		<header class="mb-4"><h4 class="card-title">Sign in</h4></header>
		<form action="login.php" method="post">
				<div class="form-group">
					<label>User Name:</label>
					<input type="text" class="form-control" placeholder=""  id="name" name="name">
					<small class="form-text text-muted" >We'll never share your email with anyone else.</small>
				</div> <!-- form-group end.// -->
                  
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" placeholder="" id="password" name="pw">
                <small class="form-text text-muted" id="wor_meg">We'll never share your email with anyone else.</small>
				</div> <!-- form-group end.// -->
                    <input type="text" value="<?php echo $p_id;?>" name="p_id" hidden></lable>
			    <div class="form-group">
			        <button type="submit" class="btn btn-primary btn-block" id="button"> Login  </button>
			    </div> <!-- form-group// --> 
                
			</form>
		</article><!-- card-body.// -->
    </div> <!-- card .// -->

    <br><br>
<!-- ============================ COMPONENT REGISTER  END.// ================================= -->


</section>
<!-- ========================= SECTION CONTENT END// ========================= -->


<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top padding-y">
	<div class="container">
		<p class="float-md-right"> 
			&copy Copyright 2019 All rights reserved
		</p>
		<p>
			<a href="#">Terms and conditions</a>
		</p>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->

<script>
var queryString = window.location.search;
console.log(queryString);
var urlParams = new URLSearchParams(queryString);
var verify = urlParams.get('verify');

    
if( verify =="no"){

    document.getElementById("wor_meg").innerHTML = "Password is not correct";
    document.getElementById("password").style.border = "1px solid red";
    document.getElementById("name").style.border = "1px solid red";
}       
    
</script>

</body>
</html>