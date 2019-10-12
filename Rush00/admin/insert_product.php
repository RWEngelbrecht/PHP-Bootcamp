<!DOCTYPE html>
<html>
	<head>
		<title>Insert Product</title>
	</head>
	<body style="background-color:white">
		<form action="insert_product.php" method="POST" enctype="multipart/form-data">
			<table align="center" width="750px" border="1px" style="background-color: rgba(65, 50, 224, 0.836)">
				<tr align="center">
					<td colspan="5"><h2>Enter new product details</h2></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product title:</td>
					<td><input type="text" name="product_title"/></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product catagory:</td>
					<td><input type="text" name="product_title"/></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product brand:</td>
					<td><input type="text" name="product_title"/></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product price:</td>
					<td><input type="text" name="product_title"/></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product image:</td>
					<td><input type="text" name="product_title"/></td>
				</tr>
				<tr>
					<td align="right" style="font-weight:bold">Product description:</td>
					<td><input type="text" name="product_title"/></td>
				</tr>
				<tr align="center">
					<td colspan="5"><input type="submit" name="product_post" value="Insert"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>
