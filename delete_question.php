<?php
//  Kết nối database
include('../connect.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}
// Lấy MSHH từ danh sách sang
$id_question = $_GET['id_question'];
$sql = "delete from contact where id_question = '$id_question'";
//  thực thi
mysqli_query($conn, $sql);
//  quay lai danh sách
header('Location: /web_chiasekienthuc/manage/index.php?page_layout=question');
?>