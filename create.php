<?php 
    session_start();
    require('php/connection.php');
    $connect = new Database();
    $get_slide = "SELECT * FROM slides WHERE id = 1";
    $slide = $connect->fetch_result($get_slide);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>Create New</title>
  <meta charset="iso-8859-1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="css/main.css" rel="stylesheet" type="text/css" media="all">
  <link href="css/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
  <link rel="stylesheet" type="text/css" href="css/edit.css">

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript" src='js/edit.js'></script>
</head>
<body class="">
<div class="wrapper row1">
  <header id="header" class="full_width clear">
    <hgroup>
      <h1><a href="index.html">Online Presentation Tool</a></h1>
      <h2>New Way Of Presentation</h2>
    </hgroup>
       <div id="header-contact">
      <ul class="list none">
        <li><span class="icon-envelope"></span> <a href="#">presentor@xyz.com</a></li>
        <li><span class="icon-phone"></span> xxx.xxx.xxxx</li>
      </ul>
    </div>
  </header>
</div>
 <!-- ################################################################################################ -->
<div class="wrapper row2">
  <nav id="topnav">
    <ul class="clear">
      <li class="active"><a href="../index.html" title="Homepage">Homepage</a></li>
      <li><a href="personal all.html" title="Personal">Personal All</a></li>
      <li><a href="work all.html" title="Work">Work All</a></li>

      <li><a class="drop" href="team.html" title="List Teams">Team</a>
        <ul>
          <li><a href="team.html" title="Team 1">Team 1</a></li>
          <li><a href="team.html" title="Team 2">Team 2</a></li>
          <li><a href="team.html" title="Team 3">Team 3</a></li>
          <li><a href="team.html" title="Team 4">Team 4</a></li>
          <li><a href="team.html" title="Team 5">Team 5</a></li>
          <li><a href="team.html" title="Team 6">Team 6</a></li>
          <li><a href="team.html" title="Team 7">Team 7</a></li>
          <li><a href="team.html" title="Team 8">Team 8</a></li>
          <li><a href="team.html" title="Team 9">Team 9</a></li>
          <li class="last-child"><a href="team.html" title="Team 10">Team 10</a></li>
        </ul>
      </li>
      <li><a class="drop" href="group.html" title="Gallery Layouts">Group</a>
        <ul>
          <li><a href="group.html" title="Group 1">Group 1</a></li>
          <li><a href="group.html" title="Group 2">Group 2</a></li>
          <li><a href="group.html" title="Group 3">Group 3</a></li>
          <li><a href="group.html" title="Group 4">Group 4</a></li>
          <li><a href="group.html" title="Group 5">Group 5</a></li>
          <li><a href="group.html" title="Group 6">Group 6</a></li>
          <li><a href="group.html" title="Group 7">Group 7</a></li>
          <li><a href="group.html" title="Group 8">Group 8</a></li>
          <li><a href="group.html" title="Group 9">Group 9</a></li>
          <li class="last-child"><a href="group.html" title="Group 10">Group 10</a></li>
        </ul>
      </li>
      <li><a href="about us.html" title="About Us">About Us</a></li>
      <li class="last-child"><a href="404.html" title="Error">Error</a></li>
    </ul>
  </nav>
</div>
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="one_fifth">
      <aside>
        <!-- ########################################################################################## -->
          <ul id='slidelist'>
          <?php
          $getslides = "SELECT * FROM slides WHERE presentation_id = 1"; 
          $slides = $connect->fetch_all($getslides);
          // var_dump($slides);
          for($i=0; $i<count($slides); $i++) {
            $j = $i +1;
            echo "<li class='list none' data-slideid=".$slides[$i]['id']."><img src='img/gallery.gif'>
                <header>
                <p class='blog-post-title'>Slide ".$j."</p>
                </header>
            </li>";
          } 
           ?>
            
          </ul>
      </aside>
    </div>
    <div id="portfolio" class="four_fifth">
      <ul class="clear">
        <li>
          <article class="clear">
            <!-- <figure class="post-image"><img src="img/900x552.png" alt=""></figure> -->
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
            <button id='add' data-presentation=<?= $slide['presentation_id'] ?>>Add Slide</button>
            <a <?= "href=index.php?id={$slide['presentation_id']}"; ?>><button>Presentation</button></a>
          </article>
        </li>
      </ul>
     </div>
      <p class="clear"><a class="fl_left" href="javascript:history.go(-1)">&laquo; Go Back</a> <a class="fl_right" href="#">Save</a></p>
  </div>
</div>
<!-- Footer -->
<div class="accordion-wrapper"><a href="javascript:void(0)" class="accordion-title orange"><span>Click for More Information</span></a>
<div class="accordion-content">
 <div class="wrapper row2">
   <div id="footer" class="clear">
     <div class="one_quarter first">
       <h2 class="footer_title">Footer Navigation</h2>
       <nav class="footer_nav">
         <ul class="nospace">
           <li><a href="#">Home Page</a></li>
           <li><a href="#">Our Services</a></li>
           <li><a href="#">Meet the Team</a></li>
           <li><a href="#">Blog</a></li>
           <li><a href="#">Contact Us</a></li>
           <li><a href="#">Gallery</a></li>
         </ul>
       </nav>
     </div>
     <div class="one_quarter">
       <h2 class="footer_title">Latest Gallery</h2>
       <ul id="ft_gallery" class="nospace spacing clear">
         <li class="one_third first"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
         <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
         <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
         <li class="one_third first"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
         <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
         <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
         <li class="one_third first"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
         <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
         <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
       </ul>
     </div>
     <div class="one_quarter">
       <h2 class="footer_title">Latest Comments</h2>
       <div class="tweet-container">
         <ul class="list none">
           <li><strong>@<a href="#">Presentor Name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">Presentation Name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
           <li><strong>@<a href="#">Presentor Name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">Presentation Name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
           <li><strong>@<a href="#">Presentor Name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">Presentation Name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
           <li><strong>@<a href="#">Presentor Name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">Presentation Name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
         </ul>
       </div>
     </div>
     <div class="one_quarter">
       <h2 class="footer_title">Contact Us</h2>
       <form class="rnd5" action="#" method="post">
         <div class="form-input clear">
           <label for="ft_author">Name <span class="required">*</span><br>
             <input type="text" name="ft_author" id="ft_author" value="" size="22">
           </label>
           <label for="ft_email">Email <span class="required">*</span><br>
             <input type="text" name="ft_email" id="ft_email" value="" size="22">
           </label>
         </div>
         <div class="form-message">
           <textarea name="ft_message" id="ft_message" cols="25" rows="10"></textarea>
         </div>
         <p>
           <input type="submit" value="Submit" class="button small orange">
           &nbsp;
           <input type="reset" value="Reset" class="button small grey">
         </p>
       </form>
     </div>
   </div>
 </div>

<div class="wrapper row4">
  <div id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2013 - All Rights Reserved - <a href="#">Domain Name</a></p>
  </div>
</div>
</div>
</div>
<!-- Scripts -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-latest.min.js"><\/script>\
<script src="js/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="js/jquery-mobilemenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>