<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <title>Grades | Grades Overview</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="grades">
<div id="top-wall">
    <div class="top-content">
        <?php include "all/scroll.php"; ?>
    </div>
</div>

<div class="top-dropdown">
    <div id="top-dropdown-cont" onclick="droptop(this)">
        <p id="top-arrow" class="top-dropdown-arrow">
            V
        </p>
    </div>
</div>
<div id="wall">
    <div class="burger-link-container" style="font-size: 1.3em;">
        <div><a href="index.php" class="burger-link">Submit</a></div>
        <div><a href="classes.php" class="burger-link">Classes</a></div>
        <div><a href="#" class="burger-link">Account</a></div>
    </div>
    <div class="burger-link-container">
        <?php if($_SESSION['userGRPID'] == 3 || $_SESSION['userGRPID'] == 4) {
            echo '<div><a href="overview.php" class="burger-link">User</a></div>';
        } ?>
        <div style="background-color: rgba(255, 255, 255, 0.1);"><a href="grades.php" class="burger-link burger-link-active">Grades</a></div>
        <div><a href="gallery.php" class="burger-link">Gallery</a></div>
        <div><a href="calendar.php" class="burger-link">Calendar</a></div>
    </div>
</div>
    <div id="grades_cont">
        <div id="grades_main">
        <form action="#" method="POST">
            <!-- <div style="position:fixed;left:15px;top:10px;z-index:10000;"> -->
                <div class="burger-icon" onclick="burger(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            <!-- </div> -->

            <div class="big-wrapper">
                <?php include 'all/allgrades.php'; ?>
            </div>
        </form>
        </div>
    </div>
    <script src="js/sort.js"></script>
    <script src="js/burger-grades.js"></script>
</body>
</html>

