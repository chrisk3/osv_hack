<?php 
require('connection.php');
$connect = new Database();

if (isset($_POST['id']) && isset($_POST['slideid'])) {
	$query = "SELECT {$_POST['id']} FROM slides WHERE id = {$_POST['slideid']}";
	$content = $connect->fetch_result($query);
	$bullet = $content["{$_POST['id']}"];
	$json = "<input type='text' data-inputid={$_POST['id']} value={$bullet}>";
	echo json_encode($json);
} elseif (isset($_POST['saveid']) && isset($_POST['saveslideid']) && isset($_POST['content'])) {
	$content = stripslashes(mysql_real_escape_string(htmlentities($_POST['content'])));
	$content = str_replace("'", "''", $content);
	$update = "UPDATE slides SET {$_POST['saveid']} = '$content' WHERE id = {$_POST['saveslideid']}";
	$connect->run_query($update);
	$get_new = "SELECT {$_POST['saveid']} FROM slides WHERE id = {$_POST['saveslideid']}";
	$content = $connect->fetch_result($get_new);
	echo $content["{$_POST['saveid']}"];
}

?>