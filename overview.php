<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Overview</title>
    <link rel="stylesheet" href="css/main.css">
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
            </div>
        </div>
        <div class="main">
                <form action='#' method='GET' id='user-form'>
                    <div id='user-div'>
                        <select onchange='submit()' name='user-preview' class='user-dropdown'>
                            <option value='-'><?php include "overview/select_username.php"; ?></option>
                            <?php if (isset($_SESSION['userID'])) {
                                    if ($_SESSION['userGRPID'] == 3) {
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
            </div>
        </div>
        <div class="footer">
            <div class="copyright">All Rights Reserved - © SPIE ICS</div>
        </div>
    </div>
</body>
</html>