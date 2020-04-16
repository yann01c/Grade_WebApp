<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new SQLite3('../sqlite/webapp.db');
    if(isset($_POST['login'])) {
        $username = $_POST['a-username'];
        $password = $_POST['a-password'];
    }
    if($username !== "" && $password !== "") {
        $result = $db->query("SELECT username,passwd FROM login WHERE username='$username' and passwd='$password'");
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if($row['username'] == $username && $row['passwd'] == $password) {
            echo "Logged in Successfully!";
        } else {
            echo "Invalid Login!";
        }
    }
}
?>