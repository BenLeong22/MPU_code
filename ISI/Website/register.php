<!DOCTYPE HTML>
<?php 
session_start();
include 'functionset.php';

if(isset($_POST['name'])){
    $name =$_POST['name'];
}else{
    $name ="";
}
$item=0;
$o_item=0;
$searching  = getelement("searching"); 
if($_SERVER["REQUEST_METHOD"] == "POST"){
$name = $_POST['name'];
$pw = $_POST['pw'];
$email = $_POST['email'];
$address = $_POST['address'];

	
$DBNAME = getdatabasename();
$conn = connection();
if( !mysqli_select_db($conn,$DBNAME)) {
  die ("Cannot connect the database");
}
    
$options = [
    'cost' => 12,
];    
$pw = password_hash($pw, PASSWORD_BCRYPT, $options);

$sql = "INSERT INTO `user`(`u_id`, `name`, `email`, `password`, `address`) VALUES ('','$name','$email','$pw','$address')";
$result = mysqli_query($conn, $sql);

    
$sql ='SELECT * from user where name= "'.$name.'"';
$result = mysqli_query($conn,$sql);
    
$row =mysqli_fetch_array($result);
$_SESSION["u_id"] =$row["u_id"];
echo $row["u_id"];
$_SESSION['name'] = $name;
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
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
    
    
function check() {
    	var name = document.getElementById("name").value;
    	var email = document.getElementById("email").value;
    	var password = document.getElementById("password").value;
    	var c_password = document.getElementById("c_password").value;
    	var address = document.getElementById("address").value;
    
        var b_name,b_email,b_password,b_c_password,b_address =false;
        
        if(password != c_password ){
            document.getElementById("wor_meg").innerHTML = "Password not match";
            document.getElementById("wor_meg1").innerHTML = "Password not match"; 
            b_password =false;
        }
        else {
            document.getElementById("wor_meg").innerHTML = "";
            document.getElementById("wor_meg1").innerHTML = ""; 
            b_password =true;
        }
    
        var re = /(?=.*\d)(?=.*[A-Z]).{6,}/;
        if(re.test(password)){
            var checkformat =true;
        }
    
        if(name !="" && email!="" && b_password==true && c_password!="" && address!=""&& checkformat==true){
            document.getElementById('button').disabled = false;
        }
        else{
            document.getElementById('button').disabled = true;
        }
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
        getheader($name,$item,$o_item,"");
                
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
		<header class="mb-4"><h4 class="card-title">Sign up</h4></header>
		<form action="register.php" method="post">
				<div class="form-group">
					<label>User Name:</label>
					<input type="text" class="form-control" placeholder="" oninput="check()" id="name" name="name">
					<small class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div> <!-- form-group end.// -->
    
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" placeholder="" oninput="check()" id="email" name="email">
					<small class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div> <!-- form-group end.// -->
            
                
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" placeholder="" oninput="check()" id="password" name="pw">
                <small class="form-text text-muted" id="wor_meg">We'll never share your email with anyone else.</small>
				</div> <!-- form-group end.// -->
            
				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" class="form-control" placeholder="" oninput="check()" id="c_password">
					<small class="form-text text-muted" id="wor_meg1">We'll never share your email with anyone else.</small>
				</div> <!-- form-group end.// -->
            
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control" placeholder="" oninput="check()" id="address" name="address">
					<small class="form-text text-muted" >We'll never share your email with anyone else.</small>
				</div> <!-- form-group end.// --> 
  
			    <div class="form-group">
			        <button type="submit" class="btn btn-primary btn-block" disabled id="button"> Register  </button>
			    </div> <!-- form-group// -->      
			</form>
		</article><!-- card-body.// -->
    </div> <!-- card .// -->
    <p class="text-center mt-4">Have an account? <a href="login.php">Log In</a></p>
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



</body>
</html>