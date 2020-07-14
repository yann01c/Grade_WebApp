<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <title>Grades | All Grades</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="grades">
    <div id="test">
        <a href="#" class="ye">test</a>
        <a href="#" class="ye">test</a>
        <a href="#" class="ye">test</a>
        <a href="#" class="ye">test</a>
    </div>
    <button onclick="openup()">OPEN</button>

    <div id="grades_cont">
        <div id="grades_main">
        <form action="#" method="POST">
        <div class="dd" onclick="navigate(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
            <!-- <div id="drpdwn" onclick="navigate()">&#9776;</div> -->
            <div class='grades-link' id="n-dropdown">
                <?php include 'all/scroll.php';?>
            </div>
            <div class="big-wrapper">
                <?php include 'all/allgrades.php'; ?>
            </div>
        </form>
        <!-- <div style="width:100%;display:flex;justify-content:center;"><a class="grades-back" href="index.php">Back</a></div> -->
        </div>
    </div>
    <script src="js/sort.js"></script>
</body>
</html>

