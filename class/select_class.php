<?php
    if(isset($_POST['c1-class']) || ($_GET['class'])) {
        $class = $_POST['c1-class'];
        if(empty($class)) {
            $class = $_GET['class'];
        }
        echo $class;
    }
?>