<?php
if (isset($_GET['c1-class']) || isset($_POST['c1-class']) || isset($_POST['user-pre'])) {
    if (empty($_GET['c1-class']) && empty($_POST['c1-class'])) {
        $class = $_POST['c2-class'];
    }
    else if (empty($_POST['c1-class'])) {
        $class = $_GET['c1-class'];
    } 
    else if (empty($_GET['c1-class'])) {
        $class = $_POST['c1-class'];
    }

    // Check if request was made from group "Berufsbildner"
    if (isset($_POST['user-pre'])) {
        $userID = $_POST['bbid'];
    } else {
        $userID = $_SESSION['userID'];
    }

    $db = new SQLite3('sqlite/webapp.db');

    // SELECT class ID
    $sqlclass = $db->prepare("SELECT class_id FROM class WHERE class = :class");
    $sqlclass->bindValue(':class',$class);
    $res = $sqlclass->execute();
    $class = $res->fetchArray();
    $classid = $class['class_id'];

    // Count grades
    $sql = $db->prepare("SELECT grade FROM grade WHERE fk_user = :userid AND fk_class = :fkclass AND deleted != 'true'");
    $sql->bindValue(':userid',$userID);
    $sql->bindValue(':fkclass',$classid);
    $result = $sql->execute();
    $total = 0;
    while ($row = $result->fetchArray()) {
            $total += 1;
    }
    echo "<p class='title''>Total grades: <span style=''>".$total."</span></p>";
}
?>