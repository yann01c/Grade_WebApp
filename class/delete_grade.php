<?php
    session_start();
    if(isset($_POST['delete_btn'])) {
        $gradeID = $_POST['delete_id'];
        $class = $_POST['class'];
        $userID = $_SESSION['userID'];
        echo $gradeID;
        echo $class;
        echo $userID;

        $db = new SQLite3('../sqlite/webapp.db');

        $sql = $db->prepare("DELETE FROM grade WHERE grade_id = :id AND fk_user = :user");
        if(!$sql) {
            header("Location: ../class.php?error=sqlerror");
            exit();
        } else {
            $sql->bindValue(':id',$gradeID);
            $sql->bindValue(':user',$userID);
            $result = $sql->execute();
            header("Location: ../class.php?c1-class=$class");
            exit();
            echo "DONE";
        }
    } else { // When accessed manually, send user back to signup page
        header("Location: ../index.php");
        exit();
    }