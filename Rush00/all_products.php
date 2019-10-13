<!DOCTYPE html>
<?php
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
					<li><a href="#">Sign Up</a></li>
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
					<div id='shopping_cart'>
						<span style="float:right;color:black;font-size:18px;padding:5px;line-height:40px">
							 Welcome, guest.
							<b> Cart: </b> Total items: Price total: <a href="cart.php" style="color:black">Go to cart</a>
						</span>
					</div>
					<div id="products_box">
					<?php
						if (!isset($_GET['cat']) && !isset($_GET['brand'])) {
							$get_prod = "select * from products";
							$run_prod = mysqli_query($con, $get_prod);
							while($row_prod = mysqli_fetch_array($run_prod)) {
								$prod_id = $row_prod['product_id'];
								$prod_brand = $row_prod['product_brand'];
								$prod_cat = $row_prod['product_cat'];
								$prod_title = $row_prod['product_title'];
								$prod_price = $row_prod['product_price'];
								$prod_image = $row_prod['product_image'];
								echo "
										<div id='single_product'>
											<h3>$prod_title</h3>
											<img src='admin/product_images/$prod_image' width='180' height='180' style=''/>
											<p style='margin-bottom:5px'>R$prod_price.99</p>
											<a href='details.php?pro_id=$prod_id' style='text-decoration:none;color:orange'>Details</a>
											<a href='index.php?pro_id=$prod_id'><button style='margin-left:70px'>Add to cart</button></a>
										</div>
								";
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
