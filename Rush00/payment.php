<div>
	<h1 style="color:white">This shop is fake! What are you doing???</h1>
	<h2 style="color:white">But you can pay so long, and we'll archive your order for you.</h2>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="submit" name="pay" value="Pay Now"/>
	</form>
	<?php
		global $con;
		$ip = getIp();
		if (isset($_POST['pay'])) {
			$get_order = "SELECT * FROM cart WHERE ip_add='$ip'";
			$run_order = mysqli_query($con, $get_order);
			$order = array();
			$cust_email = $_SESSION['customer_email'];
			$get_cust_info = "SELECT * FROM customers WHERE customer_email='$cust_email'";
			$run_cust_info = mysqli_query($con, $get_cust_info);
			$customer = mysqli_fetch_array($run_cust_info);
			$cust_id = $customer['customer_id'];
			while ($order = mysqli_fetch_array($run_order)) {
				$order_prod_id = $order['p_id'];
				$get_order_info = "SELECT * FROM products WHERE product_id='$order_prod_id'";
				$run_order_info = mysqli_query($con, $get_order_info);
				while ($order_prod = mysqli_fetch_array($run_order_info)) {
					$prod_id = $order_prod['product_id']."\n";
					$prod_name = $order_prod['product_title']."\n";
					$prod_qty = $_SESSION['qty']."\n";
					$prod_price = $order_prod['product_price'];
					$get_cust_order = "INSERT INTO orders (prod_id, prod_name, prod_qty, prod_price, cust_id) VALUES ('$prod_id','$prod_name','$prod_qty','$prod_price','$cust_id')";
					$run_cust_order = mysqli_query($con, $get_cust_order);
				}
			}
			if ($run_cust_order) {
				echo "<h3 style='color:white'>Success!</h3>";
			}
		}
	?>
</div>
