<head>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<?php 


function connection(){
$DBNAME = "isi_test";
$DBUSER = "benleong";
$DBPASSWD = "benleong";
$DBHOST = "localhost";
	
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD);

return $conn;
}

function getdatabasename(){
    return 'isi_test';
}

function getelement($element){
    if(isset($_GET[$element])){
	  return $_GET[$element];
    }
    else {
        return "";
     }
}

function getsession($session){
    if(isset($_SESSION[$session])){
	  return $_SESSION[$session];
    }
    else {
        return "";
     }
}

function getheader($name,$item,$o_item,$noti){
    if($name !=""){
	if($name !="admin"){
	echo '  <span class="text-muted" >Welcome! </span>'.$name.'<br>
			
            <div class="widget-header  mr-3">
    		
								
            <a href="shoppingcart.php" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
          
				<span class="badge badge-pill badge-danger notify">'.$item.'</span>
			</div>
    
            <div class="widget-header  mr-3">
    
            <a href="nofinication.php" class="icon icon-sm rounded-circle border"><i class="far fa-envelope"></i></a>
          
				<span class="badge badge-pill badge-danger notify">'.$noti.'</span>
			</div>
                        
                        
            <div class="widget-header  mr-3">
    
            <a href="purchaseorder.php" class="icon icon-sm rounded-circle border"><i class="fa fa-file" aria-hidden="true"></i></a>
          
				<span class="badge badge-pill badge-danger notify">'.$o_item.'</span>
			</div>
            
			<div class="widget-header icontext">

            <a href="profile.php" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
				</div>

            <div class="widget-header icontext">
            <a href="logout.php" class="icon icon-sm rounded-circle border"><i class="fas fa-sign-out-alt"></i></a>
				</div>';
		}
		else {
			echo '  <span class="text-muted" >Welcome! </span>'.$name.'<br>
			
    
            <div class="widget-header  mr-3">
    
            <a href="report.php" class="icon icon-sm rounded-circle border"> <i class="large material-icons">insert_chart</i></a>
          
				<span class="badge badge-pill badge-danger notify">0</span>
			</div>
                        
                        
            <div class="widget-header  mr-3">
    
            <a href="vendor_purchaseorder.php" class="icon icon-sm rounded-circle border"><i class="fa fa-file" aria-hidden="true"></i></a>
          
				<span class="badge badge-pill badge-danger notify">'.$o_item.'</span>
			</div>
            
			<div class="widget-header icontext">

            <a href="profile.php" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
				</div>
				
        
            <div class="widget-header icontext">
            <a href="logout.php" class="icon icon-sm rounded-circle border"><i class="fas fa-sign-out-alt"></i></a>
				</div>';
		}
            
        }
        else {echo '<div class="text">
					<span class="text-muted">Welcome! New User</span>
					<div> 
						<a href="login.php">Sign in</a> |  
						<a href="register.php"> Register</a>
					</div>
				</div>';}
}

function sendmail($tittle,$message,$user){
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "admin@ipmer.net";
    $to = $user;
    $subject = $tittle;
    $message = $message;
    $headers = "From:" . $from;
    if(mail($to,$subject,$message, $headers)) {
		echo "The email message was sent.";
    } else {
    	echo "The email message was not sent.";
    }
}

?>

