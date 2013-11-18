<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Parallax Demo</title>

	<link rel="stylesheet" media="all" href="css/pres.css">

	<script src="js/modernizr.custom.37797.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/pres.js"></script>
</head>
	<body>

<?php

    require_once('connection.php');

    $id = $_GET['id'];

	$query_fetch_slides = "SELECT * FROM slides WHERE presentation_id = {$id}";
    $slides = fetch_all($query_fetch_slides);
    $count = 1;
    $speed = count($slides) + 5;

?>

		<div id="container" <?= "data-speed='" . $speed . "'" ?> data-type="background">
<?php 

	if (isset($slides))
	{
		foreach ($slides as $slide)
		{
?>
			<div class="home">
				<div class="slide" <?= "id='" . $count . "'"; ?>>
					<div class="buttons">
						<button class="prev"><< Prev</button>
						<button class="next">Next >></button>
					</div>
					<div class="content">
						<h2><?= $slide['title']; ?></h2>
						<img <?= "src='img/upload/" . $slide['pic'] . "'"; ?> alt="picture" class="pic">
						<ul>
<?php 					if (!empty($slide['first']))
							echo "<li>" . $slide['first'] . "</li>";
						if (!empty($slide['second']))
							echo "<li>" . $slide['second'] . "</li>";
						if (!empty($slide['third']))
							echo "<li>" . $slide['third'] . "</li>";
						if (!empty($slide['fourth']))
							echo "<li>" . $slide['fourth'] . "</li>";
						if (!empty($slide['fifth']))
							echo "<li>" . $slide['fifth'] . "</li>";
						if (!empty($slide['sixth']))
							echo "<li>" . $slide['sixth'] . "</li>";
?>
						</ul>
					</div>
				</div>
			</div>
<?php	$count++;
		}
	}

?>
		</div>

	</body>
</html>