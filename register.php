<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Register</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body id="register">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="classes.php">Classes</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="account.php" class="active">Account</a>
                </div>
            </div>
            <div class="right-side">
            <img src="images/logo.png" class="logo" alt="logo"/>
            <?php
                if (isset($_SESSION['userID'])) {
		    // checking for a session makes sense. But I would propably just redirect to account.php
		    // The logout button maybe would makes sense in the navigation?
                    //echo '<form action="login/logout.php" method="POST">
                    //<button class="logout">Logout</button>
                    //</form>';
		    header("Location: /account.php\n\r");
                }
            ?>
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
                            <option value="-">-</option>
                            <?php include 'group/select_group.php'; ?>
                        </select>
                    </div>
                    <div>
                        <a href="account.php">Login</a>
                    </div>
                    <div>
                        <button id="r-btn" name="register" type="submit" value="Register">Sign Up</button>
                    </div>
                    <?php 
                        if(isset($_GET['error'])) {
                            if($_GET['error'] == "emptyfields") {
                                echo '<p class="signuperror">Fill in all fields!</p>';
                            }
                            else if ($_GET['error'] == "invalidgroup") {
                                echo '<p class="signuperror">Select a group!</p>';
                            }
                            else if ($_GET['error'] == "invalidmailusername") {
                                echo '<p class="signuperror">Select a valid E-Mail and Username!</p>';
                            }
                            else if ($_GET['error'] == "invalidmail") {
                                echo '<p class="signuperror">Select a valid E-Mail!</p>';
                            }
                            else if ($_GET['error'] == "invalidusername") {
                                echo '<p class="signuperror">Select a valid Username! (a-z | A-Z | 0-9)</p>';
                            }
                            else if ($_GET['error'] == "passwordcheck") {
                                echo '<p class="signuperror">Passwords do not match!</p>';
                            }
                            else if ($_GET['error'] == "mailtakens") {
                                echo '<p class="signuperror">E-Mail already taken!</p>';
                            }
                            else if ($_GET['error'] == "usertaken") {
                                echo '<p class="signuperror">Username already taken!</p>';
                            }
                        }
                    ?>
                </form>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">Copyright - SPIE ICS ©</div>
        </div>
    </div>
    <script src="js/account.js"></script>
</body>
</html>
