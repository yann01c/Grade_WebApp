<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Submit</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body id="index">
    <?php include 'sqlite/grade_db.php' ?>
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
                        <label for="s_class">Class</label><br>
                        <select id="s-class" name="s_class">
                            <option value="none">- none -</option>
                            <option value="english">English</option>
                        </select>
                    </div>
                    <div>
                        <label for="s_grade">Grade</label><br>
                        <input type="number" step="0.1" name="s_grade" required>
                    </div>
                    <div class="float">
                        <label for="s_date">Date</label><br>
                        <input type="date" name="s_date" required>
                    </div>
                    <div>
                        <label for="s_weighting">Weighting</label><br>
                        <input type="number" name="s_weighting" placeholder="                         %" required>
                    </div>
                    <div>
                        <label for="s_description">Description</label><br>
                        <textarea rows="6" cols="50" name="s_description" placeholder=""></textarea>
                    </div>
                    <input name="submit" type="submit" value="Submit">
                </form>
                <?php 
                if(isset($_POST['submit'])){
                    $s_class = $_POST['s_class'];
                    $s_grade = $_POST['s_grade'];
                    $s_date = $_POST['s_date'];
                    $s_weighting = $_POST['s_weighting'];
                    $s_description = $_POST['s_description'];
                    $db->exec("INSERT INTO grades (s_class,s_grade,s_date,s_weighting,s_description) VALUES ('$s_class','$s_grade','$s_date','$s_weighting','$s_description')");
                }
                ?>
            </div>
        </div>
        <div class="footer">
            <div class="copyright"></div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>