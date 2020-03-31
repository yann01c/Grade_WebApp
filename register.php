<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Account</title>
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
                    <a href="#" class="active">Account</a>
                </div>
            </div>
            <div class="right-side">
            </div>
        </div>
        <div class="main">
            <div class="form">
                <form action="register_cred.php" method="post">
                    <div>
                        <label for="r1-username">Username</label><br>
                        <input type="text" step="0.1" name="r1-username" required>
                    </div>
                    <div>
                        <label for="r2-email">E-Mail</label><br>
                        <input type="email" step="0.1" name="r2-email" required>
                    </div>
                    <div>
                        <label for="r3-password">Password</label><br>
                        <input type="password" name="r3-password" required>
                    </div>
                    <div>
                        <label for="r4-rpassword">Repeat Password</label><br>
                        <input type="password" name="r4-rpassword" required>
                    </div>
                    <div>
                        <a href="account.php">Login</a>
                    </div>
                    <input name="submit" type="submit" value="Register">
                </form>
            </div>
        </div>
        <div class="footer">
        </div>
    </div>
</body>
</html>