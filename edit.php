<?php 
session_start();
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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src='js/edit.js'></script>
</head>
<body>
	<section>
		<div id='slide'>
			<h1 class='title' id='title' data-slideid=<?= $slide['id'] ?>><?= $slide["title"] ?></h1>
			<ul>
				<li class='listitem' id='first' data-slideid=<?= $slide['id'] ?>><?= $slide['first'] ?></li>
				<li class='listitem' id='second' data-slideid=<?= $slide['id'] ?>><?= $slide['second'] ?></li>
				<li class='listitem' id='third' data-slideid=<?= $slide['id'] ?>><?= $slide['third'] ?></li>
				<li class='listitem' id='fourth' data-slideid=<?= $slide['id'] ?>><?= $slide['fourth'] ?></li>
				<li class='listitem' id='fifth' data-slideid=<?= $slide['id'] ?>><?= $slide['fifth'] ?></li>
				<li class='listitem' id='sixth' data-slideid=<?= $slide['id'] ?>><?= $slide['sixth'] ?></li>
			</ul>
			<form id="pic" method="post" action="php/editslide.php" enctype="multipart/form-data">
			<p>Uploade a picture: <input type="file" name="file"></p>
			<p id="filestatus">
				<?php 
					if (isset($_SESSION['fileupload'])) {
						echo $_SESSION['fileupload'];
						unset($_SESSION['fileupload']);
					}
				?>
			</p>
			<input type='hidden' name='id' value=<?= $slide['id'] ?>>
			<input type="submit" value="upload">
		</form>
		<div id="uploadpic"><img src=
			<?php 
				$query = "SELECT pic FROM slides WHERE id = {$slide['id']}"; 
				$pic = $connect->fetch_result($query);
				echo "img/upload/".$pic['pic'];
			?>></div>
		</div>
	</section>
</body>
</html>