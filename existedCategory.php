<?php
//  Connect dtb
include('../connect.php');

$Id = $_GET["id"];
$sql_Id = "select * from category where id_category='$Id'";
$kt_Id = mysqli_query($conn, $sql_Id);

//  CHECK ID 
if (mysqli_num_rows($kt_Id)  > 0) {
    echo "true";
}
