<?php session_start(); ?>
<?php include "login/not_logged.php";?>
<?php include "sqlite/create_db.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2, maximum-scale=1, user-scalable=0"/>
    <title>Grades | Submit</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">

    <!-- IOS Icon (instead of manifest icon)
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/logo.png">
    <link rel="apple-touch-icon" sizes="167x167" href="images/logo.png"> -->
        
    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

    <!-- IOS Startup SPLASH -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <link rel="apple-touch-startup-image" href="images/splash/splash_1125x2436.png">

    <!-- iPad Pro 12.9-inch -->
    <link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="images/splash/splash_2048x2732.png">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 1366px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="images/splash/splash_2732x2048.png">
    <!-- iPad Pro 10.5-inch -->
    <link rel="apple-touch-startup-image" media="screen and (device-width: 1112px) and (device-height: 834px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="images/splash/splash_1668x2224.png">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="images/splash/splash_2224x1668.png">
    <!-- iPad Pro 9.7-inch, iPad Air 2, iPad Mini 4 -->
    <link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="images/splash/splash_1536x2048.png">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 768px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="images/splash/splash_2048x1536.png">
    <!-- iPhone X -->
    <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="images/splash/splash_1125x2436.png">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 812px) and (device-height: 375px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="images/splash/splash_2436x1125.png">
    <!-- iPhone 6/6s Plus, iPhone 7/7s Plus, iPohne 8 Plus -->
    <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="images/splash/splash_1242x2208.png">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 736px) and (device-height: 414px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="images/splash/splash_2208x1242.png">
    <!-- iPhone 6/6s, iPhone 7, iPhone 8 -->
    <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="images/splash/splash_750x1334.png">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 667px) and (device-height: 375px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="images/splash/splash_1334x750.png">
    <!-- iPhone SE -->
    <link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="images/splash/splash_640x1136.png">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 568px) and (device-height: 320px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="images/splash/splash_1136x640.png">

    <link rel="manifest" href="/manifest.json">

</head>
<body id="index">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper" id="a-submit">
                    <a href="#" class="active">Submit</a>
                </div>
                <div class="nav-link-wrapper" id="a-classes">
                    <a href="classes.php">Classes</a>
                </div>
                <div class="nav-link-wrapper" id="a-account">
                    <a href="account.php">Account</a>
                </div>
            </div>
            <div class="right-side">
                <a href="gallery.php"><img src="images/logo.png" class="logo" alt="logo"/></a>
            </div>
            <?php if (isset($_SESSION['userID'])) {
                    echo '<a href="account.php" class="userlogged">'.$_SESSION['userUID'].'</a>';
                }
                ?>
        </div>
        <div class="main">
            <div class="form">
                <form action="submit/insert_grade.php" method="post" enctype="multipart/form-data">
                    <div>
                    <label for="fileToUpload">Upload Screenshot:</label><br>
                        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
                    </div>
                    <div class="float">
                        <label for="s_class">Class</label><br>
                        <select id="s-class" name="s_class">
                        <?php 
                        // Set an arrow instead of nothing when empty & Autofill when error occures
                        if (isset($_GET['c']) && !empty($_GET['c'])) {
                                $cvalue = $_GET['c'];
                             } else {
                                 $cvalue = "-";
                             } 
                        ?>
                            <option value="<?php echo $cvalue; ?>"><?php echo $cvalue; ?></option>
                            <?php include 'submit/select_s_classes.php';?>
                        </select>
                    </div>
                    <div>
                    <?php
                    // Autofill when error occures
                    if (isset($_GET['g']) && !empty($_GET['g'])) {
                            $gvalue = $_GET['g'];
                        } else {
                            $gvalue = "";
                    } 
                    ?>
                        <label for="s_grade">Grade</label><br>
                        <input value="<?php echo $gvalue; ?>" type="number" step="0.1" name="s_grade">
                    </div>
                    <div class="float">
                    <?php
                    // Autofill when error occures
                    if (isset($_GET['d']) && !empty($_GET['d'])) {
                            $dvalue = $_GET['d'];
                        } else {
                            $dvalue = "";
                    } 
                    ?>
                        <label for="s_date">Date</label><br>
                        <input value="<?php echo $dvalue; ?>" type="date" name="s_date">
                    </div>
                    <div style="margin-top: 0.6em;">
                        <label for="s_weighting">Weighting</label><br>
                        <select name="s_weighting">
                        <?php
                        // Autofill when error occures
                        if (isset($_GET['w']) && !empty($_GET['w'])) {
                                $wvalue = $_GET['w'];
                                $wdisplay = ($_GET['w'] * 100)."%";
                            } else {
                                $wvalue = "";
                                $wdisplay = "-";
                            } 
                            ?>
                            <option value="<?php echo $wvalue; ?>"><?php echo $wdisplay; ?></option>
                            <option value="0.0">0%</option>
                            <option value="0.25">25%</option>
                            <option value="0.33">33%</option>
                            <option value="0.5">50%</option>
                            <option value="0.66">66%</option>
                            <option value="0.75">75%</option>
                            <option value="1">100%</option>
                        </select>
                    </div>
                    <div>
                        <label for="s_description">Description</label><br>
                        <textarea rows="6" cols="50" name="s_description" placeholder=""></textarea>
                    </div>
                    <button name="submit" type="submit" value="Submit">Submit</button>
                </form>
            </div>
            <?php
            // Error Handler
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'wrongext') {
                    $message = "Extension Invalid";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == 'toobig') {
                    $message = "File(s) must be smaller than 10MB!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == 'empty') {
                    $message = "Missing fields!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == 'weighting') {
                    $message = "Weighting Invalid!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == 'invalidgrade') {
                    $message = "Grade Invalid!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == 'exist') {
                }
                else if ($_GET['error'] == 'sql') {
                    $message = "SQlite Error!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
            // Info Handler
            if (isset($_GET['info'])) {
                if ($_GET['info'] == 'success') {
                    $message = "Grade ".$_GET['grade']." - Successfully submitted to ".$_GET['class']."!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
            ?>
            </div>
        <div class="footer">
            <div class="copyright"><a style="text-decoration:none;" href="privacy.php">All Rights Reserved - © SPIE ICS</a></div>
        </div>
    </div>
</body>
</html>