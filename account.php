<?php session_start(); ?>
<?php include "login/check_cookies.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade | Account</title>
    <link rel="icon" type="image/png" href="images/icons/icon_iphone_orange.png">
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

    <link rel="manifest" href="manifest.json">

    <!-- IOS Icon (instead of manifest icon) 
    <link rel="apple-touch-icon" href="images/icons/icon_iphone_57x57.png">-->
    <!-- IPHONE -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/icon_iphone_orange.png">
    <!-- IPAD 
    <link rel="apple-touch-icon" sizes="72x72" href="images/logo.png">-->

    <!-- IOS Startup SPLASH -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
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

    <meta name="apple-mobile-web-app-title" content="Grades - WebApp">

</head>
<body id="account">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div id="a-submit"  class="nav-link-wrapper">
                    <a href="index.php">Submit</a>
                </div>
                <div id="a-classes" class="nav-link-wrapper">
                    <a href="classes.php">Classes</a>
                </div>
                <div id="a-account" class="nav-link-wrapper">
                    <a href="#" class="active">Account</a>
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
        <?php
            if (isset($_GET['login'])) {
                //echo '<div class="successdiv"><p class="successtext">Successfully logged in!</p></div>';
                $message = "Welcome, ".$_SESSION['userUID'];
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            ?>
            <div class="form">
            <?php if (isset($_GET['uid']) && !empty($_GET['uid'])) {
                        $uidvalue = $_GET['uid'];
                    } else {
                        $uidvalue = "";
            } ?>
            <?php
                if (isset($_SESSION['userID'])) {
                    $uid = $_SESSION['userUID'];
                    $mail = $_SESSION['userMAIL'];
                    $group = $_SESSION['userGRP'];
                    $groupid = $_SESSION['userGRPID'];
                    echo "<form action='login/change_login.php' method='post'>";
                    echo "<div class='account-logged'>";
                    echo "<button class='btn-logged' id='edit-btn' type='button' onclick='edit()'>Edit</button>";
                    echo "<button name='change' class='btn-logged' id='save-btn' type='submit'>Save</button>";
                    echo "<button class='btn-logged' id='cancel-btn' type='button' onclick='cancel()'>Cancel</button>";
                    echo "<p>Username</p><div class='div-logged'><input class='input-logged' id='i-uid' name='change-uid' value='$uid' disabled></div>";
                    echo "<p>Email</p><div class='div-logged'><input class='input-logged' id='i-mail' name='change-mail' value='$mail' disabled></div>";
                    echo "<p>Group</p><div class='div-logged'><select name='change-group' class='select-logged' id='s-group' disabled>";
                    echo "<option id='s-group' name='l-group' value='$groupid'>$group</option>";
                    echo include 'group/select_group.php';;
                    echo "</select></div>";
                    echo "</form>";
                    if (isset($_SESSION['userID'])) {
                        if ($_SESSION['userGRPID'] == 3 || $_SESSION['userGRPID'] == 4) {
                            echo "<br><br><a href='register.php'>Sign Up</a>";
                            echo "<br><a id='a-change' href='change_password.php'>Change Password</a>";
                        } else {
                            echo "<br><br><a id='a-change' href='change_password.php'>Change Password</a>";
                        }
                    }
                    echo "<form action='login/logout.php' method='post'><button class='logout'>Logout</button></form>";
                    echo "</div>";
                } else {
                    echo '<form action="login/check_login.php" method="post">
                    <div>
                        <label for="a-username">Username</label><br>
                        <input type="text" step="0.1" name="a-username"'; echo "value='$uidvalue'>
                    </div>
                    <div>
                        <label for='a-password'>Password</label><br>
                        <input type='password' name='a-password' value=''>
                    </div>
                    <div>
                        <a href='#' id='a-float'>Forgot Password?</a>
                    </div>";
                    //echo '<div>
                      //  <a href="register.php">Sign Up</a>
                    //</div>';
                    echo '<p class="input-text"><input id="remember" type="checkbox" name="remember" value="Remember">Remember me</p>
                    <button name="login" type="submit" value="Login">Login</button>
                    </form>';
                }
            ?>
            </div>
            <?php
            // Error handlers
            if(isset($_GET['error'])) {
                if($_GET['error'] == "wrongpassword") {
                    //echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>Wrong Password!</p></div>";
                    $message = "Wrong Password!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == "nouser") {
                    //echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>User does not exist!</p></div>";
                    $message = "User does not exist!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == "emptyfields") {
                    //echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>Empty fields!</p></div>";
                    $message = "Empty fields!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
            if (isset($_GET['info'])) {
                if ($_GET['info'] == "logout") {
                    //echo "<div class='submitteddiv'><p class='error-handler'style='color:blue;'>Successfully logged out!</p></div>";
                    $message = "Successfully logged out!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['info'] == "changed") {
                    //echo "<div class='submitteddiv'><p class='error-handler'style='color:blue;'>Successfully logged out!</p></div>";
                    $message = "Successfully changed Password!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
            ?>
        </div>
        <div class="footer">
            <div class="copyright"><a style="text-decoration:none;" href="privacy.php">All Rights Reserved - © SPIE ICS</a></div>
        </div>
    </div>
    <script src="js/install.js"></script>
    <script src="js/change.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script>
    window.cookieconsent.initialise({
    "palette": {
        "popup": {
        "background": "#0f2259"
        },
        "button": {
        "background": "#bf0413"
        }
    },
    "theme": "edgeless",
    "position": "top-right",
    "content": {
        "dismiss": "Understood!",
        "link": "Privacy Terms",
        "href": "privacy.php"
    }
    });
    </script>
</body>
</html>
