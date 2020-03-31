<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Classes</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<?php include 'submit.php'; ?>
<body id="classes">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="#" class="active">Classes</a>
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
                <div class="">
                    <label for="c1-class">Class</label><br>
                    <button name="c1-class" type="button">English</button>
                </div>
                <div>
                    <label for="c-average">Average</label><br>
                    <input type="number" name="c-average" placeholder="GRADE" required>
                </div>
                <div class="c-float">
                    <button name="c1-class" type="button">German</button>
                </div>
                <div>
                    <input type="number" name="c-average" placeholder="GRADE" required>
                </div>
            </div>
        </div>
        <div class="footer">
        </div>
    </div>
</body>
</html>