<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['s_grade'], $_POST['s_date'], $_POST['s_weighting'], $_POST['s_description'])) {
        $grade = $_POST['s_grade'];
        $date = $_POST['s_date'];
        $weighting = $_POST['s_weighting'];
        $description = $_POST['s_description'];
    }
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('INSERT INTO grade (grade,date,weighting,description) VALUES ($grade,$date,$weighting,$description)');
}
?>