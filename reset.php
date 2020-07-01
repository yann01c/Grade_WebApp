<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades | Reset PW</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">
    
    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="reset">
    <div style="position:absolute;top:7em;width:100%;display:flex;justify-content:center;">
    </div>
    <div id="reset_cont">
        <div id="reset_main">
        <form action="login/reset_password.php" method="POST">
            <div> 
                <label for="email">Enter E-Mail to reset password</label><br>
                <input name="email" type="email">
                <div class="reset-border"></div>
            </div>
            <div style="display:flex;">
                <button id="reset-bck" href="index.php">Back</button>
                <button id="reset-btn" name="reset-password" type="submit">Send</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>