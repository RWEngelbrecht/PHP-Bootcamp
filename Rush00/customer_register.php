<!DOCTYPE html>
<?php
session_start();
include("functions/functions.php");
include("includes/db_connect.php");
?>
<html>
	<head>
		<title>MozTech</title>
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="all" />
	</head>
	<body>
<!-- Main Container starts -->
		<div class ="main_wrapper">
		<!-- Header starts -->
			<div class="header_wrapper">
				<a href="index.php"><img src="images/MozBanner.gif" /></a>
			</div>
		<!-- Header ends -->
		<!-- Navigation bar starts -->
			<div class="menu_bar">
				<ul id="menu">
					<li><a href="index.php">Home</a></li></a>
					<li><a href="all_products.php">All Products</a></li>
					<li><a href="customer/my_account.php">My Account</a></li>
					<li><a href="cart.php">Cart</a></li>
					<li><a href="<?php if (!isset($_SESSION['customer_email'])){echo "checkout.php";}
										else{echo "my_account.php";}
									?>">Log In</a></li>
					<div id="form">
						<form method="GET" action="results.php" enctype="multipart/form-data">
							<input type="text" name="user_query" placeholder="What do you want?"/>
							<input type="submit" name="search" value="search" />
						</form>
					</div>
				</ul>
			</div>
		<!-- Navigation bar ends -->
		<!-- Content starts -->
			<div class="content_wrapper">
				<div id="sidebar">
					<div id="sidebar_title">Categories</div>
					<ul id="sub_cats">
						<?php get_categories(); ?>
					</ul>
					<div id="sidebar_title">Brands</div>
					<ul id="sub_cats">
						<?php get_brands(); ?>
					</ul>
				</div>
				<div id="content_area">
					<?php cart(); ?>
					<div id='shopping_cart'>
						<span style="float:right;color:black;font-size:18px;padding:5px;line-height:40px">
							 Welcome, <?php if (isset($_SESSION['customer_email'])){echo $_SESSION['customer_email'];}
							 				else{echo "Guest";} ?>.
							<b> Cart: </b> Total items: <?php total_items(); ?> Price Total: <?php total_price(); ?> <a href="cart.php" style="color:black">Go to cart</a>
						</span>
					</div>
					<div>
						<form action="customer_register.php" method="POST" enctype="multipart/form-data">
							<table align="center" width="750">
								<tr align="center">
									<td colspan="6" style="padding:15px; color:white;"><h2>Create your Account</h2></td>
								</tr>
								<tr>
									<td align="right" style="padding:15px; color:white;">Name: </td>
									<td><input type="text" name="c_name" required/></td>
								</tr>
								<tr>
									<td align="right" style="padding:15px; color:white;">E-mail: </td>
									<td><input type="text" name="c_email" required/></td>
								</tr>
								<tr>
									<td align="right" style="padding:15px; color:white;">Password: </td>
									<td><input type="password" name="c_pass" required/></td>
								</tr>
								<tr>
									<td align="right" style="padding:15px; color:white;">Image: </td>
									<td><input type="file" name="c_image" required/></td>
								</tr>
								<tr>
									<td align="right" style="padding:15px; color:white;">Country: </td>
									<td>
										<select name="c_country" required>
											<option>Select a country</option>
											<option>South Africa</option>
											<option>Nigeria</option>
											<option>China</option>
											<option>Zimbabwe</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right" style="padding:15px; color:white;">Contact Number: </td>
									<td><input type="text" name="c_contact" required/></td>
								</tr>
								<tr align="center" >
									<td colspan="6" style="padding:15px"><input type="submit" name="register" value="Create Account"/></td>
								</tr>
							</table>
						</form>
						<?php
							if (isset($_POST['register'])) {
								$ip = getIp();
								$c_name = $_POST['c_name'];
								$c_email = $_POST['c_email'];
								$c_pass = hash('whirlpool',$_POST['c_pass']);
								$c_image = $_FILES['c_image']['name'];
								$c_image_tmp = $_FILES['c_image']['tmp_name'];
								$c_country = $_POST['c_country'];
								$c_contact = $_POST['c_contact'];

								move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");
								$insert_c = "INSERT INTO customers (customer_ip, customer_name, customer_email, customer_pass, customer_country, customer_contact, customer_image) VALUES ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_contact','$c_image')";
								$run_c = mysqli_query($con, $insert_c);
								$sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";
								$run_cart = mysqli_query($con, $sel_cart);
								$check_cart = mysqli_num_rows($run_cart);
								if ($check_cart == 0) {
									$_SESSION['customer_email'] = $c_email;
									echo "<h2 align='center' style='color:white;padding:40px'>Registration Success!</h2>";
									echo "<script>window.open('customer/my_account.php', '_self')</script>";
								}
								else {
									$_SESSION['customer_email'] = $c_email;
									echo "<h2 align='center' style='color:white;padding:40px'>Registration Success!</h2>";
									echo "<script>window.open('checkout.php', '_self')</script>";
								}
							}
						?>
					</div>
				</div>
			</div>
		<!-- Content ends -->
			<div id="footer">
				<h2 style="font-size:15px; float:left; padding:70px 0 0 20px; color:white;">&copy; rengelbr 2019</h2>
				<div id="help">
					<h3>Need help?</h3>
					<li><a href="#">Contact Us</a></li>
				</div>
			</div>
		</div>
	</body>
</html>
