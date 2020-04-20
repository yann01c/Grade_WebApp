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
            </div>
        </div>
        <div class="main">
            <div class="form">
                <form action="login/insert_register.php" method="post">
                    <div>
                        <label for="r-username">Username</label><br>
                        <input type="text" name="r-username" required>
                    </div>
                    <div>
                        <label for="r-email">E-Mail</label><br>
                        <input type="email" name="r-email" required>
                    </div>
                    <div>
                        <label for="r-password">Password</label><br>
                        <input type="password" name="r-password" required>
                    </div>
                    <div>
                        <label for="r-rpassword">Repeat Password</label><br>
                        <input type="password" name="r-rpassword" required>
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
                        <button id="r-btn" name="register" type="submit" value="Register">Register</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
        </div>
    </div>
    <script src="js/account.js"></script>
</body>
</html>