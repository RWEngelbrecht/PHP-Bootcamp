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

						<form action="" method="POST" enctype="multipart/form-data">
							<table align="center" width="700" bgcolor="orange">
								<tr>
									<td colspan="5"><h2>Got everything?</h2></td>
								</tr>
								<tr>
									<th>Remove</th>
									<th>Products</th>
									<th>Qty</th>
									<th>Price</th>
								</tr>
								<?php
									$total = 0;
									global $con;
									$ip = getIp();
									$get_price = "select * from cart where ip_add='$ip'";
									$run_price = mysqli_query($con, $get_price);
									while($p_price = mysqli_fetch_array($run_price)) {
										$pro_id = $p_price['p_id'];
										$pro_price = "select * from products where product_id='$pro_id'";
										$run_pro_price = mysqli_query($con, $pro_price);
										while ($pp_price = mysqli_fetch_array($run_pro_price)) {
											$products_price = array($pp_price['product_price']);
											$product_title = $pp_price['product_title'];
											$product_image = $pp_price['product_image'];
											$single_price = $pp_price['product_price'];
											$values = array_sum($products_price);
											$total += $values;
								?>
								<tr align="center">
									<td> <input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>"/></td>
									<td><?php echo $product_title; ?><br/>
										<img src="admin/product_images/<?php echo $product_image;?>" width="60" height="60"/>
									</td>
									<td> <input type="text" size="3" name="qty" value="<?php echo $_SESSION['qty']; ?>"></td>
									<?php
										if (isset($_POST['update_cart'])) {
											$qty = $_POST['qty'];
											$update_qty = "update cart set qty='$qty'";
											$run_qty = mysqli_query($con, $update_qty);
											$_SESSION['qty'] = $qty;
											$total = $total * $qty;
											// echo "<script>window.open('cart.php','_self')</script>";
										}
									?>

									<td> <?php echo "R ".$single_price ?> </td>
								</tr>
								<?php } } ?>
								<tr>
									<td colspan="4" align="right"><b>Sub Total:</b></td>
									<td><?php echo "R".$total ?></b>
									</td>
								</tr>
								<tr align="center">
									<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
									<td><input type="submit" name="continue" value="Continue Shopping"/></td>
									<td><input type="submit" name="checkout" value="Checkout"></td>
								</tr>
							</table>
						</form>
						<?php
							global $con;
							$ip = getIp();
							if (isset($_POST['update_cart'])) {
								foreach($_POST['remove'] as $remove_id) {
									$delete_prod = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
									$run_delete = mysqli_query($con, $delete_prod);
									if ($run_delete) {
										echo "<script>window.open('cart.php','_self')</script>";
									}
								}
							}
							if (isset($_POST['continue'])) {
								echo "<script>window.open('index.php','_self')</script>";
							}
							if (isset($_POST['checkout'])) {
								echo "<script>window.open('checkout.php','_self')</script>";
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
