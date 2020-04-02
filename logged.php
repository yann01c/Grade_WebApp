<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Logged In</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body id="logged">
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
                <form action="classes.php" method="post">
                    <div>
                        <label for="logged1-username">Username</label><br>
                        <input type="text" step="0.1" name="logged1-username">
                    </div>
                    <div>
                        <label for="logged2-password">E-Mail</label><br>
                        <input type="password" name="logged1-password">
                    </div>
                    <div>
                        <label for="logged3-group">Group</label><br>
                        <input type="text" name="logged3-group" disabled>
                    </div>
                    <div>
                        <label for="s1-class">Language</label><br>
                        <select id="s1-class" name="s1-class">
                            <option value="english">English</option>
                            <option value="german">German</option>
                        </select>
                    </div>
                    <div>
                        <a href="#" id="a-float">Change Password</a>
                    </div>
                    <div>
                        <a href="#">Logout</a>
                    </div>
                    <input name="submit" type="submit" value="Save Changes">
                </form>
            </div>
        </div>
        <div class="footer">
        </div>
    </div>
</body>
</html>