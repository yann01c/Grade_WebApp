<?php
    session_start();
    if(isset($_POST['delete_btn'])) {
        $gradeID = $_POST['delete_id'];
        $class = $_POST['class'];
        $userID = $_SESSION['userID'];

        $db = new SQLite3('../sqlite/webapp.db');

        $tsql = $db->prepare("SELECT timestamp FROM grade WHERE grade_id = :gid AND fk_user = :fkuser");

        $tsql->bindValue(':gid',$gradeID);
        $tsql->bindValue(':fkuser',$userID);

        $tresult = $tsql->execute();
        $row = $tresult->fetchArray();

        $date1 = $row['timestamp'];

        // Check if grade is not older than 7 days (if true, it won't delete the grade)
        if (strtotime($date1) < strtotime('-7 day')) {
            header("Location: ../class.php?c1-class=$class&old=true");
            exit();
        } else {
            $sql = $db->prepare("DELETE FROM grade WHERE grade_id = :id AND fk_user = :user");
            if(!$sql) {
                header("Location: ../class.php?error=sqlerror");
                exit();
            } else {
                // Update file_grade to prevent not matching images
                $sql->bindValue(':id',$gradeID);
                $sql->bindValue(':user',$userID);
                $result = $sql->execute();
        
                $fsql = $db->prepare("UPDATE file_grade SET fk_grade = 0 WHERE fk_grade = :gradeid");
                $fsql->bindValue(':gradeid', $gradeID);
                $fresult = $fsql->execute();
        
                header("Location: ../class.php?c1-class=$class");
                exit();
            }
        }
    } else { // When accessed manually, send user back to signup page
        header("Location: ../index.php");
        exit();
    }