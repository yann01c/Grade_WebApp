<?php
if (isset($_GET['c1-class']) || (isset($_POST['c1-class']))) {
    // why do you need two variables with the same value?
if (empty($_GET['c1-class'])) {
    $fkclass = $_POST['c1-class'];
    $class = $_POST['c1-class'];
} else {
    $fkclass = $_GET['c1-class'];
    $class = $_GET['c1-class'];
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
$check = 0;

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
    $id = $row['grade_id'];
    $grade = $row['grade'];
    $userID = $_SESSION['userID'];

    $style = '<style type="text/css">#class-grade'.$count.'{color:'.$color.'; font-weight: bold;}</style>';
    //echo "<div class='gradelist'>";
    echo $style;
    echo "<form action='class/delete_grade.php' method='post'>";
    echo "<table>";
    $check++;
    if ($check == 1) {
        echo "<tr>
        <th>Grade</th>
        <th>Date</th>
        <th>Weighting</th>
        <th>Description</th>
        </tr>";
    } else {
        echo "<tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        </tr>";
    }
    echo "<tr>
        <td id='class-grade$count'>".$row['grade']."</td>
        <td>".$row['date']."</td>
        <td>".$row['weighting'].'%'."</td>
        <td id='des-hidden'>".$row['description']."</td>
        <td><button type='submit' name='delete_btn' class='trash-btn'>🗑️</button></td>";
    echo "<input type='text' name='delete_id' value='$id' style='display: none; position: absolute;'>";
    echo "<input type='text' name='delete_grade' value='$grade' style='display: none; position: absolute;'>";
    echo "<input type='text' name='class' value='$class' style='display: none; position: absolute;'>";
    echo "</table>";
    echo "</form>";
    }
}
