<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade | Overview</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/main.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="overview">
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
                <a href="index.php"><img src="images/logo.png" class="logo" alt="logo"/></a>
            </div>
        </div>
        <?php if (isset($_SESSION['userID'])) {
                    echo '<a href="account.php" class="userlogged">'.$_SESSION['userUID'].'</a>';
                }
        ?>
        <div class="main">
                <form action='#' method='GET' id='user-form'>
                    <div id='user-div'>
                        <select onchange='submit()' name='user-preview' class='user-dropdown'>
                            <option value='-'><?php include "overview/select_username.php"; ?></option>
                            <?php if (isset($_SESSION['userID'])) {
                                    if ($_SESSION['userGRPID'] == 3 || $_SESSION['userGRPID'] == 4) {
                                        include "overview/select_users.php";
                                    } else {
                                        header("Location: classes.php?error=noperm");
                                        exit();
                                    }
                                } else {
                                    header("Location: classes.php?error=notlogged");
                                        exit();
                                } ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="form">
                <div>
                    <?php include "overview/select_classes_bb.php"; ?>

                </div>
                <div class="bck-btn" style="margin-top:2em;">
                    <a href="classes.php">Back</a>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="copyright"><a style="text-decoration:none;" href="privacy.php">All Rights Reserved - © SPIE ICS</a></div>
        </div>
    </div>
</body>
</html>