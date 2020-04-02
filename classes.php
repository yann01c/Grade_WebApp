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
                <form action="class.php" method="POST">
                    <button id="c-add" class="c-add">Add new Class</button>
                    <div class="float">
                        <label for="c1-class">Class</label><br>
                        <select id="c1-class" name="c1-class">
                            <option value="-">-</option>
                            <option value="English">English</option>
                            <option value="German">German</option>
                            <option value="Math">Math</option>
                        </select>
                    </div>
                    <div>
                        <label for="c2-class">Average</label><br>
                        <input type="text" name="c2-grade" vaule="<?php echo "$grade"; ?>" disabled>
                    </div>
                    <div>
                        <a href="class.php" class="c-add" id="c-btn"></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>