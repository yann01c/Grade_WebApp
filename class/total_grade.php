<?php
    if($_SESSION['userGRP'] == "IT") {
        $fkclass = 2;
    } else {
        $fkclass = 1;
    }

    $db = new SQLite3('sqlite/webapp.db');

    $sql = $db->prepare("SELECT * FROM grade WHERE fk_user = :userid AND fk_class = :fkclass");

    $sql->bindValue(':userid',$_SESSION['userID']);
    $sql->bindValue(':fkclass',$fkclass);

    $result = $sql->execute();
    
    while($row = $result->fetchArray()) {
        echo $row['grade'];
    }
?>