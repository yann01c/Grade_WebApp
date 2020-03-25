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
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="#" class="active">Classes</a>
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
            </div>

                <?php
                    $class = $grade = $date = $weight = "";
                    if( isset($_POST['submit'])){
                        $class = htmlspecialchars($_POST['s1-class']);
                        $grade = htmlspecialchars($_POST['s2-grade']);
                        $date = htmlspecialchars($_POST['s3-date']);
                        $weight = htmlspecialchars($_POST['s4-weighting']);
                        echo $grade;
                        echo $class; 
                        echo $date; 
                        echo $weight;
                    }
                ?>
        </div>
        <div class="footer">
        </div>
    </div>
</body>
</html>