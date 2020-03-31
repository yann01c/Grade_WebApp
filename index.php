<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Submit</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body id="index">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper">
                    <a href="#" class="active">Submit</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="classes.php">Classes</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="account.php">Account</a>
                </div>
            </div>
            <div class="right-side">
            </div>
        </div>
        <div class="main">
            <div class="form">
                <form action="classes.php" method="post">
                    <div class="float">
                        <label for="s1-class">Class</label><br>
                        <select id="s1-class" name="s1-class">
                            <option value="none">- none -</option>
                            <option value="english">English</option>
                        </select>
                    </div>
                    <div>
                        <label for="s2-grade">Grade</label><br>
                        <input type="number" step="0.1" name="s2-grade" required>
                    </div>
                    <div class="float">
                        <label for="s3-date">Date</label><br>
                        <input type="date" name="s3-date" required>
                    </div>
                    <div>
                        <label for="s4-weighting">Weighting</label><br>
                        <input type="number" name="s4-weighting" placeholder="                           %" required>
                    </div>
                    <div>
                        <label for="s5-description">Description</label><br>
                        <textarea rows="6" cols="50" name="s5-description" placeholder="Sample"></textarea>
                    </div>
                    <input name="submit" type="submit" value="Submit">
                </form>
            </div>
        </div>
        <div class="footer">
            <div class="copyright"></div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>