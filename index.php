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
                <form action="#" method="post">
                    <div class="float">
                        <label for="s_class">Class</label><br>
                        <select id="s-class" name="s_class">
                            <option value="none">-</option>
                            <?php include 'classes/select_class.php';?>
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
                        <input type="number" name="s_weighting" placeholder="                           %" required>
                    </div>
                    <div>
                        <label for="s_description">Description</label><br>
                        <textarea rows="6" cols="50" name="s_description" placeholder=""></textarea>
                    </div>
                    <button name="submit" type="submit" value="Submit">Submit</button>
                </form>
            </div>
            <?php include 'submit/submit.php';?>
        </div>
        <div class="footer">
            <div class="copyright">Copyright - SPIE ICS</div>
        </div>
    </div>
</body>
</html>