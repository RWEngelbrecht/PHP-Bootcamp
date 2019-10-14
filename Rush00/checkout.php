<!DOCTYPE html>
<?php
session_start();
include("functions/functions.php");
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
					<div id="products_box">
						<?php
							if (!isset($_SESSION['customer_email'])) {
								include("customer_login.php");
								global $con;
								if (isset($_POST['login'])) {

									$cust_email = $_POST['email'];
									$get_customer = "SELECT * FROM customers WHERE customer_email='$cust_email'";
									$run_customer = mysqli_query($con, $get_customer);
									if (mysqli_num_rows($run_customer)==0)
										echo "<script>window.open('customer_register.php','_self')</script>";
									else {
										$cust_info = mysqli_fetch_array($run_customer);
										if ($cust_info['customer_pass'] == $_POST['pass'])
											echo "<script>window.open('checkout.php','_self')</script>";
										else
											echo "<h2 style='color:white'>Password incorrect!</h2>";
									}
								}
							}
							else {
								include("payment.php");
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
