<?php
//  Connect dtb
include('../connect.php');
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}

// Đặt các giá trị 
$alert_success = "";
$Id = $Name = "";
$IdErr = $NameErr = "";

// Kiểm tra form
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $Id = $_POST["Id"];
    $Name = $_POST["Name"];
   
    $addcategory = "INSERT INTO category(
                    id_category,
                    name           
                    ) VALUES (
                        '$Id',
                        '$Name'
                    )";

        // thực thi câu $sql với biến conn lấy từ file connection.php
        mysqli_query($conn, $addcategory);
        header('location: /web_chiasekienthuc/manage/index.php?page_layout=category');
    }
?>
