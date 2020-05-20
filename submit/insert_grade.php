<?php
if(isset($_POST['submit'])) {
    $grade = $_POST['s_grade'];
    $date = $_POST['s_date'];
    $weighting = $_POST['s_weighting'];
    $description = $_POST['s_description'];
    $class = $_POST['s_class'];

    if (isset($_FILES['fileToUpload']['name'])) { 
        $total_files = count($_FILES['fileToUpload']['name']);
        echo $total_files;
    }
    if (empty($grade) || empty($date) || empty($weighting)) {
        echo "<div class='submitteddiv'><p style='color:red;'>Missing Fields!</p></div>";
        exit();
    }
    else if ($weighting > 2.0 || $weighting < 0) {
        echo "<div class='submitteddiv'><p style='color:red;'>Weighting Invalid!</p></div>";
        exit();
    }
    else if ($grade > 6.0 || $grade < 0) {
        echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Grade Invalid!</p></div>";
        exit();
    }

    if (empty($_FILES['fileToUpload']['name'])) {
        $file = "No Image";
    } else {
        // File Vars
        $target_dir = "upload/";
        $ext_arrays = array("jpg", "JPG", "jpeg", "JPEG");
        for($i=0;$i<$total_files;$i++) {
            $filetype = $_FILES['fileToUpload']['type'][$i];
            $filesize = $_FILES['fileToUpload']['size'][$i];
            $file = $_FILES['fileToUpload']['name'][$i];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['fileToUpload']['tmp_name'][$i];
            $path_filename_ext = $target_dir.$filename.".".$ext;
            $maxSize = 0;
            // Check if extension is = JPG or JPEG
            if (in_array($ext, $ext_arrays, false)) {
                echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Extension Invalid!</p>";
                exit();
            }
            // Check if file already exists
            if (file_exists($path_filename_ext)) {
                echo "<div class='submitteddiv'><p class='submit-handler' style='color:blue;'>File already exists!</p></div>";
                exit();
            }
            move_uploaded_file($temp_name,$path_filename_ext);
            chmod($path_filename_ext, 0755);
        }
    }
    
    $db = new SQLite3('sqlite/webapp.db');
    $sql = $db->prepare("SELECT class_id from class WHERE class='$class'");
    $r = $sql->execute();
    $row = $r->fetchArray();
    $fkclass = $row['class_id'];
    $userID = $_SESSION['userID'];
    $sqlg = $db->prepare("INSERT INTO grade (grade,date,weighting,description,filename,fk_class,fk_user) VALUES (:grade,:date,:weighting,:des,:file,:fkclass,:userid)");
    if (!$sql) {
        echo "<div class='submitteddiv'><p class='submit-handler'style='color:orange;'>SQlite Error</p></div>";
        exit();
    } else {
        $sqlg->bindValue(':grade',$grade);
        $sqlg->bindValue(':date',$date);
        $sqlg->bindValue(':weighting',$weighting);
        $sqlg->bindValue(':des',$description);
        if (empty($file)) {
            $file = "No Image";
        } else {
            $file = $path_filename_ext;
        }
        $sqlg->bindValue(':file',$file);
        $sqlg->bindValue(':fkclass',$fkclass);
        $sqlg->bindValue(':userid',$userID);

        $result = $sqlg->execute();
        echo "<div class='submitteddiv'><p class='submit-handler'style='color:lightgreen;'>Successfully Submitted Grade!</p></div>";
        exit();
    }
}