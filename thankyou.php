<?php
require "php/connection.php";
session_start();

require "php/find_resources.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Thank you</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/toggle_login.js"></script>
</head>

<body>

<?php require "php/header.php"; ?>

<main>
	<section>
		<div class="container clearfix">
			<h1 class="title">Thank you for registering!</h1>
			<div class="thankyou"> 
				<p>You can now login using your username and password in the following link!</p>
				<p class="link"><a href="login.php">Log in</a></p>
			</div>
		</div>
	</section>
</main>

<?php require "php/footer.php"; ?>

</body>
</html>	