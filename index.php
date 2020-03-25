<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
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
                    <a href="#">Account</a>
                </div>
            </div>
            <div class="right-side">
                <div class="dropdown">
                    <span>ENGLISH</span>
                    <div class="dropdown-content">
                        <a href="#">GERMAN</a></br>
                        <a href="#">FRENCH</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="form">
                <form action="test.php" method="get">
                    <div>
                        <label for="s1-class">Class</label><br>
                        <select id="s1-class" name="s1-class">
                            <option value="none">- none -</option>
                            <option value="english">English</option>
                        </select>
                    </div>
                    <div>
                        <label for="s2-grade">Grade</label><br>
                        <input type="number" name="s2-grade" required>
                    </div>
                    <div>
                        <label for="s3-date">Date</label><br>
                        <input type="date" name="s3-date" required>
                    </div>
                    <div>
                        <label for="s4-weighting">Weighting</label><br>
                        <input type="number" name="s4-weighting" placeholder="                                %" required>
                    </div>
                    <input name="submit" type="submit">
                </form>
            </div>
        </div>
        <?php
        echo "hey";
            $class = htmlspecialchars($_GET['s1-class']);
            $grade = htmlspecialchars($_GET['s2-grade']);
            $date = htmlspecialchars($_GET['s3-date']);
            $weight = htmlspecialchars($_GET['s4-weighting']);
            echo $grade;
            echo $class; 
            echo $date; 
            echo $weight;
            echo "Finish";
        ?>
        <div class="footer">
        </div>
    </div>
</body>
</html>