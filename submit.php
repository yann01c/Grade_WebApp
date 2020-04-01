<?php 
    $class = $grade = $date = $weight = "";
    if( isset($_POST['submit'])){
        $class = htmlspecialchars($_POST['s1-class']);
        $grade = htmlspecialchars($_POST['s2-grade']);
        $date = htmlspecialchars($_POST['s3-date']);
        $weight = htmlspecialchars($_POST['s4-weighting']);
        echo $class;
        echo $grade; 
        echo $date; 
        echo $weight;
    }
?>