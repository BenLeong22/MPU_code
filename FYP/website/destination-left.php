<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">
<?php
    include 'functionset.php';
    
$conn =connection();
    

$sql ="SELECT * FROM attractions INNER JOIN attractions_details ON attractions.A_id = attractions_details.A_id";
$result = mysqli_query($conn,$sql);
    
    
if (!isset ($_GET['page']) || $_GET['page']<=0 ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  
    
$sort = getelement("sort");
    
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
    <section class="breadcrumb-main pb-0" style="background-image: url(images/bg/bg8.jpg);">
        <div class="breadcrumb-outer pt-10">
            <div class="container">
                <div class="breadcrumb-content d-md-flex align-items-center pt-10">
                    <h2 class="mb-0">Attraction page</h2>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Attraction page</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends -->  


    <!-- blog starts -->
    <section class="blog trending destination-b pb-2">
        <div class="container">
            <div class="row flex-lg-row-reverse">
                <div class="col-lg-12 col-xs-12 mb-4">
                    <div class="trend-box">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="list-results d-flex align-items-center justify-content-between">
                                    <div class="list-results-sort">
                                        <p class="m-0">Showing 1-5 of 80 results</p>
                                    </div>
                                    <div class="click-menu d-flex align-items-center justify-content-between">
                                        <div class="change-list mr-3"><a href="destination-list.html"><i class="fa fa-bars"></i></a></div>
                                        <div class="change-grid f-active"><a href="destination-grid.html"><i class="fa fa-th"></i></a></div>
                                        <div class="sortby d-flex align-items-center justify-content-between ml-3">
                                            <select class="niceSelect">
                                                <option value="1" >Sort By</option>
                                                <option value="2">Average rating</option>
                                                <option value="3">Price: low to high</option>
                                                <option value="4">Price: high to low</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
             <?php          $results_per_page = 10;  
                            $page_first_result = ($page-1) * $results_per_page;  
                            
                            
                            $result = $conn->query($sql);
        
                            $number_of_result = mysqli_num_rows($result);  
                            $number_of_page = ceil ($number_of_result / $results_per_page);
                                
                            $found = mysqli_num_rows($result);
                            
                            $sql =$sql. " LIMIT " . $page_first_result . ',' . $results_per_page;
                            
                            $result = $conn->query($sql);
                            if (mysqli_num_rows($result) > 0) {
                          // output data of each row
                          while($row = mysqli_fetch_assoc($result)) {
                            $attraction_id= $row["A_id"];
                            $attraction_name= $row["A_name"];
                            $attraction_AD_recommend_time= $row["AD_recommend_time"];
                              $attraction_AD_recommend_time= $row["AD_recommend_time"];
                            $attraction_AD_address= $row["AD_address"];
                            $attraction_AD_description= substr($row["AD_description"],0,200).'...';
                            echo '
                                <div class="col-lg-6 col-md-6 col-xs-12 mb-4">
                                <div class="trend-item">
                                    <div class="trend-image">
                                        <img src="attractionimage/'.$attraction_id.'_1.jpg" alt="image">
                                    </div>
                                    <div class="trend-content-main">
                                        <div class="trend-content">
                                            <div class="rating-main d-flex align-items-center pb-1">
                                                <div class="rating">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                </div>
                                                <span class="ml-2">51 Reviews</span>
                                            </div>
                                            <h4><a href="destination-single-full.php?id='.$attraction_id.'">'.$attraction_name.'</a></h4>
                                            <p class="mb-0 pink"><i class="fa fa-eye mr-1"></i> 255 Visiting Places <i class="fa fa-map-marker mr-1 ml-3"></i> Spain.</p>
                                        </div>
                                        <div class="trend-last-main">
                                            <p class="mb-0 trend-para">'.$attraction_AD_description.'</p>
                                            <div class="trend-last d-flex align-items-center justify-content-between bg-navy">
                                                <p class="mb-0 white"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 days & 2 night</p>
                                                <div class="trend-price">
                                                    <p class="price white mb-0">From <span>$350.00</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            ';
                          }
                        } else {
                          echo "0 results";
                        }
                            ?>
                            
                            
                            
                            <div class="col-lg-12">
                                <div class="text-center">
                                    
                                    
                                    <?php
                                 echo  '<div class="pagination-main text-center">
                                    <ul class="pagination">
                                ';
//                                        <li><a href="#"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
//                                        <li class="active"><a href="#">1</a></li>
//                                        <li><a href="#">2</a></li>
//                                        <li><a href="#">3</a></li>
//                                        <li><a href="#">4</a></li>
//                                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
//                                    </ul>
//                                </div>
                                    $p_page =$page-1;
                                    
                                     echo '<li><a href="destination-left.php?page='.$p_page.'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>';
                                        for($page1 = 1; $page1<= $number_of_page; $page1++) {  
                                            if($page == $page1){ echo '<li><a href="destination-left.php?page='.$page1.'">'.$page1.'</a></li>';}
                                            else { echo '<li><a href="destination-left.php?page='.$page1.'">'.$page1.'</a></li>';}
                                    }   
                                        if($page<$number_of_page){
                                            $n_page =$page+1;
                                            echo '<li><a href="destination-left.php?page='.$n_page.'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>';
                                        }
                                        else {
                                            echo '<li><a href="destination-left.php?page='.$number_of_page.'">'.$number_of_page.'</a></li>';
                                        }

                                    
                                   echo '                        
                                    </ul>
                                </div>';
//                                         $p_page =$page-1;
//                                         echo '<li class="page-item"><a class="page-link" href = "destination-left.php?page=' . $p_page.'</a></li>';
//                                        for($page1 = 1; $page1<= $number_of_page; $page1++) {  
//                                            if($page == $page1){ echo '<li class="page-item"><a class="page-link" style="background-color:Lightgray;" href = "index.php?page=' . $page1 .'</a></li>';}
//                                            else { echo '<li class="page-item"><a class="page-link" href = "index.php?page=' . $page1.' </a></li>';}
//                                    }   
//                                        if($page<$number_of_page){
//                                            $n_page =$page+1;
//                                            echo '<li class="page-item"><a class="page-link" href = "index.php?page=' . $n_page .'</a></li>';
//                                        }
//                                        else {
//                                            echo '<li class="page-item"><a class="page-link" href = "index.php?page=' . $number_of_page.'</a></li>';
//                                        }

                                    ?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<!--
                <div class="col-lg-4 col-xs-12 mb-4">
                    <div class="sidebar-sticky">
                        <div class="sidebar-item mb-4">
                            <form class="form-content">
                                <h4 class="title white">Find The Places</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="white">Your Destination</label>
                                            <div class="input-box">
                                                <i class="flaticon-placeholder"></i>
                                                <select class="niceSelect">
                                                    <option value="1">Where are you going?</option>
                                                    <option value="2">Argentina</option>
                                                    <option value="3">Belgium</option>
                                                    <option value="4">Canada</option>
                                                    <option value="5">Denmark</option>
                                                </select>
                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="white">Check In</label>
                                            <div class="input-box">
                                                <i class="flaticon-calendar"></i>
                                                <input id="date-range0" type="text" placeholder="yyyy-mmm-dd">
                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="white">Check Out</label>
                                            <div class="input-box">
                                                <i class="flaticon-calendar"></i>
                                                <input id="date-range1" type="text" placeholder="yyyy-mm-dd">
                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="white">Adult</label>
                                            <div class="input-box">
                                                <i class="flaticon-add-user"></i>
                                                <select class="niceSelect">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="white">Children</label>
                                            <div class="input-box">
                                                <i class="flaticon-add-user"></i>
                                                <select class="niceSelect">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-0">
                                            <a href="#" class="nir-btn w-100"><i class="fa fa-search"></i> Check Availability</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="list-sidebar">
                            <div class="sidebar-item">
                                <h4>Services</h4>
                                <div class="pretty p-default p-thick p-pulse mar-bottom-15">
                                    <input type="checkbox" />
                                    <div class="state p-warning-o">
                                        <label>24/7 Reception</label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse mar-bottom-15">
                                    <input type="checkbox" />
                                    <div class="state p-warning-o">
                                        <label>Parking</label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse mar-bottom-15">
                                    <input type="checkbox" />
                                    <div class="state p-warning-o">
                                        <label>Bar</label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse mar-bottom-15">
                                    <input type="checkbox" />
                                    <div class="state p-warning-o">
                                        <label>Restaurant</label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse mar-bottom-15">
                                    <input type="checkbox" />
                                    <div class="state p-warning-o">
                                        <label>Satellite Television</label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse mar-bottom-15">
                                    <input type="checkbox" />
                                    <div class="state p-warning-o">
                                        <label>Lift/ELevator</label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state p-warning-o">
                                        <label>Luggage Storage </label>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <div class="map-box">
                                    <i class="fa fa-map-marker"></i>
                                    <a href="#">Show on Map</a>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <h4>Star Rating</h4>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            <span class="star-rating">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            <span class="star-rating">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            <span class="star-rating">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            <span class="star-rating">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            <span class="star-rating">
                                                <span class="fa fa-star checked"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <h4>Price Range($)</h4>
                                <div class="range-slider">
                                    <div data-min="0" data-max="2000" data-unit="$" data-min-name="min_price" data-max-name="max_price" class="range-slider-ui ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
                                        <span class="min-value">0 $</span> 
                                        <span class="max-value">2000 $</span>
                                        <div class="ui-slider-range ui-widget-header ui-corner-all full" style="left: 0%; width: 100%;"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <h4>City</h4>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            Amsterdam<span class="number">749</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" checked />
                                    <div class="state">
                                        <label>
                                            Rotterdam<span class="number">630</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            Copenghan<span class="number">58</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            New Delhi<span class="number">29</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            New York<span class="number">29</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            Kathmandu<span class="number">29</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            Brisbane<span class="number">29</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-thick p-pulse">
                                    <input type="checkbox" />
                                    <div class="state">
                                        <label>
                                            Tokyo<span class="number">29</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
-->
            </div>
        </div>
    </section>
    <!-- blog Ends -->  

    <!-- top destination starts -->
    <section class="top-destination overflow-hidden">
        <div class="container">
            <div class="section-title text-center mb-5 pb-2 w-50 mx-auto">
                <h2 class="m-0 white">Related <span>Tour Packages</span></h2>
                <p class="mb-0 white">Travel has helped us to understand the meaning of life and it has helped us become better people. Each time we travel, we see the world with new eyes.</p>
            </div>  
            <div class="desti-inner">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-4 col-md-6 p-1">
                        <div class="desti-image">
                            <img src="images/destination/destination3.jpg" alt="desti">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-1">New York Tour</h4>
                                <div class="trend-last-main">
                                    <div class="trend-last">
                                        <p class="mb-1 white"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 days & 2 night</p>
                                        <div class="trend-price">
                                            <p class="price pink mb-0">From <span>$350.00</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desti-overlay">
                                <a href="#" class="nir-btn">
                                  <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white pl-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 p-1">
                        <div class="desti-image">
                            <img src="images/destination/destination4.jpg" alt="desti">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-1">Armania Tour</h4>
                                <div class="trend-last-main">
                                    <div class="trend-last">
                                        <p class="mb-1 white"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 days & 2 night</p>
                                        <div class="trend-price">
                                            <p class="price pink mb-0">From <span>$350.00</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desti-overlay">
                                <a href="#" class="nir-btn">
                                  <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white pl-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 p-1">
                        <div class="desti-image">
                            <img src="images/destination/destination10.jpg" alt="desti">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-1">London Tour</h4>
                                <div class="trend-last-main">
                                    <div class="trend-last">
                                        <p class="mb-1 white"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 days & 2 night</p>
                                        <div class="trend-price">
                                            <p class="price pink mb-0">From <span>$350.00</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desti-overlay">
                                <a href="#" class="nir-btn">
                                  <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white pl-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 p-1">
                        <div class="desti-image">
                            <img src="images/destination/destination5.jpg" alt="desti">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-1">Manchester Tour</h4>
                                <div class="trend-last-main">
                                    <div class="trend-last">
                                        <p class="mb-1 white"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 days & 2 night</p>
                                        <div class="trend-price">
                                            <p class="price pink mb-0">From <span>$350.00</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desti-overlay">
                                <a href="#" class="nir-btn">
                                  <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white pl-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 p-1">
                        <div class="desti-image">
                            <img src="images/destination/destination7.jpg" alt="desti">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-1">kathmandu Tour</h4>
                                <div class="trend-last-main">
                                    <div class="trend-last">
                                        <p class="mb-1 white"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 days & 2 night</p>
                                        <div class="trend-price">
                                            <p class="price pink mb-0">From <span>$350.00</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="desti-overlay">
                                <a href="#" class="nir-btn">
                                  <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white pl-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 p-1">
                        <div class="desti-image">
                            <img src="images/destination/destination8.jpg" alt="desti">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-1">Tokyo Tour</h4>
                                <div class="trend-last-main">
                                    <div class="trend-last">
                                        <p class="mb-1 white"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 days & 2 night</p>
                                        <div class="trend-price">
                                            <p class="price pink mb-0">From <span>$350.00</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desti-overlay">
                                <a href="#" class="nir-btn">
                                  <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white pl-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 p-1">
                        <div class="desti-image">
                            <img src="images/destination/destination9.jpg" alt="desti">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-1">Norwich Tour</h4>
                                <div class="trend-last-main">
                                    <div class="trend-last">
                                        <p class="mb-1 white"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 days & 2 night</p>
                                        <div class="trend-price">
                                            <p class="price pink mb-0">From <span>$350.00</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desti-overlay">
                                <a href="#" class="nir-btn">
                                  <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white pl-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <!-- top destination ends -->

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
    <script src="js/custom-date.js"></script>
</body>
</html>