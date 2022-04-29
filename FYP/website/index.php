<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">
<?php
    include 'functionset.php';
    ?>
<style>
#mydiv {
  position: fixed;
  z-index: 9;
  top: 120px;
  weight:100%;
    left: 50%;
    margin-top: -50px;
    margin-left: -50px;
}

/*
#mydivheader {
  padding: 10px;
  cursor: move;
  z-index: 10;
  background-color: #2196F3;
  color: #fff;
  border-radius: 500px;
}
    
*/
#mydiv {
  position:fixed;
  /* more styles */
}
    
    #image1{
        border-radius: 500px;
        width: 50px;
    }
    
</style>
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
    <!--Flaticons CSS-->
    <link href="fonts/flaticon.css" rel="stylesheet" type="text/css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

<script language="javascript" type="text/javascript">

    
function popitup(url) {
    console.log("tset");
newwindow=window.open(url, 'liveMatches', 'width=700,height=700,toolbar=no,location=5, directories=no, status=no, menubar=no,status=no,menubar=0,scrollbars=no,resizable=no');
if (window.focus) {newwindow.focus()}
return false;
}
    

</script>


</head>
<body>
    <!-- Preloader -->
    
    <div id="preloader">
        <div id="status"></div>
    </div>
    <!-- Preloader Ends -->

    <!-- header starts -->  
    <?php echo getheader();?>
    
    <!-- header ends -->
    
    <!-- banner starts -->
    <section class="banner overflow-hidden">

        <div class="slider slider1">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-inner">
                           <div class="slide-image" style="background-image:url(images/slider/4.jpg)"></div>
                           <div class="swiper-content1 container">
                                <h4 class="white">Choose The Best Destination</h4>
                                <h1 class="white mb-4">Make Your Trip Fun And Memorable Where You Want</h1>
                                <a href="#" class="per-btn">
                                    <span class="white">Discover</span>YO
                                    <i class="fa fa-arrow-right white"></i>
                                </a>
                            </div>
                            <div class="dot-overlay"></div>
                        </div> 
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-image" style="background-image:url(images/slider/5.jpg)"></div>
                            <div class="swiper-content1 container">
                                <h4 class="white">Feel Free To Travel</h4>
                                <h1 class="white mb-4">Discover Your Beautiful <span>Travel</span> With Us</h1>
                                <a href="#" class="per-btn">
                                  <span class="white">Discover</span>
                                  <i class="fa fa-arrow-right white"></i>
                                </a>
                            </div>
                            <div class="dot-overlay"></div>
                        </div> 
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-inner">
                           <div class="slide-image" style="background-image:url(images/slider/9.jpg)"></div>
                           <div class="swiper-content1 container">
                                <h4 class="white">Trip For Your Kids</h4>
                                <h1 class="white mb-4"><span>Sensation Ice Trip</span> Is Coming For Kids</h1>
                                <a href="#" class="per-btn">
                                  <span class="white">Discover</span>
                                  <i class="fa fa-arrow-right white"></i>
                                </a>
                            </div>
                            <div class="dot-overlay"></div>
                            
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- banner ends -->
<?php $tomorrow = date("Y-m-d", time() + 86400);
      $after15day =date("Y-m-d", time() + 1209600)
    

    ?>


    <form action="test.php" method="GET" role="form" class="form-horizontal">
    <div class="form-main">
        <div class="container">
            <div class="form-content w-100"> 
                <h3 class="form-title text-center d-inline white">Find a Places</h3>
                <div class="d-lg-flex align-items-center justify-content-between">
                    <div class="form-group pr-4 m-0">
                        <p>日期</p>
                        
                        <div class="input-box">
                            <i class="fa fa-clock"></i>
                            <input type="date" id="day" name="trip_start"
                           value="<?php echo $tomorrow ?>"
                            
                           min="<?php echo $tomorrow?>" max="<?php echo $after15day ?>">
                        </div>                            
                    </div>
                    <div class="form-group pr-4 m-0">
                        <p>開始時間</p>
                        <div class="input-box">
                            <i class="fa fa-clock"></i>
                               <input type="time" id="starttime" name="user_input_start" min="00:00" max="24:00" value="09:00" required>
                        </div>                            
                    </div>

                    <div class="form-group pr-4 m-0">
                        <p>結束時間</p>
                         <div class="input-box">
                            <i class="fa fa-clock"></i>
                               <input type="time" id="endtime" name="user_input_end" min="00:00" max="24:00" value="15:00" required>
                        </div>                           
                    </div>

                    <div class="form-group pr-4 m-0">
                        <p>預算</p>
                        <div class="input-box">
                            <i class="fa fa-clock"></i>
                            <input type="number" id="budget" name="user_input_budget" value="500" min="0" max="10000">
                        </div>                             
                    </div>
                    <div class="form-group pr-4 m-0">
                        <p>成人</p>
                        <div class="input-box">
                            <i class="fa fa-clock"></i>
                            <input type="number" id="user_input_child" name="user_input_adult" value="2" min="1" max="10000">
                        </div>                             
                    </div>
                    
                    <div class="form-group pr-4 m-0">
                        <p>小孩</p>
                        <div class="input-box">
                            <i class="fa fa-clock"></i>
                            <input type="number" id="budget" name="user_input_child" min="1" max="10000" value="1">
                        </div>                             
                    </div>
                    

                    <div class="form-group m-0">
                       <br>
                     
                        <input type="submit" class="nir-btn w-100" >
                   
<!--                        <a href="#" class="nir-btn w-100"><i class="fa fa-search"></i> Check Availability</a>-->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
     </form>
<?php
$xml =simplexml_load_file("test.xml");
$xml =$xml;

$message =$xml->Custom->SpecialInfoReport->TTS->English;

?>
<div id="mydiv" >
<?php 
    if($message!=""){
        echo '  <button type="button" class="btn btn-warning rounded-100px"><h2 class="text-dark">Notics</h2> <p class="text-dark">'.$message.'</p></button>';
    }
    ?>


    
</div>
    

    <!-- why us starts -->
    <section class="why-us pt-10 pb-6">
        <div class="container">
            <div class="why-us-box pt-9">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="why-us-item text-center">
                            <div class="why-us-icon mb-2">
                                <i class="flaticon-call pink"></i>
                            </div>
                            <div class="why-us-content">
                                <h4><a href="#">Advice & Support</a></h4>
                                <p class="mb-0">Travel worry free knowing that we're here if you need us, 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="why-us-item text-center">
                            <div class="why-us-icon mb-2">
                                <i class="flaticon-global pink"></i>
                            </div>
                            <div class="why-us-content">
                                <h4><a href="#">Air Ticketing</a></h4>
                                <p class="mb-0">Travel worry free knowing that we're here if you need us, 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="why-us-item text-center">
                            <div class="why-us-icon mb-2">
                                <i class="flaticon-building pink"></i>
                            </div>
                            <div class="why-us-content">
                                <h4><a href="#">Hotel Services</a></h4>
                                <p class="mb-0">Travel worry free knowing that we're here if you need us, 24 hours a day</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="why-us-item text-center">
                            <div class="why-us-icon mb-2">
                                <i class="flaticon-location-pin pink"></i>
                            </div>
                            <div class="why-us-content">
                                <h4><a href="#">Tour Packages</a></h4>
                                <p class="mb-0">Travel worry free knowing that we're here if you need us, 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- why us ends -->

    <!-- about-us starts -->
  

    <!-- testomonial start -->

    <!-- testimonial ends --> 



    <!-- footer starts -->
    <footer style="background-image:url(images/bg/bg4.jpg);" class="pt-10 bg-navy">
        <div class="footer-upper pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 mb-4">
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
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
                        <div class="footer-links">
                            <h4 class="white">Newsletter</h4>
                            <p>Want to be notified when we launch a new template or an udpate. Just sign up and we'll send you a notification by email.</p>
                            <div class="newsletter-form">
                                <form action="destination-list.php" method="">
                                    <input type="email" placeholder="Enter your email">
                                    <input type="submit" class="nir-btn mt-2 w-100" value="Subscribe">
                                </form>
                            </div> 
                        </div>     
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

    <!-- search popup -->
    <div id="search1">
        <button type="button" class="close">×</button>
        <form>
            <input type="search" value="" placeholder="type keyword(s) here" />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bordernone p-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="login-content p-4 text-center">
                        <div class="login-title section-border">
                            <h3 class="pink mb-1">Register</h3>  
                            <p>Access thousands of online classes in design, business, and more!</p>                  
                        </div>
                        <div class="login-form text-center">
                            <form>
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Full Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="Enter email address">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Enter password">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Confirm password">
                                </div>
                            </form>
                            <div class="form-btn">
                                <a href="#" class="nir-btn">Register</a>
                            </div>
                            <div class="form-group mb-0 form-checkbox mt-3">
                                <input type="checkbox"> By clicking this, you are agree to to<a href="#" class=""> our terms of use</a> and <a href="#" class="">privacy policy</a> including the use of cookies
                            </div>
                        </div>
                        <div class="login-social border-t mt-3 pt-2 mb-3">
                            <p class="mb-2">OR continue with</p>
                            <a href="#" class="btn-facebook"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a>
                            <a href="#" class="btn-twitter"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a>
                            <a href="#" class="btn-google"><i class="fab fa-google" aria-hidden="true"></i> Google</a>
                        </div>
                        <div class="sign-up">
                            <p class="m-0">Already have an account? <a href="login.html" class="pink">Login</a></p>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- login Modal -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bordernone p-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="login-content p-4 text-center">
                        <div class="login-title section-border">
                            <h3 class="pink">Login</h3>                    
                        </div>
                        <div class="login-form">
                            <form>
                                <div class="form-group">
                                    <input type="email" placeholder="Enter email address">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Enter password">
                                </div>
                            </form>
                            <div class="form-btn">
                                <a href="#" class="nir-btn">LOGIN</a>
                            </div>
                            <div class="form-group mb-0 form-checkbox mt-3">
                                <input type="checkbox"> Remember Me | <a href="#" class="">Forgot password?</a>
                            </div>
                        </div>
                        <div class="login-social border-t mt-3 pt-2 mb-3">
                            <p class="mb-2">OR continue with</p>
                            <a href="#" class="btn-facebook"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a>
                            <a href="#" class="btn-twitter"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a>
                        </div>
                        <div class="sign-up">
                            <p class="m-0">Do not have an account? <a href="login.html" class="pink">Sign Up</a></p>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php echo getheaderslider() ?>
    <!-- *Scripts* -->
    
    <div class="row pop-up">
  <div class="box small-6 large-centered">
    <a href="#" class="close-button">&#10006;</a>
    <h3>Welcome</h3>
    <p>You can find more interesting information on our community website</p>
    <p>http://BigTribe.net- community for those for whom IT - is not simply two letters of the alphabet.</p>
    <a href="#" class="button">Continue</a>
  </div>
</div>
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/main.js"></script>
    <script src="js/custom-swiper.js"></script>
    <script src="js/custom-nav.js"></script>
    <script>
//Make the DIV element draggagle:
dragElement(document.getElementById("mydiv"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
        
$(function() {
$('.pop-up').hide();
$('.pop-up').fadeIn(1000);
$('.close-button').click(function (e) {
$('.pop-up').fadeOut(700);
$('#overlay').removeClass('blur-in');
$('#overlay').addClass('blur-out');
e.stopPropagation();
});
});
</script>

    
</body>
</html>