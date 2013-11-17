<?php

	require_once('connection.php');

	session_start();

	if (isset($_POST['action']) AND $_POST['action'] == 'login')
		login();
	else if (isset($_POST['action']) AND $_POST['action'] == 'register')
		register();

	function login()
	{
		$errors = NULL;

		// Email validation
		if (empty($_POST['email']))
			$errors[] = "Please enter your email";
		else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == FALSE)
			$errors[] = "Invalid email format, please re-enter";

		// Password validation
		if (empty($_POST['login_password']))
			$errors[] = "Please enter your password";
		else if (strlen(($_POST['login_password'])) < 6)
			$errors[] = "Password must be at least 6 characters";

		// If there are errors, pass them to login.php
		if (count($errors) > 0)
		{
			$_SESSION['login_errors'] = $errors;
			header("Location: login.php");
		}
		else
		{
			$email = mysql_real_escape_string($_POST['email']);
			$password = mysql_real_escape_string($_POST['login_password']);

			$query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'";
			$users = fetch_all($query);

			if (count($users) > 0)
			{
				$_SESSION['logged_in'] = TRUE;
				$_SESSION['user']['id'] = $users[0]['id'];
				$_SESSION['user']['email'] = $users[0]['email'];
				$_SESSION['user']['name'] = $users[0]['name'];
				header("Location: login.php");
			}
			else
			{
				$errors[] = "Email and password do not match.";
				$_SESSION['login_errors'] = $errors;
				header("Location: login.php");
			}
		}
	}

	function register()
	{
		$errors = NULL;

		// Email validation
		if (empty($_POST['email']))
			$errors[] = "Please enter your email";
		else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == FALSE)
			$errors[] = "Invalid email format, please re-enter";

		// Name validation
		if (empty($_POST['name']))
			$errors[] = "Please enter your first name";
		else if (is_numeric($_POST['name']))
			$errors[] = "First name cannot be numeric";

		// Password validation
		if (empty($_POST['password']))
			$errors[] = "Please enter a password";
		else if (strlen($_POST['password']) < 6)
			$errors[] = "Password must be at least 6 characters";

		// Password confirm validation
		if (empty($_POST['confirm_password']))
			$errors[] = "Please confirm your password";
		else if ($_POST['password'] != $_POST['confirm_password'])
			$errors[] = "Passwords do not match";

		// If there are errors pass them to login.php
		if (count($errors) > 0)
		{
			$_SESSION['registration_errors'] = $errors;
			header("Location: login.php");
		}
		else
		{
			$email = mysql_real_escape_string($_POST['email']);
			$query = "SELECT * FROM users WHERE email = '{$email}'";
			$users = fetch_all($query);

			if (count($users) > 0)
			{
				$errors[] = "Email already registered";
				$_SESSION['registration_errors'] = $errors;
				header("Location: login.php");
			}
			else
			{
				$name = mysql_real_escape_string($_POST['name']);
				$password = mysql_real_escape_string($_POST['password']);

				$query = "INSERT INTO users (email, name, password, created_at, updated_at) VALUES ('{$email}', '{$name}', '{$password}', NOW(), NOW())";
				mysql_query($query);

				$_SESSION['success_message'] = "User created successfully";
				header("Location: login.php");
			}
		}
	}

?>