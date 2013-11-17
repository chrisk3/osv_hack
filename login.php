<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login/Registration</title>
	<link rel="stylesheet" href="css/cssreset.css">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>

	<div id="container">
		<div id="login" class="inline-b">
<?php 
	if (isset($_SESSION['login_errors']))
	{
		foreach ($_SESSION['login_errors'] as $error)
		{
			echo "<span class='error'>{$error}</span>" . "<br>";
			unset($_SESSION['login_errors']);
		}
	}
?>
			<form action="process.php" method="post">
				<input type="hidden" name="action" value="login">
				<div class="form-group">
					<label for="login_email">Email: <br />
					<input type="text" name="email" id="login_email"></label>
				</div>
				<div class="form-group">
					<label for="login_password">Password: <br />
					<input type="password" name="login_password" id="login_password"></label>
				</div>
				<input type="submit" value="Login">
			</form>
		</div>
		<div id="registration" class="inline-b">
<?php 	
	if (isset($_SESSION['registration_errors']))
	{
		foreach ($_SESSION['registration_errors'] as $error)
		{
			echo "<span class='error'>{$error}</span>" . "<br>";
			unset($_SESSION['registration_errors']);
		}
	}
?>
			<form action="process.php" method="post">
				<input type="hidden" name="action" value="register">
				<div class="form-group">
					<label for="email">Email: <br />
					<input type="text" name="email" id="email"></label>
				</div>
				<div class="form-group">
					<label for="name">Name: <br />
					<input type="text" name="name" id="name"></label>
				</div>
				<div class="form-group">
					<label for="password">Password: <br />
					<input type="password" name="password" id="password"></label>
				</div>
				<div class="form-group">
					<label for="confirm_password">Confirm Password: <br />
					<input type="password" name="confirm_password" id="confirm_password"></label>
				</div>
				<input type="submit" value="Sign Up">
			</form>
		</div>
	</div>

</body>
</html>