<?php
if(isset($_POST['c1-class']) || isset($_GET['success'])) {
    $db = new SQLite3('sqlite/webapp.db');
    if (empty($_GET['success'])) {
        $fkclass = $_POST['c1-class'];
        $class = $_POST['c1-class'];
    } else {
        $fkclass = $_GET['success'];
        $class = $_GET['success'];
    }
    $db = new SQLite3('sqlite/webapp.db');
    $userID = $_SESSION['userID'];

    $fk = $db->prepare("SELECT class_id FROM class WHERE class = :class");
    $fk->bindValue(':class',$fkclass);
    $r = $fk->execute();
    $rr = $r->fetchArray();
    $fkclass = $rr['class_id'];

    $sql = $db->prepare("SELECT * FROM grade WHERE fk_user = :userid AND fk_class = :fkclass");
    $sql->bindValue(':userid',$userID);
    $sql->bindValue(':fkclass',$fkclass);
    $result = $sql->execute();
    $count = 0;

    // Select every grade in grade and display it in "option" element in HTML
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        if ($row['grade'] >= 5.0) {
            $color = 'green';
            $count = $count + 1;
        }
        else if ($row['grade'] >= 4.0 && $row['grade'] <= 4.9) {
            $color = 'orange';
            $count = $count + 2;
        }
        else if ($row['grade'] <= 3.9) {
            $color = 'red';
            $count = $count + 3;
        }
        $des = $row['description'];
        $id = $row['grade_id'];
        $grade = $row['grade'];
        $userID = $_SESSION['userID'];
        $style = '<style type="text/css">#class-grade'.$count.'{color:'.$color.';}</style>';
        echo "<div class='gradelist'>";
        echo $style;
        echo "<form action='class/delete_grade.php' method='post'>";
        echo "<li class='class-gradelist' id='class-grade$count'>".$grade."</li>";
        echo "<li class='class-gradelist' id='class-date'>".$row['date']."</li>";
        echo "<li class='class-gradelist' id='class-weighting'>".$row['weighting']."%</li>";
        echo "<input type='text' name='delete_id' value='$id' style='display: none; position: absolute;'>";
        echo "<input type='text' name='delete_grade' value='$grade' style='display: none; position: absolute;'>";
        echo "<input type='text' name='delete_userID' value='$userID' style='display: none; position: absolute;'>";
        echo "<input type='text' name='class' value='$class' style='display: none; position: absolute;'>";
        echo "<li class='class-gradelist'><button type='submit' name='delete_btn' class='trash-btn'>🗑️</button></li>";
        echo "<li class='class-gradelist'><div class='c-des'>$des</div></li>";
        echo "</form>";
        echo "</div>";
    }
} else {
    header("Location: clkdelete_data.php");
}
