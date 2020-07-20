<?php
if (isset($_GET['user-preview'])) {
    $db = new SQLite3('sqlite/webapp.db');

    // Get user ID
    $userID = $_GET['user-preview'];

    $check = 0;

    $sql = $db->prepare("SELECT * FROM login WHERE user_id = :userid");
    if (!$sql) {
        header("Location: classes.php?error=sql");
        exit();
    }

    $sql->bindValue(':userid',$userID);
    $r = $sql->execute();
    $fk = $r->fetchArray();

    $uid = $fk['username'];
    $email = $fk['email'];

    // Get all Classes with group_id = $fkgroup
    $sql2 = $db->prepare("SELECT * FROM class WHERE fk_user = :id");
    if (!$sql2) {
        header("Location: classes.php?error=sql");
        exit();
    }
    
    $sql2->bindValue(':id',$userID);
    $result = $sql2->execute();

    // Echo user information
    echo "<div class='ov-email-div'><p class='ov-email'>E-Mail: $email</p> 
    </div>";
}