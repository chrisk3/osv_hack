<?php
require('connection.php'); 
$connect = new Database();
if (isset($_POST['slideid'])) {
    $query = "SELECT pic FROM slides WHERE id = {$_POST['slideid']}";
    $pic = $connect->fetch_result($query);

    $getslide = "SELECT * FROM slides WHERE id = {$_POST['slideid']}";
    $slide = $connect->fetch_result($getslide);
    $html = "<h1 class='title' id='title' data-slideid=".$slide['id'].">".$slide["title"]."</h1>
                <ul>
                  <li class='listitem' id='first' data-slideid=".$slide['id'].">".$slide['first']."</li>
                  <li class='listitem' id='second' data-slideid=".$slide['id'].">".$slide['second']."</li>
                  <li class='listitem' id='third' data-slideid=".$slide['id'].">".$slide['third']."</li>
                  <li class='listitem' id='fourth' data-slideid=".$slide['id'].">".$slide['fourth']."</li>
                  <li class='listitem' id='fifth' data-slideid=".$slide['id'].">".$slide['fifth']."</li>
                  <li class='listitem' id='sixth' data-slideid=".$slide['id'].">".$slide['sixth']."</li>
                </ul>
                <form id='pic' method='post' action='php/editslide.php' enctype='multipart/form-data'>
                <p>Uploade a picture: <input type='file' name='file'></p>
                <p id='filestatus'>
                </p>
                <input type='hidden' name='id' value=".$slide['id'].">
                <input type='submit' value='upload'>
              </form>
              <div id='uploadpic'><img src='img/upload/".$pic['pic']."'></div>";
              echo json_encode($html);
} else if (isset($_POST['presentation'])) {
    $query = "INSERT INTO slides (presentation_id, title, created_at) VALUES ('{$_POST['presentation']}', 'New Slide', NOW())";
    $connect->run_query($query);
    $count_slides = "SELECT count(*) as count FROM slides WHERE presentation_id={$_POST['presentation']}";
    $count = $connect->fetch_all($count_slides);
    $get_new = "SELECT * FROM slides WHERE presentation_id={$_POST['presentation']} ORDER BY created_at DESC";
    $new_slide = $connect->fetch_result($get_new);
    $html = "<li class='list none' data-slideid=".$new_slide['id']."><img src='img/gallery.gif'>
                <header>
                <p class='blog-post-title'>Slide ".$count[0]['count']."</p>
                </header>
            </li>";
    echo json_encode($html);
}
?>