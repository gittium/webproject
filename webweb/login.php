<?php
    session_start();
    include('server.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

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
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt margin-auto-0" data-tilt>
					<img src="limiter" alt="IMG">
				</div>
                <div class="login100-form validate-form">
                    <div class="login100-form-title">
                        <h2>Login <i class="fa-solid fa-circle-user"></i></h2>
                    </div>

                    <form action="login_db.php" method="post">
                        <div class="wrap-input100">
                            <input class = "input100" type="text" name="username" placeholder = "Username" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						    </span>
                        </div>
                        <div class="wrap-input100">
                            <input class = "input100"type="password" name="password" placeholder="Password" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						    </span>
                        </div>
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="error">
                                <h6 class = "requiredment">
                                    <?php 
                                        echo $_SESSION['error'];
                                        unset($_SESSION['error']);
                                    ?>
                                </h6>
                            </div>
                        <?php endif ?>
                        <div class="container-login100-form-btn">
                            <button class = "login100-form-btn" type="submit" name="login_user" class="btn">Login</button>
                        </div>

                        <div class="text-center p-t-136">
						<a class="txt2" href="register.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					    </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
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