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
        <div id="secret_main">
        <form action="login/change_pw.php" method="POST">
            <div class="grid-wrapper">
                <?php include "secret/images.php"; ?>        
            </div>
            <!--<br><a id="change-bck" href="index.php">Back</a>-->
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
    <script src="js/zoom.js"></script>
</body>
</html>

