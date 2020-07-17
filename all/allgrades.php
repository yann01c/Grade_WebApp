<?php

$db = new SQLite3('sqlite/webapp.db');

$userID = $_SESSION['userID'];

$sql = $db->prepare("SELECT * FROM grade WHERE fk_user = :user ORDER BY fk_class ASC");
$sql->bindValue(':user',$userID);

$result = $sql->execute();
$checkclass = array();

$count = 0;
$emptycheck = 0;

while ($row = $result->fetchArray()) {
    
    $id = $row['grade_id'];
    $grade = $row['grade'];
    $date = $row['date'];
    $weighting = $row['weighting'] * 100;
    $description = $row['description'];
    $created = $row['timestamp'];
    $deleted = $row['deleted'];
    $fkclass = $row['fk_class'];

    $csql = $db->prepare("SELECT class FROM class WHERE class_id = :classid");
    $csql->bindValue(':classid',$fkclass);

    $cresult = $csql->execute();

    $crow = $cresult->fetchArray();

    $count++;
    
    $class = $crow['class'];

    if (!in_array($class, $checkclass)) {
        echo "<div class='title-wrapper' id='$class'><h1>$class</h1></div>";
        $checkclass[] = $class;
    }

    // Summary

    echo "
    <div class='grades-wrapper' onclick='' id='$count' id='section'>";

    echo "
        <div style='padding:8px;font-size:1.2em;'><p class='gradetable' style='font-weight:bold;'>$grade</p></div>
        <div><p>$date</p></div>
        <div><p class='weightingtable'>$weighting%</p></div>
        <div><p>$created</p></div>";
        if ($deleted == "false") {
            $deleted = "Active";
            $color = "green";
        } else {
            $deleted = "Deleted";
            $color = "red";
        }
        echo "<div><p style='color:$color;'>$deleted</p></div>
    </div>
    ";  
    $emptycheck = 1;
}
if ($emptycheck == 0) {
    echo "<h1 style='color:white;margin-top:2em;text-shadow: 3px 3px 0 black;'>No Grades / Classes yet.</h1>";
}