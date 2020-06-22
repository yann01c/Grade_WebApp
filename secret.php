<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade | News</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="secret">
    <div id="secret_cont">
        <div style="display:flex;justify-content:center;text-align: center;">
            <div class="header">
                <h1>Gallery</h1>
                <p>
                    You can find every image you ever uploaded on this page.        
                </p>
            </div>
        </div>
        <div id="secret_main">
        <form action="#" method="POST">
            <a class="secret-back" href="index.php">Back</a>
            <div class="wrapper">
                <?php include "secret/images.php"; ?>        
            </div>
        </form>
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
</body>
</html>

