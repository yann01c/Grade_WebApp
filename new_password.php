<?php session_start(); ?>
<?php include "login/check_token.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades | New PW</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">
    
    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="new">
    <!-- <div style="position:absolute;top:5em;width:100%;display:flex;justify-content:center;">
        <p class="new-text">Hey <span style="color:#BF0413;font-weight:bold;"></span>, you can change your password on this page!</p>
    </div>
    <div style="position:absolute;top:7em;width:100%;display:flex;justify-content:center;">
        <p class="new-text" id="new-text_2">Stay Safe!</p>
    </div> -->
    <div id="new_cont">
        <div id="new_main">
            <form action="login/reset_password.php" method="POST">
                <div>
                    <label for="new1">New Password</label><br>
                    <input class="test" name="new1" type="password">
                    <div class="new-border"></div>
                </div>
                <div>
                    <label for="new2">Repeat Password</label><br>
                    <input class="test" name="new2" type="password">
                    <div class="new-border"></div>     
                </div>
                <div style="display:flex;">
                    <button id="new-btn" name="new-password" type="submit">Change</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>