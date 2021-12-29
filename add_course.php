<?php
//  Connect dtb
include('../connect.php');
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}
// Random ID 
function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Check form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set time zone
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $id_course = generateRandomString(5);
    $Name = $_POST["Name"];
    $Id = $_POST["Id"];
    $FileErr = "";
    // Date time post
    $datetime_update = date("Y-m-d h:i:s");
    $time_post = $_POST['time-post'];
    $date_post = $_POST['date-post'];

    $flag = 1;

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $file_type_allow = array('docx', 'pptx', 'ppt', 'doc', 'xls', 'pdf');
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    // if ($_FILES["fileToUpload"]["error"] == 4 || $_FILES["fileToUpload"]["error"] != 0) {
    //     $FileErr =  "Sorry, file must be submited";
    //     $flag = 0;
    // } else if (file_exists($target_file)) {
    //     $FileErr =  "Sorry, file already exists";
    //     $flag = 0;
    // } else if ($_FILES["fileToUpload"]["size"] > 2097152) {
    //     $FileErr =  "Sorry, your file is too large.";
    //     $flag = 0;
    // } else if (!in_array($file_type,  $file_type_allow)) {
    //     $FileErr =  "Sorry, only doc, docx, pptx, ppt and xls.";
    //     $flag = 0;
    // } else {
    //     $flag = 1 & $flag;
    //     $FileErr = "";
    // }

    // // 5. Ktra file và up vào hệ thống
    // if ($flag == 1) {
    //     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //         $flag = 1 & $flag;
    //     } else {
    //         $flag = 0;
    //         $FileErr =  "The file you just uploaded has problems";
    //     }
    // }


    // IV. Insert into mysql
    if ($flag == 1) {
        $datetime_post = $date_post . ' ' . $time_post;
        $addcourse = "
            INSERT INTO course(id_course, namecourse, id_category, time_update, time_post, file)
            VALUES (    '$id_course',
                        '$Name',
                        '$Id',
                        '$datetime_update',
                        '$datetime_post',
                        '$target_file'   
                    )";

        // thực thi câu $sql với biến conn lấy từ file connection.php
        mysqli_query($conn, $addcourse);
        $alert_success =  "Succesfullly";
        $alert_success =  "Succesfullly";
        header('location: /web_chiasekienthuc/manage/index.php?page_layout=course');
    }
}
