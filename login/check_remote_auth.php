<?php
if (isset($_SERVER['REMOTE_USER'])) {
    // Select user
    $uid = $_SERVER['REMOTE_USER'];
    $db = new SQLite3('sqlite/webapp.db');
    $sql = $db->prepare("SELECT * FROM login WHERE username = :uid");
    $sql->bindValue(':uid',$uid);
    $result = $sql->execute();
    $row = $result->fetchArray();
  
    if ($uid == $row['username']) {
        // Get group FK
        $fkgroup = $row['fk_group'];
        $sql = $db->prepare("SELECT * FROM 'group' WHERE group_id = $fkgroup");
        $result = $sql->execute();
        $group = $result->fetchArray();

        // Start sessions
        $_SESSION['userID'] = $row['user_id'];
        $_SESSION['userUID'] = $row['username'];
        $_SESSION['userMAIL'] = $row['email'];
        $_SESSION['userGRP'] = $group['group'];
        $_SESSION['userGRPID'] = $group['group_id'];
    }
}
?>
