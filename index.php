<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php
    class MyDB extends SQLite3
    {
        function __construct()
        {
            $this->open('grade.db');
        }
    }
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully\n";
    }
    
    $sql =<<<EOF
    CREATE TABLE SUBMIT
    (ID INT PRIMARY KEY     NOT NULL,
    GRADE           FLOAT    NOT NULL,
    CLASS           VARCHAR(30) NOT NULL,
    DATE            DATE        NOT NULL,
    WEIGHT         INT          NOT NULL);
    EOF;

    $ret = $db->exec($sql);
    if(!$ret){
    echo $db->lastErrorMsg();
    } else {
    echo "Table created successfully\n";
    }
    $db->close();
    ?>
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
                <form action="classes.php" method="post">
                    <div>
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
        <div class="footer">
        </div>
    </div>
</body>
</html>