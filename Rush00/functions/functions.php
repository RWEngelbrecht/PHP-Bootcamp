<?php

$con = mysqli_connect("localhost","root","qwerqwer","ecommerce");

//get categories from mysql database

function get_categories() {
	global $con;
	$get_cats = "select * from categories";
	$run_cats = mysqli_query($con, $get_cats);
	while ($row_cats = mysqli_fetch_array($run_cats)) {
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];
		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}

function get_brands() {
	global $con;
	$get_brands = "select * from brands";
	$run_brands = mysqli_query($con, $get_brands);
	while ($row_brands = mysqli_fetch_array($run_brands)) {
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];
		echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}

function get_prod() {
	if (!isset($_GET['cat']) && !isset($_GET['brand'])) {
		global $con;
		$get_prod = "select * from products order by RAND() LIMIT 0,6";
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
}

function get_cat_prod() {
	if (isset($_GET['cat'])) {
		global $con;
		$cat_id = $_GET['cat'];
		$get_cat_prod = "select * from products where product_cat='$cat_id'";
		$run_cat_prod = mysqli_query($con, $get_cat_prod);
		$count_cats = mysqli_num_rows($run_cat_prod);
		if ($count_cats == 0)
			echo "<h2 style='padding:20px;color:white'>There's nothing here yet :(</h2>";
		while($row_cat_prod = mysqli_fetch_array($run_cat_prod)) {
			$prod_id = $row_cat_prod['product_id'];
			$prod_title = $row_cat_prod['product_title'];
			$prod_price = $row_cat_prod['product_price'];
			$prod_image = $row_cat_prod['product_image'];
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
}

function get_brand_prod() {
	if (isset($_GET['brand'])) {
		global $con;
		$brand_id = $_GET['brand'];
		$get_brand_prod = "select * from products where product_brand='$brand_id'";
		$run_brand_prod = mysqli_query($con, $get_brand_prod);
		$count_brands = mysqli_num_rows($run_brand_prod);
		if ($count_brands == 0)
			echo "<h2 style='padding:20px;color:white'>There's nothing here yet :(</h2>";
		while($row_brand_prod = mysqli_fetch_array($run_brand_prod)) {
			$prod_id = $row_brand_prod['product_id'];
			$prod_title = $row_brand_prod['product_title'];
			$prod_price = $row_brand_prod['product_price'];
			$prod_image = $row_brand_prod['product_image'];
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
}
?>
