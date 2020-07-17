<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades - <?php if (isset($_POST['c1-class']) || (isset($_GET['c1-class']))) {
                            include 'class/select_class.php';
                        }
                        if (isset($_POST['user-pre'])) {
                            echo $_POST['bbuid']." | ".$_POST['c2-class'];} ?>
    </title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/main.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="class">
<div id="wall">
    <div class="burger-link-container" style="font-size: 1.3em;">
        <div><a href="index.php" class="burger-link">Submit</a></div>
        <div style="background-color: rgba(255, 255, 255, 0.1);"><a href="#" style="color:red;" class="burger-link">Classes</a></div>
        <div><a href="account.php" class="burger-link">Account</a></div>
    </div>
    <div class="burger-link-container">
        <?php if($_SESSION['userGRPID'] == 3 || $_SESSION['userGRPID'] == 4) {
            echo '<div><a href="overview.php" class="burger-link">User</a></div>';
        } ?>
        <div><a href="grades.php" class="burger-link">Grades</a></div>
        <div><a href="gallery.php" class="burger-link">Gallery</a></div>
        <div><a href="calendar.php" class="burger-link">Calendar</a></div>
    </div>
</div>
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                
                <!-- Burger Icon -->
                <div class="burger-icon" onclick="burger(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
                <div class="nav-link-wrapper" id="a-submit">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper" id="a-classes">
                    <a href="classes.php" class="active">Classes</a>
                </div>
                <div class="nav-link-wrapper" id="a-account">
                    <a href="account.php">Account</a>
                </div>
            </div>
            <div class="right-side">
                <a href="index.php"><img src="images/logo.png" class="logo" alt="logo"/></a>
            <?php 
                if (isset($_SESSION['userID'])) {
                    echo '<a href="account.php" class="userlogged">'.$_SESSION['userUID'].'</a>';
                } else {
                }
            ?>
            </div>
        </div>
        <div class="main">
            <div class='class-info'><p class="title"><?php if (isset($_POST['c1-class']) || (isset($_GET['c1-class']))) {
                                                                include 'class/select_class.php';
                                                            }
                                                            if (isset($_POST['user-pre'])) {
                                                                echo "<p class='title'><span style='font-weight:bold;'>".$_POST['bbuid']."</span>, ".$_POST['c2-class']."</p>";
                                            }?></p><p class='title' id='between'>-</p><?php include "class/total_grade.php"; ?></div>
            <div id="absolutecenter">
                <div id="close" onclick="unzoom()">
                    ✕
                </div>
                <div id="download">
                </div>
            </div>
            <div class="form">
                    <div id="class-center">
                            <?php include 'class/select_grade.php'; ?>
                    </div>
                <div id='imgdiv' style='width:100%;position:absolute;display:flex;justify-content:center;'></div>
                <?php
                    if (isset($_POST['who']) == "bb") {
                       echo '<div class="bck-btn">
                        <a href="overview.php" style="margin-right:10px;">Back</a>
                        <a href="classes.php">Classes</a>
                        </div>';
                    }
                ?>
            </div>
        </div>
        <div class="footer">
            <div class="copyright"><a style="text-decoration:none;" href="privacy.php">All Rights Reserved - © SPIE ICS</a></div>
        </div>
    </div>
    <script src="js/zoom.js"></script>
    <script src="js/burger.js"></script>
</body>
</html>