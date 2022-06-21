<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['content']) && !empty($_POST['title'])) {
    $txt = $_POST['content'];
    $txt = $conn->quote($txt);
    $title = $_POST['title'];
    $title = $conn->quote($title);
    if (isset($_FILES["anyfile"]) && $_FILES["anyfile"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["anyfile"]["name"];
        $filetype = $_FILES["anyfile"]["type"];
        $filesize = $_FILES["anyfile"]["size"];
        if ($filename != '') {
            // Validate file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            // Validate file size - 10MB maximum
            $maxsize = 10 * 1024 * 1024;
            if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

            // Validate type of the file
            if (in_array($filetype, $allowed)) {
                // Check whether file exists before uploading it
                if (file_exists("upload/" . $filename)) {
                    echo $filename . " is already exists.";
                } else {
                    if (move_uploaded_file($_FILES["anyfile"]["tmp_name"], "uploads/" . $filename)) {
                        $sql = "INSERT INTO images(file,type,size) VALUES('$filename','$filetype','$filesize')";
                        $conn->query($sql);
                        $lastId = $conn->lastInsertId();
                        $sql = "select * from images where img_id='$lastId'";
                        $result = $conn->query($sql);
                        $row = $result->fetchAll(PDO::FETCH_ASSOC);
                        $img = $row[0]['file'];
                        $id = $_SESSION['id'];
                        $user = $_SESSION['username'];
                        $sql = "INSERT INTO Post (`user_id`, `image`, `details`, `post_date`,`comments`, `username`,`title`,`status`) VALUES('$id','$img',$txt,now(),0,'$user',$title,'pending')";

                        $conn->query($sql);
                        header("Location: home.php");
                    } else {
                        echo "File is not uploaded";
                    }
                }
            } else {
                echo "Error: There was a problem uploading your file. Please try again.";
            }
        } else {
            echo "Error: " . $_FILES["anyfile"]["error"];
        }
    } else {
        $id = $_SESSION['id'];
        $user = $_SESSION['username'];
        $sql = "INSERT INTO Post (`user_id`, `image`, `details`, `post_date`,`comments`, `username`,`title`,`status`) VALUES('$id',NULL,$txt,now(),0,'$user',$title,'pending');";
        $conn->query($sql);
        // showPosts(1);
        header('Location: home.php');
    }
} else {
    header('Location: home.php');
    // showPosts(1); 
}
