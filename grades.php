<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <title>Grades | Al Grades</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="grades">
<div id="wall">
    <div class="burger-link-container" style="font-size: 1.3em;">
        <div><a href="index.php" class="burger-link">Submit</a></div>
        <div style="background-color: rgba(255, 255, 255, 0.1);"><a href="#" style="color:red;" class="burger-link">Classes</a></div>
        <div><a href="account.php" class="burger-link">Account</a></div>
    </div>
    <div class="burger-link-container">
        <div><a href="calendar.php" class="burger-link">Calendar</a></div>
        <div><a href="grades.php" class="burger-link">All Grades</a></div>
    </div>
</div>
    <div id="grades_cont">
        <div id="grades_main">
        <form action="#" method="POST">
        <div class="burger-icon" onclick="burger(this)">
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
    <script src="js/burger.js"></script>
</body>
</html>

