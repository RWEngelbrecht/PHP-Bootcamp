<!DOCTYPE html>
<?php
include("includes/connect.php");
?>
<html>
	<head>
		<title>Insert Product</title>
	</head>
	<body style="background-color:white">
		<form action="insert_product.php" method="POST" enctype="multipart/form-data">
			<table align="center" width="600px" border="1px" style="background-color: rgba(65, 50, 224, 0.836)">
				<tr align="center">
					<td colspan="5"><h2>Enter new product details</h2></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product title:</td>
					<td><input type="text" name="product_title" size="72" required/></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product category:</td>
					<td><select name="product_cat" required>
						<option>Select a category</option>
						<?php
							$get_cats = "select * from categories";
							$run_cats = mysqli_query($con, $get_cats);
							while ($row_cats = mysqli_fetch_array($run_cats)) {
								$cat_id = $row_cats['cat_id'];
								$cat_title = $row_cats['cat_title'];
								echo "<option value=\"$cat_id\">$cat_title</option>";
							}
						?>
					</td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product brand:</td>
					<td><select name="product_brand" required>
						<option>Select brand</option>
						<?php
							$get_brands = "select * from brands";
							$run_brands = mysqli_query($con, $get_brands);
							while ($row_brands = mysqli_fetch_array($run_brands)){
								$brand_id = $row_brands['brand_id'];
								$brand_title = $row_brands['brand_title'];
								echo "<option value=\"$brand_id\">$brand_title</option>";
							}
						?>
					</td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product price:</td>
					<td><input type="text" name="product_price" size="72" required/></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product image:</td>
					<td><input type="file" name="product_image" required/></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product description:</td>
					<td><textarea name="product_descr" cols="30" rows="5" width="72"></textarea></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product keywords:</td>
					<td><input type="text" name="product_keywords" size="72" required/></td>
				</tr>
				<tr align="center">
					<td colspan="5"><input type="submit" name="product_post" value="Insert"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php
if (isset($_POST['product_post'])){
	$prod_title = $_POST['product_title'];
	$prod_categ = $_POST['product_cat'];
	$prod_price = $_POST['product_price'];
	$prod_brand = $_POST['product_brand'];
	$prod_descr = $_POST['product_descr'];
	$prod_keywds = $_POST['product_keywords'];
	$prod_image = $_FILES['product_image']['name'];
	$prod_image_tmp = $_FILES['product_image']['tmp_name'];
	move_uploaded_file($prod_image_tmp, "product_images/$prod_image");

	$insert_product = "insert into products (product_cat, product_brand, product_title, product_price, product_descr, product_image, product_keywords) values ('$prod_categ', '$prod_brand', '$prod_title', '$prod_price', '$prod_descr', '$prod_image', '$prod_keywds')";

	if (!$insert_pro = mysqli_query($con, $insert_product))
		

}
?>
