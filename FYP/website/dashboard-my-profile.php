<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">
<?php
include 'functionset.php';
$DBNAME = getdatabasename();
$conn = connection();   
    ?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Yatriiworld - Travel and Tours Booking Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!--Custom CSS-->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!--Plugin CSS-->
    <link href="css/plugin.css" rel="stylesheet" type="text/css">
    <!--ashboard CSS-->
    <link href="css/dashboard.css" rel="stylesheet" type="text/css">
    <!--Flaticons CSS-->
    <link href="fonts/flaticon.css" rel="stylesheet" type="text/css">
    <!--Icons CSS-->
    <link href="css/icons.css" rel="stylesheet" type="text/css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <link rel="stylesheet" href="fonts/line-icons.css" type="text/css">
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div id="status"></div>
    </div>
    <!-- Preloader Ends -->

    <!-- header starts -->
       <?php echo getheader();
       
    ?>
    <?php
        $id =$_SESSION['u_id'];

    
        $sql ='SELECT * from user where U_id= "'.$id.'"';
        
        $result = mysqli_query($conn,$sql);

        $row =mysqli_fetch_array($result);
        $username= $row["U_name"];
        $usermail= $row["U_email"];
        $userDOB= $row["U_DOB"];
        $usergender= $row["U_gender"];
        $userphone = $row["U_phone"];
        $userdescribe =$row["U_describe"];
        if($row["U_image"]!=""){
           $userimage=$row["U_image"];
            $usericon=$row["U_image"];
        }else{
            $userimage="images/user-avatar.jpg";
            $usericon="images/team/img1.jpg";
        }

    ?>
    <!-- header ends -->

    <!-- BreadCrumb Starts -->  
    <section class="breadcrumb-main pb-2" style="background-image: url(images/bg/bg8.jpg);">
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends --> 

    <!-- Dashboard -->
    <div id="dashboard" class="pt-10 pb-10">
        <div class="container">
            <div class="dashboard-main">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="dashboard-sidebar">
                            <div class="profile-sec">
                                <div class="author-news mb-3">
                                    <div class="author-news-content text-center p-3">
                                        <div class="author-thumb mt-0">
                                            <img src="<?php echo $usericon?>" alt="author">
                                        </div>
                                        <div class="author-content pt-2 p-0">
                                            <h3 class="mb-1 white"><a href="#" class="white"><?php echo $username?></a></h3>
                                            <p class="detail"><i class="fa fa-map-marker"></i> <?php echo $usermail?></p>
                                            <p class="detail"><i class="fa fa-phone"></i> <?php echo $userphone?></p>
                                            <div class="header-social mt-2">
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dot-overlay"></div>
                                </div>
                            </div>
                            <!-- Responsive Navigation Trigger -->
                            <a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>  
                            <div class="dashboard-nav">
                                <div class="dashboard-nav-inner">
                                    <ul>
                                        <li><a href="dashboard.html"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                                        <li class="active"><a href="dashboard-my-profile.html"><i class="sl sl-icon-user"></i> Profile</a></li>                     
                                        <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
                                        <li><a href="dashboard-reviews.html"><i class="sl sl-icon-star"></i> Reviews</a></li>
                                        <li><a href="dashboard-add-new.html"><i class="sl sl-icon-plus"></i> Add listing</a></li>
                                        <li><a href="dashboard-list.html"><i class="sl sl-icon-layers"></i> Listing</a></li>
                                        <li><a href="dashboard-history.html"><i class="fa fa-list-ul"></i>Booking History</a></li>
                                        <li><a href="logout.php"><i class="sl sl-icon-power"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">    
                        <div class="dashboard-content">
                            <div class="dashboard-form mb-4">
                                <div class="row">

                                    <!-- Profile -->
                                    <div class="col-lg-6 col-md-6 col-xs-12 padding-right-30">
                                        <div class="dashboard-list">
                                            <h4 class="gray">Profile Details</h4>
                                            <div class="dashboard-list-static">
                                                
                                                <form method="post" action="dashboard-upload.php" enctype="multipart/form-data">
                                                    
                                                <div class="edit-profile-photo">
                                                    <img src="<?php echo $userimage ?>" alt="" id="blah">
                                                    <div class="change-photo-btn">
                                                        <div class="photoUpload">
                                                            <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                            <input type="file" class="upload" name="file123" id="file123"/>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                        <label>Your Describe</label>
                                                        <input value="<?php echo $userdescribe ?>" type="text" name="describe" >
                                                    </div>
                                                <!-- Details -->
                                                
                                                <div class="my-profile">
                                                    <div class="form-group">
                                                        <label>Your Name *</label>
                                                        <input value=" <?php echo $username ?>" type="text" name="name">
                                                    </div>                    
                                                    <div class="form-group">
                                                        <label>Phone Number *</label>
                                                        <input value="<?php echo $userphone ?>" type="text" name="phone">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email Address *</label>
                                                        <input value="<?php echo $usermail ?>" type="text" name="email" >
                                                    </div>

                                                </div>
                            
                                                <div class="form-btn">

                                                    <input type="submit" class="nir-btn" name="submit">

                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Change Password -->
                                    <div class="col-lg-6 col-md-6 col-xs-12 padding-left-30">
                                        <div class="dashboard-list margin-top-0">

                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="dashboard-form mb-4">
                                <div class="dashboard-password">
                                    <h4>Change Password</h4>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Current Password</label>
                                                    <input type="password" placeholder="*********">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Re-enter Password</label>
                                                    <input type="password">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-btn mar-top-15">
                                                    <a href="#" class="nir-btn">SAVE CHANGE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>    
            </div>    
            <!-- Content / End -->
        </div>
    </div>
    <!-- Dashboard / End -->

    <!-- footer starts -->
    <footer style="background-image:url(images/bg/bg3.jpg);" class="pt-10 ">
        <div class="footer-upper pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                        <div class="footer-links">
                            <img src="images/logo-white.png" alt="">
                            <p class="mt-3">
                                In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna
                            </p>
                            <ul>
                                <li><strong>PO Box:</strong> +47-252-254-2542</li>
                                <li><strong>Location:</strong> Collins Street, sydney, Australia</li>
                                <li><strong>Email:</strong> info@Yatriiworld.com</li>
                                <li><strong>Website:</strong> www.Yatriiworld.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mb-4">
                        <div class="footer-links">
                            <h4 class="white">Company</h4>
                            <ul>
                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mb-4">
                        <div class="footer-links">
                            <h4 class="white">Services</h4>
                            <ul>
                                <li><a href="#">Payment</a></li>
                                <li><a href="#">Feedback</a></li>
                                <li><a href="#">Contact us</a></li>
                                <li><a href="#">Our Service</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Site map</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                        <div class="footer-links">
                            <h4 class="white">Newsletter</h4>
                            <p>Want to be notified when we launch a new template or an udpate. Just sign up and we'll send you a notification by email.</p>
                            <div class="newsletter-form">
                                <form>
                                    <input type="email" placeholder="Enter your email">
                                    <input type="submit" class="nir-btn mt-2 w-100" value="Subscribe">
                                </form>
                            </div> 
                        </div>     
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-payment">
            <div class="container">
                <div class="footer-pay d-md-flex align-items-center justify-content-between pt-2 pb-2">
                    <div class="footer-payment-nav">
                        <ul class="d-md-flex align-items-center">
                            <li class="mr-2">We Support:</li>
                            <li class="mr-2"><i class="fab fa-cc-mastercard"></i></li>
                            <li class="mr-2"><i class="fab fa-cc-paypal"></i></li>
                            <li class="mr-2"><i class="fab fa-cc-stripe"></i></li>
                            <li class="mr-2"><i class="fab fa-cc-visa"></i></li>
                            <li class="mr-2"><i class="fab fa-cc-discover"></i></li>
                        </ul>
                    </div>
                    <div class="footer-payment-nav mb-0">
                        <ul>
                            <li>
                                <select>
                                    <option>English (United States)</option>
                                    <option>English (United States)</option>                                
                                    <option>English (United States)</option>
                                    <option>English (United States)</option>
                                    <option>English (United States)</option>
                                </select>
                            </li>
                            <li>
                                <select>
                                    <option>$ USD</option>
                                    <option>$ USD</option>
                                    <option>$ USD</option>
                                    <option>$ USD</option>
                                    <option>$ USD</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>    
            </div>
        </div>
        <div class="footer-copyright pt-2 pb-2">
            <div class="container">
                <div class="copyright-inner d-md-flex align-items-center justify-content-between">
                    <div class="copyright-text">
                        <p class="m-0 white">2020 Yatriiworld. All rights reserved.</p>
                    </div>
                    <div class="social-links">
                        <ul>  
                            <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>    
            </div>
        </div>
        <div class="overlay"></div>
    </footer>
    <!-- footer ends -->
    
    <!-- Back to top start -->
    <div id="back-to-top">
        <a href="#"></a>
    </div>
    <!-- Back to top ends -->

    <div class="header_sidemenu">
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
                                    <a href="#" class="nir-btn-black">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="overlay hide"></div>
        </div>
    </div>
    <!-- *Scripts* -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/main.js"></script>
    <script src="js/custom-nav.js"></script>
    <script src="js/jpanelmenu.min.js"></script>
    <script src="js/dashboard-custom.js"></script>
        <script>

file123.onchange = evt => {
  const [file] = file123.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
            
</script> 
</body>
</html>
