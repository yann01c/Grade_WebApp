<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades | All Grades</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="grades">
<script>alert("You can sort the table by clicking on the column name!");</script>
    <div id="grades_cont">
        <!-- <div style="display:flex;justify-content:center;text-align: center;">
            <div class="grades_header">
                <h1>Gallery</h1>
                <p>
                    You can find every image you ever uploaded on this page.        
                </p>
            </div>
        </div> -->
        <div id="grades_main">
        <form action="#" method="POST">
            <div class="grades_wrapper">
                <table class="grades_table" id="gradestable">
                    <tr>
                        <th onclick='sortTable(0)' class='idtable'>ID</th>
                        <th onclick='sortTable(1)' class='gradetable'>Grade</th>
                        <th onclick='sortTable(2)'>Date</th>
                        <th onclick='sortTable(3)' class='weightingtable'>Weighting</th>
                        <!-- <th onclick='sortTable(4)'>Description</th> -->
                        <th onclick='sortTable(4)'>Created / Deleted</th>
                        <th onclick='sortTable(5)'>Class</th>
                    </tr>
                    <?php include 'all/allgrades.php'; ?>
                </table>
            </div>
        </form>
        <div style="width:100%;display:flex;justify-content:center;"><a class="grades-back" href="index.php">Back</a></div>
        </div>
        <!-- <div id="absolutecenter">
            <div id="close" onclick="unzoom()">
                ✕
            </div>
            <div id="download">
            </div>
        </div> -->
    </div>
    <script src="js/sort.js"></script>
</body>
</html>

