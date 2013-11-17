<?php 
	require('php/connection.php');
	$connect = new Database();
	$get_slide = "SELECT * FROM slides WHERE id = 1";
	$slide = $connect->fetch_result($get_slide);
?>

<html>
<head>
	<title>Edit</title>
	<link rel="stylesheet" type="text/css" href="css/cssreset.css">
	<link rel="stylesheet" type="text/css" href="css/edit.css">
</head>
<body>
	<section>
		<div id='slide'>
			<h1><?= $slide["title"] ?></h1>
		</div>
	</section>
</body>
</html>