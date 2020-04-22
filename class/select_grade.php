<?php
if(isset($_POST['c1-class'])) {
    $db = new SQLite3('sqlite/webapp.db');
    $userID = $_SESSION['userID'];
    $fkclass = $_POST['c1-class'];
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
        $style = '<style type="text/css">#class-grade'.$count.'{color:'.$color.';}</style>';
        echo "<div class='gradelist'>";
        echo $style;
        echo "<li class='class-gradelist' id='class-grade$count'>".$row['grade']."</li>";
        echo "<li class='class-gradelist'>".$row['date']."</li>";
        echo "<li class='class-gradelist'>".$row['weighting']."</li>";
        echo "<li class='class-gradelist'><button id='myBtn' class='view-btn'>Description</button></li>";
        echo "<li class='class-gradelist'><button onclick='popup()' class='trash-btn'>🗑️</button></li>";
        $script = "<script type='text/javascript'>function popup () {alert('".$row['description']."');}</script>";
        echo $script;
        echo "</div>";
    }
}
?>