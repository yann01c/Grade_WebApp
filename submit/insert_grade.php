<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['s_grade'], $_POST['s_date'], $_POST['s_weighting'], $_POST['s_description'], $_POST['s_class'], $_SESSION['userID'])) {
        $grade = $_POST['s_grade'];
        $date = $_POST['s_date'];
        $weighting = $_POST['s_weighting'];
        $description = $_POST['s_description'];
        $class = $_POST['s_class'];
    
    $db = new SQLite3('sqlite/webapp.db');

    $sql = $db->prepare("SELECT class_id from class WHERE class='$class'");
    $r = $sql->execute();
    $row = $r->fetchArray();
    $fkclass = $row['class_id'];
    $userID = $_SESSION['userID'];
    $db->exec("INSERT INTO grade (grade,date,weighting,description,fk_class,fk_user) VALUES ('$grade','$date','$weighting','$description','$fkclass','$userID')");
    }
}