<?php
require_once "../core/database.php";
session_start();
if (isset($_SESSION['uid']) || isset($_COOKIE['remember_me'])) {
	header("location: index.php");
}

if (isset($_POST['login'])) {
	$email = $_POST['aEmail'];
	$pass = $_POST['aPass'];

	$mysql = "SELECT id,email,password FROM admin_credentials WHERE email = '$email' AND password = '$pass'";
	$res = mysqli_query($connection, $mysql);
	if (mysqli_num_rows($res) > 0) {
		$row = mysqli_fetch_assoc($res);
		if ($email == $row['email'] && $pass == $row['password']) {
			$_SESSION['uid'] = $row['id'];
			if (isset($_POST['rem'])) {
				setcookie("remember_me", $row['id'], time() + (86400 * 30), "/");
			}

			header("location: index.php");
		} else {
			die();
		}
	}
}

?>
<!doctype html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">

</head>

<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Admin Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center">Enter your Credentials</h3>
						<form action="login.php" method="POST" class="signin-form">
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Enter email" name="aEmail" required>
							</div>
							<div class="form-group">
								<input id="password-field" type="password" class="form-control" placeholder="Password" required name="aPass">
								<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3" name="login">Log In</button>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">Remember Me
										<input type="checkbox" name="rem">
										<span class="checkmark"></span>
									</label>
								</div>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>