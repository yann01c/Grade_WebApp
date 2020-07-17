<?php
if (isset($_GET['user-preview'])) {
    $db = new SQLite3('sqlite/webapp.db');

    // Get fk_group ID
    $userID = $_GET['user-preview'];

    // if ($userID == "") {
    //     echo "<h1>Select a user.</h1>";
    // }

    $sql = $db->prepare("SELECT * FROM login WHERE user_id = :userid");
    if (!$sql) {
        header("Location: classes.php?error=sql");
        exit();
    }

    $sql->bindValue(':userid',$userID);
    $r = $sql->execute();
    $fk = $r->fetchArray();

    $uid = $fk['username'];

    // Get all Classes with group_id = $fkgroup
    $sql2 = $db->prepare("SELECT * FROM class WHERE fk_user = :id");
    if (!$sql2) {
        header("Location: classes.php?error=sql");
        exit();
    }
    
    $sql2->bindValue(':id',$userID);
    $result = $sql2->execute();

    // Select every class in class with the right group id and display it in Table
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        $class = $row['class'];       
        echo "<form action='class.php' method='POST'>";
        echo "<input name='c2-class' style='position:absolute;display:none;' value='$class'>";
        echo "<input name='bbid' style='position:absolute;display:none;' value='$userID'>";
        echo "<input name='bbuid' style='position:absolute;display:none;' value='$uid'>";
        echo "<input name='who' style='position:absolute;display:none;' value='bb'>";
        echo "<div class='class-div'>";
        echo "<button type='submit' name='user-pre' class='class-btn'>".$row['class']." - AVERAGE"."</button>";
        echo "<div>";
        echo "</form>";
    }
}