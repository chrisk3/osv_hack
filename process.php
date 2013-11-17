<?php

	if (isset($_POST['action']) and !empty($_POST['action']))
	{
		if ($_POST['action'] == 'login')
			login();
		if ($_POST['action'] == 'register')
			register();
	}

	function login()
	{
		
	}

	function register()
	{

	}

?>