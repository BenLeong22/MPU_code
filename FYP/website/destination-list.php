<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">
<?php
include 'functionset.php';    
$conn =connection();
    
$id =$_GET['id'];

$sql ="SELECT * FROM records WHERE r_id =".$id;
$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $attraction_data= $row["r_data"];
  }
} else {
  echo "0 results";
}
$data = json_decode($attraction_data); 

$length = count($data);
$placeId =[];
$name =[];
$lattitude =[];
$longitude =[];
$start =[];
$end =[];
$traffic_time =[];

for ($i = 0;$i< $length;$i++){
    array_push($placeId, $data[$i] -> placeId);
    array_push($name, $data[$i] -> Name);
    array_push($lattitude, $data[$i] -> lattitude);
    array_push($longitude, $data[$i] -> longitude);
    array_push($start, $data[$i] -> start);
    array_push($end, $data[$i] -> end);
    array_push($traffic_time, $data[$i] -> traffic_time);

}
$audlt =$data[7]->audlt;
$child =$data[8]->child;
$trip_start =$data[6]->trip_start;
$budget =$data[6]->budget;
 
    
    
$string = file_get_contents("weatherdata.txt");
    $array = json_decode($string);
    $time = $array->{'time'};
    $image = $array->{'image'};
    $describe = $array->{'describe'};
    $weather = $array->{'weather'};
    $uvi = $array->{'uvi'};
    $wind = $array->{'wind'};
    $humidity = $array->{'humidity'};
    $sunrise = $array->{'sunrise'};
    $sunset = $array->{'sunset'};
    $cloud = $array->{'cloud'};
    $count =0;
    
    foreach($time as $values)
    {    
         if ($values == $trip_start){
             $time=$time[$count];
             $describe=$describe[$count];
             
         }
        $count+=1;
    }    
?>
<head>
     <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script>
        let map;

    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 22.1775407, lng: 113.55203152468177 },
        zoom: 13
      });
        
     const tourStops = [
//    [{ lat: 34.8791806, lng: -111.8265049 }, "Boynton Pass"],
//    [{ lat: 34.8559195, lng: -111.7988186 }, "Airport Mesa"],
//    [{ lat: 34.832149, lng: -111.7695277 }, "Chapel of the Holy Cross"],
//    [{ lat: 34.823736, lng: -111.8001857 }, "Red Rock Crossing"],
//    [{ lat: 34.800326, lng: -111.7665047 }, "Bell Rock"],
         
    <?php                  
                        foreach($placeId as $list_id){
                            
                            $sql ="SELECT * FROM attractions INNER JOIN attractions_details ON attractions.A_id = attractions_details.A_id WHERE attractions.A_id='".$list_id."'";
                            $result = mysqli_query($conn,$sql);

                            if (mysqli_num_rows($result) > 0) {
                              // output data of each row
                              while($row = mysqli_fetch_assoc($result)) {
                                  echo '  [{ lat: '.$row["A_latitude"].', lng: '.$row["A_logitude"].' }, "'.$row["A_name"].'"],';
                              }}}
         ?>
  ];
        
     const infoWindow = new google.maps.InfoWindow();

  // Create the markers.
  tourStops.forEach(([position, title], i) => {
    const marker = new google.maps.Marker({
      position,
      map,
      title: `${i + 1}. ${title}`,
      label: `${i + 1}`,
      optimized: false,
    });

    // Add a click listener for each marker, and set up the info window.
    marker.addListener("click", () => {
      infoWindow.close();
      infoWindow.setContent(marker.getTitle());
      infoWindow.open(marker.getMap(), marker);
    });
  });
        
        
    }
</script>
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
    
   
    
<style>
#map {
  width: 100%;
  background-color: black;
}
</style>
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
                    <h2 class="mb-0">Itinerary</h2>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Itinerary
</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends -->  


    <!-- blog starts -->
    <section class="blog destination-b pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xs- mb-1">
                    <div class="trend-box">
                        <div class="list-results d-flex align-items-center justify-content-between">
                            <div class="list-results-sort">
                                <p class="m-0">Showing 1-5 of 80 results</p>
                            </div>
                            <div class="click-menu d-flex align-items-center justify-content-between">
                                <div class="change-list f-active mr-2"><a href="destination-list.html"><i class="fa fa-bars"></i></a></div>
                                <div class="change-grid"><a href="destination-grid.html"><i class="fa fa-th"></i></a></div>
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
                        
                       
<?php                   $idx=0;
                        
                        foreach($placeId as $list_id){
                            
                            $sql ="SELECT * FROM attractions INNER JOIN attractions_details ON attractions.A_id = attractions_details.A_id WHERE attractions.A_id='".$list_id."'";
                            $result = mysqli_query($conn,$sql);

                            if (mysqli_num_rows($result) > 0) {
                              // output data of each row
                              while($row = mysqli_fetch_assoc($result)) {
                                $list_id= $row["A_id"];  
                                $list_name= $row["A_name"];
                                $list_visited= $row["A_visited"];
                                $budget_C= $row["AD_Child_budget"];
                                $budget_A= $row["AD_Adult_budget"];
                                $allbudget =$budget_C*$child+$budget_A*$audlt;
                                echo '
                                <div class="blog-full d-flex justify-content-around mb-1 ">
                            <div class="row w-100">
                               
                                <div class="col-lg-5 col-md-4 col-xs-12 blog-height">
                                   <div class="blog-image">
                                        <a href="blog-single.html" style="background-image: url(attractionimage/'.$list_id.'_1.jpg);"></a>
                                    </div> 
                                </div>
                                <div class="col-lg-7 col-md-8 col-xs-12">
                                    <div class="blog-content p-0">
                                        <h4 class="mb-1"><a href="destination-single-full.php?id='.$list_id.'" class="">'.$list_name.'</a></h4>
                                        <div class="trend-tags">
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                        </div>
                                        <div class="rating pb-1">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            </div>
                                        <p class="mb-2 pink"><i class="fa fa-eye mr-1"></i>sdafasdf<i class="fa fa-map-marker mr-1 ml-3"></i>
                                        <a href="https://www.google.com/maps/search/?api=1&query='.$longitude[$idx].'%2C-'.$lattitude[$idx].'">'.$longitude[$idx].','.$lattitude[$idx].'</a></p>
                                        <p class="mb-2 border-t pt-2"></p> 
                                        <p>Start:'.$start[$idx].'</p>
                                        <p>End:'.$end[$idx].'</p>
                                        <div class="deal-price">
                                            <p>Child budget: $'.$budget_C.' x '.$child.'</p>
                                            <p>Adult budget: $'.$budget_A.' x '.$child.'</p>
                                            <p class="price mb-0">Total <span>$'.$allbudget.'</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                        <br>
                            <a href="#" class="nir-btn"><i class="fa fa-bus"></i> Traffic time: '.$traffic_time[$idx].' Min</a>
                            <br>
                        </div>
                                ';
                              }
                            } else {
                              echo "0 results";
                            }
                            $idx++;
                        }
                        //https://www.google.com/maps/search/?api=1&query=%2C
                        //https://www.google.com/maps/search/?api=1&query=113.544799%2C22.191604
                        ?>
                        

                    </div>
                </div>


                <div class="col-lg-4 col-xs-12 mb-4">
                    <div class="sidebar-sticky">
                        <div class="sidebar-item mb-4">
                            <form class="form-content">
                                <h4 class="title white">Your condition</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="white">Weather</label>
                                            <div class="input-box">
                                                <i class="flaticon-placeholder"></i>
                                                <select class="niceSelect">
                                                    <option value="1"><?php echo $describe?></option>

                                                </select>
                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="white">Trip date</label>
                                            <div class="input-box">
                                                <i class="flaticon-calendar"></i>
                                                <input id="date-range0" type="text" placeholder="<?php echo $trip_start?>">
                                            </div>                            
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="white">Adult</label>
                                            <div class="input-box">
                                                <i class="flaticon-add-user"></i>
                                                <select class="niceSelect">
                                                    <option value="1"><?php echo $audlt?></option>

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
                                                    <option value="1"><?php echo $child?></option>

                                                </select>
                                            </div>                             
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="white">Budget</label>
                                            <div class="input-box">
                                                <i class="flaticon-add-user"></i>
                                                <select class="niceSelect">
                                                    <option value="1"><?php echo $budget?></option>

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
                                
   
                            <div id="test">asdfsadf</div>
                            <div class="sidebar-item">

                             


                          
<!--
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
-->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- blog Ends -->  

    <!-- Trending Starts -->
    <section id="map">

         

    </section>
    <!-- Trending Ends -->

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
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvJTbnzdh7y_Fy9iPuwSa3HagvcfBbSpw&callback=initMap&v=weekly"
      async
    ></script>
</body>
</html>