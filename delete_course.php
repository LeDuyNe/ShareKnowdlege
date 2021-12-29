<?php
//  Kết nối database
include('../connect.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}
// Lấy MSHH từ danh sách sang
$id_course = $_GET['id_course'];
$sql = "delete from course where id_course = '$id_course'";
//  thực thi
mysqli_query($conn, $sql);
//  quay lai danh sách
header('Location: /web_chiasekienthuc/manage/index.php?page_layout=course');
?>