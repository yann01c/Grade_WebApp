<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['register'])) {
        $username = $_POST['r-username'];
        $email = $_POST['r-email'];
        $passwd = $_POST['r-password'];
        $rpasswd = $_POST['r-rpassword'];
    }
    if($passwd == $rpasswd) {
        $db = new SQLite3('../sqlite/webapp.db');
        $db->exec("INSERT INTO login (username,email,passwd,rpasswd) VALUES ('$username','$email','$passwd','$rpasswd')");
        echo "Registered";
    } else {
        alert("Password not Matching");
    }
}
?>