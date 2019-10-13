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
				<img src="images/MozBanner.gif" />
			</div>
		<!-- Header ends -->
		<!-- Navigation bar starts -->
			<div class="menu_bar">
				<ul id="menu">
					<li><a href="#">Home</a></li>
					<li><a href="#">All Products</a></li>
					<li><a href="#">My Account</a></li>
					<li><a href="#">Cart</a></li>
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
					<?php
						if (isset($_GET['pro_id'])) {
							$product_id = $_GET['pro_id'];
							$get_prod = "select * from products where product_id='$product_id'";
							$run_prod = mysqli_query($con, $get_prod);
							while($row_prod = mysqli_fetch_array($run_prod)) {
								$prod_id = $row_prod['product_id'];
								$prod_title = $row_prod['product_title'];
								$prod_price = $row_prod['product_price'];
								$prod_image = $row_prod['product_image'];
								$prod_descr = $row_prod['product_descr'];
								echo "
										<div id='single_product'>
											<h3>$prod_title</h3>
											<img src='admin/product_images/$prod_image' width='250' height='200'/>
											<p style='margin-bottom:5px;color:white'>R$prod_price.00</p>
											<p> $prod_descr</p>
											<a href='index.php' style='text-decoration:none;color:orange'>Go Back</a>
											<a href='index.php?pro_id=$prod_id'><button style='margin-left:100px'>Add to cart</button></a>
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
