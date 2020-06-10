<?php session_start(); ?>
<?php include "login/not_logged.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade | Classes</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/main.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="classes">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper" id="a-submit">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper" id="a-classes">
                    <a href="#" class="active">Classes</a>
                </div>
                <div class="nav-link-wrapper" id="a-account">
                    <a href="account.php">Account</a>
                </div>
            </div>
            <div class="right-side">
            <img src="images/logo.png" class="logo" alt="logo"/>
            </div>
        </div>
        <?php if (isset($_SESSION['userID'])) {
                    echo '<a href="account.php" class="userlogged">'.$_SESSION['userUID'].'</a>';
                }
                ?>
        <div class="main">
            <div class="form">
                <div class="class-center">
                    <div id="c-add-cont">
                        <button onclick="newClass()" type="button" id="c-add" class="c-add">Add new Class</button>
                   </div>
                   <?php
                   if (isset($_SESSION['userID'])) {
                        if ($_SESSION['userGRPID'] == 3 || $_SESSION['userGRPID'] == 4) {
                            echo "<div>";
                            echo "<a class='c-add' id='user-bb' href='overview.php' name='user-bb'>User Overview</a>";
                            echo "</div>";
                        } else {
                        }
                    } else {
                        header("Location: account.php");
                   }
                   ?>
                   <?php
                        if (isset($_GET['user-preview'])) {
                            if ($_SESSION['userGRPID'] == 3) {
                                include 'classes/select_classes_bb.php';
                            } else {
                                header("Location: classes.php");
                            }
                        } else {
                            include 'classes/select_classes.php';
                        }
                    ?>
                </div>
            </div>
            <!--<div id="classadded_container">
                <p id="classadded"></p>
            </div>-->
        </div>
        <div class="footer">
            <div class="copyright"><a style="text-decoration:none;" href="privacy.php">All Rights Reserved - © SPIE ICS</a></div>
        </div>
    </div>
    <script src="js/zoom.js"></script>
    <script src="js/main.js"></script>
</body>
</html>