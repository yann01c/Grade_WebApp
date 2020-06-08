<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Register</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="css/account.css">
</head>
<body id="register">
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
            <img src="images/logo.png" class="logo" alt="logo"/>
            </div>
        </div>
        <div class="main">
            <div class="form">
                <form action="login/insert_register.php" method="post">
                    <div>
                        <label for="r-uid">Username</label><br>
                        <input type="text" name="r-uid">
                    </div>
                    <div>
                        <label for="r-email">E-Mail</label><br>
                        <input type="email" name="r-email">
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
                            <option value="-">&#8595</option>
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
                        echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>Missing fields!</p></div>";
                    }
                    else if ($_GET['error'] == "invalidgroup") {
                        echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>Select a group!</p></div>";
                    }
                    else if ($_GET['error'] == "invalidmailusername") {
                        echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>Select a valid E-Mail and Username!</p></div>";
                    }
                    else if ($_GET['error'] == "invalidmail") {
                        echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>Select a valid E-Mail!</p></div>";
                    }
                    else if ($_GET['error'] == "invalidusername") {
                        echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>Select a valid Username! (a-z | A-Z | 0-9)</p></div>";
                    }
                    else if ($_GET['error'] == "passwordcheck") {
                        echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>Passwords do not match!</p></div>";
                    }
                    else if ($_GET['error'] == "mailtakens") {
                        echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>E-Mail already taken!</p></div>";
                    }
                    else if ($_GET['error'] == "usertaken") {
                        echo "<div class='submitteddiv'><p class='error-handler'style='color:red;'>Username already taken!</p></div>";
                    }
                }
            ?>
        </div>
        <div class="footer">
            <div class="copyright"><a style="text-decoration:none;" href="privacy.php">All Rights Reserved - © SPIE ICS</a></div>
        </div>
    </div>
    <script src="js/account.js"></script>
</body>
</html>