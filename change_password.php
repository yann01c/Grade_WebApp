<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Change PW</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="css/account.css">
    <link rel="manifest" href="manifest.json">
</head>
<body id="change">
    <div style="position:absolute;top:5em;width:100%;display:flex;justify-content:center;">
        <p class="change-text">Hey <?php echo $_SESSION['userUID'] ?>, you can change your password on this page!</p>
    </div>
    <div style="position:absolute;top:7em;width:100%;display:flex;justify-content:center;">
        <p class="change-text" id="change-text_2">Stay Safe!</p>
    </div>
    <div id="change_cont">
        <div id="change_main">
        <form action="login/change_pw.php" method="POST">
            <div> 
                <label for="old1">Old Password</label><br>
                <input name="old1" type="password">
            </div>
            <div>
                <label for="old2">New Password</label><br>
                <input name="old2" type="password">     
            </div>
            <div>
                <label for="old3">Repeat Password</label><br>
                <input name="old3" type="password">     
            </div>
            <button id="change-btn" type="submit">Change</button>
            <br><a id="change-bck" href="index.php">Back</a>
        </form>
        <?php include "login/change_pw.php"; ?>
        </div>
    </div>
</body>
</html>