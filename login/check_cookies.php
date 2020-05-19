<?php
if (isset($_COOKIE['username']) && isset($_COOKIE['identifier'])) {
    $uid = $_COOKIE['username'];

    $db = new SQLite3('sqlite/webapp.db');

    $sql = $db->prepare("SELECT * FROM login WHERE username = :uid");
    $sql->bindValue(':uid',$uid);
    $result = $sql->execute();
    $row = $result->fetchArray();

    $fkgroup = $row['fk_group'];
    $sql = $db->prepare("SELECT * FROM 'group' WHERE group_id = $fkgroup");
    $result = $sql->execute();
    $group = $result->fetchArray();

    $_SESSION['userID'] = $row['user_id'];
    $_SESSION['userUID'] = $row['username'];
    $_SESSION['userMAIL'] = $row['email'];
    $_SESSION['userGRP'] = $group['group'];
    $_SESSION['userGRPID'] = $group['group_id'];

} else {
    echo "NO COOKIES FOUND";
}