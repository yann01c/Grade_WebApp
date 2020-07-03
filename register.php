<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <title>Grades | Register</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="register">
<?php //if($_SESSION['userGRPID'] != 3 && $_SESSION['userGRPID'] != 4) {
    //header("Location: account.php");
    //exit();
//} ?>
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper" id="a-submit">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper" id="a-classes">
                    <a href="classes.php">Classes</a>
                </div>
                <div class="nav-link-wrapper" id="a-account">
                    <a href="account.php" class="active">Account</a>
                </div>
            </div>
            <div class="right-side">
                <a href="index.php"><img src="images/logo.png" class="logo" alt="logo"/></a>
            </div>
        </div>
        <div class="main">
            <div class="form">
                <form action="login/insert_register.php" method="post">
                <?php if (isset($_GET['r-uid']) || isset($_GET['r-email']) || isset($_GET['r-group'])) {
                    $uid = $_GET['r-uid'];
                    $email = $_GET['r-email'];
                    $group = $_GET['r-group'];

                    if (empty($group)) {
                        $group = "-";
                    }

                    $db = new SQLite3('sqlite/webapp.db');
                    
                    $sql = $db->prepare("SELECT * FROM 'group' WHERE group_id = :grpid");
                    $sql->bindValue(':grpid',$group);
                    $result = $sql->execute();
                    $row = $result->fetchArray();

                    $gdisplay = $row['group'];

                    if (empty($group) || $group == "-") {
                        $gdisplay = "&#8595";
                    }
                } else {
                    $uid = "";
                    $email = "";
                    $group = "";
                } ?>
                    <div>
                        <label for="r-uid">Username</label><br>
                        <input value="<?php echo $uid; ?>" type="text" name="r-uid">
                    </div>
                    <div>
                        <label for="r-email">E-Mail</label><br>
                        <input value="<?php echo $email; ?>" type="email" name="r-email">
                    </div>
                    <div>
                        <label for="r-pwd">Password</label><br>
                        <input type="password" name="r-pwd">
                    </div>
                    <div>
                        <label for="r-rpwd">Repeat Password</label><br>
                        <input type="password" name="r-rpwd">
                    </div>
                    <div>
                        <label for="r-group">Group</label><br>
                        <select name="r-group" id="r-group">
                            <option value="<?php echo $group; ?>"><?php echo "-"; ?></option>
                            <?php include 'group/select_group.php'; ?>
                        </select>
                    </div>
                    <div>
                        <a href="account.php">Login</a>
                    </div>
                    <div>
                        <button id="r-btn" name="register" type="submit" value="Register">Sign Up</button>
                    </div>
                </form>
            </div>
            <?php 
                if(isset($_GET['error'])) {
                    if($_GET['error'] == "emptyfields") {
                        $message = "Empty fields!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if ($_GET['error'] == "invalidgroup") {
                        $message = "Select a Group!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if ($_GET['error'] == "invalidmailusername") {
                        $message = "Invalid Username!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if ($_GET['error'] == "invalidmail") {
                        $message = "Invalid Mail!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if ($_GET['error'] == "invalidusername") {
                        $message = "Invalid Username!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if ($_GET['error'] == "passwordcheck") {
                        $message = "Passwords not Matching!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if ($_GET['error'] == "mailtakens") {
                        $message = "Mail already taken!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if ($_GET['error'] == "usertaken") {
                        $message = "Username already taken!";
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