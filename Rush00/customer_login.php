<div>
	<form method="POST" action="">
		<table width="500" align="center" bgcolor="orange">
			<tr align="center">
				<td colspan="3"><h2>Please log in or register</h2></td>
			</tr>
			<tr align="center">
				<td align="right">Email:</td>
				<td><input type="text" name="email" placeholder="enter email" required/></td>
			</tr>
			<tr>
				<td align="right">Password:</td>
				<td><input type="password" name="pass" placeholder="enter password" required/></td>
			</tr>
			<tr align="right">
				<td colspan="3" style="font-size:12px;padding:5px 85px"><a href="checkout.php?forgot_pass">Forgot Password?</a></td>
			</tr>
			<tr align="center">
				<td colspan="3"><input type="submit" name="login" value="Login"/></td>
			</tr>
		</table>
		<h2 style="float:left; padding-right:300px;color:white;">Don't have an acoount? <a href="customer_register.php" style="text-decoration:none;color:orange;">Register here</a>, it's free! <small style="font-size:10px">mostly...</small></h2>
	</form>
	<?php
		// global $con;
		// if (isset($_POST['login'])) {

		// 	$cust_email = $_POST['email'];
		// 	$get_customer = "SELECT * FROM customers WHERE customer_email='$cust_email'";
		// 	$run_customer = mysqli_query($con, $get_customer);
		// 	print_r($run_cust);
		// 	if (mysqli_num_row($run_customer)==0)
		// 		echo "<script>window.open('customer_register.php','_self')</script>";
		// 	else {
		// 		$cust_info = mysqli_fetch_array($run_customer);
		// 		if ($cust_info['customer_pass'] == $_POST['pass'])
		// 			echo "<script>window.open('checkout.php','_self')</script>";
		// 		else
		// 			echo "<h2 style='color:white'>Password incorrect!</h2>";
		// 	}
		// }
	?>
</div>
