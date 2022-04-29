<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">
<?php
    include 'functionset.php';
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
    <?php echo getheader();?>
    <!-- header ends -->

    <!-- BreadCrumb Starts -->  
    <section class="breadcrumb-main pb-0" style="background-image: url(images/bg/bg8.jpg);">
        <div class="breadcrumb-outer pt-10">
            <div class="container">
                <div class="breadcrumb-content d-md-flex align-items-center pt-10">
                    <h2 class="mb-0">Blog List</h2>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog List</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends --> 

    <!-- blog starts -->
    <section class="blog blog-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 float-right">
                    <div class="listing-inner">
                        <div class="list-results d-flex align-items-center justify-content-between">
                            <div class="list-results-sort">
                                <p class="m-0">Showing 1-5 of 80 results</p>
                            </div>
                            <div class="click-menu d-flex align-items-center justify-content-between">
                                <div class="change-list f-active mr-2"><a href="blog-list.html"><i class="fa fa-bars"></i></a></div>
                                <div class="change-grid"><a href="blog-grid.html"><i class="fa fa-th"></i></a></div>
                                <div class="sortby d-flex align-items-center justify-content-between ml-2">
                                    <select class="niceSelect">
                                        <option value="1" >Sort By</option>
                                        <option value="2">Average rating</option>
                                        <option value="3">Price: low to high</option>
                                        <option value="4">Price: high to low</option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="blog-full d-flex justify-content-around mb-4">
                            <div class="row w-100">
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(images/blog/blog3.jpg);"></a>
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content">
                                        <span class="h-date pink mb-1 font-weight-light d-block"> Mar 15, 2020</span>
                                        <h3 class="mb-2"><a href="#" class="">Visiting London on a Budget: Top City Views</a></h3>
                                        <p class="date-cats mb-0 border-t pt-2 pb-2">
                                            <a href="#" class="mr-2"><i class="fa fa-file"></i> Categories</a> <a href="#" class=""><i class="fa fa-user"></i> By Lorem Ipsum</a>
                                        </p> 
                                        <p class="mb-2 border-t pt-2">Susp endisse ullam corper a adipiscing class ullam corper inceptos nisl consequat eros congue.</p>  
                                        <a href="" class="grey font-weight-light">Read This <i class="fa fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-full d-flex justify-content-around mb-4">
                            <div class="row flex-row-reverse w-100">
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(images/blog/blog1.jpg);"></a>
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content">
                                        <span class="h-date pink mb-1 font-weight-light d-block"> Mar 15, 2020</span>
                                        <h3 class="mb-2"><a href="#" class="">Bring to the table win-win survival strategies</a></h3>
                                        <p class="date-cats mb-0 border-t pt-2 pb-2">
                                            <a href="#" class="mr-2"><i class="fa fa-file"></i> Categories</a> <a href="#"><i class="fa fa-user"></i> By Lorem Ipsum</a>
                                        </p> 
                                        <p class="mb-2 border-t pt-2">Susp endisse ullam corper a adipiscing class ullam corper inceptos nisl consequat eros.</p>  
                                        <a href="" class="grey font-weight-light">Read This <i class="fa fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-full d-flex justify-content-around mb-4">
                            <div class="row w-100">
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(images/blog/blog2.jpg);"></a>
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content">
                                        <span class="h-date pink mb-1 font-weight-light d-block"> Apr 20, 2020</span>
                                        <h3 class="mb-2"><a href="#" class="">Top 8 Amazing Places to Stay in Canada</a></h3>
                                        <p class="date-cats mb-0 border-t pt-2 pb-2">
                                            <a href="#" class="mr-2"><i class="fa fa-file"></i> Categories</a> <a href="#" class=""><i class="fa fa-user"></i> By Lorem Ipsum</a>
                                        </p> 
                                        <p class="mb-2 border-t pt-2">Susp endisse ullam corper a adipiscing class ullam corper inceptos nisl consequat eros.</p> 
                                        <a href="" class="grey font-weight-light">Read This <i class="fa fa-long-arrow-alt-right"></i></a> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-full d-flex justify-content-around mb-4">
                            <div class="row flex-row-reverse w-100">
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(images/blog/blog3.jpg);"></a>
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content">
                                        <span class="h-date pink mb-1 font-weight-light d-block"> Feb 21, 2020</span>
                                        <h3 class="mb-2"><a href="#" class="">DevOps. Nanotechnology immersion along</a></h3>
                                        <p class="date-cats mb-0 border-t pt-2 pb-2">
                                            <a href="#" class="mr-2"><i class="fa fa-file"></i> Categories</a> <a href="#" class=""><i class="fa fa-user"></i> By Lorem Ipsum</a>
                                        </p> 
                                        <p class="mb-2 border-t pt-2">Susp endisse ullam corper a adipiscing class ullam corper inceptos nisl consequat eros congue.</p>  
                                        <a href="" class="grey font-weight-light">Read This <i class="fa fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-full d-flex justify-content-around mb-4">
                            <div class="row w-100">
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(images/blog/blog4.jpg);"></a>
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content">
                                        <span class="h-date pink mb-1 font-weight-light d-block"> Jun 10, 2020</span>
                                        <h3 class="mb-2"><a href="#" class="">Top 8 Amazing Places to Stay in Canada</a></h3>
                                        <p class="date-cats mb-0 border-t pt-2 pb-2">
                                            <a href="#" class="mr-2"><i class="fa fa-file"></i> Categories</a> <a href="#" class=""><i class="fa fa-user"></i> By Lorem Ipsum</a>
                                        </p> 
                                        <p class="mb-2 border-t pt-2">Susp endisse ullam corper a adipiscing class ullam corper inceptos nisl consequat eros congue.</p>  
                                        <a href="" class="grey font-weight-light">Read This <i class="fa fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-full d-flex justify-content-around mb-4">
                            <div class="row flex-row-reverse w-100">
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(images/blog/blog5.jpg);"></a>
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content">
                                        <span class="h-date pink mb-1 font-weight-light d-block"> Mar 15, 2020</span>
                                        <h3 class="mb-2"><a href="#" class="">Capitalize on low hanging fruit to identify</a></h3>
                                        <p class="date-cats mb-0 border-t pt-2 pb-2">
                                            <a href="#" class="mr-2"><i class="fa fa-file"></i> Categories</a> <a href="#" class=""><i class="fa fa-user"></i> By Lorem Ipsum</a>
                                        </p> 
                                        <p class="mb-2 border-t pt-2">Susp endisse ullam corper a adipiscing class ullam corper inceptos nisl consequat eros congue.</p>  
                                        <a href="" class="grey font-weight-light">Read This <i class="fa fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-full d-flex justify-content-around mb-4">
                            <div class="row w-100">
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(images/blog/blog6.jpg);"></a>
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content">
                                        <span class="h-date pink mb-1 font-weight-light d-block"> Jul 13, 2020</span>
                                        <h3 class="mb-2"><a href="#" class="">At the end of the day, going forward, a new normal</a></h3>
                                        <p class="date-cats mb-0 border-t pt-2 pb-2">
                                            <a href="#" class="mr-2"><i class="fa fa-file"></i> Categories</a> <a href="#" class=""><i class="fa fa-user"></i> By Lorem Ipsum</a>
                                        </p> 
                                        <p class="mb-2 border-t pt-2">Susp endisse ullam corper a adipiscing class ullam corper inceptos nisl consequat eros.</p>  
                                        <a href="" class="grey font-weight-light">Read This <i class="fa fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-full d-flex justify-content-around mb-4">
                            <div class="row flex-row-reverse w-100">
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(images/blog/blog3.jpg);"></a>
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content">
                                        <span class="h-date pink mb-1 font-weight-light d-block"> Mar 26, 2020</span>
                                        <h3 class="mb-2"><a href="#" class="">Bring to the table win-win survival strategies</a></h3>
                                        <p class="date-cats mb-0 border-t pt-2 pb-2">
                                            <a href="#" class="mr-2"><i class="fa fa-file"></i> Categories</a> <a href="#" class=""><i class="fa fa-user"></i> By Lorem Ipsum</a>
                                        </p> 
                                        <p class="mb-2 border-t pt-2">Susp endisse ullam corper a adipiscing class ullam corper inceptos nisl consequat eros.</p>  
                                        <a href="" class="grey font-weight-light">Read This <i class="fa fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-full d-flex justify-content-around mb-4">
                            <div class="row w-100">
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(images/blog/blog5.jpg);"></a>
    
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content">
                                        <span class="h-date pink mb-1 font-weight-light d-block"> Dec 8, 2020</span>
                                        <h3 class="mb-2"><a href="#" class="">Leverage agile frameworks to provide a robust</a></h3>
                                        <p class="date-cats mb-0 border-t pt-2 pb-2">
                                            <a href="#" class="mr-2"><i class="fa fa-file"></i> Categories</a> <a href="#" class=""><i class="fa fa-user"></i> By Lorem Ipsum</a>
                                        </p> 
                                        <p class="mb-2 border-t pt-2">Susp endisse ullam corper a adipiscing class ullam corper inceptos nisl consequat eros congue.</p>  
                                        <a href="" class="grey font-weight-light">Read This <i class="fa fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pagination-main text-center">
                            <ul class="pagination">
                                <li><a href="#"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- sidebar starts -->
                <div class="col-lg-4 col-md-12">
                    <div class="sidebar-sticky">
                        <div class="list-sidebar">
                            <div class="author-news mb-4">
                                <div class="author-news-content">
                                    <div class="author-thumb">
                                        <img src="images/team/img2.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <span>Author News</span>
                                        <h4 class="title mb-0"><a href="#" class="white">Relson Dulux</a></h4>
                                        <p class="m-0">Director / Suplex World</p>
                                        <div class="header-social">
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

                            <div class="sidebar-item mb-4">
                                <h4 class="">All Categories</h4>
                                <ul class="sidebar-category">
                                    <li><a href="#">All</a></li>
                                    <li><a href="#">Featured</a></li>
                                    <li><a href="#">Sliders</a></li>
                                    <li class="active"><a href="#">Manage Listings</a></li>
                                    <li><a href="#">Address and Map</a></li>
                                    <li><a href="#">Reservation Requests</a></li>
                                    <li><a href="#">Your Reservation</a></li>
                                    <li><a href="#">Search Results</a></li>
                                </ul>
                            </div>

                            <div class="sidebar-item mb-4">
                                <div class="sidebar-tabs">
                                    <div class="sidebar-navtab text-center">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#popular"><i class="fa fa-check-circle"></i> Most Popular </a></li>
                                            <li><a data-toggle="tab" href="#recent"><i class="fa fa-check-circle"></i> Recent Post</a></li>
                                        </ul>
                                    </div>    

                                    <div class="tab-content">
                                        <div id="popular" class="tab-pane fade in active">
                                            <div class="sidebar-image mb-2 mt-2">
                                                <a href="blog-single.php"><img src="images/blog/blog3.jpg" alt=""></a>
                                            </div>
                                            <article class="post mb-2">
                                                <div class="s-content d-flex align-items-center justify-space-between">
                                                    <div class="blog-no">01</div>
                                                    <div class="content-list pl-3">
                                                        <div class="date">Jun 28, 2019</div>
                                                        <h5 class="m-0"><a href="blog-single.php">Takes on Baboon, and It Doesn’t Go Well for It</a></h5>
                                                    </div>    
                                                </div>     
                                                
                                            </article>

                                            <article class="post mb-2">
                                                <div class="s-content d-flex align-items-center justify-space-between">
                                                    <div class="blog-no">02</div>
                                                    <div class="content-list pl-3">
                                                        <div class="date">Jun 28, 2019</div>
                                                        <h5 class="m-0"><a href="blog-single.php">Zebras Hold New Record for Longest Migration</a></h5>
                                                    </div>    
                                                </div>     
                                                
                                            </article>

                                            <article class="post">
                                                <div class="s-content d-flex align-items-center justify-space-between">
                                                    <div class="blog-no">03</div>
                                                    <div class="content-list pl-3">
                                                        <div class="date">Jun 28, 2019</div>
                                                        <h5 class="m-0"><a href="blog-single.php">African Reserve Got Killed by Lions Instead</a></h5>
                                                    </div>    
                                                </div>     
                                                
                                            </article>
                                        </div>

                                        <div id="recent" class="tab-pane fade">
                                            <div class="sidebar-image mb-2 mt-2">
                                                <a href="blog-single.php"><img src="images/blog/blog1.jpg" alt=""></a>
                                            </div>
                                            <article class="post mb-2">
                                                <div class="s-content d-flex align-items-center justify-space-between">
                                                    <div class="blog-no">01</div>
                                                    <div class="content-list pl-3">
                                                        <div class="date">Jun 28, 2019</div>
                                                        <h5 class="m-0"><a href="blog-single.php">Takes on Baboon, and It Doesn’t Go Well for It</a></h5>
                                                    </div>    
                                                </div>     
                                                
                                            </article>

                                            <article class="post mb-2">
                                                <div class="s-content d-flex align-items-center justify-space-between">
                                                    <div class="blog-no">02</div>
                                                    <div class="content-list pl-3">
                                                        <div class="date">Jun 28, 2019</div>
                                                        <h5 class="m-0"><a href="blog-single.php">Zebras Hold New Record for Longest Migration</a></h5>
                                                    </div>    
                                                </div>     
                                                
                                            </article>

                                            <article class="post">
                                                <div class="s-content d-flex align-items-center justify-space-between">
                                                    <div class="blog-no">03</div>
                                                    <div class="content-list pl-3">
                                                        <div class="date">Jun 28, 2019</div>
                                                        <h5 class="m-0"><a href="blog-single.php">African Reserve Got Killed by Lions Instead</a></h5>
                                                    </div>    
                                                </div>     
                                                
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-item mb-4">
                                <h4 class="">Tags</h4>
                                <ul class="sidebar-tags">
                                    <li><a href="#">Tour</a></li>
                                    <li><a href="#">Rental</a></li>
                                    <li><a href="#">City</a></li>
                                    <li><a href="#">Yatch</a></li>
                                    <li><a href="#">Activity</a></li>
                                    <li><a href="#">Museum</a></li>
                                    <li><a href="#">Beauty</a></li>
                                    <li><a href="#">Classic</a></li>
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">Designs</a></li>
                                    <li><a href="#">Featured</a></li>
                                    <li><a href="#">Free Style</a></li>
                                    <li><a href="#">Programs</a></li>
                                    <li><a href="#">Travel</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</body>
</html>