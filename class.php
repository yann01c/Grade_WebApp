<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Class</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<?php include 'submit.php'; ?>
<body id="class">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="classes.php" class="active">Classes</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="account.php">Account</a>
                </div>
            </div>
            <div class="right-side">
            </div>
        </div>
        <div class="main">
            <div class="bck-btn">
                <a href="classes.php">Back</a>
            </div>
            <div class="title">
                <h2>Overview - English</h2>
            </div>
            <div class="form">
                <form action="grade.php" method="POST">
                    <div id="class-center">
                        <div>
                            <label for="class1-grades">Grades</label><br/>
                            <select name="class1-grades" id="class1-grades">
                                <option value="-">-</option>
                                <option value="5.0">5.0</option>
                                <option value="">6.0</option>
                            </select>
                        </div>
                        <div>
                            <label for="class2-weighting">Weighting</label><br/>
                            <input type="text" name="class2-weighting" id="class2-weighting" disabled>                        
                        </div>
                        <div>
                            <label for="class3-date">Date</label><br/>
                            <input type="text" name="class3-date" id="class3-date" disabled>
                        </div>
                    </div>
                    <div id="class4-description">
                        <label for="class4-description">Description</label><br/>
                        <textarea rows="6" cols="50" name="class4-description" placeholder="" disabled></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
        </div>
    </div>
    <script src="js/main.js"></script>
    <script src="sqlite/sqlite.js"></script>
</body>
</html>