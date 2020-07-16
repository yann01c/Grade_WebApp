<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" class="gbody">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades | Gallery</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="gallery" class="gbody">
<div id="wall">
    <div class="burger-link-container" style="font-size: 1.3em;">
        <div><a href="index.php" class="burger-link">Submit</a></div>
        <div><a href="#" class="burger-link">Classes</a></div>
        <div><a href="account.php" class="burger-link">Account</a></div>
    </div>
    <div class="burger-link-container">
        <div><a href="overview.php" class="burger-link">User Overview</a></div>
        <div><a href="grades.php" class="burger-link">Grades Overview</a></div>
        <div style="background-color: rgba(255, 255, 255, 0.1);"><a href="gallery.php" class="burger-link burger-link-active">Image Gallery</a></div>
        <div><a href="calendar.php" class="burger-link">Calendar</a></div>
    </div>
</div>
<!-- Burger Icon -->
<div class="burger-icon" onclick="burger(this)">
    <div class="bar1"></div>
    <div class="bar2"></div>
    <div class="bar3"></div>
</div>
    <div id="gallery_cont">
        <div style="display:flex;justify-content:center;text-align: center;">
            <div class="header">
                <h1>Gallery</h1>
                <p>
                    You can find every image you ever uploaded on this page.        
                </p>
            </div>
        </div>
        <div id="gallery_main">
        <form action="#" method="POST">
            <!-- <a class="gallery-back" href="index.php">Back</a> -->
            <div style="margin-bottom:11em;width: 100%;"></div>
            <div class="wrapper">
                <?php include "all/images.php"; ?>        
            </div>
        </div>
        <div id="absolutecenter">
            <div id="close" onclick="unzoom()">
                ✕
            </div>
            <div id="download">
            </div>
        </div>
    </div>
    <script src="js/zoom_gallery.js"></script>
    <script src="js/burger-grades.js"></script>
</body>
</html>

