<?php
    session_start();
    include('server.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <link rel="stylesheet" href="style2.css">
    <script src="https://kit.fontawesome.com/5368a84f0e.js" crossorigin="anonymous"></script>
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/main_pic.jfif"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
<!--===============================================================================================-->
</head>
<body>
<form action="product_db.php" method="POST">
    <label for="product_id">Product ID:</label>
    <input type="text" name="product_id" required><br>

    <label for="product_name">Product Name:</label>
    <input type="text" name="product_name" required><br>

    <label for="category">Category:</label>
    <input type="text" name="category" required><br>

    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" required><br>

    <label for="stock">Stock Quantity:</label>
    <input type="number" name="stock" required><br>

    <button type="submit" name="Addmin_user">Add Product</button>
</form>

    <!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>