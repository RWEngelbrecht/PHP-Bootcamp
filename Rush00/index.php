<!DOCTYPE html>
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
					<form method="GET" action="results" enctype="multipart/form-data">
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
						<li><a href="#">Computer</a></li>
						<li><a href="#">Mobile</a></li>
						<li><a href="#">Camera</a></li>
					</ul>
					<div id="sidebar_title">Brands</div>
					<ul id="sub_cats">
						<li><a href="#">Apple</a></li>
						<li><a href="#">Dell</a></li>
						<li><a href="#">Toshiba</a></li>
					</ul>
				</div>
				<div id="content_area"></div>
			</div>
		<!-- Content ends -->
			<div id="footer">
				<div id="help">
					<h3>Need help?</h3>
					<li><a href="#">Contact Us</a></li>
				</div>
			</div>
		</div>
	</body>
</html>
