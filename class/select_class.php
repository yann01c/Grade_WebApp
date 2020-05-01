<?php
    if (empty($_GET['c1-class'])) {
        $class = $_POST['c1-class'];
    } else {
        $class = $_GET['c1-class'];
    }
    echo $class;
?>
