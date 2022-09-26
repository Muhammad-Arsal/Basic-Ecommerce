<?php
session_start();
if (isset($_SESSION['user_login'])) {
    $current_user = $_SESSION['user_login'];
}
require_once "./core/database.php";
$posts = select_all("products", $connection);
if (isset($_SESSION['user_login'])) {
    $key = $_SESSION['user_login'];
    $from_db = select_where("user_credentials", "id", $key, $connection, 1);
}


?>
<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Store</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- modal css -->
    <link rel="stylesheet" href="css/modal.css">
    <style>
        .badge:after {
            content: attr(value);
            font-size: 12px;
            color: #fff;
            background: red;
            border-radius: 50%;
            padding: 0 5px;
            position: relative;
            left: -8px;
            top: -10px;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.php"> <img src="img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="category.php" id="navbarDropdown_1">
                                        Shop
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                            <?php if (!isset($_SESSION['user_login']) && !isset($_COOKIE['remember_me'])) { ?>
                                <a id="modal_trigger" href="#modal" class="btn btn_3">Login/Register</a>
                            <?php } else { ?>
                                <a href="user_dash.php" class="btn btn_3"><?php echo $from_db['name']; ?></a>
                            <?php } ?>
                            <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <a href="./wishlist.php"><i class="ti-heart"></i></a>
                            <div class="dropdown cart">
                                <a href="cart.php"><i class="fa badge cart_count" style="font-size:14px; margin-left: 15px;" value="<?php if (isset($_SESSION['cart_items'])) {
                                                                                                                                        echo count($_SESSION['cart_items']);
                                                                                                                                    } ?>">&#xf07a;</i></a>
                                <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <div class="single_product">
    
                                    </div>
                                </div> -->

                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <!-- product_list start-->
    <section class="product_list section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product_list_slider owl-carousel">
                        <div class="single_product_list_slider">
                            <div class="row align-items-center justify-content-between">
                                <?php
                                if (!empty($posts)) {
                                    foreach ($posts as $productVal) {
                                        $current_id = $productVal['id'];
                                        $seller_product_val  = select_where("seller_products", "product_id", $current_id, $connection, 1);
                                ?>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="single_product_item">
                                                <a href="single-product.php?id=<?php echo $productVal['id']; ?>"> <img src="<?php echo "./productimages/" . $productVal['product_image']; ?>" alt="" style="width: 400px; height: 250px;">
                                                </a>
                                                <div class="single_product_text">
                                                    <h4><?php echo $productVal['product_name']; ?></h4>
                                                    <h3><?php if (!empty($seller_product_val['sale_price'])) {
                                                            echo $seller_product_val['sale_price'] . "$";
                                                        } else {
                                                            echo "Out Of Stock";
                                                        }  ?></h3>
                                                    <?php if (!empty($seller_product_val['stock'])) { ?>
                                                        <a href="#" data-id="<?php echo $productVal['id']; ?>" class="add_cart">+ add to cart<?php
                                                                                                                                                if (isset($_SESSION['user_login']) || isset($_COOKIE['remember_me'])) {
                                                                                                                                                    $que = "SELECT * FROM wishlist WHERE user_id = '$current_user' AND product_id = '$current_id'";
                                                                                                                                                    $res = mysqli_query($connection, $que);
                                                                                                                                                    if (mysqli_num_rows($res) > 0) {
                                                                                                                                                ?>
                                                            <i style="display: none;" data-value="<?php echo $productVal['id']; ?>" class="ti-heart heat"></i></a>
                                                    <?php } else { ?>
                                                        <i style="display: block;" data-value="<?php echo $productVal['id']; ?>" class="ti-heart heat"></i></a><?php }
                                                                                                                                                        }
                                                                                                                                                    } ?>

                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- subscribe_area part start-->
    <section class="subscribe_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="subscribe_area_text text-center">
                        <h5>Join Our Newsletter</h5>
                        <h2>Subscribe to get Updated
                            with new offers</h2>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="enter email address" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text btn_2" id="basic-addon2">subscribe now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::subscribe_area part end::-->



    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Top Products</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Managed Website</a></li>
                            <li><a href="">Manage Reputation</a></li>
                            <li><a href="">Power Tools</a></li>
                            <li><a href="">Marketing Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Jobs</a></li>
                            <li><a href="">Brand Assets</a></li>
                            <li><a href="">Investor Relations</a></li>
                            <li><a href="">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Features</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Jobs</a></li>
                            <li><a href="">Brand Assets</a></li>
                            <li><a href="">Investor Relations</a></li>
                            <li><a href="">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Resources</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Guides</a></li>
                            <li><a href="">Research</a></li>
                            <li><a href="">Experts</a></li>
                            <li><a href="">Agencies</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="single_footer_part">
                        <h4>Newsletter</h4>
                        <p>Heaven fruitful doesn't over lesser in days. Appear creeping
                        </p>
                        <div id="mc_embed_signup">
                            <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative mail_part">
                                <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address" class="placeholder hide-on-focus" onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '">
                                <button type="submit" name="submit" id="newsletter-submit" class="email_icon newsletter-submit button-contactForm">subscribe</button>
                                <div class="mt-10 info"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="copyright_text">
                            <P>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This
                                template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </P>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer_icon social_icon">
                            <ul class="list-unstyled">
                                <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade bs-modal-sm log-sign" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="bs-example bs-example-tabs">
                    <ul id="myTab" class="nav nav-tabs">
                        <li id="tab1" class=" active tab-style login-shadow "><a href="#signin" data-toggle="tab">Log In</a></li>
                        <li id="tab2" class=" tab-style "><a href="#signup" data-toggle="tab">Sign Up</a></li>

                    </ul>
                </div>
                <div class="modal-body">
                    <div id="myTabContent" class="tab-content">

                        <div class="tab-pane fade active in" id="signin">
                            <form class="form-horizontal">
                                <fieldset>
                                    <!-- Sign In Form -->
                                    <!-- Text input-->

                                    <div class="group">
                                        <input required="" class="input" type="text"><span class="highlight"></span><span class="bar"></span>
                                        <label class="label" for="date">Email address</label>
                                    </div>


                                    <!-- Password input-->
                                    <div class="group">
                                        <input required="" class="input" type="password"><span class="highlight"></span><span class="bar"></span>
                                        <label class="label" for="date">Password</label>
                                    </div>
                                    <em>minimum 6 characters</em>

                                    <div class="forgot-link">
                                        <a href="#forgot" data-toggle="modal" data-target="#forgot-password"> I forgot my password</a>
                                    </div>


                                    <!-- Button -->
                                    <div class="control-group">
                                        <label class="control-label" for="signin"></label>
                                        <div class="controls">
                                            <button id="signin" name="signin" class="btn btn-primary btn-block">Log In</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>


                        <div class="tab-pane fade" id="signup">
                            <form class="form-horizontal">
                                <fieldset>
                                    <!-- Sign Up Form -->
                                    <!-- Text input-->
                                    <div class="group">
                                        <input required="" class="input" type="text"><span class="highlight"></span><span class="bar"></span>
                                        <label class="label" for="date">First Name</label>
                                    </div>

                                    <!-- Text input-->
                                    <div class="group">
                                        <input required="" class="input" type="text"><span class="highlight"></span><span class="bar"></span>
                                        <label class="label" for="date">Last Name</label>
                                    </div>

                                    <!-- Password input-->
                                    <div class="group">
                                        <input required="" class="input" type="text"><span class="highlight"></span><span class="bar"></span>
                                        <label class="label" for="date">Email</label>
                                    </div>

                                    <!-- Text input-->
                                    <div class="group">
                                        <input required="" class="input" type="password"><span class="highlight"></span><span class="bar"></span>
                                        <label class="label" for="date">Password</label>
                                    </div>
                                    <em>1-8 Characters</em>

                                    <div class="group2">
                                        <input required="" class="input" type="text"><span class="highlight"></span><span class="bar"></span>
                                        <label class="label" for="date">Country</label>
                                    </div>



                                    <!-- Button -->
                                    <div class="control-group">
                                        <label class="control-label" for="confirmsignup"></label>
                                        <div class="controls">
                                            <button id="confirmsignup" name="confirmsignup" class="btn btn-primary btn-block">Sign Up</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <!--<div class="modal-footer">
      <center>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </center>
      </div>-->
            </div>
        </div>
    </div>



    <!--modal2-->

    <div class="modal fade bs-modal-sm" id="forgot-password" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Password will be sent to your email</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="group">
                                <input required="" class="input" type="text"><span class="highlight"></span><span class="bar"></span>
                                <label class="label" for="date">Email address</label>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="forpassword"></label>
                                <div class="controls">
                                    <button id="forpasswodr" name="forpassword" class="btn btn-primary btn-block">Send</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <!--::footer_part end::-->
    <div id="modal" class="popupContainer" style="display:none;">
        <header class="popupHeader">
            <span class="header_title">Login</span>
            <span class="modal_close"><i class="fa fa-times"></i></span>
        </header>

        <section class="popupBody">
            <!-- Social Login -->
            <div class="social_login">

                <div class="action_btns">
                    <div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
                    <div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
                </div>
            </div>

            <!-- Username & Password Login form -->
            <div class="user_login">
                <form id="form1">
                    <label>Email / Username</label>
                    <input type="text" name="email" />
                    <br />

                    <label>Password</label>
                    <input type="password" name="password" />
                    <br />

                    <div class="checkbox">
                        <input id="remember" type="checkbox" name="s_remember" />
                        <label for="remember">Remember me on this computer</label>
                    </div>

                    <div class="action_btns">
                        <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                        <div class="one_half last"><a href="#" class="btn btn_red login_form">Login</a></div>
                    </div>
                </form>
            </div>

            <!-- Register Form -->
            <div class="user_register">
                <form id="form2">
                    <label>Full Name</label>
                    <input type="text" name="fullname" />
                    <br />

                    <label>Email Address</label>
                    <input type="email" name="email" />
                    <br />

                    <label>Password</label>
                    <input type="password" name="password" />
                    <br />

                    <div class="action_btns">
                        <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                        <div class="one_half last"><a href="#" class="btn btn_red btn_reg">Register</a></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    </div>

    <!-- jquery plugins here-->
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- slick js -->
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
    <script src="./jquery.leanModal.min.js"></script>

    <script>
        //Add cart AJAX
        $(function() {
            $(".add_cart").click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: 'post',
                    url: "jquerydata.php",
                    data: {
                        product_id: id,
                    },
                    success: function(response) {
                        if (response) {
                            $(".cart_count").attr('value', response);
                        }
                    }
                })
            })

            $(".heat").click(function(e) {
                e.preventDefault();
                var id = $(this).data('value');
                console.log(id);
                var thisPoint = $(this);
                $.ajax({
                    type: 'post',
                    url: 'wishlist_data.php',
                    data: {
                        product_id: id,
                    },
                    success: function(response) {
                        $(thisPoint).css("display", "none");
                    }
                })
            })

        });
        // Plugin options and our code
        $("#modal_trigger").leanModal({
            top: 100,
            overlay: 0.6,
            closeButton: ".modal_close"
        });

        $(function() {
            // Calling Login Form
            $("#login_form").click(function() {
                $(".social_login").hide();
                $(".user_login").show();
                return false;
            });

            // Calling Register Form
            $("#register_form").click(function() {
                $(".social_login").hide();
                $(".user_register").show();
                $(".header_title").text('Register');
                return false;
            });

            // Going back to Social Forms
            $(".back_btn").click(function() {
                $(".user_login").hide();
                $(".user_register").hide();
                $(".social_login").show();
                $(".header_title").text('Login');
                return false;
            });
        });
    </script>
    <script>
        $(function() {
            $(".login_form").click(function() {
                var data1 = $("#form1").serialize();
                $.ajax({
                    type: 'post',
                    url: 'user_login_control.php',
                    data: data1,
                    success: function(response) {
                        const obj = JSON.parse(response);
                        console.log(obj);
                        if (obj.num == 1) {
                            $(".btn_3").replaceWith('<a href="user_dash.php" class="btn btn_3">' + obj.name + '</a>')
                            $("#modal").css("display", "none");
                            $("#lean_overlay").css({
                                "display": "none",
                                "opacity": "1"
                            })
                            // $(".heat").css("display", "block")
                        } else {
                            $(".btn_3").text("Login Error");
                        }
                    }
                })
            })
        });
    </script>
    <script>
        $(function() {
            $(".btn_reg").click(function() {
                var data2 = $("#form2").serialize();
                $.ajax({
                    type: 'post',
                    url: 'register_control.php',
                    data: data2,
                    success: function(response) {
                        $(".btn_3").text(response);
                        $("#modal").css("display", "none");
                        $("#lean_overlay").css({
                            "display": "none",
                            "opacity": "1"
                        })
                    }
                })
            })
        });
    </script>
</body>


</html>