<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2, maximum-scale=1, user-scalable=0"/>
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
                <input class="input" name="email" type="email">
                <div class="reset-border"></div>
            </div>
            <div style="display:flex;">
                <input id="reset-bck" onclick="location.href='account.php';" type="button" value="Back">
                <button id="reset-btn" name="reset-password" type="submit">Send</button>
            </div>
        </form>
        </div>
    </div>
<?php
    if(isset($_GET['error'])) {
        if($_GET['error'] == "empty") {
            $message = "Empty Field!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else if ($_GET['error'] == "invalid") {
            $message = "E-Mail Invalid!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
}
            ?>
</body>
</html>