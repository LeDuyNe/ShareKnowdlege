<?php
//  Kết nối database
include('../connect.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}
// Lấy MSHH từ danh sách sang
$ID = $_GET['Id'];
$sql = "delete from category where id_category = '$ID'";
$sql_1 = "delete from course where id_category = '$ID'";
//  thực thi
mysqli_query($conn, $sql);
mysqli_query($conn, $sql_1);
//  quay lai danh sách
header('Location: /web_chiasekienthuc/manage/index.php?page_layout=category');
?>