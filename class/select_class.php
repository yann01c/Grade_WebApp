<?php
if(isset($_GET['c1-class'])) {
    $db = new SQLite3('sqlite/webapp.db');
    if (empty($_GET['c1-class'])) {
        $class = $_POST['c1-class'];
    } else {
        $class = $_GET['c1-class'];
    }
    echo $class;
}
?>