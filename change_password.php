<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade | Change PW</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">
    
    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="change">
    <div style="position:absolute;top:5em;width:100%;display:flex;justify-content:center;">
        <p class="change-text">Hey <span style="color:#BF0413;font-weight:bold;"><?php echo $_SESSION['userUID'] ?></span>, you can change your password on this page!</p>
    </div>
    <div style="position:absolute;top:7em;width:100%;display:flex;justify-content:center;">
        <p class="change-text" id="change-text_2">Stay Safe!</p>
    </div>
    <div id="change_cont">
        <div id="change_main">
        <form action="login/change_pw.php" method="POST">
            <div> 
                <label for="old">Old Password</label><br>
                <input name="old" type="password">
            </div>
            <div>
                <label for="new1">New Password</label><br>
                <input name="new1" type="password">     
            </div>
            <div>
                <label for="new2">Repeat Password</label><br>
                <input name="new2" type="password">     
            </div>
            <button id="change-btn" name="changepw" type="submit">Change</button>
            <br><a id="change-bck" href="index.php">Back</a>
        </form>
        <?php include "login/change_pw.php"; ?>
        </div>
    </div>
</body>
</html>