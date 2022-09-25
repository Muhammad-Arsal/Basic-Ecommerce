<?php
require_once "./core/database.php";
session_start();
if (isset($_POST['login'])) {
  $name = $_POST['name'];
  $pass = $_POST['password'];

  $name = trim($name);

  $que = "SELECT id,email_num,password FROM user_credentials WHERE email_num='$name' AND password = '$pass'";
  $result = mysqli_query($connection, $que);
  if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_assoc($result);

    if ($name == $row['email_num'] && $pass == $row['password']) {

      $_SESSION['user_login'] = $row['id'];
      if (isset($_POST['selector'])) {
        setcookie("remember_me", $row['id'], time() + (86400 * 30), "/");
      }
      header("location: checkout.php");
    }
  }
}
$country_name = select_all("country_name", $connection);
if (isset($_SESSION['user_login'])) {
  $user_id = $_SESSION['user_login'];
}
if (isset($_POST['proceed'])) {
  $random_number = rand(1000, 10000);
  $forms_data = array(
    "first_name" => $_POST['first_name'],
    "last_name" => $_POST['last_name'],
    "phone_number" => $_POST['number'],
    "email" => $_POST['email'],
    "country_id" => $_POST['country_select'],
    "address" => $_POST['address'],
    "postal_code" => $_POST['zip'],
    "city" => $_POST['city'],
    "order_number" => $random_number,
    "user_id" => $user_id
  );

  insert_func("order_details", $forms_data, $connection);
  $last_id = mysqli_insert_id($connection);


  $cart_session = $_SESSION['cart_items'];

  $items_in_cart = array_count_values($cart_session);

  print_r($items_in_cart);

  foreach ($items_in_cart as $key => $value) {

    $ordered_details = array();
    $product_details = select_where("seller_products", "product_id", $key, $connection, 1);
    $ordered_details = array(
      "product_id" => $key,
      "order_id" => $last_id,
      "quantity" => $value,
      "single_price" => $product_details['cost_price'],
      "total_price" => $product_details['cost_price'] * $value,
      "order_number" => $random_number,
      "status"=> 0,
      "user_id"=> $user_id,
    );
    insert_func("ordered_products", $ordered_details, $connection);
    $total_quantity = select_where("seller_products", "product_id", $key, $connection, 1);
    $current_quantity = $total_quantity['stock'];
    $main_array = array(
      "stock" => $current_quantity - $value
    );
    $id_array = array(
      "product_id" => $key
    );
    update("seller_products", $main_array, $id_array, $connection);
  }
  $notification_array = array(
    "order_id" => $last_id
  );
  insert_func("notification", $notification_array, $connection);
  unset($_SESSION['cart_items']);
  header("location: confirmation.php");
}
?>
<!doctype php>
<php lang="zxx">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>aranaz</title>
        <link rel="icon" href="img/favicon.png">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- animate CSS -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <!-- nice select CSS -->
        <link rel="stylesheet" href="css/nice-select.css">
        <!-- font awesome CSS -->
        <link rel="stylesheet" href="css/all.css">
        <!-- flaticon CSS -->
        <link rel="stylesheet" href="css/flaticon.css">
        <link rel="stylesheet" href="css/themify-icons.css">
        <!-- font awesome CSS -->
        <link rel="stylesheet" href="css/magnific-popup.css">
        <!-- swiper CSS -->
        <link rel="stylesheet" href="css/slick.css">
        <link rel="stylesheet" href="css/price_rangs.css">
        <!-- style CSS -->
        <link rel="stylesheet" href="css/style.css">
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

        .error {
            color: red;
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
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
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
                                        <a class="nav-link" href="contact.php">Contact</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="hearer_icon d-flex">
                                <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                                <a href=""><i class="ti-heart"></i></a>
                                <div class="dropdown cart">
                                    <a href="cart.php"><i class="fa badge cart_count"
                                            style="font-size:14px; margin-left: 15px;"
                                            value="<?php if (isset($_SESSION['cart_items'])) {
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

        <!--================Home Banner Area =================-->
        <!-- breadcrumb start-->
        <section class="breadcrumb breadcrumb_bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="breadcrumb_iner">
                            <div class="breadcrumb_iner_item">
                                <h2>Product Checkout</h2>
                                <p>Home <span>-</span> Shop Single</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb start-->

        <!--================Checkout Area =================-->
        <section class="checkout_area padding_top">
            <div class="container">
                <div class="returning_customer">

                    <?php
          if (!isset($_SESSION['user_login']) && !isset($_COOKIE['remember_me'])) {
          ?>
                    <div class="check_title">
                        <h2>
                            New Customer?
                            <a href="register.php">Click here to Register</a>
                        </h2>
                    </div>
                    <p>
                        If you have shopped with us before,Enter your credentials
                    </p>
                    <form class="row contact_form" action="checkout.php" method="post" novalidate="novalidate">
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="name" name="name" value=" "
                                placeholder="Mobile Number or Email" />

                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="password" class="form-control" id="password" name="password" value=""
                                placeholder="Password" />
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="btn_3" name="login">
                                log in
                            </button>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option" name="selector" />
                                <label for="f-option">Remember me</label>
                            </div>
                        </div>
                    </form>
                    <?php
          }
          ?>
                </div>
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Billing Details</h3>
                            <form class="row contact_form" action="checkout.php" method="post" novalidate="novalidate">
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="first" name="first_name"
                                        placeholder="First Name" />
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="last" name="last_name"
                                        placeholder="Last Name" />
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="number" name="number"
                                        placeholder="Phone Number" />

                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email" />
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <select class="country_select" name="country_select">
                                        <?php
                    foreach ($country_name as $names) {
                    ?>
                                        <option value="<?php echo $names['id']; ?> "><?php echo $names['name'] ?>
                                        </option>
                                        <?php
                    }
                    ?>

                                    </select>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="add1" name="address"
                                        placeholder="Address" />
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="City/town" />

                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="zip" name="zip"
                                        placeholder="Postcode/ZIP" placeholder="Postcode/ZIP" />
                                </div>
                                <?php
                if (isset($_SESSION['user_login']) || isset($_COOKIE['remember_me'])) { ?>
                                <input type="submit" name="proceed" id="" class="btn_3" value="Proceed to Confirmation">
                                <?php } ?>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li>
                                        <a href="#">Product
                                            <span>Total</span>
                                        </a>
                                    </li>
                                    <?php
                  $session_count = $_SESSION['cart_items'];
                  $number_of_repeat = count($_SESSION['cart_items']);

                  $total_items = array_count_values($session_count);

                  $sub_total = 0;
                  foreach ($total_items as $key => $value) {
                    $supplier_data = select_where("seller_products", "product_id", $key, $connection, 1);
                    $products_name = select_where("products", "id", $key, $connection, 1);
                    $sub_total += $supplier_data['cost_price'] * $value;
                  ?>
                                    <li>
                                        <a href="#"><?php echo $products_name['product_name']; ?>
                                            <span class="middle">x<?php echo $value ?></span>
                                            <span
                                                class="last"><?php echo $supplier_data['cost_price'] * $value; ?>$</span>
                                        </a>
                                    </li>
                                    <?php
                  }
                  ?>
                                </ul>

                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Subtotal
                                            <span><?php echo $sub_total; ?>$</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Checkout Area =================-->

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
                                <form target="_blank"
                                    action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                    method="get" class="subscribe_form relative mail_part">
                                    <input type="email" name="email" id="newsletter-form-email"
                                        placeholder="Email Address" class="placeholder hide-on-focus"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '">
                                    <button type="submit" name="submit" id="newsletter-submit"
                                        class="email_icon newsletter-submit button-contactForm">subscribe</button>
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
                                    Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                    </script> All rights reserved | This template is made with <i class="ti-heart"
                                        aria-hidden="true"></i> by <a href="https://colorlib.com"
                                        target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </P>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer_icon social_icon">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a>
                                    </li>
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
        <!--::footer_part end::-->

        <!-- jquery plugins here-->
        <!-- jquery -->
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
        <script src="js/stellar.js"></script>
        <script src="js/price_rangs.js"></script>
        <!-- custom js -->
        <script src="js/custom.js"></script>
        <script>
        $(document).ready(function() {
            $(".contact_form").validate({
                rules: {
                    first_name: 'required',
                    last_name: 'required',
                    city: 'required',
                    number: 'required',
                    email: 'required',
                    address: 'required',
                    zip: 'required',
                    country_select: 'required',
                },
                message: {
                    first_name: 'Field is required',
                    last_name: 'Field is required',
                    city: 'Field is required',
                    number: 'Field is required',
                    email: 'Field is required',
                    address: 'Field is required',
                    zip: 'Field is required',
                    country_select: 'Field is required',
                }
            })
        });
        </script>

    </body>

</php>