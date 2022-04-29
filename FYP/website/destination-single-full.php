<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">
<?php
include 'functionset.php';
    
$conn =connection();
    
$id =$_GET['id'];
$u_id =getsession("u_id");

$sql ="SELECT * FROM attractions INNER JOIN attractions_details ON attractions.A_id = attractions_details.A_id WHERE attractions.A_id='".$id."'";
$result = mysqli_query($conn,$sql);

$submitreview =getelement("submitreview");

if($submitreview !=""){
    $conn = connection();
    $stars= getelement("stars");
    $DBNAME = getdatabasename();
    $conn = connection();
    $comment =getelement("comment");
    $sql = 'INSERT INTO `comment`(`A_id`, `U_id`, `C_star`, `C_content`) VALUES ('.$id.','.$u_id.','.$stars.',"'.$comment.'")';
    $conn->query($sql);
    
}
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
    <!--Flaticons CSS-->
    <link href="fonts/flaticon.css" rel="stylesheet" type="text/css">
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
       <?php
    echo  getheader();
    ?>
    <!-- header ends -->

    <!-- BreadCrumb Starts -->  
    <div class="breadcrumb-main pb-0" style="background-image: url(images/bg/bg8.jpg);">
        <div class="breadcrumb-outer pt-10">
            <div class="container">
                <div class="breadcrumb-content bread-content text-center pt-10">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Attraction Detail Page</li>
                        </ul>
                    </nav>
                    <h2 class="mb-0 white text-uppercase">Attraction Detail Page</h2>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </div>
    <!-- BreadCrumb Ends -->  

    <div class="tabs-navbar1 bg-white sticky1 p-4">
        <div class="row">
            <div class="col-md-12">
                <ul id="tabs" class="nav nav-tabs bordernone">
                    <li class="active"><a data-toggle="tab" href="#description">Highlight</a></li>
                    <li><a data-toggle="tab" href="#iternary">Iternary</a></li>
                    <li><a data-toggle="tab" href="#single-map">Map</a></li>
                    <li><a data-toggle="tab" href="#single-review">Average Reviews</a></li>
                    <li><a data-toggle="tab" href="#single-comments">Comments</a></li>
                    <li><a data-toggle="tab" href="#single-add-review" class="bordernone">Add Reviews</a></li>
                </ul>
            </div>
        </div>
    </div>


    <section class="blog trending destination-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <div class="description-images mb-4">
                            <div class="thumbnail-images">
                                <div class="slider-store">
                                    <div>
                                       <img src="images/bg/bg1.jpg" alt="1">
                                    </div>
                                    <div>
                                        <img src="images/bg/bg2.jpg" alt="1">
                                    </div>
                                    <div>
                                        <img src="images/bg/bg3.jpg" alt="1">
                                    </div>
                                    <div>
                                        <img src="images/bg/bg7.jpg" alt="1">
                                    </div>
                                    <div>
                                        <img src="images/bg/bg8.jpg" alt="1">
                                    </div> 
                                    <div>
                                        <img src="images/bg/bg2.jpg" alt="1">
                                    </div>   
                                </div>
                                <div class="slider-thumbs">
                                    <div>
                                       <img src="images/bg/bg1.jpg" alt="1">
                                    </div>
                                    <div>
                                        <img src="images/bg/bg2.jpg" alt="1">
                                    </div>
                                    <div>
                                        <img src="images/bg/bg3.jpg" alt="1">
                                    </div>
                                    <div>
                                        <img src="images/bg/bg7.jpg" alt="1">
                                    </div>
                                    <div>
                                        <img src="images/bg/bg8.jpg" alt="1">
                                    </div>  
                                    <div>
                                        <img src="images/bg/bg2.jpg" alt="1">
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <?php
                            if (mysqli_num_rows($result) > 0) {
                          // output data of each row
                          while($row = mysqli_fetch_assoc($result)) {
                            $attraction_id= $row["A_id"];
                            $attraction_name= $row["A_name"];
                            $attraction_AD_recommend_time= $row["AD_recommend_time"];
                              $attraction_AD_recommend_time= $row["AD_recommend_time"];
                            $attraction_AD_address= $row["AD_address"];
                            $attraction_AD_description= $row["AD_description"];
                            echo '
                                <div class="description" id="description">
                            <div class="single-full-title border-b mb-2 pb-2">
                                <div class="single-title">
                                    <h3 class="mb-1">'.$attraction_name.'</h3>
                                    <div class="rating-main d-sm-flex align-items-center">
                                        <p class="mb-0 mr-2"><i class="flaticon-location-pin"></i>'.$attraction_AD_address.'</p>
                                        <div class="rating mr-2">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                        </div>
                                        <span>(1,186 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="description-inner mb-2">
                                <h4>Highlight</h4>
                                <p></p>
                            </div>

                            <div class="tour-includes mb-2">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><i class="fa fa-clock-o pink mr-1" aria-hidden="true"></i> 5 Days</td>
                                            <td><i class="fa fa-group pink mr-1" aria-hidden="true"></i> Max People : 26</td>
                                            <td><i class="fa fa-calendar pink mr-1" aria-hidden="true"></i> Jan 18 - Dec 21</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-user pink mr-1" aria-hidden="true"></i> Min Age : 10+</td>
                                            <td><i class="fa fa-map-signs pink mr-1" aria-hidden="true"></i> Pickup : Airport</td>
                                            <td><i class="fa fa-file-alt pink mr-1" aria-hidden="true"></i> Langauge - English, Thai</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="description-inner mb-2">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 mb-2 pr-2">
                                        <div class="desc-box">
                                            <h5 class="mb-1">Departure & Return Location</h5>
                                            <p class="mb-0">John F.K. International Airport(Google Map)</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-2 pl-2">
                                        <div class="desc-box">
                                            <h5 class="mb-1">Bedroom</h5>
                                            <p class="mb-0">4 Bedrooms</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-2 pr-2">
                                        <div class="desc-box">
                                            <h5 class="mb-1">Departure Time</h5>
                                            <p class="mb-0">3 Hours Before Flight Time</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-2 pl-2">
                                        <div class="desc-box">
                                            <h5 class="mb-1">Departure Time</h5>
                                            <p class="mb-0">3 Hours Before Flight Time</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-2 pr-2">
                                        <div class="desc-box">
                                            <h5 class="mb-1">Price Includes</h5>
                                            <ul>
                                                <li><i class="fa fa-check pink mr-1"></i> Air Fares</li>
                                                <li><i class="fa fa-check pink mr-1"></i> 3 Nights Hotel Accomodation</li>
                                                <li><i class="fa fa-check pink mr-1"></i> Tour Guide</li>
                                                <li><i class="fa fa-check pink mr-1"></i> Entrance Fees</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-2 pl-2">
                                        <div class="desc-box">
                                            <h5 class="mb-1">Departure & Return Location</h5>
                                            <ul>
                                                <li><i class="fa fa-close pink mr-1"></i> Guide Service Fee</li>
                                                <li><i class="fa fa-close pink mr-1"></i> Driver Service Fee</li>
                                                <li><i class="fa fa-close pink mr-1"></i> Any Private Expenses</li>
                                                <li><i class="fa fa-close pink mr-1"></i> Room Service Fees</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="description-inner mb-4">
                                <h4>What to Expect</h4>
                                <p>'.$attraction_AD_description.'</p>
                                          
                            </div>
                        </div>
                            ';
                          }
                        } else {
                          echo "0 results";
                        }
                            ?>
                        

                        <div class="accrodion-grp faq-accrodion mb-4" id="iternary" data-grp-name="faq-accrodion">
                            <h4>Iternary</h4>
                            <div class="accrodion active">
                                <div class="accrodion-title">
                                    <h5 class="mb-0"><span>Day 1</span> - Barcelona - Zaragoza - Madrid</h5>
                                </div>
                                <div class="accrodion-content" style="display: block;">
                                    <div class="inner">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, inventore cumque veniam, praesentium velit incidunt rem quas a, quos eos ipsum, reprehenderit voluptatem.</p>
                                    </div><!-- /.inner -->
                                </div>
                            </div>
                            <div class="accrodion ">
                                <div class="accrodion-title">
                                    <h5 class="mb-0"><span>Day 2</span> - Zurich - Biel/Bienne - Neuchatel - Geneva</h5>
                                </div>
                                <div class="accrodion-content" style="display: none;">
                                    <div class="inner">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, inventore cumque veniam, praesentium velit incidunt rem quas a, quos eos ipsum, reprehenderit voluptatem.</p>
                                    </div><!-- /.inner -->
                                </div>
                            </div>
                            <div class="accrodion">
                                <div class="accrodion-title">
                                    <h5 class="mb-0"><span>Day 3</span> - Enchanting Engelberg</h5>
                                </div>
                                <div class="accrodion-content" style="display: none;">
                                    <div class="inner">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, inventore cumque veniam, praesentium velit incidunt rem quas a, quos eos ipsum, reprehenderit voluptatem.</p>
                                    </div><!-- /.inner -->
                                </div>
                            </div>
                            <div class="accrodion ">
                                <div class="accrodion-title">
                                    <h5 class="mb-0"><span>Day 4</span> - Barcelona - Zaragoza - Madrid</h5>
                                </div>
                                <div class="accrodion-content" style="display: none;">
                                    <div class="inner">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, inventore cumque veniam, praesentium velit incidunt rem quas a, quos eos ipsum, reprehenderit voluptatem.</p>
                                    </div><!-- /.inner -->
                                </div>
                            </div>
                        </div>

                        <div class="single-map mb-4" id="single-map">
                            <h4>Map</h4>
                            <div class="map">
                                <div style="width: 100%">
                                    <iframe height="400" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=+(mangal%20bazar)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                                </div>
                            </div>
                        </div>

                        <div class="single-review mb-4" id="single-review">
                            <h4>Average Reviews</h4>
                            <div class="row d-flex align-items-center">
                                <div class="col-lg-4 col-md-4">
                                    <div class="review-box bg-pink text-center pb-4 pt-4">
                                        <h2 class="mb-1 white"><span>2.2</span>/5</h2>
                                        <h4 class="white mb-1">"Feel so much worst than thinking"</h4>
                                        <p class="mb-0 white font-italic">From 40 Reviews</p>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="review-progress">
                                        <div class="progress-item">
                                            <p>Cleanliness</p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                                    <span class="sr-only">40% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-item">
                                            <p>Facilities</p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
                                                    <span class="sr-only">30% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-item">
                                            <p>Value for money</p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-item">
                                            <p>Service</p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-item">
                                            <p>Location</p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width:45%">
                                                    <span class="sr-only">45% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- blog comment list -->
                        <div class="single-comments single-box mb-4" id="single-comments">
                            <h5 class="border-b pb-2 mb-2">Showing 16 verified guest comments</h5>

                           <?php
                            $sql ='SELECT * FROM comment WHERE A_id='.$id;
                           $result = mysqli_query($conn,$sql);
    
                            if (mysqli_num_rows($result) > 0) {
                              // output data of each row
                              while($row = mysqli_fetch_assoc($result)) {
                                $C_Create_time= $row["C_Create_time"];
                                $C_content= $row["C_content"];
                                $C_star= $row["C_star"];
                                  echo '
                                  <div class="comment-box" style="width: 100%;">
                                <div class="comment-image">
                                    <img src="images/reviewer/1.jpg" alt="image">
                                </div>
                                <div class="comment-content " style="width: 100%;">
                                    <h5 class="mb-1">Helena</h5>
                                    <p class="comment-date" >'.$C_Create_time.'</p>
                                    <div class="comment-rate">
                                        <div class="rating mar-right-15">';
                                  for($i=0;$i<$C_star;$i++){
                                      echo '<span class="fa fa-star checked"></span>';
                                  }
                                  
                                            
                               echo '</div>
                                        <span class="comment-title">The worst hotel ever"</span>
                                    </div>    
                                    
                                    <p class="comment" style="width: 100%;">'.$C_content.'</p>
                                    <div class="comment-like">
                                        <div class="like-title">
                                            <a href="#" class="nir-btn">Reply</a>
                                        </div>
                                        <div class="like-btn pull-right">
                                            <a href="#" class="like"><i class="fa fa-thumbs-up"></i> Like</a>
                                            <a href="#" class="disike"><i class="fa fa-thumbs-down"></i> Dislike</a>
                                            <a href="#" class="love"><i class="flaticon-like"></i> Love</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                              }
                            } else {
                              echo "0 results";
                            }
                            
                            
                            
                            
                            
                            ?>
                            
                            
                            
                        </div>

                        <?php if($u_id != ""){
    echo '<div class="single-add-review" id="single-add-review">
                            <h4>Write a Review</h4>
                            <form action="destination-single-full.php" method="get">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="hidden" name="id" value='.$id.'>
                                            
                                            <p>Star</p>
                                            <select name="stars" id="stars">
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                            </select>
                                            
                                            <p>Comment</p>
                                            <textarea name="comment"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-btn">
                                            <input type="submit" name="submitreview">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}?>
                        
    </section>
    <!-- blog Ends -->  

    <!-- footer starts -->
    <footer style="background-image:url(images/bg/bg3.jpg);" class="pt-10">
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

    <!-- header side menu --> 
    
    <?php echo getheaderslider() ?>

    <!-- *Scripts* -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/main.js"></script>
    <script src="js/custom-nav.js"></script>
    <script src="js/custom-accordian.js"></script>
    <script src="js/custom-navscroll.js"></script>
</body>
</html>