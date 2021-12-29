
<?php
//  Connect dtb
include('../connect.php');

$name_course = $_GET["name_course"];
$sql_name = "select * from course where namecourse='$name_course'";
$kt_name = mysqli_query($conn, $sql_name);
$res = [ 'nameDuplicated' => false, 'ok' => false];
//  Check Id
if (mysqli_num_rows($kt_name)  > 0) {
    $res['nameDuplicated'] = true;
}

echo json_encode($res);

?>