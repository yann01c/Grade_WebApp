<?php
if(isset($_GET['c1-class'])) {
    $db = new SQLite3('sqlite/webapp.db');
    if (empty($_GET['c1-class'])) {
        $class1 = $_POST['c1-class'];
        $class = filter_var($class1, FILTER_SANITIZE_STRING);
    } else {
        $class1 = $_GET['c1-class'];
        $class = filter_var($class1, FILTER_SANITIZE_STRING);
    }

    echo $class;
}
?>