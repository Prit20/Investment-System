<?php
include('include/dbcon.php');
// include('include/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- style link -->
    <link rel="stylesheet" href="style.css">

    <!-- js link  -->
    <script src="script.js"></script>

    <!-- bootstrep cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- bootstrep icon cdn link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
	body{
	background: linear-gradient(90deg, #C7C5F4, #776BCC);		

	}
</style>
<div class="container">
	<div class="screen">
		<div class="screen__content">
            <form method="POST" action="login_db.php" class="login">

				<div class="login__field">
					<i class="login__icon bi bi-person-circle"></i>
					<input type="text" class="login__input" name="userid" placeholder="UserId" require>
				</div>
				<div class="login__field">
					<i class="login__icon bi bi-lock"></i>
					<input type="password" class="login__input" name="password" placeholder="Password" require>
				</div>
				<button type="submit" class="button login__submit" name="login">
					<span class="button__text">Log In</span>
					<i class="button__icon bi bi-chevron-right"></i>
				</button>				
			</form>
			<!-- <div class="social-login">
				<h3>log in via</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div> -->
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>


<?php
include('include/footer.php');
?>