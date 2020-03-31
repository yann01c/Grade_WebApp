<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Account</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body id="account">
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
                <form action="login_cred.php" method="post">
                    <div>
                        <label for="a1-username">Username</label><br>
                        <input type="text" step="0.1" name="a1-username" required>
                    </div>
                    <div>
                        <label for="a2-password">Password</label><br>
                        <input type="password" name="a2-password" required>
                    </div>
                    <div>
                        <a href="#" id="a-float">Forgot Password</a>
                    </div>    
                    <div>
                        <a href="register.php">Register</a>
                    </div>
                    <input name="submit" type="submit" value="Login">
                </form>
            </div>
        </div>
        <div class="footer">
        </div>
    </div>
</body>
</html>