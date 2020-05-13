<?php
    if(isset($_POST['c1-class']) || isset($_GET['c1-class'])) {
        $db = new SQLite3('sqlite/webapp.db');
        if (empty($_GET['c1-class'])) {
            $class = $_POST['c1-class'];
        } else {
            $class = $_GET['c1-class'];
        }

        // SELECT class ID
        $sqlclass = $db->prepare("SELECT class_id FROM class WHERE class = :class");
        $sqlclass->bindValue(':class',$class);
        $res = $sqlclass->execute();
        $class = $res->fetchArray();
        $classid = $class['class_id'];

        // Count grades
        $sql = $db->prepare("SELECT grade FROM grade WHERE fk_user = :userid AND fk_class = :fkclass");
        $sql->bindValue(':userid',$_SESSION['userID']);
        $sql->bindValue(':fkclass',$classid);
        $result = $sql->execute();
        $total = 0;
        while ($row = $result->fetchArray()) {
                $total += 1;
        }
        echo "<p class='total'>Total grades: ".$total."</p>";
}
?>