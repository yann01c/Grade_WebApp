<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - <?php include 'class/select_class.php'; ?></title>
    <link rel="icon" type="image/png" href="images/logo.png" sizes="32x32">
    <link rel="stylesheet" href="css/main.css">
</head>
<body id="class">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
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
            <img src="images/logo.png" class="logo" alt="logo"/>
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
                <div class="bck-btn">
                    <a href="classes.php" style="margin-right:10px;">Back</a>
                    <a href="index.php">Submit</a>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="copyright"><a style="text-decoration:none;" href="privacy.php">All Rights Reserved - © SPIE ICS</a></div>
        </div>
    </div>
    <script src="js/zoom.js"></script>
</body>
</html>