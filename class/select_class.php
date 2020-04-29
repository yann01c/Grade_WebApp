<?php
if(isset($_POST['c1-class']) || isset($_GET['success'])) {
    $db = new SQLite3('sqlite/webapp.db');
    if (empty($_GET['success'])) {
        $class = $_POST['c1-class'];
    } else {
        $class = $_GET['success'];
    }
    echo $class;
}
?>