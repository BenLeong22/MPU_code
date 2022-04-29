<head>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<?php 

session_start();
function connection(){
$DBNAME = "fyp";
$DBUSER = "benleong";
$DBPASSWD = "benleong";
$DBHOST = "localhost";
	
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD,$DBNAME);

return $conn;
}

function getdatabasename(){
    return 'fyp';
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

function getheader(){
    $id =getsession("u_id");
    if($id != ""){
        echo '<header class="main_header_area headerstye-1">
        <!-- Navigation Bar -->
        <div class="header_menu" id="header_menu">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-flex d-flex align-items-center justify-content-between w-100 pb-2 pt-2">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="navbar-brand" href="index.php">
                                <img src="images/logo-white.png" alt="image">
                                <img src="images/logo.png" alt="image">
                            </a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="navbar-collapse1 d-flex align-items-center" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav" id="responsive-menu">
                                <li class="dropdown submenu">
                                    <a href="index.php" class="dropdown-toggle">Home </a>

                                </li>

                                <li><a href="weather.php">weather</a></li>
                                <li class="submenu dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <i class="icon-arrow-down" aria-hidden="true"></i></a> 
                                    <ul class="dropdown-menu">
                                        <li><a href="booking.html">Booking</a></li>
                                        <li><a href="confirmation.html">Confirmation</a></li>
                                        <li class="submenu dropdown">
                                            <a href="gallery.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gallery<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="gallery.html">Gallery</a></li>
                                                <li><a href="gallery1.html">Gallery Masonry</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu dropdown">
                                            <a href="404.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Error<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="404.html">Error Page 1</a></li>
                                                <li><a href="404-1.html">Error Page 2</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu dropdown">
                                            <a href="comingsoon.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Comming Soon<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="comingsoon.html">Coming Soon 1</a></li>
                                                <li><a href="comingsoon-1.html">Coming Soon 2</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="shop-grid1.html">Right Grid</a></li>
                                                <li><a href="shop-list1.html">Right List</a></li>
                                                <li><a href="shop-detail.html">Shop Single One</a></li>
                                                <li><a href="cart.html">Cart</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="login.html">Account</a></li>
                                                <li><a href="wishlist.html">Wishlist</a></li>
                                                <li><a href="forgot-password.html">Forgot Password</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="faq.html">Faq</a></li>
                                        <li><a href="testimonial.html">Testimonials</a></li>
                                        <li><a href="pricing.html">Pricing</a></li>
                                    </ul> 
                                </li>

                                <li class="submenu dropdown active">
                                    <a href="destination.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Attractions<i class="icon-arrow-down" aria-hidden="true"></i></a> 
                                    <ul class="dropdown-menu">
                                        <li><a href="destination-left.php">All attractions</a></li>
                                        <li><a href="destination-list.html">Destination Right</a></li>
                                        <li><a href="destination-masonry.html">Destination Masonry</a></li>
                                        <li class="submenu dropdown">
                                            <a href="destination-single.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Destination Single<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="destination-single.html">Destination Single 1</a></li>
                                                <li><a href="destination-single1.html">Destination Single 2</a></li>
                                                <li><a href="destination-single-full.html">Destination Single Full</a></li>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li>

                                <li class="submenu dropdown">
                                    <a href="blog-home.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blogs <i class="icon-arrow-down" aria-hidden="true"></i></a> 
                                    <ul class="dropdown-menu">
                                        <li><a href="blog-full.php">Blog List</a></li>
                                      
                                    </ul> 
                                </li>  
                                <li class="submenu dropdown">
                                    <a href="dashboard.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dashboard <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
                                    <ul class="dropdown-menu">
                                        <li><a href="dashboard.html">Dashboard</a></li>
                                        <li><a href="dashboard-my-profile.html">User Profile</a></li>
                                        <li><a href="dashboard-list.html">User Wishlist</a></li>
                                        <li><a href="dashboard-messages.html">User Messages</a></li>
                                        <li><a href="dashboard-history.html">Booking History</a></li>
                                        <li><a href="dashboard-add-new.html">Add New</a></li>
                                        <li><a href="dashboard-list.html">Tour List</a></li>
                                        <li><a href="dashboard-reviews.html">Dashboard Reviews</a></li>
                                    </ul>
                                </li> 
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>

                        </div><!-- /.navbar-collapse -->   
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" onclick=popitup("chat.php") aria-expanded="false">
                                    <i class="far fa-comment-dots"></i> Message
                                </button>
                        <div class="register-login"><a href="dashboard-my-profile.php"> 
                        
                            <div class="dropdown">
                               <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" aria-expanded="false">
                                    <i class="fa fa-user-circle"></i> My Account
                                </button>
                                

                            </div>
                            </a>
                        </div>
                        
                    </div>
                </div><!-- /.container-fluid --> 
                
            </nav>
        </div>
        <!-- Navigation Bar Ends -->
    </header>';
    }
    else {
	echo '     <header class="main_header_area headerstye-1">
        <!-- Navigation Bar -->
        <div class="header_menu" id="header_menu">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-flex d-flex align-items-center justify-content-between w-100 pb-2 pt-2">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="navbar-brand" href="index.php">
                                <img src="images/logo-white.png" alt="image">
                                <img src="images/logo.png" alt="image">
                            </a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="navbar-collapse1 d-flex align-items-center" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav" id="responsive-menu">
                                <li class="dropdown submenu">
                                    <a href="index.php" class="dropdown-toggle">Home </a>

                                </li>

                                 <li><a href="Weather.php">Weather</a></li>
                                <li class="submenu dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <i class="icon-arrow-down" aria-hidden="true"></i></a> 
                                    <ul class="dropdown-menu">
                                        <li><a href="booking.html">Booking</a></li>
                                        <li><a href="confirmation.html">Confirmation</a></li>
                                        <li class="submenu dropdown">
                                            <a href="gallery.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gallery<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="gallery.html">Gallery</a></li>
                                                <li><a href="gallery1.html">Gallery Masonry</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu dropdown">
                                            <a href="404.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Error<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="404.html">Error Page 1</a></li>
                                                <li><a href="404-1.html">Error Page 2</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu dropdown">
                                            <a href="comingsoon.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Comming Soon<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="comingsoon.html">Coming Soon 1</a></li>
                                                <li><a href="comingsoon-1.html">Coming Soon 2</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="shop-grid1.html">Right Grid</a></li>
                                                <li><a href="shop-list1.html">Right List</a></li>
                                                <li><a href="shop-detail.html">Shop Single One</a></li>
                                                <li><a href="cart.html">Cart</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="login.html">Account</a></li>
                                                <li><a href="wishlist.html">Wishlist</a></li>
                                                <li><a href="forgot-password.html">Forgot Password</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="faq.html">Faq</a></li>
                                        <li><a href="testimonial.html">Testimonials</a></li>
                                        <li><a href="pricing.html">Pricing</a></li>
                                    </ul> 
                                </li>

                                <li class="submenu dropdown active">
                                    <a href="destination.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Attractions<i class="icon-arrow-down" aria-hidden="true"></i></a> 
                                    <ul class="dropdown-menu">
                                        <li><a href="destination-left.php">All attractions</a></li>
                                        <li><a href="destination-list.html">Destination Right</a></li>
                                        <li><a href="destination-masonry.html">Destination Masonry</a></li>
                                        <li class="submenu dropdown">
                                            <a href="destination-single.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Destination Single<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="destination-single.html">Destination Single 1</a></li>
                                                <li><a href="destination-single1.html">Destination Single 2</a></li>
                                                <li><a href="destination-single-full.html">Destination Single Full</a></li>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li>

                                <li class="submenu dropdown">
                                    <a href="blog-home.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blogs <i class="icon-arrow-down" aria-hidden="true"></i></a> 
                                    <ul class="dropdown-menu">
                                        <li><a href="blog-list.html">Blog List</a></li>
                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                        <li><a href="blog-full.html">Blog Fullwidth</a></li>
                                        <li><a href="blog-left.html">Blog Left</a></li>
                                        <li><a href="blog-list.html">Blog Right</a></li>
                                        <li><a href="blog-masonry.html">Blog Masonry</a></li>
                                        <li><a href="blog-single.html">Blog Single</a></li>
                                        <li><a href="blog-single-full.html">Blog Single Full</a></li>
                                    </ul> 
                                </li>  
                                <li class="submenu dropdown">
                                    <a href="dashboard.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dashboard <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
                                    <ul class="dropdown-menu">
                                        <li><a href="dashboard.html">Dashboard</a></li>
                                        <li><a href="dashboard-my-profile.html">User Profile</a></li>
                                        <li><a href="dashboard-list.html">User Wishlist</a></li>
                                        <li><a href="dashboard-messages.html">User Messages</a></li>
                                        <li><a href="dashboard-history.html">Booking History</a></li>
                                        <li><a href="dashboard-add-new.html">Add New</a></li>
                                        <li><a href="dashboard-list.html">Tour List</a></li>
                                        <li><a href="dashboard-reviews.html">Dashboard Reviews</a></li>
                                    </ul>
                                </li> 
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                            <div class="header_sidemenu">
                                <div class="mhead">
                                    <span class="menu-ham">
                                      
                                    </span>
                                </div>
                            </div>
                        </div><!-- /.navbar-collapse -->   

                        <div class="register-login">
                            <a href="register.php"><i class="icon-user mr-1"></i> Register</a>
                            <a href="login.php"><i class="icon-login mr-1"></i> Login</a>
                        </div>   
                        <div id="slicknav-mobile"></div>
                    </div>
                </div><!-- /.container-fluid --> 
            </nav>
        </div>
        <!-- Navigation Bar Ends -->
    </header>';
	
    }
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

function getheaderslider(){
    echo '<div class="header_sidemenu">
        <div class="header_sidemenu_in">
            <div class="menu">
                <div class="close-menu">
                    <i class="fa fa-times white"></i>
                </div>
                 <div class="m-contentmain">
                    <div class="cart-main">
                        <div class="cart-box">
                            <div class="popup-container">
                                <h5 class="p-3 mb-0 bg-pink white text-caps">My Carts(3 Items)</h5>
                                <div class="cart-entry d-flex align-items-center p-3">
                                    <a href="#" class="image">
                                        <img src="images/shop/shop1.jpg" alt="">
                                    </a>
                                    <div class="content">
                                        <a href="#" class="title font-weight-bold">Pullover Batwing</a>
                                        <p class="quantity m-0">Quantity: 3</p>
                                        <span class="price">$45.00</span>
                                    </div>
                                    <div class="button-x">
                                        <i class="icon-close"></i>
                                    </div>
                                </div>
                                <div class="cart-entry d-flex align-items-center p-3">
                                    <a href="#" class="image">
                                        <img src="images/shop/shop2.jpg" alt="">
                                    </a>
                                    <div class="content">
                                        <a href="#" class="title font-weight-bold">Pullover Batwing</a>
                                        <p class="quantity m-0">Quantity: 3</p>
                                        <span class="price">$90.00</span>
                                    </div>
                                    <div class="button-x">
                                        <i class="icon-close"></i>
                                    </div>
                                </div>
                                <div class="cart-entry d-flex align-items-center p-3">
                                    <a href="#" class="image">
                                        <img src="images/shop/shop6.jpg" alt="">
                                    </a>
                                    <div class="content">
                                        <a href="#" class="title font-weight-bold">Pullover Batwing</a>
                                        <p class="quantity m-0">Quantity: 3</p>
                                        <span class="price">$90.00</span>
                                    </div>
                                    <div class="button-x">
                                        <i class="icon-close"></i>
                                    </div>
                                </div>
                                <div class="summary-total">
                                    <div class="summary d-flex align-items-center justify-content-between">
                                        <div class="subtotal font-weight-bold">Delivery Charge</div>
                                        <div class="price-s">$10</div>
                                    </div>
                                    <div class="summary d-flex align-items-center justify-content-between">
                                        <div class="subtotal font-weight-bold">Sub Total</div>
                                        <div class="price-s">$200</div>
                                    </div>
                                    <div class="summary d-flex align-items-center justify-content-between">
                                        <div class="subtotal font-weight-bold">Discount</div>
                                        <div class="price-s">$2</div>
                                    </div>
                                    <div class="summary d-flex align-items-center justify-content-between">
                                        <div class="subtotal font-weight-bold">Total</div>
                                        <div class="price-s">$208</div>
                                    </div>
                                </div>
                                <div class="cart-buttons d-flex align-items-center justify-content-between">
                                    <a href="#" class="nir-btn">View Cart</a>
                                    <a href="logout.php" class="nir-btn-black">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="overlay hide"></div>
        </div>
    </div>';
    
    
    

    
    
    
}


?>

