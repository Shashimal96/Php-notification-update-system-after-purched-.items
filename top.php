<?php
require ('connection.inc.php');
require ('functions.inc.php');
require('add_to_cart.inc.php');
$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
$cat_arr=array(); 
while($row=mysqli_fetch_assoc($cat_res)){ 
    $cat_arr[]=$row;     
}

$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();
?>

<!doctype html> 
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Welcome to Plants</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
     
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">


    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-1 col-sm-2 col-xs-5"> 
                                <div class="logo">
                                     <a href="index.php"><img src="images/logo/Plants.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 col-sm-4 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <?php
                                        foreach($cat_arr as $list) {
                                        ?>
                                        <li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>
                                        <?php
                                        }
                                        ?>
                                        <li><a href="contact.php">contact</a></li>
                                        <li><a href="search.php">Search</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <?php
                                            foreach($cat_arr as $list) {
                                                ?>
                                            <li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>
                                            <?php
                                            }
                                            ?>
                                            <li><a href="contact.php">contact</a></li>
                                        <li><a href="search.php">Search</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-4 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">  
                                    <div class="header__account">
                                        <?php if(isset($_SESSION['USER_LOGIN'])){
                                                echo '<a href="logout.php">Logout</a> <a href="my_order.php">My Order</a>';
                                        }else{
                                            echo '<a href="login.php">Login/Registration </a>'; 
                                        }
                                        ?>  
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->
