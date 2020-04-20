<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Class</title>
    <link rel="stylesheet" href="css/main.css">
</head>
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
                <h2>Overview - <?php include 'class/select_class.php'; ?></h2>
            </div>
            <div class="form">
                <form action="grade.php" method="POST">
                    <div id="class-center">
                        <div>
                            <label for="class-grades">Grades</label><br/>
                            <select name="class-grades" id="class1-grades">
                                <option value="-">-</option>
                                <?php include 'class/select_grade.php'; ?>
                            </select>
                        </div>
                        <div>
                            <label for="class-weighting">Weighting</label><br/>
                            <input type="text" name="class2-weighting" id="class-weighting" disabled>                        
                        </div>
                        <div>
                            <label for="class-date">Date</label><br/>
                            <input type="text" name="class3-date" id="class-date" disabled>
                        </div>
                    </div>
                    <div id="class4-description">
                        <label for="class-description">Description</label><br/>
                        <textarea rows="6" cols="50" name="class-description" placeholder="" disabled></textarea>
                    </div>
                    <div>
                        <button type="submit" class="c-button" id="class-btn">Go to Grade</button>                
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
        </div>
    </div>
</body>
</html>