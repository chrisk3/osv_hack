<?php 
session_start();
require('connection.php');
$connect = new Database();

if (isset($_POST['id']) && isset($_POST['slideid'])) {
	$query = "SELECT {$_POST['id']} FROM slides WHERE id = {$_POST['slideid']}";
	$content = $connect->fetch_result($query);
	$bullet = $content["{$_POST['id']}"];
	$json = "<input type='text' data-inputid={$_POST['id']} value='".$bullet."'>";
	echo json_encode($json);
} elseif (isset($_POST['saveid']) && isset($_POST['saveslideid']) && isset($_POST['content'])) {
	$content = stripslashes(mysql_real_escape_string(htmlentities($_POST['content'])));
	$content = str_replace("'", "''", $content);
	$update = "UPDATE slides SET {$_POST['saveid']} = '$content' WHERE id = {$_POST['saveslideid']}";
	$connect->run_query($update);
	$get_new = "SELECT {$_POST['saveid']} FROM slides WHERE id = {$_POST['saveslideid']}";
	$content = $connect->fetch_result($get_new);
	echo $content["{$_POST['saveid']}"];
} else if (isset($_FILES['file']) && isset($_POST['id'])) {
	// File restrictions
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	// && ($_FILES["file"]["size"] < 20000)
	&& in_array($extension, $allowedExts)) {
		 if ($_FILES["file"]["error"] > 0) {
	    	$_SESSION['fileupload'] = "Error: " . $_FILES["file"]["error"] . "<br>";
		 } else {
	   		if (file_exists("../img/upload/" . $_FILES["file"]["name"])) {
	      		$_SESSION['fileupload'] = $_FILES["file"]["name"] . " already exists. ";
	      		header("Location: ../edit.php");
	      	} else {
		      move_uploaded_file($_FILES["file"]["tmp_name"],
		      "../img/upload/" . $_FILES["file"]["name"]);
		      $_SESSION['fileupload'] = $_FILES["file"]["name"]." successfully uploaded";

		      $query = "UPDATE slides SET pic = '{$_FILES['file']['name']}' WHERE id = '{$_POST['id']}'";
		      $connect->run_query($query);
		      header("Location: ../edit.php");
		    }
		 }
	}
}

?>